<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TanSamiti;
use App\Models\TanSamitiInstallment;
use App\Models\TanSamitiMember;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TanSamitiController extends Controller
{
    public function index()
    {
        $samitis = TanSamiti::withCount(['activeMembers', 'draws'])
            ->with('owner')
            ->latest()
            ->paginate(20);

        return view('admin.pages.tan-samiti.index', compact('samitis'));
    }

    public function create()
    {
        return view('admin.pages.tan-samiti.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'monthly_amount' => 'required|numeric|min:1',
            'total_cycles' => 'required|integer|min:2|max:500',
            'enable_lottery_draw' => 'nullable|boolean',
            'member_limit' => 'nullable|integer|min:1|max:10000',
            'start_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['enable_lottery_draw'] = $request->boolean('enable_lottery_draw');

        TanSamiti::create([
            ...$validated,
            'created_by_admin_id' => auth('admin')->id(),
        ]);

        return redirect()->route('admin.tan-samiti.index')
            ->with('success', 'Investment Plan created successfully.');
    }

    public function show(TanSamiti $tanSamiti)
    {
        $tanSamiti->load(['draws.user.profile', 'createdBy']);

        $members = $tanSamiti->activeMembers()
            ->with('user.profile')
            ->get();

        $draws = $tanSamiti->draws()->with('user.profile', 'drawnBy')->get();

        // Installments grouped by cycle
        $installmentsByCycle = $tanSamiti->installments()
            ->with('user.profile', 'memberPaymentMethod', 'completedByAdmin')
            ->orderBy('cycle_number')
            ->orderBy('user_id')
            ->get()
            ->groupBy('cycle_number');

        $allMembers = User::whereHas('profile')
            ->whereNotIn('id', $tanSamiti->members()->pluck('user_id'))
            ->orderBy('name')
            ->get();

        return view('admin.pages.tan-samiti.show', compact(
            'tanSamiti', 'members', 'draws', 'installmentsByCycle', 'allMembers'
        ));
    }

    public function edit(TanSamiti $tanSamiti)
    {
        return view('admin.pages.tan-samiti.edit', compact('tanSamiti'));
    }

    public function update(Request $request, TanSamiti $tanSamiti)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'monthly_amount' => 'required|numeric|min:1',
            'total_cycles' => 'required|integer|min:2|max:500',
            'enable_lottery_draw' => 'nullable|boolean',
            'member_limit' => 'nullable|integer|min:1|max:10000',
            'start_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['enable_lottery_draw'] = $request->boolean('enable_lottery_draw');

        if ($tanSamiti->hasMemberLimit() || $request->filled('member_limit')) {
            $activeCount = $tanSamiti->activeMembers()->count();
            if ($request->filled('member_limit') && (int) $request->input('member_limit') < $activeCount) {
                return back()->withInput()->with('error', "Member limit cannot be less than the current active member count ({$activeCount}).");
            }
        }

        $tanSamiti->update($validated);

        $tanSamiti->refresh()->regenerateInstallmentsForAllActiveMembers();

        return redirect()->route('admin.tan-samiti.show', $tanSamiti)
            ->with('success', 'Investment Plan updated successfully.');
    }

    public function destroy(TanSamiti $tanSamiti)
    {
        $tanSamiti->delete();

        return redirect()->route('admin.tan-samiti.index')
            ->with('success', 'Investment Plan deleted successfully.');
    }

    public function addMember(Request $request, TanSamiti $tanSamiti)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        if ($tanSamiti->isFull()) {
            return back()->with('error', "Member limit reached ({$tanSamiti->member_limit}). Cannot add more members.");
        }

        $exists = $tanSamiti->members()->where('user_id', $request->user_id)->exists();

        if ($exists) {
            return back()->with('error', 'This member has already joined this Investment Plan.');
        }

        $tanSamiti->members()->create([
            'user_id' => $request->user_id,
            'status' => 'active',
            'joined_at' => now(),
        ]);

        $tanSamiti->generateInstallmentsForUser((int) $request->user_id);

        return back()->with('success', 'Member added and installments generated successfully.');
    }

    public function removeMember(TanSamiti $tanSamiti, TanSamitiMember $member)
    {
        if ($member->tan_samiti_id !== $tanSamiti->id) {
            abort(403);
        }

        $member->update(['status' => 'inactive']);

        return back()->with('success', 'Member removed from Tan Samiti.');
    }

    public function paymentRequests(Request $request)
    {
        $query = TanSamitiInstallment::with(['user.profile', 'tanSamiti', 'memberPaymentMethod'])
            ->latest('updated_at');

        // Status filter — default to submitted (awaiting approval)
        switch ($request->input('status', 'submitted')) {
            case 'submitted':
                $query->where('status', 'pending')
                    ->whereNotNull('member_submitted_at')
                    ->whereNull('rejected_at');
                break;
            case 'completed':
                $query->where('status', 'completed');
                break;
            case 'rejected':
                $query->whereNotNull('rejected_at');
                break;
            case 'pending':
                $query->where('status', 'pending')
                    ->whereNull('member_submitted_at')
                    ->whereNull('rejected_at');
                break;
            case 'overdue':
                $query->where('status', 'pending')
                    ->where('due_date', '<', now()->startOfDay());
                break;
            default:
                // All — no filter
                break;
        }

        // Samiti filter
        if ($request->filled('samiti_id')) {
            $query->where('tan_samiti_id', $request->input('samiti_id'));
        }

        // User search
        if ($request->filled('user')) {
            $search = $request->input('user');
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"));
        }

        // Date range (due_date)
        if ($request->filled('date_from')) {
            $query->where('due_date', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->where('due_date', '<=', $request->input('date_to'));
        }

        $requests = $query->paginate(20)->withQueryString();
        $samitis = TanSamiti::orderBy('name')->get(['id', 'name']);

        return view('admin.pages.tan-samiti.payment-requests', compact('requests', 'samitis'));
    }

    public function approveInstallment(Request $request, TanSamitiInstallment $installment): RedirectResponse
    {
        if ($installment->isCompleted()) {
            return back()->with('error', 'Installment is already completed.');
        }

        $installment->update([
            'status' => 'completed',
            'paid_at' => now(),
            'completed_by_admin_id' => auth('admin')->id(),
            'note' => $request->input('note'),
        ]);

        return back()->with('success', 'Payment approved successfully.');
    }

    public function rejectInstallment(Request $request, TanSamitiInstallment $installment): RedirectResponse
    {
        $installment->update([
            'member_payment_method_id' => null,
            'member_txn_id' => null,
            'member_proof_path' => null,
            'member_submitted_at' => null,
            'rejected_at' => now(),
            'rejected_by_admin_id' => auth('admin')->id(),
            'rejection_reason' => $request->input('rejection_reason'),
            'note' => $request->input('note'),
        ]);

        return back()->with('success', 'Payment rejected.');
    }
}

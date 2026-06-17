<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MembersExport;
use App\Http\Controllers\Controller;
use App\Mail\MemberWelcome;
use App\Models\MembershipCategory;
use App\Models\MembershipInstallment;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegisteredMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['profile.membershipCategory']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('profile', function ($profileQuery) use ($search) {
                        $profileQuery->where('mobile', 'like', "%{$search}%")
                            ->orWhere('nid_passport', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by membership category
        if ($request->filled('category')) {
            $query->whereHas('profile', function ($profileQuery) use ($request) {
                $profileQuery->where('membership_category_id', $request->category);
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);
        $categories = MembershipCategory::all();

        return view('admin.pages.registered-members.index', compact('users', 'categories'));
    }

    public function export(Request $request)
    {
        $filename = 'registered-members-'.now()->format('Y-m-d-His').'.xlsx';

        return Excel::download(
            new MembersExport($request->input('category'), $request->input('search')),
            $filename
        );
    }

    public function create()
    {
        $categories = MembershipCategory::all();

        return view('admin.pages.registered-members.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = MembershipCategory::findOrFail($request->membership_category_id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|max:20|unique:user_profiles,mobile',
            'date_of_birth' => 'required|date|before:today',
            'nid_passport' => 'required|string|max:255',
            'profession_organization' => 'required|string|max:255',
            'address' => 'required|string',
            'membership_category_id' => 'required|exists:membership_categories,id',
        ];

        if ($category->duration !== 'Lifetime') {
            $rules['subscription_period'] = 'required|integer|min:1';
        }

        $validated = $request->validate($rules);

        // Generate 6-digit random password
        $password = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        try {
            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($password),
            ]);

            // Calculate membership dates
            $startAt = now();
            $subscriptionPeriod = (int) ($request->subscription_period ?? 0);

            if ($category->duration === 'Monthly') {
                $endAt = $startAt->copy()->addMonths($subscriptionPeriod);
            } elseif ($category->duration === 'Yearly') {
                $endAt = $startAt->copy()->addYears($subscriptionPeriod);
            } else {
                $endAt = $startAt->copy()->addYears(20);
            }

            // Create user profile
            $profile = UserProfile::create([
                'user_id' => $user->id,
                'date_of_birth' => $validated['date_of_birth'],
                'nid_passport' => $validated['nid_passport'],
                'profession_organization' => $validated['profession_organization'],
                'mobile' => $validated['mobile'],
                'address' => $validated['address'],
                'membership_category_id' => $validated['membership_category_id'],
                'membership_start_at' => $startAt,
                'membership_end_at' => $endAt,
            ]);

            // Generate installments
            if ($category->duration === 'Monthly') {
                for ($i = 0; $i < $subscriptionPeriod; $i++) {
                    MembershipInstallment::create([
                        'user_id'            => $user->id,
                        'user_profile_id'    => $profile->id,
                        'installment_number' => $i + 1,
                        'due_date'           => $startAt->copy()->addMonths($i)->toDateString(),
                        'amount'             => $category->installment_price,
                    ]);
                }
            } elseif ($category->duration === 'Yearly') {
                for ($i = 0; $i < $subscriptionPeriod; $i++) {
                    MembershipInstallment::create([
                        'user_id'            => $user->id,
                        'user_profile_id'    => $profile->id,
                        'installment_number' => $i + 1,
                        'due_date'           => $startAt->copy()->addYears($i)->toDateString(),
                        'amount'             => $category->installment_price,
                    ]);
                }
            }
            // Lifetime: no installments

            // Send welcome email
            Mail::to($user->email)->send(new MemberWelcome($user, $password));

            DB::commit();

            return redirect()->route('admin.registered-members.index')
                ->with('success', 'Member created successfully and welcome email sent.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create member: '.$e->getMessage()]);
        }
    }

    public function show(string $id)
    {
        $user = User::with([
            'profile.membershipCategory',
            'profile.installments.completedByAdmin',
        ])->findOrFail($id);

        return view('admin.pages.registered-members.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::with('profile')->findOrFail($id);
        $categories = MembershipCategory::all();

        return view('admin.pages.registered-members.edit', compact('user', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::with('profile')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile' => 'required|string|max:20|unique:user_profiles,mobile,'.$user->profile->id,
            'date_of_birth' => 'required|date|before:today',
            'nid_passport' => 'required|string|max:255',
            'profession_organization' => 'required|string|max:255',
            'address' => 'required|string',
            'membership_category_id' => 'required|exists:membership_categories,id',
            'manual_member_id' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Update user
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Update user profile
            $user->profile->update([
                'date_of_birth' => $validated['date_of_birth'],
                'nid_passport' => $validated['nid_passport'],
                'profession_organization' => $validated['profession_organization'],
                'mobile' => $validated['mobile'],
                'address' => $validated['address'],
                'membership_category_id' => $validated['membership_category_id'],
                'manual_member_id' => $validated['manual_member_id'] ?: null,
            ]);

            DB::commit();

            return redirect()->route('admin.registered-members.index')
                ->with('success', 'Member updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update member: '.$e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete(); // Cascade delete will remove profile automatically

        return redirect()->route('admin.registered-members.index')
            ->with('success', 'Member deleted successfully.');
    }

    public function impersonate(string $id)
    {
        $user = User::findOrFail($id);

        // Store admin ID in session so we can return later
        session()->put('impersonating_admin_id', Auth::guard('admin')->id());

        // Log in as the member using the web guard
        Auth::guard('web')->login($user);

        return redirect()->route('member.dashboard');
    }

    public function extendMembership(Request $request, string $id)
    {
        $user = User::with(['profile.membershipCategory', 'profile.installments'])->findOrFail($id);
        $profile = $user->profile;

        if (! $profile || ! $profile->membership_end_at) {
            return redirect()->route('admin.registered-members.show', $id)
                ->with('error', 'This member does not have an active membership period.');
        }

        $validated = $request->validate([
            'new_end_date' => [
                'required',
                'date',
                'after:' . $profile->membership_end_at->toDateString(),
            ],
        ]);

        $newEndDate  = Carbon::parse($validated['new_end_date'])->endOfDay();
        $oldEndDate  = $profile->membership_end_at->copy();
        $category    = $profile->membershipCategory;
        $lastNumber  = $profile->installments->max('installment_number') ?? 0;

        $newInstallments = [];

        if ($category->duration === 'Lifetime') {
            // Single installment at the start of the extension (lifetime has no recurring fee)
            // No new installments for lifetime extensions
        } elseif ($category->duration === 'Yearly') {
            // Yearly installments from old end date up to new end date
            $current = $oldEndDate->copy()->startOfDay();
            $i = 1;
            while ($current->lte($newEndDate)) {
                $newInstallments[] = [
                    'user_id'            => $user->id,
                    'user_profile_id'    => $profile->id,
                    'installment_number' => $lastNumber + $i,
                    'due_date'           => $current->toDateString(),
                    'amount'             => $category->installment_price,
                ];
                $current->addYear();
                $i++;
            }
        } else {
            // Monthly installments from old end date up to (but not exceeding) new end date
            $current = $oldEndDate->copy()->startOfDay();
            $i = 1;
            while ($current->lte($newEndDate)) {
                $newInstallments[] = [
                    'user_id'            => $user->id,
                    'user_profile_id'    => $profile->id,
                    'installment_number' => $lastNumber + $i,
                    'due_date'           => $current->toDateString(),
                    'amount'             => $category->installment_price,
                ];
                $current->addMonth();
                $i++;
            }
        }

        DB::transaction(function () use ($profile, $newEndDate, $newInstallments) {
            $profile->update(['membership_end_at' => $newEndDate]);
            foreach ($newInstallments as $installment) {
                MembershipInstallment::create($installment);
            }
        });

        $count = count($newInstallments);

        return redirect()->route('admin.registered-members.show', $id)
            ->with('success', "Membership extended to {$newEndDate->format('d M Y')}. {$count} new installment(s) added.");
    }

    public function suspend(Request $request, $id)
    {
        $request->validate([
            'suspension_reason' => 'required|string|max:1000',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'suspended_at'          => now(),
            'suspension_reason'     => $request->suspension_reason,
            'suspended_by_admin_id' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.registered-members.show', $id)
            ->with('success', "Member \"{$user->name}\" has been suspended.");
    }

    public function unsuspend($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'suspended_at'          => null,
            'suspension_reason'     => null,
            'suspended_by_admin_id' => null,
        ]);

        return redirect()->route('admin.registered-members.show', $id)
            ->with('success', "Member \"{$user->name}\" suspension has been lifted.");
    }

    public function downloadQrCode(string $id)
    {
        $user = User::findOrFail($id);

        $profileUrl = route('member.profile', $user->id);

        $qrCode = QrCode::format('svg')
            ->size(300)
            ->margin(1)
            ->errorCorrection('H')
            ->generate($profileUrl);

        $fileName = 'qr-' . str_replace(' ', '_', $user->name) . '-' . $user->id . '.svg';

        return response($qrCode, 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}

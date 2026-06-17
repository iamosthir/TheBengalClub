<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationReceived;
use App\Models\Invitation;
use App\Models\MembershipApplication;
use App\Models\MembershipCategory;
use App\Models\PaymentMethod;
use App\Models\SiteSetting;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MembershipApplicationController extends Controller
{
    /**
     * Show the membership application form
     */
    public function showForm(Request $request)
    {
        // Fetch only public membership categories (filter out invite-only)
        $membershipCategories = MembershipCategory::where('is_invite_only', false)->get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        // Get pre-selected category from query string
        $selectedCategoryId = $request->query('category');

        return view('frontend.pages.membership-application', compact('membershipCategories', 'selectedCategoryId', 'paymentMethods'));
    }

    /**
     * Submit membership application
     */
    public function submit(Request $request)
    {
        // Get client IP address
        $ipAddress = $request->ip();

        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'date_of_birth' => 'required|date|before:today',
            'nid_passport' => 'required|string|max:50',
            'profession_organization' => 'required|string|max:500',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:1000',
            'reference' => 'nullable|string|max:500',
            'membership_category_id' => 'required|exists:membership_categories,id',
            'nid_photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'transaction_id' => 'required|string|max:255',
            'payment_proof' => 'required|image|mimes:png,jpg,jpeg|max:5120',
            'is_tos_accepted' => 'required|accepted',
        ]);

        // Check if selected category is invite-only
        $category = MembershipCategory::find($validated['membership_category_id']);
        if ($category && $category->is_invite_only) {
            return response()->json([
                'success' => false,
                'message' => 'This membership category is invite-only and cannot be applied for directly.',
                'errors' => [
                    'membership_category_id' => ['This membership category is invite-only.']
                ]
            ], 422);
        }

        // Check if email already exists in users table
        $existingUser = User::where('email', $validated['email'])->first();
        if ($existingUser) {
            return response()->json([
                'success' => false,
                'message' => 'The email is already registered.',
                'errors' => [
                    'email' => ['The email is already registered.']
                ]
            ], 422);
        }

        // Check for existing applications
        $existingByEmail = MembershipApplication::where('email', $validated['email'])
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        $existingByMobile = MembershipApplication::where('mobile', $validated['mobile'])
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        if ($existingByEmail || $existingByMobile) {
            return response()->json([
                'success' => false,
                'message' => 'You already have a pending or accepted application with this email or mobile number.',
                'errors' => [
                    'email' => $existingByEmail ? ['An application with this email already exists.'] : [],
                    'mobile' => $existingByMobile ? ['An application with this mobile number already exists.'] : [],
                ]
            ], 422);
        }

        try {
            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('application-photos', 'public');
            }

            // Handle NID / passport photo upload
            $nidPhotoPath = null;
            if ($request->hasFile('nid_photo')) {
                $nidPhotoPath = $request->file('nid_photo')->store('nid-photos', 'public');
            }

            // Handle payment proof upload
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');
            }

            // Create membership application
            $application = MembershipApplication::create([
                'name' => $validated['name'],
                'photo' => $photoPath,
                'date_of_birth' => $validated['date_of_birth'],
                'nid_passport' => $validated['nid_passport'],
                'profession_organization' => $validated['profession_organization'],
                'mobile' => $validated['mobile'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'reference' => $validated['reference'] ?? null,
                'membership_category_id' => $validated['membership_category_id'],
                'nid_photo' => $nidPhotoPath,
                'payment_method_id' => $validated['payment_method_id'],
                'transaction_id' => $validated['transaction_id'],
                'payment_proof_path' => $paymentProofPath,
                'is_tos_accepted' => true,
                'ip_address' => $ipAddress,
                'status' => 'pending',
            ]);

            $pdfUrl = route('membership.application.pdf', $application->id);

            // Send confirmation email
            $application->load('membershipCategory');
            Mail::to($application->email)->send(new ApplicationReceived($application, $pdfUrl));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for applying! Your application has been submitted successfully. We will review and contact you soon.',
                'application_id' => $application->id,
                'pdf_url' => $pdfUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again later.'
            ], 500);
        }
    }

    /**
     * Show the invite-based membership application form
     */
    public function showInviteForm(string $inviteId)
    {
        $invitation = Invitation::with('membershipCategory')
            ->where('invite_id', $inviteId)
            ->firstOrFail();

        if ($invitation->is_used) {
            abort(410, 'This invitation has already been used.');
        }

        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        return view('frontend.pages.invited-application', compact('invitation', 'paymentMethods'));
    }

    /**
     * Submit invite-based membership application
     */
    public function submitInvite(Request $request, string $inviteId)
    {
        $invitation = Invitation::with('membershipCategory')
            ->where('invite_id', $inviteId)
            ->firstOrFail();

        if ($invitation->is_used) {
            return response()->json([
                'success' => false,
                'message' => 'This invitation has already been used.',
            ], 422);
        }

        $ipAddress = $request->ip();

        $validated = $request->validate([
            'name'                    => 'required|string|max:255',
            'photo'                   => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'date_of_birth'           => 'required|date|before:today',
            'nid_passport'            => 'required|string|max:50',
            'profession_organization' => 'required|string|max:500',
            'mobile'                  => 'required|string|max:20',
            'address'                 => 'required|string|max:1000',
            'reference'               => 'nullable|string|max:500',
            'nid_photo'               => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'payment_method_id'       => 'required|exists:payment_methods,id',
            'transaction_id'          => 'required|string|max:255',
            'payment_proof'           => 'required|image|mimes:png,jpg,jpeg|max:5120',
            'is_tos_accepted'         => 'required|accepted',
        ]);

        // Use the locked values from the invitation
        $email = $invitation->email;
        $membershipCategoryId = $invitation->membership_category_id;

        // Check if email already exists in users table
        if (User::where('email', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already registered as a member.',
                'errors'  => ['email' => ['This email is already registered as a member.']],
            ], 422);
        }

        // Check for existing pending/accepted applications
        $existingByEmail = MembershipApplication::where('email', $email)
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        $existingByMobile = MembershipApplication::where('mobile', $validated['mobile'])
            ->whereIn('status', ['pending', 'accepted'])
            ->first();

        if ($existingByEmail || $existingByMobile) {
            return response()->json([
                'success' => false,
                'message' => 'An application with this email or mobile already exists.',
                'errors'  => [
                    'mobile' => $existingByMobile ? ['An application with this mobile number already exists.'] : [],
                ],
            ], 422);
        }

        try {
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('application-photos', 'public');
            }

            $nidPhotoPath = null;
            if ($request->hasFile('nid_photo')) {
                $nidPhotoPath = $request->file('nid_photo')->store('nid-photos', 'public');
            }

            $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

            $application = MembershipApplication::create([
                'name'                    => $validated['name'],
                'photo'                   => $photoPath,
                'date_of_birth'           => $validated['date_of_birth'],
                'nid_passport'            => $validated['nid_passport'],
                'profession_organization' => $validated['profession_organization'],
                'mobile'                  => $validated['mobile'],
                'email'                   => $email,
                'address'                 => $validated['address'],
                'reference'               => $validated['reference'] ?? null,
                'membership_category_id'  => $membershipCategoryId,
                'nid_photo'               => $nidPhotoPath,
                'payment_method_id'       => $validated['payment_method_id'],
                'transaction_id'          => $validated['transaction_id'],
                'payment_proof_path'      => $paymentProofPath,
                'is_tos_accepted'         => true,
                'ip_address'              => $ipAddress,
                'status'                  => 'pending',
                'invite_id'               => $inviteId,
            ]);

            // Mark invitation as used
            $invitation->update(['is_used' => true]);

            $pdfUrl = route('membership.application.pdf', $application->id);

            $application->load('membershipCategory');
            Mail::to($application->email)->send(new ApplicationReceived($application, $pdfUrl));

            return response()->json([
                'success'        => true,
                'message'        => 'Thank you for applying! Your application has been submitted successfully. We will review and contact you soon.',
                'application_id' => $application->id,
                'pdf_url'        => $pdfUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again later.',
            ], 500);
        }
    }

    /**
     * Download membership application as PDF
     */
    public function downloadPdf(MembershipApplication $application)
    {
        $application->load('membershipCategory');
        $settings = SiteSetting::getSettings();

        $pdf = Pdf::loadView('pdf.membership-application', [
            'application' => $application,
            'settings' => $settings,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('membership-application-' . $application->id . '.pdf');
    }
}

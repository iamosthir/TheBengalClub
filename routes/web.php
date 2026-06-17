<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BoardDirectorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventRegistrationController as AdminEventRegistrationController;
use App\Http\Controllers\Frontend\EventRegistrationController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MembershipApplicationController as AdminMembershipApplicationController;
use App\Http\Controllers\Admin\MembershipCategoryController;
use App\Http\Controllers\Admin\MembershipInstallmentController;
use App\Http\Controllers\Admin\RegisteredMemberController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SlideshowBannerController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PaymentRequestController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\Frontend\MemberInstallmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MembershipApplicationController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\ForgotPasswordController;
use App\Http\Controllers\Frontend\MemberDashboardController;
use App\Http\Controllers\Frontend\MemberProfileController;
use App\Http\Controllers\Frontend\HonoraryMemberController;
use App\Http\Controllers\Frontend\DonationController;
use App\Http\Controllers\Frontend\PaymentLinkController;
use App\Http\Controllers\Admin\PaymentLinkController as AdminPaymentLinkController;
use App\Http\Controllers\Admin\HonoraryMemberController as AdminHonoraryMemberController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\DonationCategoryController as AdminDonationCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\DonationReportController;
use App\Http\Controllers\Admin\TanSamitiController as AdminTanSamitiController;
use App\Http\Controllers\Admin\TanSamitiDrawController;
use App\Http\Controllers\Frontend\TanSamitiController as FrontendTanSamitiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Artisan;

// System routes
Route::get("/storage-link",function(){
    Artisan::call("storage:link");
    return "Storage link created successfully.";
});

Route::get("/run-migrations",function(){
    Artisan::call("migrate", ["--force" => true]);
    return "<pre>" . Artisan::output() . "</pre>";
});

// Shop Routes (public)
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/order/{order}/success', [ShopController::class, 'orderSuccess'])->name('shop.order.success');
Route::get('/shop/{product}/order', [ShopController::class, 'orderForm'])->name('shop.order');
Route::post('/shop/{product}/order', [ShopController::class, 'placeOrder'])->name('shop.order.place');

// Frontend Routes
Route::get("/", [FrontEndController::class, 'index'])->name('frontend.index');
Route::get("/events/{event}", [FrontEndController::class, 'eventDetails'])->name('frontend.events.show');
Route::post("/events/{event}/register", [EventRegistrationController::class, 'store'])->name('frontend.events.register');
Route::get("/certification", [FrontEndController::class, 'certification'])->name('frontend.certification');
Route::get("/certification/pdf", [FrontEndController::class, 'showCertificatePdf'])->name('frontend.certification.pdf');

// Honorary Members
Route::get('/honorary-members', [HonoraryMemberController::class, 'index'])->name('honorary-members');

// Donations
Route::get('/donate', [DonationController::class, 'index'])->name('donate');
Route::post('/donate', [DonationController::class, 'submit'])->name('donate.submit');

// Public Payment Links
Route::get('/pay/{token}', [PaymentLinkController::class, 'show'])->name('payment-link.show');
Route::post('/pay/{token}', [PaymentLinkController::class, 'submit'])->name('payment-link.submit');

// Invite Landing Page
Route::get('/invites/{inviteId}', [MembershipApplicationController::class, 'showInviteForm'])->name('invites.show');
Route::post('/invites/{inviteId}', [MembershipApplicationController::class, 'submitInvite'])->name('invites.submit');

// Contact Form Submission
Route::post("/contact/submit", [ContactController::class, 'submit'])->name('contact.submit');

// Membership Application Routes
Route::get('/membership/apply', [MembershipApplicationController::class, 'showForm'])->name('membership.application.form');
Route::post('/membership/apply', [MembershipApplicationController::class, 'submit'])->name('membership.application.submit');
Route::get('/membership/application/{application}/pdf', [MembershipApplicationController::class, 'downloadPdf'])->name('membership.application.pdf');

// Member Authentication Routes
Route::prefix('member')->name('member.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login']);
        Route::get('forgot-password', [ForgotPasswordController::class, 'showForm'])->name('forgot-password');
        Route::post('forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('forgot-password.send-otp');
        Route::post('forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot-password.verify-otp');
        Route::post('forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot-password.reset');
    });
    Route::middleware(['auth', 'member.not-suspended'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        Route::get('payments', [MemberDashboardController::class, 'paymentTimeline'])->name('payments');
        Route::post('dashboard/update-profile', [MemberDashboardController::class, 'updateProfile'])->name('dashboard.update-profile');
        Route::post('dashboard/update-email', [MemberDashboardController::class, 'updateEmail'])->name('dashboard.update-email');
        Route::post('dashboard/update-password', [MemberDashboardController::class, 'updatePassword'])->name('dashboard.update-password');
        Route::post('stop-impersonating', [AuthController::class, 'stopImpersonating'])->name('stop-impersonating');
        Route::post('installments/{installment}/submit-payment', [MemberInstallmentController::class, 'submitPayment'])->name('installments.submit-payment');
        Route::post('donate', [MemberInstallmentController::class, 'donate'])->name('donate');
        Route::get('orders', [ShopController::class, 'myOrders'])->name('orders');

        // Tan Samiti Routes
        Route::get('tan-samiti', [FrontendTanSamitiController::class, 'index'])->name('tan-samiti.index');
        Route::get('tan-samiti/create', [FrontendTanSamitiController::class, 'createOwn'])->name('tan-samiti.create');
        Route::post('tan-samiti', [FrontendTanSamitiController::class, 'storeOwn'])->name('tan-samiti.store');
        Route::get('tan-samiti/{tanSamiti}', [FrontendTanSamitiController::class, 'show'])->name('tan-samiti.show');
        Route::post('tan-samiti/{tanSamiti}/join', [FrontendTanSamitiController::class, 'join'])->name('tan-samiti.join');
        Route::get('tan-samiti/{tanSamiti}/agreement-pdf', [FrontendTanSamitiController::class, 'agreementPdf'])->name('tan-samiti.agreement-pdf');
        Route::post('tan-samiti-installments/{installment}/submit-payment', [FrontendTanSamitiController::class, 'submitPayment'])->name('tan-samiti.installments.submit-payment');
    });
});

// Member Search
Route::get('/member-search', [MemberProfileController::class, 'search'])->name('member.search');

// Member Profile Routes (must be after /member auth routes to avoid wildcard conflicts)
Route::get('/member/{userId}', [MemberProfileController::class, 'show'])->name('member.profile')->where('userId', '[0-9]+');
Route::get('/member/{userId}/qr-code', [MemberProfileController::class, 'qrCode'])->name('member.qr-code')->where('userId', '[0-9]+');
Route::get('/member/{userId}/vcard', [MemberProfileController::class, 'downloadVCard'])->name('member.vcard')->where('userId', '[0-9]+');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login']);
    });

    // Redirect /admin to dashboard (which will redirect to login if not authenticated)
    Route::get('/', fn () => redirect()->route('admin.dashboard'));

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Admin Management Routes
        Route::resource('admins', AdminController::class);

        // Slideshow Banner Routes
        Route::resource('slideshow-banner', SlideshowBannerController::class);

        // Board Directors Routes
        Route::resource('board-directors', BoardDirectorController::class);

        // Facilities Routes
        Route::resource('facilities', FacilityController::class);

        // Membership Categories Routes
        Route::resource('membership-categories', MembershipCategoryController::class);

        // Archive Routes
        Route::resource('archive', ArchiveController::class)->except(['show']);

        // Events Routes
        Route::delete('events/{event}/gallery-image', [EventController::class, 'destroyGalleryImage'])->name('events.gallery-image.destroy');
        Route::resource('events', EventController::class);

        // Event Registrations Routes
        Route::prefix('events/{event}/registrations')->name('event-registrations.')->group(function () {
            Route::get('/', [AdminEventRegistrationController::class, 'index'])->name('index');
            Route::get('/{registration}', [AdminEventRegistrationController::class, 'show'])->name('show');
            Route::post('/{registration}/approve', [AdminEventRegistrationController::class, 'approve'])->name('approve');
            Route::post('/{registration}/cancel', [AdminEventRegistrationController::class, 'cancel'])->name('cancel');
        });

        // Registered Members Routes
        Route::get('registered-members/export', [RegisteredMemberController::class, 'export'])->name('registered-members.export');
        Route::resource('registered-members', RegisteredMemberController::class);
        Route::post('registered-members/{id}/impersonate', [RegisteredMemberController::class, 'impersonate'])->name('registered-members.impersonate');
        Route::post('registered-members/{id}/extend-membership', [RegisteredMemberController::class, 'extendMembership'])->name('registered-members.extend-membership');
        Route::post('registered-members/{id}/suspend', [RegisteredMemberController::class, 'suspend'])->name('registered-members.suspend');
        Route::post('registered-members/{id}/unsuspend', [RegisteredMemberController::class, 'unsuspend'])->name('registered-members.unsuspend');
        Route::get('registered-members/{id}/download-qr', [RegisteredMemberController::class, 'downloadQrCode'])->name('registered-members.download-qr');

        // Announcements Routes
        Route::resource('announcements', AnnouncementController::class)->except(['show']);

        // Products Routes
        Route::resource('products', ProductController::class)->except(['show']);

        // Orders Routes
        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

        // Payment Methods Routes
        Route::resource('payment-methods', PaymentMethodController::class)->except(['show']);

        // Payment Requests Routes
        Route::prefix('payment-requests')->name('payment-requests.')->group(function () {
            Route::get('/', [PaymentRequestController::class, 'index'])->name('index');
            Route::post('/{installment}/approve', [PaymentRequestController::class, 'approve'])->name('approve');
            Route::post('/{installment}/reject', [PaymentRequestController::class, 'reject'])->name('reject');
            Route::delete('/{installment}', [PaymentRequestController::class, 'destroy'])->name('destroy');
        });

        // Payment Links Routes
        Route::post('payment-links/{paymentLink}/verify', [AdminPaymentLinkController::class, 'verify'])->name('payment-links.verify');
        Route::post('payment-links/{paymentLink}/cancel', [AdminPaymentLinkController::class, 'cancel'])->name('payment-links.cancel');
        Route::resource('payment-links', AdminPaymentLinkController::class)->except(['edit', 'update']);

        // Honorary Members Routes
        Route::resource('honorary-members', AdminHonoraryMemberController::class)->except(['show']);

        // Donations Routes
        Route::get('donations', [AdminDonationController::class, 'index'])->name('donations.index');
        Route::get('donations/{donation}', [AdminDonationController::class, 'show'])->name('donations.show');
        Route::post('donations/{donation}/update-status', [AdminDonationController::class, 'updateStatus'])->name('donations.update-status');
        Route::delete('donations/{donation}', [AdminDonationController::class, 'destroy'])->name('donations.destroy');

        // Donation Categories Routes
        Route::resource('donation-categories', AdminDonationCategoryController::class)->except(['show']);

        // Expenses Routes
        Route::resource('expenses', ExpenseController::class)->except(['show']);

        // Donation Report
        Route::get('donation-report', [DonationReportController::class, 'index'])->name('donation-report.index');

        // About Us Routes
        Route::get('about-us', [AboutUsController::class, 'edit'])->name('about-us.edit');
        Route::put('about-us', [AboutUsController::class, 'update'])->name('about-us.update');

        // Vision & Mission Routes
        Route::get('vision-mission', [VisionMissionController::class, 'edit'])->name('vision-mission.edit');
        Route::put('vision-mission', [VisionMissionController::class, 'update'])->name('vision-mission.update');

        // Site Settings Routes
        Route::get('site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
        Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

        // SEO Settings Routes
        Route::get('seo-settings', [SeoSettingController::class, 'edit'])->name('seo-settings.edit');
        Route::put('seo-settings', [SeoSettingController::class, 'update'])->name('seo-settings.update');

        // Inquiries Routes
        Route::prefix('inquiries')->name('inquiries.')->group(function () {
            Route::get('/', [InquiryController::class, 'index'])->name('index');
            Route::get('/{inquiry}', [InquiryController::class, 'show'])->name('show');
            Route::delete('/{inquiry}', [InquiryController::class, 'destroy'])->name('destroy');
            Route::post('/{inquiry}/mark-viewed', [InquiryController::class, 'markAsViewed'])->name('mark-viewed');
            Route::post('/{inquiry}/mark-unread', [InquiryController::class, 'markAsUnread'])->name('mark-unread');
            Route::post('/bulk-delete', [InquiryController::class, 'bulkDelete'])->name('bulk-delete');
            Route::get('/unread/count', [InquiryController::class, 'getUnreadCount'])->name('unread-count');
        });

        // Invitation Routes
        Route::get('invitations', [InvitationController::class, 'index'])->name('invitations.index');
        Route::post('invitations/send', [InvitationController::class, 'send'])->name('invitations.send');
        Route::delete('invitations/{invitation}', [InvitationController::class, 'destroy'])->name('invitations.destroy');

        // Tan Samiti Routes
        Route::resource('tan-samiti', AdminTanSamitiController::class);
        Route::post('tan-samiti/{tanSamiti}/add-member', [AdminTanSamitiController::class, 'addMember'])->name('tan-samiti.add-member');
        Route::delete('tan-samiti/{tanSamiti}/members/{member}', [AdminTanSamitiController::class, 'removeMember'])->name('tan-samiti.remove-member');
        Route::get('tan-samiti-payment-requests', [AdminTanSamitiController::class, 'paymentRequests'])->name('tan-samiti.payment-requests');
        Route::post('tan-samiti/installments/{installment}/approve', [AdminTanSamitiController::class, 'approveInstallment'])->name('tan-samiti.approve-installment');
        Route::post('tan-samiti/installments/{installment}/reject', [AdminTanSamitiController::class, 'rejectInstallment'])->name('tan-samiti.reject-installment');
        // Tan Samiti Draw Routes
        Route::get('tan-samiti/{tanSamiti}/draw', [TanSamitiDrawController::class, 'show'])->name('tan-samiti.draw.show');
        Route::post('tan-samiti/{tanSamiti}/draw/spin', [TanSamitiDrawController::class, 'spin'])->name('tan-samiti.draw.spin');
        Route::post('tan-samiti/{tanSamiti}/draw/confirm', [TanSamitiDrawController::class, 'confirm'])->name('tan-samiti.draw.confirm');

        // Membership Installments Routes
        Route::patch(
            'membership-installments/{installment}',
            [MembershipInstallmentController::class, 'update']
        )->name('membership-installments.update');

        // Membership Applications Routes
        Route::prefix('membership-applications')->name('membership-applications.')->group(function () {
            Route::get('/', [AdminMembershipApplicationController::class, 'index'])->name('index');
            Route::get('/{membershipApplication}', [AdminMembershipApplicationController::class, 'show'])->name('show');
            Route::post('/{membershipApplication}/update-status', [AdminMembershipApplicationController::class, 'updateStatus'])->name('update-status');
            Route::post('/{membershipApplication}/verify-payment', [AdminMembershipApplicationController::class, 'verifyPayment'])->name('verify-payment');
            Route::delete('/{membershipApplication}', [AdminMembershipApplicationController::class, 'destroy'])->name('destroy');
            Route::get('/pending/count', [AdminMembershipApplicationController::class, 'getPendingCount'])->name('pending-count');
        });
    });
});




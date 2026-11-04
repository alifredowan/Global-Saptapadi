<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FamilyRepresentativeController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    $featuredCandidates = \App\Models\User::with(['profile', 'kundli'])
        ->whereIn('role', ['groom', 'bride'])
        ->where('status', 'active')
        ->take(4)
        ->get();

    return view('welcome', compact('featuredCandidates'));
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Language forced to English
Route::get('/language/{lang}', function () {
    session(['locale' => 'en']);
    return back();
})->name('language.switch');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/demo-login', [AuthController::class, 'demoLogin'])->name('demo.login');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Role-Specific Dashboards (Opened from Sidebar)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/groom/dashboard', [DashboardController::class, 'groomDashboard'])->name('groom.dashboard');
    Route::get('/bride/dashboard', [DashboardController::class, 'brideDashboard'])->name('bride.dashboard');
    Route::get('/pandit/dashboard', [DashboardController::class, 'panditDashboard'])->name('pandit.dashboard');

    // Discovery, Matching & Search
    Route::get('/discovery', [DiscoveryController::class, 'index'])->name('discovery.index');
    Route::post('/shortlist/{id}', [DiscoveryController::class, 'toggleShortlist'])->name('shortlist.toggle');
    Route::get('/shortlists', [DiscoveryController::class, 'shortlists'])->name('shortlists.index');

    // Profile & Biodata Management
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id?}', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/photo/{id}/delete', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::post('/profile/photo/{id}/primary', [ProfileController::class, 'setPrimaryPhoto'])->name('profile.photo.primary');
    Route::post('/profile/deactivate', [ProfileController::class, 'deactivateAccount'])->name('profile.deactivate');
    Route::post('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');

    // Kundli (Horoscope) & Astrological Compatibility
    Route::get('/horoscope', [HoroscopeController::class, 'edit'])->name('horoscope.edit');
    Route::post('/horoscope', [HoroscopeController::class, 'update'])->name('horoscope.update');
    Route::get('/horoscope/compare/{candidateId}', [HoroscopeController::class, 'compareWith'])->name('horoscope.compare');

    // Formal Proposals & Interests
    Route::get('/proposals', [ProposalController::class, 'index'])->name('proposals.index');
    Route::post('/proposals/send/{receiverId}', [ProposalController::class, 'store'])->name('proposals.store');
    Route::post('/proposals/{id}/accept', [ProposalController::class, 'accept'])->name('proposals.accept');
    Route::post('/proposals/{id}/decline', [ProposalController::class, 'decline'])->name('proposals.decline');

    // Secure Chaperoned Communication
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{partnerId}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{partnerId}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/{partnerId}/contact-exchange', [ChatController::class, 'requestContactExchange'])->name('chat.contact_exchange');
    Route::post('/chat/{partnerId}/report', [ChatController::class, 'reportUser'])->name('chat.report');

    // Family Representative Delegation
    Route::get('/family/dashboard', [FamilyRepresentativeController::class, 'dashboard'])->name('family.dashboard');
    Route::get('/family/manage', [FamilyRepresentativeController::class, 'index'])->name('family.manage');
    Route::post('/family/link', [FamilyRepresentativeController::class, 'store'])->name('family.link');
    Route::post('/family/{id}/remove', [FamilyRepresentativeController::class, 'remove'])->name('family.remove');
    Route::post('/family/proposal/{id}', [FamilyRepresentativeController::class, 'handleProposal'])->name('family.proposal.handle');

    // KYC Verification & Trust Badge
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::post('/verification', [VerificationController::class, 'submit'])->name('verification.submit');

    // Membership & Single Vivah Pass
    Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');
    Route::post('/membership/checkout', [MembershipController::class, 'checkout'])->name('membership.checkout');
    Route::post('/membership/stripe', [MembershipController::class, 'processStripe'])->name('membership.stripe');
    Route::post('/membership/paypal/order', [MembershipController::class, 'createPayPalOrder'])->name('membership.paypal.order');
    Route::post('/membership/paypal/capture', [MembershipController::class, 'capturePayPalOrder'])->name('membership.paypal.capture');
    Route::post('/membership/paypal', [MembershipController::class, 'processPayPal'])->name('membership.paypal');

    // Vivah Milestone & Shubho Bibaho Certificate
    Route::get('/milestone', [MilestoneController::class, 'index'])->name('milestone.index');
    Route::post('/milestone/declare', [MilestoneController::class, 'declareMarriage'])->name('milestone.declare');
    Route::get('/certificate/{uuid}', [MilestoneController::class, 'viewCertificate'])->name('milestone.certificate');

    // Admin & Moderation Operations
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/kyc/{id}', [AdminController::class, 'reviewKyc'])->name('admin.kyc.review');
    Route::post('/admin/report/{id}', [AdminController::class, 'handleReport'])->name('admin.report.handle');
    Route::get('/admin/audit-logs', [AdminController::class, 'auditLogs'])->name('admin.audit_logs');
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IdentityVerification;
use App\Models\UserReport;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'grooms' => User::where('role', 'groom')->count(),
            'brides' => User::where('role', 'bride')->count(),
            'family_reps' => User::where('role', 'family_rep')->count(),
            'pending_kyc' => IdentityVerification::where('status', 'pending')->count(),
            'pending_reports' => UserReport::where('status', 'pending')->count(),
            'pro_users' => User::where('membership_tier', 'pro')->count(),
            'married_users' => User::where('status', 'married')->count(),
        ];

        $pendingKycs = IdentityVerification::with('user.profile')->where('status', 'pending')->latest()->take(10)->get();
        $recentReports = UserReport::with(['reporter', 'reported'])->where('status', 'pending')->latest()->take(10)->get();
        $recentAuditLogs = AuditLog::with('user')->latest()->take(15)->get();

        return view('admin.dashboard', compact('stats', 'pendingKycs', 'recentReports', 'recentAuditLogs'));
    }

    public function reviewKyc(Request $request, $id)
    {
        $kyc = IdentityVerification::findOrFail($id);
        $action = $request->input('action'); // 'approve' or 'reject'
        $reason = $request->input('rejection_reason');

        if ($action === 'approve') {
            $kyc->update([
                'status' => 'approved',
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);
            $kyc->user->update(['is_verified' => true]);

            AuditLog::log('kyc_approved', ['user_id' => $kyc->user_id], Auth::id());
            return back()->with('success', "Verified Seeker trust badge granted to {$kyc->user->name}.");
        } else {
            $kyc->update([
                'status' => 'rejected',
                'rejection_reason' => $reason,
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);
            $kyc->user->update(['is_verified' => false]);

            AuditLog::log('kyc_rejected', ['user_id' => $kyc->user_id, 'reason' => $reason], Auth::id());
            return back()->with('info', "KYC application marked rejected.");
        }
    }

    public function handleReport(Request $request, $id)
    {
        $report = UserReport::findOrFail($id);
        $action = $request->input('action'); // 'warn', 'suspend', 'ban', 'dismiss'
        $adminNotes = $request->input('admin_notes');

        $reportedUser = $report->reported;

        if ($action === 'ban') {
            $reportedUser->update(['status' => 'banned']);
            $report->update(['status' => 'resolved', 'admin_notes' => "Permanent ban enforced: {$adminNotes}"]);
            AuditLog::log('user_permanently_banned', ['user_id' => $reportedUser->id, 'reason' => $adminNotes], Auth::id());
            return back()->with('success', "User {$reportedUser->name} permanently banned for ethical violation.");
        } elseif ($action === 'suspend') {
            $reportedUser->update(['status' => 'suspended']);
            $report->update(['status' => 'resolved', 'admin_notes' => "Account suspended: {$adminNotes}"]);
            AuditLog::log('user_suspended', ['user_id' => $reportedUser->id, 'reason' => $adminNotes], Auth::id());
            return back()->with('success', "User {$reportedUser->name} account suspended.");
        } else {
            $report->update(['status' => 'dismissed', 'admin_notes' => $adminNotes]);
            return back()->with('info', "Report dismissed.");
        }
    }

    public function auditLogs()
    {
        $logs = AuditLog::with('user')->latest()->paginate(25);
        return view('admin.audit_logs', compact('logs'));
    }

    public function compliance()
    {
        $settings = \App\Services\ComplianceService::getSettings();
        return view('admin.compliance', compact('settings'));
    }

    public function updateCompliance(Request $request)
    {
        $validated = $request->validate([
            'banner_heading' => 'required|string|max:120',
            'banner_text' => 'required|string|max:500',
            'policy_url' => 'required|string|max:255',
            'privacy_url' => 'required|string|max:255',
            'terms_url' => 'required|string|max:255',
            'categories' => 'nullable|array',
        ]);

        \App\Services\ComplianceService::updateSettings($validated, Auth::id());

        return back()->with('success', 'Compliance notice, cookie categories, and policy links updated successfully.');
    }
}


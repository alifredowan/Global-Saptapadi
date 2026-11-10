@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Admin Top Banner -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-950 rounded-2xl p-6 sm:p-8 text-amber-100 shadow-md">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-red-800 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
                    <img src="{{ asset('images/logo-emblem.png') }}" alt="" class="w-4 h-4 rounded-full object-cover inline-block">
                    <span>Vivah Connect Trust & Operations Center</span>
                </div>
                <h1 class="font-heading font-bold text-2xl sm:text-3xl text-amber-100">
                    Administrative & Safety Operations
                </h1>
                <p class="text-xs text-amber-200/80 mt-1">
                    Enforcing statutory age parameters, KYC validations, Dowry Prohibition Act compliance, and immutable audit logs.
                </p>
            </div>

            <a href="{{ route('admin.audit_logs') }}" class="px-4 py-2.5 rounded-xl border border-amber-400/50 bg-amber-900/40 hover:bg-amber-800/60 text-amber-200 text-xs font-bold transition self-start sm:self-center">
                📋 View Full Audit Logs
            </a>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-sm">
            <span class="text-xs text-gray-500 uppercase font-bold block mb-1">Total Registered</span>
            <span class="text-2xl font-extrabold text-gray-900">{{ $stats['total_users'] }}</span>
            <span class="text-[11px] text-gray-400 block mt-1">{{ $stats['grooms'] }} Grooms • {{ $stats['brides'] }} Brides</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-sm">
            <span class="text-xs text-gray-500 uppercase font-bold block mb-1">Pending KYC Queue</span>
            <span class="text-2xl font-extrabold text-amber-800">{{ $stats['pending_kyc'] }}</span>
            <span class="text-[11px] text-amber-700 block mt-1">Requires Trust Officer Review</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-sm">
            <span class="text-xs text-gray-500 uppercase font-bold block mb-1">Dowry & Incident Reports</span>
            <span class="text-2xl font-extrabold text-red-800">{{ $stats['pending_reports'] }}</span>
            <span class="text-[11px] text-red-700 block mt-1">Ethical Policy Alerts</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-sm">
            <span class="text-xs text-gray-500 uppercase font-bold block mb-1">Pro Vivah Passes</span>
            <span class="text-2xl font-extrabold text-emerald-800">{{ $stats['pro_users'] }}</span>
            <span class="text-[11px] text-emerald-700 block mt-1">{{ $stats['married_users'] }} Celebrated Unions</span>
        </div>
    </div>

    <!-- Pending KYC Queue (FR-9.1) -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>🪪</span>
                <span>Government ID & Selfie KYC Review Queue (FR-9.1)</span>
            </h2>
            <span class="text-xs text-amber-800 font-semibold">{{ $pendingKycs->count() }} Pending</span>
        </div>

        @if($pendingKycs->isEmpty())
        <div class="p-8 text-center bg-gray-50 rounded-xl text-xs text-gray-500">
            No pending KYC submissions. All user verifications are up to date.
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-amber-50/70 text-amber-950 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-3 px-3">Candidate</th>
                        <th class="py-3 px-3">ID Type & Number</th>
                        <th class="py-3 px-3">Submitted Documents</th>
                        <th class="py-3 px-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($pendingKycs as $k)
                    <tr>
                        <td class="py-3 px-3">
                            <span class="font-bold text-gray-900 block">{{ $k->user->name }}</span>
                            <span class="text-[10px] text-gray-500">{{ $k->user->email }} • {{ $k->user->phone }}</span>
                        </td>
                        <td class="py-3 px-3">
                            <span class="font-semibold capitalize">{{ str_replace('_', ' ', $k->id_type) }}</span>
                            <span class="block text-gray-500 font-mono text-[11px]">{{ $k->id_number }}</span>
                        </td>
                        <td class="py-3 px-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ asset($k->id_document_path) }}" target="_blank" class="text-amber-800 font-bold hover:underline">View Gov ID</a>
                                <span>•</span>
                                <a href="{{ asset($k->selfie_document_path) }}" target="_blank" class="text-amber-800 font-bold hover:underline">View Selfie</a>
                            </div>
                        </td>
                        <td class="py-3 px-3 text-right">
                            <form method="POST" action="{{ route('admin.kyc.review', $k->id) }}" class="inline-flex space-x-2">
                                @csrf
                                <button type="submit" name="action" value="approve" class="px-3 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-[11px]">
                                    ✓ Approve & Verify
                                </button>
                                <button type="submit" name="action" value="reject" class="px-2.5 py-1.5 rounded-lg bg-red-100 hover:bg-red-200 text-red-800 font-bold text-[11px]">
                                    ✕ Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <!-- Incident & Dowry Violation Reports Queue (FR-8.4, FR-9.3) -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
            <span>⚖️</span>
            <span>Safety, Anti-Dowry & Ethics Violation Queue (FR-8.4, FR-9.3)</span>
        </h2>

        @if($recentReports->isEmpty())
        <div class="p-8 text-center bg-gray-50 rounded-xl text-xs text-gray-500">
            No pending community reports. Community environment is clean and respectful.
        </div>
        @else
        <div class="space-y-3">
            @foreach($recentReports as $rep)
            <div class="p-4 rounded-xl border border-red-200 bg-red-50/30 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded bg-red-800 text-white font-bold text-[10px] uppercase">
                            {{ str_replace('_', ' ', $rep->category) }}
                        </span>
                        <span class="font-bold text-gray-900">Reported User: {{ $rep->reported->name }}</span>
                        <span class="text-gray-500">by {{ $rep->reporter->name }}</span>
                    </div>
                    <p class="text-gray-700 mt-1 italic">"{{ $rep->details }}"</p>
                </div>

                <form method="POST" action="{{ route('admin.report.handle', $rep->id) }}" class="inline-flex space-x-2 shrink-0">
                    @csrf
                    <button type="submit" name="action" value="warn" class="px-3 py-1.5 rounded-lg bg-amber-100 hover:bg-amber-200 text-amber-900 font-bold text-[11px]">
                        Warn
                    </button>
                    <button type="submit" name="action" value="suspend" class="px-3 py-1.5 rounded-lg bg-orange-600 hover:bg-orange-700 text-white font-bold text-[11px]">
                        Suspend
                    </button>
                    <button type="submit" name="action" value="ban" class="px-3 py-1.5 rounded-lg bg-red-800 hover:bg-red-900 text-white font-bold text-[11px]">
                        Permanent Ban
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Recent Immutable Audit Logs (NFR-4) -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
            <span>📋</span>
            <span>Immutable Server Audit Log Stream (NFR-4)</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 text-gray-700 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-2.5 px-3">Timestamp</th>
                        <th class="py-2.5 px-3">Action Event</th>
                        <th class="py-2.5 px-3">Initiated By</th>
                        <th class="py-2.5 px-3">Metadata Details</th>
                        <th class="py-2.5 px-3">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[11px]">
                    @foreach($recentAuditLogs as $log)
                    <tr>
                        <td class="py-2 px-3 text-gray-500 font-mono">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="py-2 px-3 font-bold text-red-950">{{ $log->action }}</td>
                        <td class="py-2 px-3 text-gray-700">{{ $log->user?->name ?? 'System' }}</td>
                        <td class="py-2 px-3 text-gray-500 truncate max-w-xs font-mono text-[10px]">
                            {{ json_encode($log->details) }}
                        </td>
                        <td class="py-2 px-3 text-gray-400 font-mono text-[10px]">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


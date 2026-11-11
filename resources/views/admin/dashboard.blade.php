@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Admin Top Banner -->
    <div class="relative overflow-hidden rounded-2xl section--dark p-6 sm:p-8 text-white shadow-sm border border-[var(--color-accent)]/30">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs text-stone-200 text-xs font-medium tracking-wide mb-2 border border-white/20">
                    <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    <span>Trust &amp; Safety Console</span>
                </div>
                <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">
                    Operations &amp; Member Verification
                </h1>
                <p class="text-xs text-stone-200 mt-1 max-w-xl leading-relaxed">
                    Review candidate identity submissions, handle community policy reports, and oversee platform security.
                </p>
            </div>

            <a href="{{ route('admin.audit_logs') }}" class="px-4 py-2 rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 text-white text-xs font-medium transition self-start sm:self-center">
                View Audit Logs &rarr;
            </a>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Total Members</span>
            <span class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">{{ $stats['total_users'] }}</span>
            <span class="text-[11px] text-stone-400 block mt-1">{{ $stats['grooms'] }} Grooms &bull; {{ $stats['brides'] }} Brides</span>
        </div>

        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Pending KYC Queue</span>
            <span class="text-2xl font-serif font-bold text-[var(--color-accent)] dark:text-[var(--color-accent)]">{{ $stats['pending_kyc'] }}</span>
            <span class="text-[11px] text-stone-400 block mt-1">Requires human review</span>
        </div>

        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Safety Reports</span>
            <span class="text-2xl font-serif font-bold text-rose-700 dark:text-rose-400">{{ $stats['pending_reports'] }}</span>
            <span class="text-[11px] text-stone-400 block mt-1">Incident alerts</span>
        </div>

        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Single Vivah Passes</span>
            <span class="text-2xl font-serif font-bold text-emerald-700 dark:text-emerald-400">{{ $stats['pro_users'] }}</span>
            <span class="text-[11px] text-stone-400 block mt-1">{{ $stats['married_users'] }} Celebrated Unions</span>
        </div>
    </div>

    <!-- Pending KYC Queue -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-serif font-bold text-lg text-stone-900 dark:text-stone-100 flex items-center space-x-2">
                <svg class="w-4 h-4 text-[var(--color-accent)] dark:text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/></svg>
                <span>ID &amp; Selfie Verification Queue</span>
            </h2>
            <span class="text-xs text-[var(--color-accent)] dark:text-[var(--color-accent)] font-medium">{{ $pendingKycs->count() }} Pending</span>
        </div>

        @if($pendingKycs->isEmpty())
        <div class="p-8 text-center bg-stone-50 dark:bg-stone-800/40 rounded-xl text-xs text-stone-500">
            No pending KYC submissions. All user verifications are up to date.
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-500 uppercase font-medium text-[10px]">
                    <tr>
                        <th class="py-3 px-3">Candidate</th>
                        <th class="py-3 px-3">Document</th>
                        <th class="py-3 px-3">Submitted Files</th>
                        <th class="py-3 px-3 text-right">Review Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-stone-700 dark:text-stone-300">
                    @foreach($pendingKycs as $k)
                    <tr>
                        <td class="py-3 px-3">
                            <span class="font-medium text-stone-900 dark:text-stone-100 block">{{ $k->user->name }}</span>
                            <span class="text-[11px] text-stone-400">{{ $k->user->email }} &bull; {{ $k->user->phone }}</span>
                        </td>
                        <td class="py-3 px-3">
                            <span class="font-medium capitalize">{{ str_replace('_', ' ', $k->id_type) }}</span>
                            <span class="block text-stone-400 font-mono text-[11px]">{{ $k->id_number }}</span>
                        </td>
                        <td class="py-3 px-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ asset($k->id_document_path) }}" target="_blank" class="text-[var(--color-accent)] dark:text-[var(--color-accent)] font-medium hover:underline">View Gov ID</a>
                                <span class="text-stone-300">&bull;</span>
                                <a href="{{ asset($k->selfie_document_path) }}" target="_blank" class="text-[var(--color-accent)] dark:text-[var(--color-accent)] font-medium hover:underline">View Selfie</a>
                            </div>
                        </td>
                        <td class="py-3 px-3 text-right">
                            <form method="POST" action="{{ route('admin.kyc.review', $k->id) }}" class="inline-flex space-x-2">
                                @csrf
                                <button type="submit" name="action" value="approve" class="px-3 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-medium text-[11px] cursor-pointer">
                                    Approve
                                </button>
                                <button type="submit" name="action" value="reject" class="px-2.5 py-1.5 rounded-lg border border-stone-300 dark:border-stone-700 hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-600 dark:text-stone-300 font-medium text-[11px] cursor-pointer">
                                    Reject
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

    <!-- Incident & Dowry Violation Reports Queue -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
        <h2 class="font-serif font-bold text-lg text-stone-900 dark:text-stone-100 flex items-center space-x-2">
            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/></svg>
            <span>Safety &amp; Anti-Dowry Incident Queue</span>
        </h2>

        @if($recentReports->isEmpty())
        <div class="p-8 text-center bg-stone-50 dark:bg-stone-800/40 rounded-xl text-xs text-stone-500">
            No pending community reports. Community environment is quiet and respectful.
        </div>
        @else
        <div class="space-y-3">
            @foreach($recentReports as $rep)
            <div class="p-4 rounded-xl border border-rose-200/80 dark:border-rose-900/60 bg-rose-50/40 dark:bg-rose-950/20 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded-full bg-rose-100 dark:bg-rose-900/50 text-rose-800 dark:text-rose-300 font-medium text-[10px] uppercase">
                            {{ str_replace('_', ' ', $rep->category) }}
                        </span>
                        <span class="font-medium text-stone-900 dark:text-stone-100">Reported: {{ $rep->reported->name }}</span>
                        <span class="text-stone-400">by {{ $rep->reporter->name }}</span>
                    </div>
                    <p class="text-stone-600 dark:text-stone-300 mt-1 italic leading-relaxed">&ldquo;{{ $rep->details }}&rdquo;</p>
                </div>

                <form method="POST" action="{{ route('admin.report.handle', $rep->id) }}" class="inline-flex space-x-2 shrink-0">
                    @csrf
                    <button type="submit" name="action" value="warn" class="px-3 py-1.5 rounded-lg border border-amber-300 bg-amber-50 dark:bg-amber-950/40 text-[var(--color-accent)] font-medium text-[11px] cursor-pointer">
                        Warn
                    </button>
                    <button type="submit" name="action" value="suspend" class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-medium text-[11px] cursor-pointer">
                        Suspend
                    </button>
                    <button type="submit" name="action" value="ban" class="px-3 py-1.5 rounded-lg bg-rose-700 hover:bg-rose-800 text-white font-medium text-[11px] cursor-pointer">
                        Ban
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Recent Immutable Audit Logs -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
        <h2 class="font-serif font-bold text-lg text-stone-900 dark:text-stone-100 flex items-center space-x-2">
            <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/></svg>
            <span>Server Audit Log Stream</span>
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-500 uppercase font-medium text-[10px]">
                    <tr>
                        <th class="py-2.5 px-3">Timestamp</th>
                        <th class="py-2.5 px-3">Action</th>
                        <th class="py-2.5 px-3">User</th>
                        <th class="py-2.5 px-3">Details</th>
                        <th class="py-2.5 px-3">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-[11px] text-stone-600 dark:text-stone-300">
                    @foreach($recentAuditLogs as $log)
                    <tr>
                        <td class="py-2 px-3 text-stone-400 font-mono">{{ $log->created_at->format('d M H:i:s') }}</td>
                        <td class="py-2 px-3 font-medium text-stone-900 dark:text-stone-100">{{ $log->action }}</td>
                        <td class="py-2 px-3 text-stone-600 dark:text-stone-300">{{ $log->user?->name ?? 'System' }}</td>
                        <td class="py-2 px-3 text-stone-400 truncate max-w-xs font-mono text-[10px]">
                            {{ json_encode($log->details) }}
                        </td>
                        <td class="py-2 px-3 text-stone-400 font-mono text-[10px]">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

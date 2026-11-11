@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 border border-stone-200/90 dark:border-stone-800 shadow-xs flex items-center justify-between">
        <div>
            <div class="inline-flex items-center space-x-1.5 text-xs font-medium text-[var(--color-accent)] uppercase tracking-wider mb-1">
                <span>Accountability &amp; Security</span>
            </div>
            <h1 class="font-serif font-bold text-2xl text-stone-900 dark:text-stone-100">Immutable Server Audit Logs</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl border border-stone-300 dark:border-stone-700 text-xs font-medium text-stone-700 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 transition">
            &larr; Return to Dashboard
        </a>
    </div>

    <div class="bg-white dark:bg-stone-900 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-stone-50 dark:bg-stone-800/60 text-stone-500 uppercase font-medium text-[10px]">
                    <tr>
                        <th class="py-3 px-4">Timestamp</th>
                        <th class="py-3 px-4">Event Action</th>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4">Payload Details</th>
                        <th class="py-3 px-4">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800 text-[11px] text-stone-600 dark:text-stone-300">
                    @foreach($logs as $log)
                    <tr class="hover:bg-stone-50/50 dark:hover:bg-stone-800/40 transition">
                        <td class="py-3 px-4 font-mono text-stone-400 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="py-3 px-4 font-medium text-stone-900 dark:text-stone-100">{{ $log->action }}</td>
                        <td class="py-3 px-4 text-stone-700 dark:text-stone-300">{{ $log->user?->name ?? 'System Service' }}</td>
                        <td class="py-3 px-4 font-mono text-[10px] text-stone-500 dark:text-stone-400 max-w-sm truncate">
                            {{ json_encode($log->details) }}
                        </td>
                        <td class="py-3 px-4 font-mono text-stone-400 whitespace-nowrap">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-stone-100 dark:border-stone-800">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection

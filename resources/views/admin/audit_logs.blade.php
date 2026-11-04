@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm flex items-center justify-between">
        <div>
            <div class="inline-flex items-center space-x-1.5 text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">
                <span>📋</span>
                <span>Accountability & Security (NFR-4)</span>
            </div>
            <h1 class="font-heading font-bold text-2xl text-gray-900">Immutable Server Audit Logs</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl border border-gray-300 text-xs font-bold text-gray-700 hover:bg-gray-50">
            ← Back to Operations Dashboard
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-amber-50 text-amber-950 uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-3 px-4">Timestamp</th>
                        <th class="py-3 px-4">Event Action</th>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4">Payload Details</th>
                        <th class="py-3 px-4">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[11px]">
                    @foreach($logs as $log)
                    <tr class="hover:bg-amber-50/20 transition">
                        <td class="py-3 px-4 font-mono text-gray-500 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="py-3 px-4 font-bold text-red-950">{{ $log->action }}</td>
                        <td class="py-3 px-4 text-gray-800">{{ $log->user?->name ?? 'System Service' }}</td>
                        <td class="py-3 px-4 font-mono text-[10px] text-gray-600 max-w-sm truncate">
                            {{ json_encode($log->details) }}
                        </td>
                        <td class="py-3 px-4 font-mono text-gray-400 whitespace-nowrap">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection


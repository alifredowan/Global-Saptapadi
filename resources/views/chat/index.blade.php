@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-2xl p-6 sm:p-8 text-amber-100 shadow-md">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
            <span>💬</span>
            <span>Chaperoned Matrimonial Communication</span>
        </div>
        <h1 class="font-heading font-bold text-2xl text-amber-100">
            Secure Chaperoned Conversations
        </h1>
        <p class="text-xs text-amber-200/80 mt-1 leading-relaxed">
            Direct peer messaging strictly protected by Contact Shield, anti-dowry compliance scanning, and optional familial oversight.
        </p>
    </div>

    <!-- Conversations List -->
    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden divide-y divide-gray-100">
        @forelse($conversations as $item)
            @php
                $partner = $item['partner'];
                $lastMsg = $item['last_message'];
            @endphp
            <a href="{{ route('chat.show', $partner->id) }}" class="p-5 flex items-center justify-between hover:bg-amber-50/40 transition">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gray-100 overflow-hidden border border-amber-200 relative shrink-0">
                        <img src="{{ $partner->primary_photo_url }}" alt="{{ $partner->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-bold text-base text-gray-900">{{ $partner->name }}</h3>
                            @if($partner->is_verified)
                            <span class="text-emerald-700 text-xs font-semibold">✓ Verified</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ $partner->profile?->city ?? 'Location Open' }} • Gotra: {{ $partner->profile?->gotra ?? 'N/A' }}
                        </p>
                        @if($lastMsg)
                        <p class="text-xs text-gray-600 mt-1 truncate max-w-md">
                            {{ $lastMsg->displayed_content }}
                        </p>
                        @else
                        <p class="text-xs text-amber-800 italic mt-1">
                            Mutual proposal accepted. Start your conversation with auspicious greetings.
                        </p>
                        @endif
                    </div>
                </div>

                <div class="text-right shrink-0">
                    <span class="text-xs font-bold text-red-900 hover:underline">Open Room →</span>
                </div>
            </a>
        @empty
            <div class="p-12 text-center text-gray-500 text-xs">
                No active conversations yet. Direct messaging is unlocked once a formal proposal is mutually accepted.
            </div>
        @endforelse
    </div>
</div>
@endsection


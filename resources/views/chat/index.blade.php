@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)]">
        <div class="space-y-1">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-[11px] font-semibold uppercase tracking-wider mb-1">
                <span>Chaperoned Conversations</span>
            </div>
            <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">
                Private Family Conversations
            </h1>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                Direct messaging with candidate privacy protection, anti-dowry monitoring, and optional family guardian participation.
            </p>
        </div>
    </div>

    <!-- Conversations List -->
    <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden divide-y divide-[var(--border-subtle)]">
        @forelse($conversations as $item)
            @php
                $partner = $item['partner'];
                $lastMsg = $item['last_message'];
            @endphp
            <a href="{{ route('chat.show', $partner->id) }}" class="p-5 flex items-center justify-between hover:bg-[var(--bg-subtle)]/60 transition group">
                <div class="flex items-center space-x-4">
                    <div class="w-13 h-13 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] overflow-hidden border border-[var(--border-default)] relative shrink-0">
                        <img src="{{ $partner->primary_photo_url }}" alt="{{ $partner->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-serif font-bold text-base text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] transition">{{ $partner->name }}</h3>
                            @if($partner->is_verified)
                            <span class="text-[var(--color-success)] text-xs font-semibold flex items-center gap-0.5">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Verified</span>
                            </span>
                            @endif
                        </div>
                        <p class="text-xs text-[var(--text-muted)] mt-0.5">
                            {{ $partner->profile?->city ?? 'Diaspora' }} &bull; Gotra: {{ $partner->profile?->gotra ?? 'N/A' }}
                        </p>
                        @if($lastMsg)
                        <p class="text-xs text-[var(--text-secondary)] mt-1 truncate max-w-md">
                            {{ $lastMsg->displayed_content }}
                        </p>
                        @else
                        <p class="text-xs text-[var(--secondary-text)] italic mt-1">
                            Mutual expression of interest accepted. You may begin your conversation.
                        </p>
                        @endif
                    </div>
                </div>

                <div class="text-right shrink-0">
                    <span class="btn-secondary text-xs !min-h-[34px] group-hover:border-[var(--accent-primary)] group-hover:text-[var(--accent-primary)]">
                        <span>Enter Room</span>
                        &rarr;
                    </span>
                </div>
            </a>
        @empty
            <div class="p-12 text-center text-[var(--text-muted)] text-xs space-y-1">
                <p class="font-semibold text-sm text-[var(--text-primary)]">No active conversations yet.</p>
                <p>Direct communication begins once an expression of interest is mutually accepted by both parties.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

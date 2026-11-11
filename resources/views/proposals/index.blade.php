@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-[11px] font-semibold uppercase tracking-wider mb-1">
                <span>Family Inquiries &amp; Expressions</span>
            </div>
            <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">Matrimonial Proposals &amp; Inquiries</h1>
            <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                Review expressions of interest received from candidates and their families.
            </p>
        </div>

        <div class="text-left sm:text-right">
            <span class="text-[11px] text-[var(--text-muted)] block">Inquiry Allowance:</span>
            <span class="font-semibold text-xs {{ auth()->user()->isPro() ? 'text-[var(--color-success)]' : 'text-[var(--text-primary)]' }}">
                {{ auth()->user()->isPro() ? 'Single Vivah Pass: Unlimited' : 'Standard Member: Up to 5 per day' }}
            </span>
        </div>
    </div>

    <!-- Inbound Proposals Received -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                Inbound Expressions Received ({{ $inboundProposals->count() }})
            </h2>
            <span class="text-xs text-[var(--text-muted)]">Awaiting your family's review</span>
        </div>

        @if($inboundProposals->isEmpty())
        <div class="p-8 text-center bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-[var(--text-muted)] text-xs border border-[var(--border-subtle)] space-y-1">
            <p class="font-medium text-[var(--text-primary)]">No pending inbound proposals.</p>
            <p class="text-[11px]">When candidates or families express interest in your biodata, they will appear here.</p>
        </div>
        @else
        <div class="space-y-4">
            @foreach($inboundProposals as $prop)
            <div class="p-5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] hover:border-[var(--border-strong)] transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-start space-x-4">
                    <div class="w-14 h-14 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] overflow-hidden border border-[var(--border-default)] shrink-0">
                        <img src="{{ $prop->sender->primary_photo_url }}" alt="{{ $prop->sender->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">{{ $prop->sender->name }}</h3>
                            <span class="text-[10px] px-2 py-0.5 rounded-[var(--radius-xs)] font-semibold {{ $prop->status === 'accepted' ? 'bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]' : ($prop->status === 'declined' ? 'bg-[var(--color-danger-bg)] text-[var(--color-danger)] border border-[var(--color-danger-border)]' : 'bg-[var(--secondary-subtle)] text-[var(--secondary-text)] border border-[var(--secondary-border)]') }}">
                                {{ ucfirst(str_replace('_', ' ', $prop->status)) }}
                            </span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                            {{ $prop->sender->age }} yrs &bull; {{ $prop->sender->profile?->city ?? 'Diaspora' }} &bull; {{ $prop->sender->profile?->profession ?? 'Professional' }} &bull; Gotra: {{ $prop->sender->profile?->gotra ?? 'N/A' }}
                        </p>
                        <p class="text-xs text-[var(--text-secondary)] mt-2 italic bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-sm)] border border-[var(--border-subtle)]">
                            "{{ $prop->introductory_note ?? 'Namaskar. Our family was pleased to read your candidate biodata and would appreciate the opportunity to connect.' }}"
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-2 shrink-0 self-end sm:self-center">
                    <a href="{{ route('profile.show', $prop->sender->id) }}" class="btn-secondary text-xs !min-h-[34px]">
                        View Biodata
                    </a>

                    @if($prop->status === 'pending' || $prop->status === 'routed_to_family')
                    <form method="POST" action="{{ route('proposals.accept', $prop->id) }}">
                        @csrf
                        <button type="submit" class="btn-primary text-xs !min-h-[34px] cursor-pointer">
                            Accept Interest
                        </button>
                    </form>

                    <form method="POST" action="{{ route('proposals.decline', $prop->id) }}">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] hover:bg-[var(--border-default)] text-[var(--text-secondary)] text-xs font-semibold cursor-pointer transition">
                            Decline
                        </button>
                    </form>
                    @elseif($prop->status === 'accepted')
                    <a href="{{ route('chat.show', $prop->sender->id) }}" class="btn-primary text-xs !min-h-[34px] flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>Open Conversation</span>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Outbound Proposals Sent -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                Sent Expressions ({{ $outboundProposals->count() }})
            </h2>
            <span class="text-xs text-[var(--text-muted)]">Awaiting responses</span>
        </div>

        @if($outboundProposals->isEmpty())
        <div class="p-8 text-center bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-[var(--text-muted)] text-xs border border-[var(--border-subtle)]">
            You have not sent any expressions of interest yet. Browse candidates in Discovery to connect with families.
        </div>
        @else
        <div class="space-y-4">
            @foreach($outboundProposals as $prop)
            <div class="p-4 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-3.5">
                    <div class="w-12 h-12 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] overflow-hidden border border-[var(--border-default)] shrink-0">
                        <img src="{{ $prop->receiver->primary_photo_url }}" alt="{{ $prop->receiver->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-serif font-bold text-sm text-[var(--text-primary)]">{{ $prop->receiver->name }}</h3>
                            <span class="text-[10px] px-2 py-0.5 rounded-[var(--radius-xs)] font-semibold {{ $prop->status === 'accepted' ? 'bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]' : ($prop->status === 'declined' ? 'bg-[var(--color-danger-bg)] text-[var(--color-danger)] border border-[var(--color-danger-border)]' : 'bg-[var(--secondary-subtle)] text-[var(--secondary-text)] border border-[var(--secondary-border)]') }}">
                                {{ ucfirst(str_replace('_', ' ', $prop->status)) }}
                            </span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                            {{ $prop->receiver->age }} yrs &bull; {{ $prop->receiver->profile?->city ?? 'Diaspora' }} &bull; {{ $prop->receiver->profile?->profession ?? 'Professional' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-2 shrink-0">
                    <a href="{{ route('profile.show', $prop->receiver->id) }}" class="btn-secondary text-xs !min-h-[34px]">
                        View Biodata
                    </a>
                    @if($prop->status === 'accepted')
                    <a href="{{ route('chat.show', $prop->receiver->id) }}" class="btn-primary text-xs !min-h-[34px]">
                        Open Chat
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

</div>
@endsection

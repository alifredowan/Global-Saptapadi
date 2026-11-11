@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)]">
        <div class="space-y-1">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-[11px] font-semibold uppercase tracking-wider mb-1">
                <span>Family First Matrimony</span>
            </div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">
                Family Guardian &amp; Elder Console
            </h1>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed max-w-2xl">
                Review proposals, grant family blessings, and participate in chaperoned conversations. Your family can review each suitor with calm discretion.
            </p>
        </div>
    </div>

    <!-- Assigned Candidate Wards -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-base text-[var(--text-primary)]">
                Linked Candidate Wards
            </h2>
            <span class="text-xs text-[var(--text-muted)]">Profiles under your family care</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($links as $link)
                @php $ward = $link->seekerUser; @endphp
                <div class="p-4 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] flex items-center justify-between">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-12 h-12 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--bg-subtle)] border border-[var(--border-default)] shrink-0">
                            <img src="{{ $ward->primary_photo_url }}" alt="{{ $ward->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-sm text-[var(--text-primary)]">{{ $ward->name }}</h3>
                            <span class="text-[11px] text-[var(--secondary-text)] font-medium block">
                                Relationship: {{ $link->relationship }}
                            </span>
                            <span class="text-[11px] text-[var(--text-muted)]">
                                {{ $ward->age }} yrs &bull; Gotra: {{ $ward->profile?->gotra ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <a href="{{ route('profile.show', $ward->id) }}" class="btn-secondary text-xs !min-h-[32px] !px-3">
                        View Biodata
                    </a>
                </div>
            @empty
                <div class="col-span-2 p-6 text-center text-xs text-[var(--text-muted)] bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] border border-[var(--border-subtle)]">
                    No linked candidate wards assigned to your representative account yet.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Inbound Proposals Awaiting Elder Approval -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-base text-[var(--text-primary)]">
                Proposals Awaiting Family Review ({{ $pendingProposals->count() }})
            </h2>
            <span class="text-xs text-[var(--color-success)] font-semibold">Elder Consent Protocol</span>
        </div>

        @if($pendingProposals->isEmpty())
        <div class="p-8 text-center bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-[var(--text-muted)] text-xs border border-[var(--border-subtle)]">
            All inbound candidate inquiries are reviewed and up to date.
        </div>
        @else
        <div class="space-y-4">
            @foreach($pendingProposals as $prop)
            <div class="p-5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-12 h-12 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--bg-subtle)] border border-[var(--border-default)] shrink-0">
                            <img src="{{ $prop->sender->primary_photo_url }}" alt="{{ $prop->sender->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">{{ $prop->sender->name }}</h3>
                                <span class="text-[10px] px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] border border-[var(--secondary-border)] font-semibold">
                                    Seeking: {{ $prop->receiver->name }}
                                </span>
                            </div>
                            <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                                {{ $prop->sender->age }} yrs &bull; {{ $prop->sender->profile?->city ?? 'Diaspora' }} &bull; Gotra: {{ $prop->sender->profile?->gotra ?? 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('profile.show', $prop->sender->id) }}" class="btn-secondary text-xs !min-h-[34px] self-start sm:self-center">
                        Inspect Suitor Biodata
                    </a>
                </div>

                <!-- Introductory note -->
                <div class="p-3 bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] border border-[var(--border-subtle)] text-xs text-[var(--text-secondary)] italic">
                    "{{ $prop->introductory_note }}"
                </div>

                <!-- Polite Response Form -->
                <form method="POST" action="{{ route('family.proposal.handle', $prop->id) }}" class="space-y-3 pt-2 border-t border-[var(--border-subtle)]">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Response Message from Family Elders:
                        </label>
                        <select name="family_rep_notes" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] text-xs bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none">
                            <option value="Namaskar. Our family elders have reviewed your respected biodata and feel pleased to grant our blessings for your conversation.">
                                [Approval] Blessings granted: We welcome initiating conversation.
                            </option>
                            <option value="Pranam. We are honoured by your interest. Our family would be pleased to speak with your elders directly.">
                                [Approval] Direct family dialogue invited.
                            </option>
                            <option value="With utmost respect and goodwill to your family, our elders feel our horizons are not aligned at this time.">
                                [Respectful Decline] Wishing you success in finding your life partner.
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="submit" name="action" value="decline" class="px-3.5 py-2 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] hover:bg-[var(--border-default)] text-[var(--text-secondary)] text-xs font-semibold cursor-pointer transition">
                            Decline
                        </button>

                        <button type="submit" name="action" value="approve" class="btn-primary text-xs !min-h-[36px] cursor-pointer">
                            Approve with Family Blessings
                        </button>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Active Chaperoned Conversations -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-base text-[var(--text-primary)]">
                Chaperoned Conversation Oversight
            </h2>
            <span class="text-xs text-[var(--text-muted)]">Supervisory room access</span>
        </div>

        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
            As a family representative, you maintain transparent oversight in the communication room to ensure dignity and decorum.
        </p>

        <div class="space-y-3">
            @php
                $wardIds = $links->pluck('seeker_user_id')->toArray();
            @endphp
            @forelse($acceptedProposals as $p)
            @php
                $suitor = in_array($p->sender_user_id, $wardIds) ? $p->receiver : $p->sender;
                $wardName = in_array($p->sender_user_id, $wardIds) ? $p->sender->name : $p->receiver->name;
            @endphp
            <div class="p-3.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] flex items-center justify-between text-xs">
                <div>
                    <span class="font-serif font-bold text-sm text-[var(--text-primary)]">{{ $wardName }} (Candidate)</span>
                    <span class="text-[var(--text-muted)] mx-2">&bull;</span>
                    <span class="font-serif font-bold text-sm text-[var(--text-primary)]">{{ $suitor->name }} (Suitor)</span>
                    <span class="text-[10px] text-[var(--color-success)] font-semibold ml-2">Chaperoned Active</span>
                </div>

                <a href="{{ route('chat.show', $suitor->id) }}" class="btn-primary text-xs !min-h-[32px] !px-3">
                    <span>Enter Room</span>
                    &rarr;
                </a>
            </div>
            @empty
            <div class="p-6 text-center text-xs text-[var(--text-muted)]">
                No active conversations yet.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

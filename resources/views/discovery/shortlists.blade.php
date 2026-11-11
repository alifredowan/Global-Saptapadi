@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-[11px] font-semibold uppercase tracking-wider mb-1">
                <span>Personal Collection</span>
            </div>
            <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">Saved Shortlists &amp; Family Notes</h1>
            <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                Private candidates bookmarked by you or your family elders with confidential notes.
            </p>
        </div>
        <a href="{{ route('discovery.index') }}" class="btn-primary text-xs !min-h-[38px] !px-4">
            <span>Explore More Profiles</span>
            &rarr;
        </a>
    </div>

    <!-- Shortlist Items -->
    <div class="space-y-4">
        @forelse($shortlists as $item)
            @php $candidate = $item->candidate; @endphp
            <div class="card-ledger p-5 bg-[var(--bg-surface)] border border-[var(--border-default)] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center space-x-4">
                    <div class="w-14 h-14 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] overflow-hidden border border-[var(--border-default)] shrink-0">
                        <img src="{{ $candidate->primary_photo_url }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">{{ $candidate->name }}</h3>
                            <span class="text-xs text-[var(--text-muted)] font-medium">{{ $candidate->age }} yrs</span>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                            {{ $candidate->profile?->city ?? 'Diaspora' }} &bull; Gotra: {{ $candidate->profile?->gotra ?? 'N/A' }} &bull; {{ $candidate->profile?->profession ?? 'Professional' }}
                        </p>
                        @if($item->confidential_notes)
                        <div class="mt-2 text-xs bg-[var(--bg-subtle)] p-2.5 rounded-[var(--radius-sm)] border border-[var(--border-subtle)] text-[var(--text-primary)]">
                            <span class="font-semibold text-[10px] uppercase text-[var(--secondary-text)] block">Private Family Note:</span>
                            {{ $item->confidential_notes }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-2 shrink-0 self-end sm:self-center">
                    <a href="{{ route('profile.show', $candidate->id) }}" class="btn-secondary text-xs !min-h-[34px]">
                        View Biodata
                    </a>
                    <form method="POST" action="{{ route('shortlist.toggle', $candidate->id) }}">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] text-[var(--color-danger)] border border-[var(--color-danger-border)] hover:bg-red-100 text-xs font-semibold cursor-pointer transition">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="card-ledger p-12 text-center bg-[var(--bg-surface)] border border-[var(--border-default)] text-xs text-[var(--text-muted)] space-y-2">
                <p>You haven't saved any candidate profiles yet.</p>
                <p class="text-[11px] text-[var(--text-secondary)]">Click the bookmark icon on any candidate card to save them here for your family to review.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

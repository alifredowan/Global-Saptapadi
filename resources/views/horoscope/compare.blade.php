@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)]">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-6 border-b border-[var(--border-subtle)]">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-[11px] font-semibold uppercase tracking-wider">
                    <span>Vedic Astrological Guidance</span>
                </div>
                <h1 class="font-serif font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">
                    Horoscope Alignment Analysis
                </h1>
                <p class="text-xs text-[var(--text-secondary)]">
                    Comparing <strong>{{ $viewer->name }}</strong> and <strong>{{ $candidate->name }}</strong>. Horoscope matching is optional; values and character remain primary.
                </p>
            </div>

            <!-- Score Pill -->
            <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-center min-w-[150px] shrink-0">
                <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Guna Milan Score</span>
                <span class="font-serif font-bold text-3xl sm:text-4xl text-[var(--accent-primary)] block mt-0.5">
                    {{ $compatibility['percentage'] }}%
                </span>
                @if($compatibility['guna_milan'])
                <span class="text-[11px] text-[var(--secondary-text)] font-semibold block mt-0.5">
                    {{ $compatibility['guna_milan']['total_score'] }} of 36 Gunas
                </span>
                @endif
            </div>
        </div>

        <div class="pt-4 flex flex-wrap items-center gap-4 text-xs text-[var(--text-muted)]">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a14.5 14.5 0 0 0 0 18M12 3a14.5 14.5 0 0 1 0 18M3 12h18"/></svg>
                <span>Ashtakoota 8-Factor Model</span>
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[var(--color-success)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                <span>Same Gotra Check Included</span>
            </span>
        </div>
    </div>

    <!-- Same Gotra Advisory (Quiet Alert) -->
    @if(!empty($compatibility['gotra_advisory']['has_advisory']))
    <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--color-warning-bg)] border border-[var(--color-warning-border)] text-[var(--color-warning)] flex items-start space-x-3 text-xs">
        <svg class="w-5 h-5 shrink-0 text-[var(--color-warning)] mt-0.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
        <div class="space-y-0.5">
            <h3 class="font-bold text-sm">{{ $compatibility['gotra_advisory']['title'] }}</h3>
            <p class="leading-relaxed">
                {{ $compatibility['gotra_advisory']['message'] }}
            </p>
        </div>
    </div>
    @endif

    <!-- Manglik Status Assessment -->
    @if($compatibility['manglik_analysis'])
    <div class="p-4 rounded-[var(--radius-sm)] {{ $compatibility['manglik_analysis']['match'] ? 'bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[var(--color-success)]' : 'bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)]' }} flex items-start space-x-3 text-xs">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
            @if($compatibility['manglik_analysis']['match'])
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
            @else
                <circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"/>
            @endif
        </svg>
        <div class="space-y-0.5">
            <h3 class="font-bold text-sm">{{ $compatibility['manglik_analysis']['label'] }}</h3>
            <p class="leading-relaxed">
                {{ $compatibility['manglik_analysis']['details'] }}
            </p>
        </div>
    </div>
    @endif

    <!-- 36-Point Ashtakoota Breakdown Table -->
    @if($compatibility['guna_milan'])
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-[var(--border-subtle)]">
            <div>
                <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                    Ashtakoota 8 Koota Breakdown (36 Total Gunas)
                </h2>
                <p class="text-xs text-[var(--text-muted)]">Classical astrological compatibility factors.</p>
            </div>
            <span class="px-2.5 py-1 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] text-[var(--text-primary)] text-xs font-semibold border border-[var(--border-default)]">
                {{ $compatibility['guna_milan']['classification'] }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border border-[var(--border-default)] rounded-[var(--radius-sm)] overflow-hidden">
                <thead class="bg-[var(--bg-subtle)] text-[var(--text-secondary)] uppercase font-semibold text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4 border-b border-[var(--border-default)]">Koota</th>
                        <th class="py-3 px-4 border-b border-[var(--border-default)]">Significance</th>
                        <th class="py-3 px-4 border-b border-[var(--border-default)] text-center">Score</th>
                        <th class="py-3 px-4 border-b border-[var(--border-default)] text-center">Maximum</th>
                        <th class="py-3 px-4 border-b border-[var(--border-default)] text-right">Evaluation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @foreach($compatibility['guna_milan']['breakdown'] as $kootaKey => $koota)
                    <tr class="hover:bg-[var(--bg-subtle)]/50 transition">
                        <td class="py-3 px-4 font-semibold text-[var(--text-primary)] capitalize">{{ $koota['name'] }}</td>
                        <td class="py-3 px-4 text-[var(--text-secondary)]">
                            @if($kootaKey === 'varna') Spiritual &amp; ego compatibility
                            @elseif($kootaKey === 'vashya') Mutual affection &amp; alignment
                            @elseif($kootaKey === 'tara') Destiny, health &amp; well-being
                            @elseif($kootaKey === 'yoni') Biological &amp; physical affinity
                            @elseif($kootaKey === 'graha_maitri') Friendship &amp; mental harmony
                            @elseif($kootaKey === 'gana') Temperament &amp; behavioral traits
                            @elseif($kootaKey === 'bhakoot') Family welfare &amp; prosperity
                            @elseif($kootaKey === 'nadi') Genetic health &amp; progeny continuation
                            @endif
                        </td>
                        <td class="py-3 px-4 font-bold text-center text-[var(--accent-primary)] text-sm font-serif">
                            {{ $koota['score'] }}
                        </td>
                        <td class="py-3 px-4 text-center text-[var(--text-muted)]">
                            {{ $koota['max'] }}
                        </td>
                        <td class="py-3 px-4 text-right">
                            @if($koota['score'] == $koota['max'])
                                <span class="px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--color-success-bg)] text-[var(--color-success)] text-[10px] font-semibold">Favorable</span>
                            @elseif($koota['score'] > 0)
                                <span class="px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] text-[10px] font-semibold">Moderate</span>
                            @else
                                <span class="px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--color-danger-bg)] text-[var(--color-danger)] text-[10px] font-semibold">Requires Review</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-[var(--bg-subtle)] font-semibold text-[var(--text-primary)]">
                    <tr>
                        <td colspan="2" class="py-3 px-4 text-right text-xs uppercase tracking-wider">Total Guna Score:</td>
                        <td class="py-3 px-4 text-center text-base font-bold text-[var(--accent-primary)] font-serif">
                            {{ $compatibility['guna_milan']['total_score'] }}
                        </td>
                        <td class="py-3 px-4 text-center text-[var(--text-muted)]">36.0</td>
                        <td class="py-3 px-4 text-right text-xs text-[var(--accent-primary)] font-bold">
                            {{ $compatibility['guna_milan']['percentage'] }}%
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @else
    <div class="card-ledger p-8 text-center bg-[var(--bg-surface)] border border-[var(--border-default)]">
        <p class="text-xs text-[var(--text-secondary)] max-w-md mx-auto leading-relaxed">
            One or both candidates have selected "Horoscope Not Required". Matching is evaluated on cultural background, education, and shared family values.
        </p>
    </div>
    @endif

    <!-- Action Bar -->
    <div class="flex items-center justify-between pt-2">
        <a href="{{ route('profile.show', $candidate->id) }}" class="btn-secondary text-xs !min-h-[38px]">
            &larr; Back to {{ $candidate->name }}'s Biodata
        </a>

        <form method="POST" action="{{ route('proposals.store', $candidate->id) }}">
            @csrf
            <button type="submit" class="btn-primary text-xs !min-h-[38px]">
                <span>Send Expression of Interest</span>
                &rarr;
            </button>
        </form>
    </div>
</div>
@endsection

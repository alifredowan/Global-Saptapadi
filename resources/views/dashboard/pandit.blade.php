@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Pandit Hero Banner -->
    <div class="relative overflow-hidden rounded-2xl section--dark text-white p-6 sm:p-8 shadow-sm border border-[var(--color-accent)]/30">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs text-stone-200 text-xs font-medium tracking-wide border border-white/20">
                    <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                    <span>Pandit &amp; Acharya Matchmaking Console</span>
                </div>
                <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">
                    Pranam, {{ $user->name }}
                </h1>
                <p class="text-xs sm:text-sm text-stone-200 max-w-xl leading-relaxed">
                    Vedic astrological guidance for Global Saptapadi. Assisting families with Ashtakoota Guna Milan, Gotra lineage consultations, and auspicious marriage rites.
                </p>

                <div class="flex flex-wrap items-center gap-2 pt-2 text-[11px]">
                    <span class="px-2.5 py-1 rounded-lg bg-black/20 border border-white/10 text-stone-200">
                        Authority: <strong>Vedic Jyotish &amp; Matchmaking Acharya</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-emerald-950/60 border border-emerald-500/50 text-emerald-300 font-medium inline-flex items-center gap-1">
                        <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Astrological Advisory Council</span>
                    </span>
                </div>
            </div>

            <div class="bg-black/30 backdrop-blur-xs p-4 sm:p-5 rounded-xl border border-white/15 text-center sm:text-right shrink-0 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 block">Solemnized Unions</span>
                <div class="text-2xl font-serif font-bold text-white">{{ $solemnizedMilestones->count() }}</div>
                <span class="text-[10px] text-stone-300 block">Shubho Bibaho Registry</span>
            </div>
        </div>
    </div>

    <!-- 4 Astrological Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Eligible Grooms (Var)</span>
            <div class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">{{ $groomsCount }}</div>
            <span class="text-[10px] text-stone-400 block mt-1">Verified candidates</span>
        </div>

        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Eligible Brides (Kanya)</span>
            <div class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">{{ $bridesCount }}</div>
            <span class="text-[10px] text-stone-400 block mt-1">Verified candidates</span>
        </div>

        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Registered Kundlis</span>
            <div class="text-2xl font-serif font-bold text-[var(--color-accent)] dark:text-[var(--color-accent)]">{{ $totalKundlis }}</div>
            <span class="text-[10px] text-stone-400 block mt-1">36-Guna charts</span>
        </div>

        <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs">
            <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500 block mb-1">Sagotra Inquiries</span>
            <div class="text-2xl font-serif font-bold text-[var(--color-primary)] dark:text-[var(--color-accent)]">{{ count($sagotraCases) }}</div>
            <span class="text-[10px] text-stone-400 block mt-1">Lineage review cases</span>
        </div>
    </div>

    <!-- Sagotra (Same Gotra) Lineage Advisory Console -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
        <div class="flex items-center justify-between pb-2 border-b border-stone-200 dark:border-stone-800">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--color-accent)] dark:text-[var(--color-accent)] block">Vedic Lineage Advisory</span>
                <h2 class="font-serif font-bold text-lg text-stone-900 dark:text-stone-100 flex items-center space-x-2">
                    <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                    <span>Sagotra (Same Gotra) Consultations Requiring Guidance</span>
                </h2>
            </div>
            <span class="px-2.5 py-1 rounded-full bg-amber-50 dark:bg-amber-950/40 text-[var(--color-accent)] text-xs font-medium border border-amber-200 dark:border-amber-800">
                {{ count($sagotraCases) }} Detected Cases
            </span>
        </div>

        @if(!empty($sagotraCases))
            <div class="space-y-3">
                @foreach($sagotraCases as $case)
                    <div class="p-4 rounded-xl bg-amber-50/70 dark:bg-amber-950/20 border border-amber-200/80 dark:border-amber-900/50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex -space-x-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-stone-100 dark:bg-stone-800 border-2 border-white dark:border-stone-800">
                                    <img src="{{ $case['groom']->primary_photo_url }}" alt="{{ $case['groom']->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-stone-100 dark:bg-stone-800 border-2 border-white dark:border-stone-800">
                                    <img src="{{ $case['bride']->primary_photo_url }}" alt="{{ $case['bride']->name }}" class="w-full h-full object-cover filter blur-xs">
                                </div>
                            </div>
                            <div>
                                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">
                                    {{ $case['groom']->name }} &amp; {{ $case['bride']->name }}
                                </h3>
                                <p class="text-xs text-[var(--color-accent)] dark:text-[var(--color-accent)] font-medium">
                                    Shared Paternal Gotra: <span class="underline font-bold">{{ $case['gotra'] }}</span>
                                </p>
                                <p class="text-[11px] text-stone-500 dark:text-stone-400">
                                    Same-Gotra pairings are customarily reviewed for maternal lineage (Nanihal) separation across 5–7 generations.
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('horoscope.compare', $case['bride']->id) }}" class="px-4 py-2 rounded-xl bg-amber-100 dark:bg-amber-900/40 hover:bg-amber-200 border border-amber-300 dark:border-amber-700 text-[var(--color-accent)] font-medium text-xs transition shrink-0">
                            Perform 36-Guna Milan &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 text-center text-xs text-stone-500 bg-stone-50 dark:bg-stone-800/40 rounded-xl border border-stone-200/80 dark:border-stone-800">
                No active Sagotra conflict cases detected among current proposals.
            </div>
        @endif
    </div>

    <!-- Quick Ashtakoota Comparison Launcher Tool -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
        <h2 class="font-serif font-bold text-lg text-stone-900 dark:text-stone-100">
            Astrological Compatibility Engine
        </h2>
        <p class="text-xs text-stone-600 dark:text-stone-400">
            Compare any prospective groom and bride across all 8 Kootas: Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            @foreach($grooms->take(2) as $sampleGroom)
                <div class="p-4 rounded-xl border border-stone-200 dark:border-stone-700 bg-stone-50/50 dark:bg-stone-800/50 space-y-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-stone-100 dark:bg-stone-800 shrink-0">
                            <img src="{{ $sampleGroom->primary_photo_url }}" alt="{{ $sampleGroom->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-serif font-bold text-sm text-stone-900 dark:text-stone-100">{{ $sampleGroom->name }} (Var)</h4>
                            <span class="text-[11px] text-stone-500 dark:text-stone-400">Gotra: {{ $sampleGroom->profile?->gotra ?? 'Not specified' }} &bull; Rashi: {{ $sampleGroom->kundli?->rashi ?? 'Mesha' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('horoscope.compare', $sampleGroom->id) }}" class="w-full py-1.5 rounded-xl border border-stone-300 dark:border-stone-600 text-stone-700 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-700 text-xs font-medium text-center block transition">
                        Compare Kundli &amp; Gunas
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

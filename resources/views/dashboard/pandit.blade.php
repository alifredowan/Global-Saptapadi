@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Pandit Hero Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-950 via-[#2f1008] to-red-950 text-amber-100 p-6 sm:p-8 shadow-xl border border-amber-800/40">
        <div class="absolute -right-16 -top-16 w-56 h-56 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold uppercase tracking-wider border border-amber-400/30">
                    <img src="{{ asset('images/logo-emblem.png') }}" alt="" class="w-4 h-4 rounded-full object-cover inline-block">
                    <span>Pandit & Acharya Matchmaking Console</span>
                </div>
                <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-amber-100">
                    Pranam, {{ $user->name }}
                </h1>
                <p class="text-xs sm:text-sm text-amber-200/90 max-w-xl leading-relaxed">
                    Vedic astrological authority for Vivah Connect. Guiding families through authentic Shastric Jyotish, Ashtakoota Guna Milan, and sacred Shubho Bibaho solemnization.
                </p>

                <div class="flex flex-wrap items-center gap-2 pt-2 text-[11px]">
                    <span class="px-2.5 py-1 rounded-lg bg-amber-900/50 border border-amber-700/60 text-amber-200">
                        Authority: <strong>Vedic Jyotish & Matchmaking Acharya</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-emerald-900/60 border border-emerald-500/60 text-emerald-300 font-bold">
                        ✓ Astrological Advisory Council Head
                    </span>
                </div>
            </div>

            <div class="bg-stone-950/70 p-4 sm:p-5 rounded-2xl border border-amber-500/40 text-center sm:text-right shrink-0 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400 block">Solemnized Unions</span>
                <div class="text-2xl font-black text-amber-300">{{ $solemnizedMilestones->count() }}</div>
                <span class="text-[10px] text-amber-200/80 block">Shubho Bibaho Registry</span>
            </div>
        </div>
    </div>

    <!-- 4 Astrological Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-stone-500 block mb-1">Eligible Grooms (Var)</span>
            <div class="text-2xl font-extrabold text-red-950">{{ $groomsCount }}</div>
            <span class="text-[10px] text-stone-500 block mt-1">Active verified seekers</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-stone-500 block mb-1">Eligible Brides (Kanya)</span>
            <div class="text-2xl font-extrabold text-red-950">{{ $bridesCount }}</div>
            <span class="text-[10px] text-stone-500 block mt-1">Active verified seekers</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-stone-500 block mb-1">Registered Kundlis</span>
            <div class="text-2xl font-extrabold text-amber-800">{{ $totalKundlis }}</div>
            <span class="text-[10px] text-amber-700 block mt-1">36-Guna Astro Charts</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-stone-500 block mb-1">Sagotra Inquiries</span>
            <div class="text-2xl font-extrabold text-orange-700">{{ count($sagotraCases) }}</div>
            <span class="text-[10px] text-orange-600 block mt-1">Lineage review cases</span>
        </div>
    </div>

    <!-- Sagotra (Same Gotra) Lineage Advisory Console -->
    <div class="bg-white rounded-3xl p-6 border border-amber-200 shadow-xs space-y-4">
        <div class="flex items-center justify-between pb-2 border-b border-amber-100">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 block">Vedic Lineage Advisory</span>
                <h2 class="font-heading font-bold text-lg text-red-950 flex items-center space-x-2">
                    <span>⚠️</span>
                    <span>Sagotra (Same Gotra) Consultations Requiring Shastric Guidance</span>
                </h2>
            </div>
            <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold">
                {{ count($sagotraCases) }} Detected Cases
            </span>
        </div>

        @if(!empty($sagotraCases))
            <div class="space-y-3">
                @foreach($sagotraCases as $case)
                    <div class="p-4 rounded-2xl bg-amber-50/60 border border-amber-200/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex -space-x-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-stone-900 border-2 border-white">
                                    <img src="{{ $case['groom']->primary_photo_url }}" alt="{{ $case['groom']->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-stone-900 border-2 border-white">
                                    <img src="{{ $case['bride']->primary_photo_url }}" alt="{{ $case['bride']->name }}" class="w-full h-full object-cover filter blur-xs">
                                </div>
                            </div>
                            <div>
                                <h3 class="font-heading font-bold text-sm text-stone-900">
                                    {{ $case['groom']->name }} & {{ $case['bride']->name }}
                                </h3>
                                <p class="text-xs text-amber-900 font-semibold">
                                    Shared Paternal Gotra: <span class="underline font-bold">{{ $case['gotra'] }}</span>
                                </p>
                                <p class="text-[11px] text-stone-500">
                                    Customary Vedic rule: Same-Gotra marriage is customarily reviewed by an Acharya for Pravara and maternal lineage (Nanihal) non-conflict.
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('horoscope.compare', $case['bride']->id) }}" class="px-4 py-2 rounded-xl border border-amber-700 bg-amber-100 hover:bg-amber-200 text-amber-950 font-bold text-xs transition shrink-0">
                            Perform 36-Guna Kundli Milan →
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 text-center text-xs text-stone-500 bg-amber-50/20 rounded-2xl border border-amber-100">
                No active Sagotra conflict cases detected among current proposals.
            </div>
        @endif
    </div>

    <!-- Quick Ashtakoota Comparison Launcher Tool -->
    <div class="bg-white rounded-3xl p-6 border border-amber-200 shadow-xs space-y-4">
        <h2 class="font-heading font-bold text-lg text-red-950 flex items-center space-x-2">
            <span>🪐</span>
            <span>Astrological Compatibility Comparison Engine</span>
        </h2>
        <p class="text-xs text-stone-600">
            Compare any prospective groom and bride across all 8 Kootas: Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            @foreach($grooms->take(2) as $sampleGroom)
                <div class="p-4 rounded-2xl border border-stone-200 bg-stone-50 space-y-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-stone-900 shrink-0">
                            <img src="{{ $sampleGroom->primary_photo_url }}" alt="{{ $sampleGroom->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-stone-900">{{ $sampleGroom->name }} (Groom)</h4>
                            <span class="text-[10px] text-stone-500">Gotra: {{ $sampleGroom->profile?->gotra ?? 'N/A' }} • Rashi: {{ $sampleGroom->kundli?->rashi ?? 'Mesha' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('horoscope.compare', $sampleGroom->id) }}" class="w-full py-1.5 rounded-lg border border-red-900 text-red-900 hover:bg-red-50 text-[11px] font-bold text-center block transition">
                        Compare Kundli & Gunas
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection


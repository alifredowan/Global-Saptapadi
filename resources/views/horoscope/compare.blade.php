@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-3xl p-6 sm:p-8 text-amber-100 shadow-md">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
                    <span>🪐</span>
                    <span>Ashtakoota 36-Point Compatibility Analysis</span>
                </div>
                <h1 class="font-heading font-bold text-2xl sm:text-3xl text-amber-100">
                    Horoscope Alignment Analysis
                </h1>
                <p class="text-xs text-amber-200/80 mt-1">
                    Comparing {{ $viewer->name }} & {{ $candidate->name }}
                </p>
            </div>

            <!-- Score Badge -->
            <div class="text-center p-4 rounded-2xl bg-black/40 backdrop-blur-md border border-amber-400/40 min-w-[140px]">
                <span class="text-xs uppercase font-bold text-amber-300 block">Overall Match</span>
                <span class="font-heading font-extrabold text-3xl sm:text-4xl text-amber-200 block">
                    {{ $compatibility['percentage'] }}%
                </span>
                @if($compatibility['guna_milan'])
                <span class="text-[11px] text-amber-100 font-semibold block mt-1">
                    {{ $compatibility['guna_milan']['total_score'] }} / 36 Gunas
                </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Same Gotra Advisory (FR-3.6) -->
    @if(!empty($compatibility['gotra_advisory']['has_advisory']))
    <div class="p-4 rounded-2xl bg-amber-50 border-2 border-amber-300 text-amber-950 flex items-start space-x-3 shadow-sm">
        <span class="text-2xl">⚠️</span>
        <div>
            <h3 class="font-bold text-sm">{{ $compatibility['gotra_advisory']['title'] }}</h3>
            <p class="text-xs text-amber-900 mt-1 leading-relaxed">
                {{ $compatibility['gotra_advisory']['message'] }}
            </p>
        </div>
    </div>
    @endif

    <!-- Manglik Status Assessment (FR-3.4) -->
    @if($compatibility['manglik_analysis'])
    <div class="p-4 rounded-2xl {{ $compatibility['manglik_analysis']['match'] ? 'bg-emerald-50 border border-emerald-300 text-emerald-950' : 'bg-amber-50 border border-amber-300 text-amber-950' }} flex items-start space-x-3 shadow-sm">
        <span class="text-2xl">{{ $compatibility['manglik_analysis']['match'] ? '✓' : 'ℹ️' }}</span>
        <div>
            <h3 class="font-bold text-sm">{{ $compatibility['manglik_analysis']['label'] }}</h3>
            <p class="text-xs mt-1 leading-relaxed">
                {{ $compatibility['manglik_analysis']['details'] }}
            </p>
        </div>
    </div>
    @endif

    <!-- 36-Point Ashtakoota Breakdown Matrix (FR-3.3) -->
    @if($compatibility['guna_milan'])
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-amber-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-lg text-red-950 flex items-center space-x-2">
                <span>☸️</span>
                <span>Ashtakoota 8 Koota Score Breakdown (Total 36 Gunas)</span>
            </h2>
            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold border border-amber-300">
                {{ $compatibility['guna_milan']['classification'] }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border border-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-amber-50 text-amber-950 uppercase font-bold text-[11px]">
                    <tr>
                        <th class="py-3 px-4 border-b">Koota (Compatibility Aspect)</th>
                        <th class="py-3 px-4 border-b">Significance</th>
                        <th class="py-3 px-4 border-b text-center">Score Obtained</th>
                        <th class="py-3 px-4 border-b text-center">Max Points</th>
                        <th class="py-3 px-4 border-b text-right">Compatibility</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($compatibility['guna_milan']['breakdown'] as $kootaKey => $koota)
                    <tr class="hover:bg-amber-50/30 transition">
                        <td class="py-3 px-4 font-bold text-gray-900 capitalize">{{ $koota['name'] }}</td>
                        <td class="py-3 px-4 text-gray-500">
                            @if($kootaKey === 'varna') Spiritual & ego compatibility
                            @elseif($kootaKey === 'vashya') Mutual affection & power balance
                            @elseif($kootaKey === 'tara') Destiny, health & long life
                            @elseif($kootaKey === 'yoni') Biological & physical affinity
                            @elseif($kootaKey === 'graha_maitri') Friendship & psychological harmony
                            @elseif($kootaKey === 'gana') Temperament & behavioral traits
                            @elseif($kootaKey === 'bhakoot') Family welfare & financial growth
                            @elseif($kootaKey === 'nadi') Genetic health & progeny continuation
                            @endif
                        </td>
                        <td class="py-3 px-4 font-extrabold text-center text-red-900 text-sm">
                            {{ $koota['score'] }}
                        </td>
                        <td class="py-3 px-4 font-semibold text-center text-gray-400">
                            {{ $koota['max'] }}
                        </td>
                        <td class="py-3 px-4 text-right">
                            @if($koota['score'] == $koota['max'])
                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Perfect</span>
                            @elseif($koota['score'] > 0)
                                <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold">Good</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-red-100 text-red-800 text-[10px] font-bold">Dosha</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-red-50 text-red-950 font-bold">
                    <tr>
                        <td colspan="2" class="py-3 px-4 text-right text-xs uppercase tracking-wider">Total Guna Score:</td>
                        <td class="py-3 px-4 text-center text-base font-extrabold text-red-900">
                            {{ $compatibility['guna_milan']['total_score'] }}
                        </td>
                        <td class="py-3 px-4 text-center text-gray-500">36.0</td>
                        <td class="py-3 px-4 text-right text-xs">
                            {{ $compatibility['guna_milan']['percentage'] }}%
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @else
    <div class="bg-white rounded-2xl p-8 text-center border border-amber-200">
        <p class="text-sm text-gray-600">
            One or both candidates have selected "Horoscope Not Required". Matching is evaluated on cultural and lifestyle values.
        </p>
    </div>
    @endif

    <!-- Action Bar -->
    <div class="flex items-center justify-between pt-4">
        <a href="{{ route('profile.show', $candidate->id) }}" class="px-5 py-2.5 rounded-xl border border-gray-300 hover:bg-gray-50 text-xs font-bold text-gray-700 transition">
            ← Back to {{ $candidate->name }}'s Biodata
        </a>

        <form method="POST" action="{{ route('proposals.store', $candidate->id) }}">
            @csrf
            <button type="submit" class="px-6 py-2.5 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95 transition flex items-center space-x-1.5">
                <span>💌</span>
                <span>Send Matrimonial Interest</span>
            </button>
        </form>
    </div>
</div>
@endsection


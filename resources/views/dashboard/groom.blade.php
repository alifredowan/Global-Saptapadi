@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Groom Hero Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-red-950 via-red-900 to-amber-950 text-amber-100 p-6 sm:p-8 shadow-xl border border-amber-800/40">
        <div class="absolute -right-16 -top-16 w-56 h-56 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold uppercase tracking-wider border border-amber-400/30">
                    <span>🪷</span>
                    <span>Groom Portal • Var Dashboard</span>
                </div>
                <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-amber-100">
                    Namaste, {{ $user->name }}
                </h1>
                <p class="text-xs sm:text-sm text-amber-200/90 max-w-xl leading-relaxed">
                    Welcome to your sacred matrimonial console. Track bride inquiries, astrological compatibility, and family chaperoned conversations.
                </p>

                <!-- Profile Tags -->
                <div class="flex flex-wrap items-center gap-2 pt-2 text-[11px]">
                    <span class="px-2.5 py-1 rounded-lg bg-amber-900/50 border border-amber-700/60 text-amber-200">
                        Gotra: <strong>{{ $profile?->gotra ?? 'Not specified' }}</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-amber-900/50 border border-amber-700/60 text-amber-200">
                        Sampradaya: <strong>{{ $profile?->sampradaya ?? 'Dharmic' }}</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-amber-900/50 border border-amber-700/60 text-amber-200">
                        {{ $user->age ?? 28 }} yrs • {{ $profile?->city ?? 'Diaspora' }}
                    </span>
                    @if($user->is_verified)
                        <span class="px-2.5 py-1 rounded-lg bg-emerald-900/60 border border-emerald-500/60 text-emerald-300 font-bold">
                            ✓ 100% ID KYC Verified
                        </span>
                    @else
                        <a href="{{ route('verification.index') }}" class="px-2.5 py-1 rounded-lg bg-amber-500/20 border border-amber-400/50 text-amber-300 font-bold hover:bg-amber-500/30 transition">
                            ⚠️ Complete KYC Verification →
                        </a>
                    @endif
                </div>
            </div>

            <!-- Single Vivah Pass Status Box -->
            <div class="bg-stone-950/60 backdrop-blur-xs p-4 sm:p-5 rounded-2xl border border-amber-500/40 text-center sm:text-right shrink-0 space-y-1.5">
                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400 block">Single Vivah Pass</span>
                @if($isPro)
                    <div class="text-lg font-black text-amber-300 flex items-center justify-center sm:justify-end space-x-1.5">
                        <span>⭐</span>
                        <span>PRO PASS ACTIVE</span>
                    </div>
                    <span class="text-[11px] text-emerald-400 font-semibold block">Valid until Shubho Bibaho</span>
                @else
                    <div class="text-base font-extrabold text-amber-200">Free Tier</div>
                    <a href="{{ route('membership.index') }}" class="inline-block mt-1 px-3.5 py-1.5 rounded-xl gold-gradient text-white text-xs font-bold hover:opacity-95 shadow-sm transition">
                        Get Single Pass ($29) →
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Profile Completeness Prompt (Nikah Matrimony Pattern) -->
    @php
        $completeness = $profile?->profile_completeness_pct ?? 40;
    @endphp
    @if($completeness < 100)
    <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-4 sm:p-5 border border-amber-300/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center space-x-2">
                <span class="text-base">📝</span>
                <span class="font-bold text-amber-950 text-xs sm:text-sm">Complete Your Sacred Biodata</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-200 text-amber-900">{{ $completeness }}% Complete</span>
            </div>
            <p class="text-[11px] text-amber-900/80">
                Profiles with 100% complete Gotra, education, lifestyle, and family roots receive 4x more compatible matrimonial proposals.
            </p>
            <div class="w-full sm:w-72 bg-amber-200/60 rounded-full h-2 overflow-hidden mt-1">
                <div class="gold-gradient h-full rounded-full transition-all duration-500" style="width: {{ $completeness }}%"></div>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="px-4 py-2.5 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95 transition shrink-0 flex items-center justify-center space-x-1.5">
            <span>✨</span>
            <span>Complete 7-Step Biodata →</span>
        </a>
    </div>
    @endif

    <!-- 4 Key Statistics Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <!-- Eligible Brides -->
        <a href="{{ route('discovery.index') }}" class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs hover:border-amber-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Eligible Brides</span>
                <span class="text-lg group-hover:scale-110 transition transform">👰</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $totalCompatibleBrides }}</div>
            <span class="text-[10px] text-amber-700 font-semibold mt-1 block">Browse Matches →</span>
        </a>

        <!-- Received Proposals -->
        <a href="{{ route('proposals.index') }}" class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs hover:border-amber-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Proposals</span>
                <span class="text-lg group-hover:scale-110 transition transform">💌</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $pendingReceivedProposals->count() }} <span class="text-xs text-stone-400 font-normal">pending</span></div>
            <span class="text-[10px] text-stone-500 mt-1 block">{{ $sentProposalsCount }} sent by you</span>
        </a>

        <!-- Shortlisted -->
        <a href="{{ route('shortlists.index') }}" class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs hover:border-amber-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Shortlists</span>
                <span class="text-lg group-hover:scale-110 transition transform">⭐</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $shortlistsCount }}</div>
            <span class="text-[10px] text-amber-700 font-semibold mt-1 block">View Shortlisted →</span>
        </a>

        <!-- Chaperoned Chat -->
        <a href="{{ route('chat.index') }}" class="bg-white p-5 rounded-2xl border border-amber-200 shadow-xs hover:border-amber-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Chaperoned Chat</span>
                <span class="text-lg group-hover:scale-110 transition transform">💬</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $unreadMessagesCount }} <span class="text-xs text-stone-400 font-normal">unread</span></div>
            <span class="text-[10px] text-emerald-700 font-semibold mt-1 block">Family Protected →</span>
        </a>
    </div>

    <!-- Quick Action Launchpad Bar -->
    <div class="bg-white rounded-2xl p-4 border border-amber-200/90 shadow-xs flex flex-wrap items-center justify-between gap-3 text-xs">
        <span class="font-bold text-stone-700 uppercase tracking-wider text-[11px] flex items-center space-x-1.5">
            <span>⚡</span>
            <span>Groom Quick Actions:</span>
        </span>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('discovery.index') }}" class="px-3 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-300 text-amber-900 font-bold transition">
                🔍 Find Compatible Brides
            </a>
            <a href="{{ route('horoscope.edit') }}" class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 border border-red-200 text-red-900 font-bold transition">
                🪐 My Kundli & 36-Gunas
            </a>
            <a href="{{ route('family.manage') }}" class="px-3 py-1.5 rounded-xl bg-stone-50 hover:bg-stone-100 border border-stone-300 text-stone-800 font-bold transition">
                👥 Family Elders / Ghotok
            </a>
            <a href="{{ route('membership.index') }}" class="px-3 py-1.5 rounded-xl gold-gradient text-white font-bold transition shadow-2xs">
                💎 Single Vivah Pass ($29)
            </a>
        </div>
    </div>

    <!-- Main Grid: Top Recommended Brides & Family Oversight -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Column 1 & 2: Top Compatible Bride Candidates -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between pb-1 border-b border-amber-200/80">
                <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                    <span>🪐</span>
                    <span>Top Astrological & Cultural Matches</span>
                </h2>
                <a href="{{ route('discovery.index') }}" class="text-xs font-bold text-amber-800 hover:text-red-900">
                    View All Brides →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($recommendedBrides as $item)
                    @php
                        $bride = $item['user'];
                        $bProfile = $bride->profile;
                        $comp = $item['compatibility'];
                    @endphp
                    <div class="bg-white rounded-2xl border border-amber-200 shadow-xs hover:border-amber-400 transition smooth-card overflow-hidden flex flex-col justify-between">
                        <div>
                            <!-- Photo with Modesty Shield -->
                            <div class="relative h-44 bg-stone-900 overflow-hidden">
                                <img src="{{ $bride->primary_photo_url }}" alt="{{ $bride->name }}" class="w-full h-full object-cover filter blur-sm scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>

                                <div class="absolute top-2 inset-x-2 flex items-center justify-between">
                                    <span class="bg-emerald-900/90 text-emerald-200 px-2 py-0.5 rounded-full text-[10px] font-bold border border-emerald-400/40">
                                        ✓ Verified
                                    </span>
                                    <span class="bg-red-950/90 text-amber-200 px-2 py-0.5 rounded-full text-[10px] font-bold border border-amber-400/40">
                                        ✨ {{ $comp['percentage'] }}% Match
                                    </span>
                                </div>

                                <div class="absolute bottom-2 inset-x-3 text-white">
                                    <h3 class="font-heading font-bold text-sm text-white truncate">{{ $bride->name }}</h3>
                                    <p class="text-[10px] text-amber-200/90 truncate">
                                        {{ $bride->age }} yrs • {{ $bProfile?->city ?? 'Diaspora' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Specs -->
                            <div class="p-3 space-y-2 text-xs">
                                <div class="grid grid-cols-2 gap-1.5 text-[11px] bg-amber-50/50 p-2 rounded-xl">
                                    <div>
                                        <span class="text-stone-400 text-[9px] uppercase font-bold block">Gotra</span>
                                        <span class="font-semibold text-stone-800 truncate block">{{ $bProfile?->gotra ?? 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-stone-400 text-[9px] uppercase font-bold block">Profession</span>
                                        <span class="font-semibold text-stone-800 truncate block">{{ $bProfile?->profession ?? 'Professional' }}</span>
                                    </div>
                                </div>

                                <!-- Guna Milan Row -->
                                @if(!empty($comp['guna_milan']))
                                    <div class="flex items-center justify-between p-1.5 rounded-lg bg-red-50 text-[10px] font-bold text-red-950">
                                        <span>🪐 Ashtakoota:</span>
                                        <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-900">
                                            {{ $comp['guna_milan']['total_score'] }} / 36
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-3 pt-0">
                            <a href="{{ route('profile.show', $bride->id) }}" class="w-full py-1.5 rounded-xl border border-red-900 text-red-900 hover:bg-red-50 text-xs font-bold text-center block transition">
                                View Full Biodata
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 p-6 text-center text-xs text-stone-500 bg-white rounded-2xl border border-amber-200">
                        No active bride profiles found matching criteria.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Column 3: Family Representative & Chaperone Status -->
        <div class="space-y-6">
            <!-- Family Representative Card -->
            <div class="bg-white rounded-3xl p-5 border border-amber-200 shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-amber-100">
                    <h3 class="font-heading font-bold text-sm text-red-950 flex items-center space-x-1.5">
                        <span>👥</span>
                        <span>Family Elder (Ghotok)</span>
                    </h3>
                    <a href="{{ route('family.manage') }}" class="text-[10px] font-bold text-amber-800 hover:underline">
                        Manage →
                    </a>
                </div>

                @if($familyRepLink)
                    <div class="p-3.5 rounded-2xl bg-amber-50/60 border border-amber-200/80 space-y-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-red-900 text-amber-200 font-bold flex items-center justify-center text-xs shrink-0">
                                {{ strtoupper(substr($familyRepLink->representativeUser->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-stone-900 text-xs truncate">{{ $familyRepLink->representativeUser->name }}</h4>
                                <span class="text-[10px] text-amber-800 font-semibold block">
                                    {{ ucfirst($familyRepLink->relationship) }} • {{ ucfirst(str_replace('_', ' ', $familyRepLink->permission_scope)) }}
                                </span>
                            </div>
                        </div>
                        <p class="text-[11px] text-stone-600 leading-tight">
                            ✓ Actively assisting in proposal evaluation and chaperoned 3-way conversations.
                        </p>
                    </div>
                @else
                    <div class="text-center py-4 space-y-2">
                        <div class="text-2xl">👨‍👩‍👧</div>
                        <p class="text-xs text-stone-600 leading-relaxed">
                            Empower your parents or a trusted community Ghotok to review suitor biodatas on your behalf.
                        </p>
                        <a href="{{ route('family.manage') }}" class="inline-block px-4 py-2 rounded-xl bg-amber-100 hover:bg-amber-200 text-amber-900 text-xs font-bold transition">
                            Link Family Elder (Free)
                        </a>
                    </div>
                @endif
            </div>

            <!-- Customary Vedic Integrity Notice -->
            <div class="bg-gradient-to-br from-[#2a080c] to-[#1a0507] text-amber-100 rounded-3xl p-5 border border-amber-800/40 shadow-xs space-y-2.5 text-xs">
                <span class="font-bold text-amber-300 text-[11px] uppercase tracking-wider block">
                    Vedic Matrimonial Guidelines
                </span>
                <ul class="space-y-1.5 text-amber-200/80 text-[11px]">
                    <li>• Statutory Minimum Age: 21 Groom / 18 Bride</li>
                    <li>• Sagotra marriage requires traditional pravara review</li>
                    <li>• Zero-Dowry Policy strictly enforced under UN CEDAW</li>
                    <li>• Saptapadi vows celebrate union in Shubho Bibaho registry</li>
                </ul>
                <div class="pt-1">
                    <a href="{{ route('about') }}" class="text-[10px] font-bold text-amber-300 hover:underline">
                        Read Sacred Matrimonial Code →
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection


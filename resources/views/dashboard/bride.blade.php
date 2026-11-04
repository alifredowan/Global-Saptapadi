@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Bride Hero Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-red-950 via-[#3a090e] to-rose-950 text-amber-100 p-6 sm:p-8 shadow-xl border border-rose-800/40">
        <div class="absolute -right-16 -top-16 w-56 h-56 bg-rose-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-rose-500/20 text-rose-200 text-xs font-bold uppercase tracking-wider border border-rose-400/30">
                    <span>🪷</span>
                    <span>Bride Portal • Kanya Dashboard</span>
                </div>
                <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-amber-100">
                    Namaste, {{ $user->name }}
                </h1>
                <p class="text-xs sm:text-sm text-amber-200/90 max-w-xl leading-relaxed">
                    Welcome to your private matrimonial sanctuary. Your dignity, personal modesty, and family honor are protected at every stage.
                </p>

                <!-- Profile Tags -->
                <div class="flex flex-wrap items-center gap-2 pt-2 text-[11px]">
                    <span class="px-2.5 py-1 rounded-lg bg-rose-950/60 border border-rose-700/60 text-amber-200">
                        Gotra: <strong>{{ $profile?->gotra ?? 'Not specified' }}</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-rose-950/60 border border-rose-700/60 text-amber-200">
                        Sampradaya: <strong>{{ $profile?->sampradaya ?? 'Dharmic' }}</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-rose-950/60 border border-rose-700/60 text-amber-200">
                        {{ $user->age ?? 26 }} yrs • {{ $profile?->city ?? 'Diaspora' }}
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

            <!-- Modesty Privacy Shield Status Box -->
            <div class="bg-stone-950/70 backdrop-blur-xs p-4 sm:p-5 rounded-2xl border border-rose-400/40 text-center sm:text-right shrink-0 space-y-1.5">
                <span class="text-[10px] font-bold uppercase tracking-wider text-rose-300 block">Photo Privacy Shield</span>
                <div class="text-base font-black text-white flex items-center justify-center sm:justify-end space-x-1.5">
                    <span>🔒</span>
                    <span>{{ $photoPrivacy === 'blur_until_mutual' ? 'MODESTY BLUR ACTIVE' : 'PUBLIC PHOTO' }}</span>
                </div>
                <span class="text-[10px] text-amber-300/80 block">
                    {{ $photoPrivacy === 'blur_until_mutual' ? 'Unlocks only on mutual consent' : 'Visible to verified seekers' }}
                </span>
                <a href="{{ route('profile.edit') }}#privacy" class="inline-block text-[11px] text-rose-300 hover:text-white underline font-semibold">
                    Change Privacy Setting →
                </a>
            </div>
        </div>
    </div>

    <!-- Profile Completeness Prompt (Nikah Matrimony Pattern) -->
    @php
        $completeness = $profile?->profile_completeness_pct ?? 40;
    @endphp
    @if($completeness < 100)
    <div class="bg-gradient-to-r from-rose-50 to-amber-50 rounded-2xl p-4 sm:p-5 border border-rose-300/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center space-x-2">
                <span class="text-base">📝</span>
                <span class="font-bold text-rose-950 text-xs sm:text-sm">Complete Your Sacred Biodata</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-200 text-rose-900">{{ $completeness }}% Complete</span>
            </div>
            <p class="text-[11px] text-stone-600">
                A complete biodata with modesty photo settings and family preferences fosters greater respect and genuine Dharmic proposals.
            </p>
            <div class="w-full sm:w-72 bg-rose-200/60 rounded-full h-2 overflow-hidden mt-1">
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
        <!-- Suitor Proposals Pending -->
        <a href="{{ route('proposals.index') }}" class="bg-white p-5 rounded-2xl border border-rose-200 shadow-xs hover:border-rose-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Pending Suitors</span>
                <span class="text-lg group-hover:scale-110 transition transform">💌</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $pendingReceivedProposals->count() }}</div>
            <span class="text-[10px] text-rose-700 font-semibold mt-1 block">Awaiting Your Review →</span>
        </a>

        <!-- Compatible Grooms -->
        <a href="{{ route('discovery.index') }}" class="bg-white p-5 rounded-2xl border border-rose-200 shadow-xs hover:border-rose-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Eligible Grooms</span>
                <span class="text-lg group-hover:scale-110 transition transform">🤵</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $totalCompatibleGrooms }}</div>
            <span class="text-[10px] text-amber-700 font-semibold mt-1 block">Browse Matches →</span>
        </a>

        <!-- Shortlists -->
        <a href="{{ route('shortlists.index') }}" class="bg-white p-5 rounded-2xl border border-rose-200 shadow-xs hover:border-rose-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Shortlisted</span>
                <span class="text-lg group-hover:scale-110 transition transform">⭐</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $shortlistsCount }}</div>
            <span class="text-[10px] text-amber-700 font-semibold mt-1 block">Saved Grooms →</span>
        </a>

        <!-- Chaperoned Chat -->
        <a href="{{ route('chat.index') }}" class="bg-white p-5 rounded-2xl border border-rose-200 shadow-xs hover:border-rose-400 transition smooth-card group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-600">Family Chat</span>
                <span class="text-lg group-hover:scale-110 transition transform">💬</span>
            </div>
            <div class="text-2xl font-extrabold text-red-950">{{ $unreadMessagesCount }} <span class="text-xs text-stone-400 font-normal">unread</span></div>
            <span class="text-[10px] text-emerald-700 font-semibold mt-1 block">Family Protected →</span>
        </a>
    </div>

    <!-- Quick Action Launchpad Bar -->
    <div class="bg-white rounded-2xl p-4 border border-rose-200/90 shadow-xs flex flex-wrap items-center justify-between gap-3 text-xs">
        <span class="font-bold text-stone-700 uppercase tracking-wider text-[11px] flex items-center space-x-1.5">
            <span>⚡</span>
            <span>Bride Quick Actions:</span>
        </span>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('proposals.index') }}" class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-300 text-rose-950 font-bold transition">
                💌 Review Suitor Proposals ({{ $pendingReceivedProposals->count() }})
            </a>
            <a href="{{ route('discovery.index') }}" class="px-3 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-300 text-amber-900 font-bold transition">
                🔍 Find Compatible Grooms
            </a>
            <a href="{{ route('horoscope.edit') }}" class="px-3 py-1.5 rounded-xl bg-red-50 hover:bg-red-100 border border-red-200 text-red-900 font-bold transition">
                🪐 Kundli & 36-Gunas
            </a>
            <a href="{{ route('profile.edit') }}#privacy" class="px-3 py-1.5 rounded-xl bg-stone-50 hover:bg-stone-100 border border-stone-300 text-stone-800 font-bold transition">
                🔒 Privacy & Modesty Shield
            </a>
        </div>
    </div>

    <!-- Main Grid: Incoming Suitors & Family Representative Chaperone -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Column 1 & 2: Suitor Proposals Awaiting Review -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between pb-1 border-b border-rose-200/80">
                <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                    <span>💌</span>
                    <span>Suitors Seeking Your Sacred Union</span>
                </h2>
                <a href="{{ route('proposals.index') }}" class="text-xs font-bold text-rose-800 hover:text-red-900">
                    All Proposals →
                </a>
            </div>

            @if($pendingReceivedProposals->isNotEmpty())
                <div class="space-y-3">
                    @foreach($pendingReceivedProposals as $prop)
                        @php
                            $suitor = $prop->sender;
                            $sProfile = $suitor->profile;
                        @endphp
                        <div class="bg-white rounded-2xl p-4 border border-rose-200/80 shadow-xs hover:border-rose-400 transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center space-x-3.5">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden bg-stone-900 border border-rose-300 shrink-0">
                                    <img src="{{ $suitor->primary_photo_url }}" alt="{{ $suitor->name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="font-heading font-bold text-sm text-stone-900">{{ $suitor->name }}</h3>
                                    <p class="text-xs text-rose-900 font-semibold">
                                        {{ $sProfile?->caste_jati ?? 'Hindu' }} ({{ $sProfile?->gotra ?? 'Gotra N/A' }}) • {{ $suitor->age }} yrs
                                    </p>
                                    <p class="text-[11px] text-stone-500">
                                        {{ $sProfile?->profession ?? 'Professional' }} • {{ $sProfile?->city ?? 'Diaspora' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2 w-full sm:w-auto">
                                <form action="{{ route('proposals.accept', $prop->id) }}" method="POST" class="flex-1 sm:flex-initial">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 rounded-xl gold-gradient text-white font-bold text-xs shadow-xs hover:opacity-95 transition">
                                        Accept Interest
                                    </button>
                                </form>
                                <form action="{{ route('proposals.decline', $prop->id) }}" method="POST" class="flex-1 sm:flex-initial">
                                    @csrf
                                    <button type="submit" class="w-full px-3 py-2 rounded-xl border border-stone-300 text-stone-600 font-bold text-xs hover:bg-stone-50 transition">
                                        Decline
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-rose-50/50 rounded-2xl p-6 border border-rose-200 text-center space-y-2">
                    <span class="text-2xl">🕊️</span>
                    <h3 class="font-heading font-bold text-sm text-rose-950">No Pending Suitor Proposals</h3>
                    <p class="text-xs text-stone-600 max-w-md mx-auto">
                        Your biodata is active in the discovery directory. When prospective grooms send proposals, you and your family elders can review them here.
                    </p>
                    <a href="{{ route('discovery.index') }}" class="inline-block mt-2 px-4 py-2 rounded-xl gold-gradient text-white text-xs font-bold shadow-xs">
                        Explore Compatible Grooms
                    </a>
                </div>
            @endif

            <!-- Recommended Compatible Grooms Preview -->
            <div class="pt-4">
                <h3 class="font-heading font-bold text-sm text-stone-900 mb-3 flex items-center space-x-1.5">
                    <span>✨</span>
                    <span>Recommended Grooms Based on Your Sanskar:</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($recommendedGrooms as $item)
                        @php
                            $groom = $item['user'];
                            $gProfile = $groom->profile;
                            $comp = $item['compatibility'];
                        @endphp
                        <div class="bg-white rounded-2xl border border-amber-200/90 p-3.5 space-y-2 shadow-xs hover:border-amber-400 transition smooth-card">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-stone-900 shrink-0">
                                    <img src="{{ $groom->primary_photo_url }}" alt="{{ $groom->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-bold text-xs text-stone-900 truncate">{{ $groom->name }}</h4>
                                    <span class="text-[10px] text-amber-800 font-semibold block truncate">
                                        {{ $gProfile?->gotra ?? 'Gotra' }} • {{ $groom->age }} yrs • {{ $gProfile?->city ?? 'Diaspora' }}
                                    </span>
                                    <span class="text-[10px] text-emerald-700 font-bold">
                                        ✨ {{ $comp['percentage'] }}% Match
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('profile.show', $groom->id) }}" class="w-full py-1.5 rounded-lg border border-red-900 text-red-900 hover:bg-red-50 text-[11px] font-bold text-center block transition">
                                View Suitor Biodata
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Column 3: Family Representative & Chaperone Status -->
        <div class="space-y-6">
            <!-- Family Representative Card -->
            <div class="bg-white rounded-3xl p-5 border border-rose-200 shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-rose-100">
                    <h3 class="font-heading font-bold text-sm text-red-950 flex items-center space-x-1.5">
                        <span>👥</span>
                        <span>Guardian Chaperone</span>
                    </h3>
                    <a href="{{ route('family.manage') }}" class="text-[10px] font-bold text-rose-800 hover:underline">
                        Manage →
                    </a>
                </div>

                @if($familyRepLink)
                    <div class="p-3.5 rounded-2xl bg-rose-50/60 border border-rose-200/80 space-y-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-rose-900 text-amber-200 font-bold flex items-center justify-center text-xs shrink-0">
                                {{ strtoupper(substr($familyRepLink->representativeUser->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-stone-900 text-xs truncate">{{ $familyRepLink->representativeUser->name }}</h4>
                                <span class="text-[10px] text-rose-800 font-semibold block">
                                    {{ ucfirst($familyRepLink->relationship) }} • Full Oversight
                                </span>
                            </div>
                        </div>
                        <p class="text-[11px] text-stone-600 leading-tight">
                            ✓ Active in 3-way chaperoned conversations to safeguard family honor and ensure respectful discourse.
                        </p>
                    </div>
                @else
                    <div class="text-center py-4 space-y-2">
                        <div class="text-2xl">👨‍👩‍👧</div>
                        <p class="text-xs text-stone-600 leading-relaxed">
                            Link your father, mother, or trusted family elder to chaperone chats and review prospective in-laws.
                        </p>
                        <a href="{{ route('family.manage') }}" class="inline-block px-4 py-2 rounded-xl bg-rose-100 hover:bg-rose-200 text-rose-950 text-xs font-bold transition">
                            Link Family Elder (Free)
                        </a>
                    </div>
                @endif
            </div>

            <!-- Modesty & Anti-Dowry Shield Notice -->
            <div class="bg-gradient-to-br from-[#2a080c] to-[#1a0507] text-amber-100 rounded-3xl p-5 border border-rose-900/50 shadow-xs space-y-2.5 text-xs">
                <span class="font-bold text-rose-300 text-[11px] uppercase tracking-wider block">
                    Kanya Safeguards & Ethics
                </span>
                <ul class="space-y-1.5 text-amber-200/80 text-[11px]">
                    <li>• Contact shield masks your phone and email from suitors</li>
                    <li>• Dowry demands automatically trigger instant ban & police report</li>
                    <li>• Photos remain respectfully blurred until you grant mutual consent</li>
                    <li>• Chaperoned family oversight ensures zero unsolicited harassment</li>
                </ul>
                <div class="pt-1">
                    <a href="{{ route('about') }}#legal-compliance" class="text-[10px] font-bold text-rose-300 hover:underline">
                        Read Kanya Protection Charter →
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection


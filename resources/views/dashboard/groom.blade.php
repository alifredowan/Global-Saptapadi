@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Groom Hero Banner -->
    <div class="relative overflow-hidden rounded-2xl section--dark text-white p-6 sm:p-8 shadow-sm border border-[var(--color-accent)]/30">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs text-stone-200 text-xs font-medium tracking-wide border border-white/20">
                    <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                    <span>Var Portal &bull; Groom Dashboard</span>
                </div>
                <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">
                    Namaste, {{ $user->name }}
                </h1>
                <p class="text-xs sm:text-sm text-stone-200 max-w-xl leading-relaxed">
                    Track candidate inquiries, review astrological compatibility, and manage conversations guided by family trust.
                </p>

                <!-- Profile Tags -->
                <div class="flex flex-wrap items-center gap-2 pt-2 text-[11px]">
                    <span class="px-2.5 py-1 rounded-lg bg-black/20 border border-white/10 text-stone-200">
                        Gotra: <strong>{{ $profile?->gotra ?? 'Not specified' }}</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-black/20 border border-white/10 text-stone-200">
                        Sampradaya: <strong>{{ $profile?->sampradaya ?? 'Dharmic' }}</strong>
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-black/20 border border-white/10 text-stone-200">
                        {{ $user->age ?? 28 }} yrs &bull; {{ $profile?->city ?? 'Diaspora' }}
                    </span>
                    @if($user->is_verified)
                        <span class="px-2.5 py-1 rounded-lg bg-emerald-950/60 border border-emerald-500/50 text-emerald-300 font-medium inline-flex items-center gap-1">
                            <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            <span>ID Verified</span>
                        </span>
                    @else
                        <a href="{{ route('verification.index') }}" class="px-2.5 py-1 rounded-lg bg-amber-500/20 border border-amber-400/50 text-[var(--color-accent)] font-medium hover:bg-amber-500/30 transition inline-flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                            <span>Complete ID Verification &rarr;</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Single Vivah Pass Status Box -->
            <div class="bg-black/30 backdrop-blur-xs p-4 sm:p-5 rounded-xl border border-white/15 text-center sm:text-right shrink-0 space-y-1.5">
                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 block">Single Vivah Pass</span>
                @if($isPro)
                    <div class="text-base font-serif font-bold text-white flex items-center justify-center sm:justify-end gap-1.5">
                        <svg class="w-4 h-4 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>PRO PASS ACTIVE</span>
                    </div>
                    <span class="text-[11px] text-emerald-300 font-medium block">Valid until wedding declaration</span>
                @else
                    <div class="text-sm font-medium text-stone-200">Free Explorer Tier</div>
                    <a href="{{ route('membership.index') }}" class="inline-block mt-1 px-3.5 py-1.5 rounded-xl bg-[var(--color-accent)] hover:bg-[var(--color-accent-hover)] text-white text-xs font-medium shadow-xs transition">
                        Get Single Pass ($29 once) &rarr;
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Profile Completeness Prompt -->
    @php
        $completeness = $profile?->profile_completeness_pct ?? 40;
    @endphp
    @if($completeness < 100)
    <div class="bg-amber-50/70 dark:bg-amber-950/20 rounded-2xl p-4 sm:p-5 border border-amber-200/80 dark:border-amber-900/50 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-[var(--color-accent)] dark:text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                <span class="font-medium text-stone-900 dark:text-stone-100 text-xs sm:text-sm">Complete Your Biodata</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-100 dark:bg-amber-900/40 text-[var(--color-accent)] dark:text-amber-300 border border-amber-200/60 dark:border-amber-800/60">{{ $completeness }}% Complete</span>
            </div>
            <p class="text-[11px] text-stone-600 dark:text-stone-400">
                Candidates with completed Gotra, lifestyle, education, and family preferences receive more aligned family responses.
            </p>
            <div class="w-full sm:w-72 bg-stone-200 dark:bg-stone-700 rounded-full h-1.5 overflow-hidden mt-1.5">
                <div class="bg-[var(--color-primary)] dark:bg-[var(--color-accent)] h-full rounded-full transition-all duration-500" style="width: {{ $completeness }}%"></div>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white text-xs font-medium shadow-xs transition shrink-0 flex items-center justify-center space-x-1.5">
            <span>Complete 7-Step Biodata &rarr;</span>
        </a>
    </div>
    @endif

    <!-- 4 Key Statistics Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <!-- Eligible Brides -->
        <a href="{{ route('discovery.index') }}" class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs hover:border-[var(--color-accent)]/40 transition group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500">Eligible Candidates</span>
                <svg class="w-4 h-4 text-stone-400 group-hover:text-[var(--color-primary)] dark:group-hover:text-[var(--color-accent)] transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
            <div class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">{{ $totalCompatibleBrides }}</div>
            <span class="text-[10px] text-[var(--color-accent)] dark:text-[var(--color-accent)] font-medium mt-1 block">Browse Matches &rarr;</span>
        </a>

        <!-- Received Proposals -->
        <a href="{{ route('proposals.index') }}" class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs hover:border-[var(--color-accent)]/40 transition group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500">Proposals</span>
                <svg class="w-4 h-4 text-stone-400 group-hover:text-[var(--color-primary)] dark:group-hover:text-[var(--color-accent)] transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
            </div>
            <div class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">{{ $pendingReceivedProposals->count() }} <span class="text-xs text-stone-400 font-sans font-normal">pending</span></div>
            <span class="text-[10px] text-stone-500 mt-1 block">{{ $sentProposalsCount }} sent by you</span>
        </a>

        <!-- Shortlisted -->
        <a href="{{ route('shortlists.index') }}" class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs hover:border-[var(--color-accent)]/40 transition group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500">Shortlists</span>
                <svg class="w-4 h-4 text-stone-400 group-hover:text-[var(--color-primary)] dark:group-hover:text-[var(--color-accent)] transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/></svg>
            </div>
            <div class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">{{ $shortlistsCount }}</div>
            <span class="text-[10px] text-[var(--color-accent)] dark:text-[var(--color-accent)] font-medium mt-1 block">View Shortlisted &rarr;</span>
        </a>

        <!-- Chaperoned Chat -->
        <a href="{{ route('chat.index') }}" class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs hover:border-[var(--color-accent)]/40 transition group">
            <div class="flex items-center justify-between text-stone-400 mb-2">
                <span class="text-[11px] font-medium uppercase tracking-wider text-stone-500">Chaperoned Chat</span>
                <svg class="w-4 h-4 text-stone-400 group-hover:text-[var(--color-primary)] dark:group-hover:text-[var(--color-accent)] transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v7.018z"/></svg>
            </div>
            <div class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">{{ $unreadMessagesCount }} <span class="text-xs text-stone-400 font-sans font-normal">unread</span></div>
            <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-medium mt-1 block">Family Protected &rarr;</span>
        </a>
    </div>

    <!-- Quick Action Launchpad Bar -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-4 border border-stone-200/90 dark:border-stone-800 shadow-xs flex flex-wrap items-center justify-between gap-3 text-xs">
        <span class="font-medium text-stone-700 dark:text-stone-300 tracking-wider text-[11px] flex items-center space-x-1.5">
            <span>Groom Actions:</span>
        </span>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('discovery.index') }}" class="px-3 py-1.5 rounded-xl bg-stone-50 dark:bg-stone-800 hover:bg-stone-100 dark:hover:bg-stone-700 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-200 font-medium transition">
                Browse Candidates
            </a>
            <a href="{{ route('horoscope.edit') }}" class="px-3 py-1.5 rounded-xl bg-stone-50 dark:bg-stone-800 hover:bg-stone-100 dark:hover:bg-stone-700 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-200 font-medium transition">
                Kundli &amp; 36-Gunas
            </a>
            <a href="{{ route('family.manage') }}" class="px-3 py-1.5 rounded-xl bg-stone-50 dark:bg-stone-800 hover:bg-stone-100 dark:hover:bg-stone-700 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-200 font-medium transition">
                Family Elders / Ghotok
            </a>
            <a href="{{ route('membership.index') }}" class="px-3 py-1.5 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium transition shadow-xs">
                Single Vivah Pass ($29)
            </a>
        </div>
    </div>

    <!-- Main Grid: Top Recommended Candidates & Family Oversight -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Column 1 & 2: Top Compatible Candidates -->
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between pb-1 border-b border-stone-200 dark:border-stone-800">
                <h2 class="font-serif font-bold text-lg text-stone-900 dark:text-stone-100">
                    Recommended Candidates
                </h2>
                <a href="{{ route('discovery.index') }}" class="text-xs font-medium text-[var(--color-accent)] dark:text-[var(--color-accent)] hover:underline">
                    View All &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($recommendedBrides as $item)
                    @php
                        $bride = $item['user'];
                        $bProfile = $bride->profile;
                        $comp = $item['compatibility'];
                    @endphp
                    <div class="bg-white dark:bg-stone-900 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs hover:border-[var(--color-accent)]/40 transition overflow-hidden flex flex-col justify-between">
                        <div>
                            <!-- Photo with Modesty Shield -->
                            <div class="relative h-44 bg-stone-900 overflow-hidden">
                                <img src="{{ $bride->primary_photo_url }}" alt="{{ $bride->name }}" class="w-full h-full object-cover filter blur-xs scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                                <div class="absolute top-2 inset-x-2 flex items-center justify-between">
                                    <span class="bg-black/60 backdrop-blur-xs text-stone-200 px-2 py-0.5 rounded-full text-[10px] font-medium border border-white/20">
                                        ✓ Verified
                                    </span>
                                    <span class="bg-[var(--color-primary)]/90 text-stone-100 px-2.5 py-0.5 rounded-full text-[10px] font-medium border border-white/20">
                                        {{ $comp['percentage'] }}% Match
                                    </span>
                                </div>

                                <div class="absolute bottom-2 inset-x-3 text-white">
                                    <h3 class="font-serif font-bold text-base text-white truncate">{{ $bride->name }}</h3>
                                    <p class="text-[11px] text-stone-300 truncate">
                                        {{ $bride->age }} yrs &bull; {{ $bProfile?->city ?? 'Diaspora' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Specs -->
                            <div class="p-3.5 space-y-2 text-xs">
                                <div class="grid grid-cols-2 gap-1.5 text-[11px] bg-stone-50 dark:bg-stone-800/60 p-2.5 rounded-xl border border-stone-100 dark:border-stone-700/60">
                                    <div>
                                        <span class="text-stone-400 text-[9px] uppercase font-bold block">Gotra</span>
                                        <span class="font-medium text-stone-800 dark:text-stone-200 truncate block">{{ $bProfile?->gotra ?? 'Not specified' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-stone-400 text-[9px] uppercase font-bold block">Profession</span>
                                        <span class="font-medium text-stone-800 dark:text-stone-200 truncate block">{{ $bProfile?->profession ?? 'Professional' }}</span>
                                    </div>
                                </div>

                                <!-- Guna Milan Row -->
                                @if(!empty($comp['guna_milan']))
                                    <div class="flex items-center justify-between p-2 rounded-lg bg-amber-50/70 dark:bg-amber-950/30 border border-amber-200/80 dark:border-amber-900/40 text-[11px] text-stone-800 dark:text-stone-200">
                                        <span>Ashtakoota Milan:</span>
                                        <span class="px-2 py-0.5 rounded-full font-medium bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                            {{ $comp['guna_milan']['total_score'] }} / 36
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="p-3.5 pt-0">
                            <a href="{{ route('profile.show', $bride->id) }}" class="w-full py-2 rounded-xl border border-stone-300 dark:border-stone-700 text-stone-700 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 text-xs font-medium text-center block transition">
                                View Biodata
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 p-6 text-center text-xs text-stone-500 bg-white dark:bg-stone-900 rounded-2xl border border-stone-200 dark:border-stone-800">
                        No active candidate profiles found matching your preferences.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Column 3: Family Representative & Chaperone Status -->
        <div class="space-y-6">
            <!-- Family Representative Card -->
            <div class="bg-white dark:bg-stone-900 rounded-2xl p-5 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-stone-200 dark:border-stone-800">
                    <h3 class="font-serif font-bold text-sm text-stone-900 dark:text-stone-100 flex items-center space-x-1.5">
                        <svg class="w-4 h-4 text-[var(--color-accent)] dark:text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                        <span>Family Elder (Ghotok)</span>
                    </h3>
                    <a href="{{ route('family.manage') }}" class="text-[11px] font-medium text-[var(--color-accent)] dark:text-[var(--color-accent)] hover:underline">
                        Manage &rarr;
                    </a>
                </div>

                @if($familyRepLink)
                    <div class="p-3.5 rounded-xl bg-amber-50/70 dark:bg-amber-950/20 border border-amber-200/80 dark:border-amber-900/50 space-y-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-[var(--color-primary)] text-stone-100 font-serif font-bold flex items-center justify-center text-xs shrink-0">
                                {{ strtoupper(substr($familyRepLink->representativeUser->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-medium text-stone-900 dark:text-stone-100 text-xs truncate">{{ $familyRepLink->representativeUser->name }}</h4>
                                <span class="text-[11px] text-stone-500 dark:text-stone-400 block">
                                    {{ ucfirst($familyRepLink->relationship) }} &bull; {{ ucfirst(str_replace('_', ' ', $familyRepLink->permission_scope)) }}
                                </span>
                            </div>
                        </div>
                        <p class="text-[11px] text-stone-600 dark:text-stone-400 leading-tight">
                            ✓ Actively assisting in proposal evaluation and chaperoned family conversations.
                        </p>
                    </div>
                @else
                    <div class="text-center py-4 space-y-2">
                        <p class="text-xs text-stone-600 dark:text-stone-400 leading-relaxed">
                            Invite your parents or a trusted family Ghotok to review biodatas on your behalf.
                        </p>
                        <a href="{{ route('family.manage') }}" class="inline-block px-4 py-2 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-[var(--color-accent)] dark:text-amber-300 text-xs font-medium transition hover:bg-amber-100">
                            Link Family Elder (Free)
                        </a>
                    </div>
                @endif
            </div>

            <!-- Customary Vedic Integrity Notice -->
            <div class="bg-stone-50 dark:bg-stone-800/60 text-stone-700 dark:text-stone-300 rounded-2xl p-5 border border-stone-200/90 dark:border-stone-700/80 shadow-xs space-y-2.5 text-xs">
                <span class="font-serif font-bold text-stone-900 dark:text-stone-100 text-sm block">
                    Matrimonial Safeguards
                </span>
                <ul class="space-y-1.5 text-stone-600 dark:text-stone-400 text-[11px]">
                    <li>&bull; Minimum legal age: 21 for groom / 18 for bride</li>
                    <li>&bull; Sagotra marriages require ancestral Gotra verification</li>
                    <li>&bull; Zero-dowry policy strictly enforced by law</li>
                    <li>&bull; Saptapadi vows celebrate union upon match</li>
                </ul>
                <div class="pt-1">
                    <a href="{{ route('about') }}" class="text-[11px] font-medium text-[var(--color-accent)] dark:text-[var(--color-accent)] hover:underline">
                        Read Community Guidelines &rarr;
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

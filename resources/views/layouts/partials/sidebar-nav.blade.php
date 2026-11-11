@php
    $user = Auth::user();
    $unreadCount = $user ? \App\Models\Message::where('receiver_user_id', $user->id)->whereNull('read_at')->count() : 0;
    $pendingProposals = $user ? $user->receivedProposals()->where('status', 'pending')->count() : 0;
    $shortlistsCount = $user ? $user->shortlists()->count() : 0;
    $isRep = $user && (in_array($user->role, ['family_rep', 'pandit']) || \App\Models\FamilyRepresentative::where('rep_user_id', $user->id)->exists());
    $isAdmin = $user && $user->role === 'admin';
    $isSeeker = $user && in_array($user->role, ['groom', 'bride']);
    $pendingMilestone = $user ? \App\Models\VivahMilestone::where(function($q) use ($user) {
        $q->where('spouse_a_user_id', $user->id)->orWhere('spouse_b_user_id', $user->id);
    })->latest()->first() : null;
@endphp

<div class="space-y-6">

    {{-- 0. ROLE-SPECIFIC DASHBOARD NAVIGATION --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] flex items-center justify-between">
            <span>Portal</span>
            <span class="text-[9px] px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-text)] font-semibold uppercase">
                @if($isAdmin) Admin
                @elseif($user?->role === 'pandit') Pandit Acharya
                @elseif($user?->role === 'family_rep') Family Elder
                @elseif($user?->gender === 'female' || $user?->role === 'bride') Kanya (Bride)
                @else Var (Groom)
                @endif
            </span>
        </div>
        <div class="space-y-1">
            @if($isAdmin)
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    <span class="flex-1">Admin Dashboard</span>
                </a>
            @elseif($user?->role === 'pandit')
                <a href="{{ route('pandit.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('pandit.dashboard') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3m14.5-6.5-13 13m0-13 13 13"/></svg>
                    <span class="flex-1">Pandit Acharya Dashboard</span>
                </a>
            @elseif($user?->role === 'family_rep')
                <a href="{{ route('family.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('family.dashboard') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                    <span class="flex-1">Family Elder Console</span>
                </a>
            @elseif($user?->gender === 'female' || $user?->role === 'bride')
                <a href="{{ route('bride.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('bride.dashboard') || (request()->routeIs('dashboard') && $user?->gender === 'female') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                    <span class="flex-1">Bride Dashboard (Kanya)</span>
                </a>
            @else
                <a href="{{ route('groom.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('groom.dashboard') || (request()->routeIs('dashboard') && $user?->gender !== 'female') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                    <span class="flex-1">Groom Dashboard (Var)</span>
                </a>
            @endif
        </div>

        {{-- Collapsible: All User Role Dashboards --}}
        <div x-data="{ showAllDashboards: false }" class="mt-2">
            <button type="button" @click="showAllDashboards = !showAllDashboards"
                    class="w-full flex items-center justify-between px-3 py-1.5 rounded-[var(--radius-sm)] bg-stone-900/60 hover:bg-stone-900 text-[11px] font-medium text-stone-300 border border-stone-800 transition">
                <span class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    <span>Switch Role View</span>
                </span>
                <span x-text="showAllDashboards ? '−' : '+'" class="text-xs text-stone-400"></span>
            </button>
            <div x-show="showAllDashboards" x-cloak class="mt-1.5 space-y-1 pl-2 border-l border-stone-800">
                <a href="{{ route('groom.dashboard') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded text-[11px] text-stone-300 hover:text-white hover:bg-white/5 transition">
                    <span>Groom Dashboard</span>
                </a>
                <a href="{{ route('bride.dashboard') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded text-[11px] text-stone-300 hover:text-white hover:bg-white/5 transition">
                    <span>Bride Dashboard</span>
                </a>
                <a href="{{ route('family.dashboard') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded text-[11px] text-stone-300 hover:text-white hover:bg-white/5 transition">
                    <span>Family Elder Console</span>
                </a>
                <a href="{{ route('pandit.dashboard') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded text-[11px] text-stone-300 hover:text-white hover:bg-white/5 transition">
                    <span>Pandit Acharya Console</span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-2.5 py-1.5 rounded text-[11px] text-stone-300 hover:text-white hover:bg-white/5 transition">
                    <span>Admin Operations</span>
                </a>
            </div>
        </div>
    </div>

    {{-- 1. MATCHMAKING & DISCOVERY --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] flex items-center justify-between">
            <span>Discovery</span>
        </div>
        <div class="space-y-1">
            <a href="{{ route('discovery.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('discovery.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <span class="flex-1">Explore Candidates</span>
            </a>

            <a href="{{ route('shortlists.index') }}"
               class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('shortlists.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                    <span>Saved Shortlists</span>
                </div>
                @if($shortlistsCount > 0)
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-stone-800 text-stone-300 border border-stone-700">
                        {{ $shortlistsCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('proposals.index') }}"
               class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('proposals.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    <span>Proposals &amp; Notifications</span>
                </div>
                @if($pendingProposals > 0)
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-[var(--secondary-primary)] text-white">
                        {{ $pendingProposals }}
                    </span>
                @endif
            </a>

            <a href="{{ route('chat.index') }}"
               class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('chat.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/></svg>
                    <span>Messages &amp; Chat</span>
                </div>
                @if($unreadCount > 0)
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-[var(--color-danger)] text-white">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    {{-- 2. VEDIC ASTROLOGY & HERITAGE --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)]">
            Vedic Heritage
        </div>
        <div class="space-y-1">
            <a href="{{ route('horoscope.edit') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('horoscope.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a14.5 14.5 0 0 0 0 18M12 3a14.5 14.5 0 0 1 0 18M3 12h18"/></svg>
                <span class="flex-1">Kundli &amp; 36-Guna Milan</span>
            </a>
            <a href="{{ route('profile.edit') }}#gotra"
               class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition text-stone-300 hover:bg-white/5 hover:text-white">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                <span class="flex-1">Gotra Lineage Integrity</span>
            </a>
        </div>
    </div>

    {{-- 3. FAMILY DELEGATION & OVERSIGHT --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] flex items-center justify-between">
            <span>Family Care</span>
            <span class="text-[9px] px-1.5 py-0.5 rounded bg-[var(--color-success-bg)] text-[var(--color-success)] font-semibold uppercase">Always Free</span>
        </div>
        <div class="space-y-1">
            @if($isRep)
                <a href="{{ route('family.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('family.dashboard') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5"/></svg>
                    <span class="flex-1">Guardian Console</span>
                </a>
            @else
                <a href="{{ route('family.manage') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('family.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                    <span class="flex-1">Family Elders &amp; Guardians</span>
                </a>
            @endif
        </div>
    </div>

    {{-- 4. SACRED MILESTONE & SHUBHO BIBAHO --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)]">
            Sacred Union
        </div>
        <div class="space-y-1">
            <a href="{{ route('milestone.index') }}"
               class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('milestone.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5"/></svg>
                    <span>Shubho Bibaho Registry</span>
                </div>
                @if($pendingMilestone)
                    <span class="px-1.5 py-0.5 rounded text-[9px] font-semibold bg-[var(--secondary-primary)] text-white">
                        {{ ucfirst($pendingMilestone->status) }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    {{-- 5. TRUST, PRIVACY & PASS --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)]">
            Trust &amp; Membership
        </div>
        <div class="space-y-1">
            <a href="{{ route('verification.index') }}"
               class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('verification.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    <span>Verification &amp; Privacy Shield</span>
                </div>
                @if($user && $user->is_verified)
                    <span class="text-[var(--color-success)] text-xs font-bold">✓</span>
                @endif
            </a>

            <a href="{{ route('membership.index') }}"
               class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('membership.*') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <span>Single Vivah Pass</span>
                </div>
                @if($user && $user->isPro())
                    <span class="px-1.5 py-0.2 rounded text-[9px] font-bold bg-[var(--secondary-primary)] text-white uppercase tracking-wider">Pass Active</span>
                @endif
            </a>
        </div>
    </div>

    {{-- 6. ADMIN GOVERNANCE (If Admin) --}}
    @if($isAdmin)
        <div>
            <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-rose-400 flex items-center justify-between">
                <span>Platform Governance</span>
                <span class="text-[9px] px-1.5 py-0.5 rounded bg-rose-500/20 text-rose-300 font-semibold uppercase">Admin</span>
            </div>
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/></svg>
                    <span class="flex-1">Admin Operations</span>
                </a>
                <a href="{{ route('admin.audit_logs') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('admin.audit_logs') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                    <span class="flex-1">Audit Logs</span>
                </a>
            </div>
        </div>
    @endif

    {{-- 7. DEMO PERSONAS (Subtle tester bar) --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-stone-400">
            Switch Demo Account
        </div>
        <div class="grid grid-cols-2 gap-1.5 px-1">
            <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}"
               class="p-1.5 rounded-[var(--radius-sm)] text-[11px] font-medium text-center transition border {{ $user?->email === 'arun@example.com' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-stone-900 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Dr. Arun (Groom)
            </a>
            <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}"
               class="p-1.5 rounded-[var(--radius-sm)] text-[11px] font-medium text-center transition border {{ $user?->email === 'priya@example.com' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-stone-900 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Priya (Bride)
            </a>
            <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}"
               class="p-1.5 rounded-[var(--radius-sm)] text-[11px] font-medium text-center transition border {{ $user?->email === 'subhash@example.com' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-stone-900 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Subhash (Elder)
            </a>
            <a href="{{ route('demo.login', ['email' => 'pandit@globalsaptapadi.com']) }}"
               class="p-1.5 rounded-[var(--radius-sm)] text-[11px] font-medium text-center transition border {{ $user?->email === 'pandit@globalsaptapadi.com' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-stone-900 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Pandit Kalyan
            </a>
        </div>
    </div>

    {{-- 8. BIODATA & SETTINGS --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)]">
            Account &amp; Settings
        </div>
        <div class="space-y-1">
            <a href="{{ route('profile.show') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('profile.show') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                <span class="flex-1">View Biodata &amp; Photos</span>
            </a>
            <a href="{{ route('profile.edit') }}"
               class="flex items-center justify-between px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('profile.edit') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                    <span class="flex-1">Edit Biodata</span>
                </div>
                <span class="text-[9px] px-1.5 py-0.5 rounded bg-stone-800 text-stone-300 font-semibold">7 Steps</span>
            </a>
            <a href="{{ route('settings.privacy') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('settings.privacy') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                <span class="flex-1">Settings &amp; Privacy</span>
            </a>
            @if($isAdmin)
                <a href="{{ route('admin.compliance') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-[var(--radius-sm)] text-xs font-medium transition {{ request()->routeIs('admin.compliance') ? 'bg-[var(--accent-primary)] text-white shadow-xs' : 'text-stone-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    <span class="flex-1">Compliance &amp; Cookies</span>
                </a>
            @endif
        </div>
    </div>

</div>

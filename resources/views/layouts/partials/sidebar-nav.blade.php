@php
    $user = Auth::user();
    $unreadCount = $user ? \App\Models\Message::where('receiver_user_id', $user->id)->whereNull('read_at')->count() : 0;
    $pendingProposals = $user ? $user->receivedProposals()->where('status', 'pending')->count() : 0;
    $shortlistsCount = $user ? $user->shortlists()->count() : 0;
    $isRep = $user && $user->role === 'family_rep';
    $isAdmin = $user && $user->role === 'admin';
    $isSeeker = $user && in_array($user->role, ['groom', 'bride']);
    $pendingMilestone = $user ? \App\Models\VivahMilestone::where(function($q) use ($user) {
        $q->where('spouse_a_user_id', $user->id)->orWhere('spouse_b_user_id', $user->id);
    })->latest()->first() : null;
@endphp

<div class="space-y-6">

    {{-- 1. MATCHMAKING & DISCOVERY (Seekers & Reps) --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-amber-400/80 flex items-center justify-between">
            <span>Matchmaking</span>
            <span class="text-[9px] px-1.5 py-0.5 rounded bg-amber-500/20 text-amber-300 font-bold uppercase">Seeker</span>
        </div>
        <div class="space-y-1">
            <a href="{{ route('discovery.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('discovery.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <span class="text-base">🔍</span>
                <span class="flex-1">Find Matches</span>
            </a>

            <a href="{{ route('shortlists.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('shortlists.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <span class="text-base">⭐</span>
                    <span>Shortlists</span>
                </div>
                @if($shortlistsCount > 0)
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/30 text-amber-300 border border-amber-500/40">
                        {{ $shortlistsCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('proposals.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('proposals.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <span class="text-base">💌</span>
                    <span>Proposals & Interests</span>
                </div>
                @if($pendingProposals > 0)
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-500 text-stone-950 animate-pulse">
                        {{ $pendingProposals }}
                    </span>
                @endif
            </a>

            <a href="{{ route('chat.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('chat.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <span class="text-base">💬</span>
                    <span>Chaperoned Chat</span>
                </div>
                @if($unreadCount > 0)
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-red-500 text-white animate-pulse">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    {{-- 2. VEDIC ASTROLOGY & HERITAGE --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-amber-400/80">
            Astrology & Heritage
        </div>
        <div class="space-y-1">
            <a href="{{ route('horoscope.edit') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('horoscope.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <span class="text-base">🪐</span>
                <span class="flex-1">Kundli & 36-Guna Milan</span>
            </a>
            <a href="{{ route('profile.edit') }}#gotra"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition text-stone-300 hover:bg-stone-800/60 hover:text-white">
                <span class="text-base">📜</span>
                <span class="flex-1">Gotra & Ancestral Lineage</span>
            </a>
        </div>
    </div>

    {{-- 3. FAMILY DELEGATION & OVERSIGHT --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-amber-400/80 flex items-center justify-between">
            <span>Family Oversight</span>
            <span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-bold uppercase">Always Free</span>
        </div>
        <div class="space-y-1">
            @if($isRep)
                <a href="{{ route('family.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('family.dashboard') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <span class="text-base">🏛️</span>
                    <span class="flex-1">Guardian Console</span>
                </a>
            @else
                <a href="{{ route('family.manage') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('family.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <span class="text-base">👥</span>
                    <span class="flex-1">Family Elders & Chaperone</span>
                </a>
            @endif
        </div>
    </div>

    {{-- 4. MILESTONE & SACRED UNION --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-amber-400/80">
            Sacred Union
        </div>
        <div class="space-y-1">
            <a href="{{ route('milestone.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('milestone.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <span class="text-base">🪔</span>
                    <span>Shubho Bibaho Registry</span>
                </div>
                @if($pendingMilestone)
                    <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-amber-500 text-stone-950">
                        {{ ucfirst($pendingMilestone->status) }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    {{-- 5. TRUST, PRIVACY & MEMBERSHIP --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-amber-400/80">
            Trust & Membership
        </div>
        <div class="space-y-1">
            <a href="{{ route('verification.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('verification.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <span class="text-base">🛡️</span>
                    <span>Photo Privacy & KYC</span>
                </div>
                @if($user && $user->is_verified)
                    <span class="text-emerald-400 text-xs font-bold">✓</span>
                @endif
            </a>

            <a href="{{ route('membership.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('membership.*') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md shadow-red-950/40 border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <span class="text-base">✨</span>
                    <span>Single Vivah Pass</span>
                </div>
                @if($user && $user->isPro())
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-amber-500 text-stone-950 uppercase tracking-wider">PRO</span>
                @endif
            </a>
        </div>
    </div>

    {{-- 6. ADMIN GOVERNANCE (If Admin) --}}
    @if($isAdmin)
        <div>
            <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-red-400 flex items-center justify-between">
                <span>⚡ Admin Console</span>
                <span class="text-[9px] px-1.5 py-0.5 rounded bg-red-500/20 text-red-300 font-bold uppercase">Admin</span>
            </div>
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <span class="text-base">📊</span>
                    <span class="flex-1">Admin Dashboard</span>
                </a>
                <a href="{{ route('admin.audit_logs') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.audit_logs') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    <span class="text-base">📋</span>
                    <span class="flex-1">Audit Logs</span>
                </a>
            </div>
        </div>
    @endif

    {{-- 7. DEMO ROLE SWITCHER (Integrated inside sidebar) --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-amber-400/80">
            Demo Persona Switcher
        </div>
        <div class="grid grid-cols-2 gap-1.5 px-1">
            <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}"
               class="p-2 rounded-lg text-[11px] font-semibold text-center transition border {{ $user?->email === 'arun@example.com' ? 'bg-amber-500 text-stone-950 border-amber-400 font-bold shadow-xs' : 'bg-stone-900/80 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Groom (Dr. Arun)
            </a>
            <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}"
               class="p-2 rounded-lg text-[11px] font-semibold text-center transition border {{ $user?->email === 'priya@example.com' ? 'bg-amber-500 text-stone-950 border-amber-400 font-bold shadow-xs' : 'bg-stone-900/80 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Bride (Priya)
            </a>
            <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}"
               class="p-2 rounded-lg text-[11px] font-semibold text-center transition border {{ $user?->email === 'subhash@example.com' ? 'bg-amber-500 text-stone-950 border-amber-400 font-bold shadow-xs' : 'bg-stone-900/80 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Family Rep (Subhash)
            </a>
            <a href="{{ route('demo.login', ['email' => 'admin@vivahconnect.com']) }}"
               class="p-2 rounded-lg text-[11px] font-semibold text-center transition border {{ $user?->email === 'admin@vivahconnect.com' ? 'bg-red-700 text-white border-red-500 font-bold shadow-xs' : 'bg-stone-900/80 text-stone-300 border-stone-800 hover:bg-stone-800 hover:text-white' }}">
                Admin
            </a>
        </div>
    </div>

    {{-- 8. ACCOUNT SETTINGS & PROFILE --}}
    <div>
        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-widest text-amber-400/80">
            Account
        </div>
        <div class="space-y-1">
            <a href="{{ route('profile.show') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('profile.show') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <span class="text-base">👤</span>
                <span class="flex-1">My Biodata & Photos</span>
            </a>
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-red-800 to-amber-900 text-amber-100 shadow-md border-l-4 border-amber-400' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                <span class="text-base">✏️</span>
                <span class="flex-1">Edit Preferences</span>
            </a>
        </div>
    </div>

</div>


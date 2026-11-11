{{-- Standardized Mobile Bottom Tab Bar (Max 5 items) --}}
{{-- Specs: Discover, Interests, Messages (with badge), Shortlist, Profile.
     Messages moves to the bottom bar on mobile.
     Profile button triggers mobile bottom sheet account menu. --}}

@php
    $unreadMsgDisplay = $navUnreadMessagesCount > 9 ? '9+' : ($navUnreadMessagesCount > 0 ? (string)$navUnreadMessagesCount : null);
    $notifDisplay = $navPendingProposalsCount > 9 ? '9+' : ($navPendingProposalsCount > 0 ? (string)$navPendingProposalsCount : null);
    $shortlistDisplay = $navShortlistsCount > 9 ? '9+' : ($navShortlistsCount > 0 ? (string)$navShortlistsCount : null);
@endphp

<nav class="fixed bottom-0 inset-x-0 z-40 bg-[var(--bg-surface)]/95 backdrop-blur-md border-t border-[var(--border-default)] lg:hidden pb-[env(safe-area-inset-bottom)] shadow-lg"
     aria-label="Mobile Navigation Bar">
    <div class="grid grid-cols-5 h-14 items-center">

        {{-- 1. Discover --}}
        <a href="{{ route('discovery.index') }}"
           class="flex flex-col items-center justify-center py-1 transition relative {{ request()->routeIs('discovery.*') ? 'text-[var(--accent-primary)] font-semibold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('discovery.*') ? 'stroke-[var(--accent-primary)]' : 'stroke-current' }}"
                 fill="none"
                 stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
            </svg>
            <span class="text-[10px] mt-0.5 tracking-tight leading-none">Discover</span>
            @if(request()->routeIs('discovery.*'))
                <span class="w-1 h-1 rounded-full bg-[var(--accent-primary)] absolute bottom-0.5"></span>
            @endif
        </a>

        {{-- 2. Interests --}}
        <a href="{{ route('proposals.index') }}"
           class="flex flex-col items-center justify-center py-1 transition relative {{ request()->routeIs('proposals.*') ? 'text-[var(--accent-primary)] font-semibold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <div class="relative">
                <svg class="w-5 h-5 {{ request()->routeIs('proposals.*') ? 'stroke-[var(--accent-primary)]' : 'stroke-current' }}"
                     fill="none"
                     stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                </svg>
                @if($notifDisplay)
                    <span class="absolute -top-1 -right-2.5 min-w-[16px] h-4 px-1 rounded-full bg-[var(--color-primary)] text-white text-[9px] font-bold flex items-center justify-center ring-1 ring-[var(--bg-surface)]">
                        {{ $notifDisplay }}
                    </span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight leading-none">Interests</span>
            @if(request()->routeIs('proposals.*'))
                <span class="w-1 h-1 rounded-full bg-[var(--accent-primary)] absolute bottom-0.5"></span>
            @endif
        </a>

        {{-- 3. Messages (with Badge) --}}
        <a href="{{ route('chat.index') }}"
           class="flex flex-col items-center justify-center py-1 transition relative {{ request()->routeIs('chat.*') ? 'text-[var(--accent-primary)] font-semibold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <div class="relative">
                <svg class="w-5 h-5 {{ request()->routeIs('chat.*') ? 'stroke-[var(--accent-primary)]' : 'stroke-current' }}"
                     fill="none"
                     stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/>
                </svg>
                @if($unreadMsgDisplay)
                    <span class="absolute -top-1 -right-2.5 min-w-[16px] h-4 px-1 rounded-full bg-[var(--color-primary)] text-white text-[9px] font-bold flex items-center justify-center ring-1 ring-[var(--bg-surface)]">
                        {{ $unreadMsgDisplay }}
                    </span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight leading-none">Messages</span>
            @if(request()->routeIs('chat.*'))
                <span class="w-1 h-1 rounded-full bg-[var(--accent-primary)] absolute bottom-0.5"></span>
            @endif
        </a>

        {{-- 4. Shortlist --}}
        <a href="{{ route('shortlists.index') }}"
           class="flex flex-col items-center justify-center py-1 transition relative {{ request()->routeIs('shortlists.*') ? 'text-[var(--accent-primary)] font-semibold' : 'text-[var(--text-secondary)] hover:text-[var(--text-primary)]' }}">
            <div class="relative">
                <svg class="w-5 h-5 {{ request()->routeIs('shortlists.*') ? 'stroke-[var(--accent-primary)]' : 'stroke-current' }}"
                     fill="none"
                     stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/>
                </svg>
                @if($shortlistDisplay)
                    <span class="absolute -top-1 -right-2 min-w-[14px] h-3.5 px-0.5 rounded-full bg-stone-700 text-stone-200 text-[8px] font-semibold flex items-center justify-center">
                        {{ $shortlistDisplay }}
                    </span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight leading-none">Shortlist</span>
            @if(request()->routeIs('shortlists.*'))
                <span class="w-1 h-1 rounded-full bg-[var(--accent-primary)] absolute bottom-0.5"></span>
            @endif
        </a>

        {{-- 5. Profile (Opens Mobile Account Menu Bottom Sheet) --}}
        <button type="button"
                @click="mobileAccountOpen = true"
                class="flex flex-col items-center justify-center py-1 transition cursor-pointer text-[var(--text-secondary)] hover:text-[var(--text-primary)]"
                aria-label="Account and Profile Settings">
            <div class="w-5 h-5 rounded-full overflow-hidden bg-[var(--accent-primary)] text-white text-[9px] font-serif font-bold flex items-center justify-center border border-[var(--border-default)]">
                @if(Auth::user()->primary_photo_url && !str_contains(Auth::user()->primary_photo_url, 'unsplash'))
                    <img src="{{ Auth::user()->primary_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                @else
                    <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight leading-none">Profile</span>
        </button>

    </div>
</nav>


{{-- Standardized Header Controls (Strict Order: Messages -> Notifications -> Theme Toggle -> Avatar Account Menu) --}}
{{-- Specs: 22px icons inside 44x44px hit area, 8px gap between icons, 18px badge (1-9 then 9+, hidden at 0),
     hover circle in 10% tint, active/current filled + 2px underline, visible focus ring, tooltips on hover & focus.
     NO standalone logout icon in header! --}}

@php
    $navUser = Auth::user();
    $unreadMsgDisplay = $navUnreadMessagesCount > 9 ? '9+' : ($navUnreadMessagesCount > 0 ? (string)$navUnreadMessagesCount : null);
    $totalNotifCount = $navPendingProposalsCount;
    $notifDisplay = $totalNotifCount > 9 ? '9+' : ($totalNotifCount > 0 ? (string)$totalNotifCount : null);
@endphp

<div class="flex items-center gap-2 shrink-0">

    {{-- 1. MESSAGES ICON (Chat Bubble) with Unread Count Badge --}}
    <div class="relative">
        <a href="{{ route('chat.index') }}"
           class="group relative w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-stone-500/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition cursor-pointer {{ request()->routeIs('chat.*') ? 'text-[var(--accent-primary)] after:absolute after:bottom-0 after:left-2 after:right-2 after:h-0.5 after:bg-[var(--accent-primary)]' : '' }}"
           title="Messages"
           aria-label="{{ $navUnreadMessagesCount > 0 ? $navUnreadMessagesCount . ' unread messages' : 'Messages' }}">
            {{-- Monoline Chat Bubble 22px, 1.5px stroke --}}
            <svg class="w-[22px] h-[22px] {{ request()->routeIs('chat.*') ? 'fill-[var(--accent-primary)]/15 stroke-[var(--accent-primary)]' : 'stroke-current' }}"
                 fill="none"
                 stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/>
            </svg>

            {{-- 18px Badge (Maroon, 1-9 then 9+, hidden at 0) --}}
            @if($unreadMsgDisplay)
                <span class="absolute -top-0.5 -right-0.5 w-[18px] h-[18px] rounded-full bg-[var(--color-primary)] text-white text-[11px] font-bold leading-none flex items-center justify-center ring-2 ring-[var(--bg-surface)] select-none pointer-events-none"
                      aria-hidden="true">
                    {{ $unreadMsgDisplay }}
                </span>
                <span class="sr-only">{{ $navUnreadMessagesCount }} unread messages</span>
            @endif
        </a>
    </div>

    {{-- 2. NOTIFICATIONS ICON (Bell) with Unread Count Badge & Dropdown Panel --}}
    <div class="relative">
        <button type="button"
                @click="notifOpen = !notifOpen; if(notifOpen) { accountOpen = false; }"
                :aria-expanded="notifOpen"
                aria-haspopup="dialog"
                class="group relative w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-stone-500/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition cursor-pointer"
                :class="notifOpen ? 'text-[var(--accent-primary)] after:absolute after:bottom-0 after:left-2 after:right-2 after:h-0.5 after:bg-[var(--accent-primary)]' : ''"
                title="Notifications"
                aria-label="{{ $totalNotifCount > 0 ? $totalNotifCount . ' notifications' : 'Notifications' }}">
            {{-- Monoline Bell 22px, 1.5px stroke --}}
            <svg class="w-[22px] h-[22px]"
                 :class="notifOpen ? 'fill-[var(--accent-primary)]/15 stroke-[var(--accent-primary)]' : 'stroke-current'"
                 fill="none"
                 stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
            </svg>

            {{-- 18px Badge (Maroon, 1-9 then 9+, hidden at 0) --}}
            @if($notifDisplay)
                <span class="absolute -top-0.5 -right-0.5 w-[18px] h-[18px] rounded-full bg-[var(--color-primary)] text-white text-[11px] font-bold leading-none flex items-center justify-center ring-2 ring-[var(--bg-surface)] select-none pointer-events-none"
                      aria-hidden="true">
                    {{ $notifDisplay }}
                </span>
                <span class="sr-only">{{ $totalNotifCount }} notifications</span>
            @endif
        </button>

        {{-- Dropdown Notifications Panel --}}
        @include('layouts.partials.notifications-panel')
    </div>

    {{-- 3. THEME TOGGLE (Sun/Moon), Icon-Only --}}
    <button type="button"
            @click="toggleTheme()"
            class="relative w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-stone-500/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition cursor-pointer"
            :title="isDark ? 'Switch to light theme' : 'Switch to dark theme'"
            aria-label="Toggle theme">
        {{-- Sun icon (shown when dark mode is active) --}}
        <template x-if="isDark">
            <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="4"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
            </svg>
        </template>
        {{-- Moon icon (shown when light mode is active) --}}
        <template x-if="!isDark">
            <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
            </svg>
        </template>
    </button>

    {{-- 4. AVATAR BUTTON (User photo or initials) with small chevron, opening Account Menu --}}
    <div class="relative" x-ref="accountContainer">
        <button type="button"
                x-ref="accountButton"
                @click="accountOpen = !accountOpen; if(accountOpen) { notifOpen = false; $nextTick(() => { focusFirstMenuItem(); }); }"
                :aria-expanded="accountOpen"
                aria-haspopup="menu"
                aria-controls="account-menu-dropdown"
                class="group h-11 pl-1 pr-2 rounded-full flex items-center gap-1.5 hover:bg-stone-500/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] focus-visible:ring-offset-2 transition cursor-pointer"
                title="Account"
                aria-label="Account menu">
            {{-- Avatar 32x32px --}}
            <div class="w-8 h-8 rounded-full overflow-hidden bg-[var(--accent-primary)] text-white font-serif font-bold text-xs flex items-center justify-center shrink-0 border border-[var(--border-default)]">
                @if($navUser->primary_photo_url && !str_contains($navUser->primary_photo_url, 'unsplash'))
                    <img src="{{ $navUser->primary_photo_url }}" alt="{{ $navUser->name }}" class="w-full h-full object-cover">
                @else
                    <span>{{ strtoupper(substr($navUser->name, 0, 1)) }}</span>
                @endif
            </div>

            {{-- Small chevron --}}
            <svg class="w-3.5 h-3.5 text-[var(--text-secondary)] group-hover:text-[var(--text-primary)] transition-transform duration-200"
                 :class="accountOpen ? 'rotate-180' : ''"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
            </svg>
        </button>

        {{-- Dropdown Account Menu --}}
        @include('layouts.partials.account-menu')
    </div>

</div>


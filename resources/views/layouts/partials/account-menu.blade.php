{{-- Standardized Account Menu (Avatar Dropdown & Mobile Bottom Sheet) --}}
{{-- Specs: Width 260-280px, 8px radius, subtle shadow, closes on outside click, Esc, route change.
     Fully keyboard accessible (arrow keys, Home/End, focus returns to avatar button), role="menu" with ARIA.
     Header row: Avatar, display name (truncated), plan badge (Free/Pro), Verified badge.
     Order: My profile, Family dashboard (if rep), Settings, Privacy & cookies, Membership (Pro), Admin (if admin), Help, divider, Log out (neutral color, not red, with icon). --}}

<div x-show="accountOpen"
     @click.outside="closeAccountMenu()"
     x-cloak
     x-transition:enter="transition ease-out duration-150 transform"
     x-transition:enter-start="opacity-0 scale-95 translate-y-1"
     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
     x-transition:leave="transition ease-in duration-100 transform"
     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
     x-transition:leave-end="opacity-0 scale-95 translate-y-1"
     @keydown.escape.prevent.stop="closeAccountMenu()"
     @keydown.arrow-down.prevent="navigateMenu(1)"
     @keydown.arrow-up.prevent="navigateMenu(-1)"
     @keydown.home.prevent="navigateMenuTo(0)"
     @keydown.end.prevent="navigateMenuTo('last')"
     id="account-menu-dropdown"
     role="menu"
     aria-orientation="vertical"
     aria-label="User Account Menu"
     class="absolute right-0 top-full mt-2 w-[272px] rounded-lg bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-2xl z-50 text-[var(--text-primary)] py-2 select-none">

    {{-- Header Row: Avatar, Display Name, Badges --}}
    <div class="px-3.5 py-2.5 border-b border-[var(--border-subtle)] flex items-center gap-3">
        {{-- Avatar --}}
        <div class="w-10 h-10 rounded-full overflow-hidden bg-[var(--accent-primary)] text-white font-serif font-bold text-base flex items-center justify-center shrink-0 border border-[var(--border-default)]">
            @if(Auth::user()->primary_photo_url && !str_contains(Auth::user()->primary_photo_url, 'unsplash'))
                <img src="{{ Auth::user()->primary_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
            @else
                <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            @endif
        </div>

        {{-- Name & Badges --}}
        <div class="min-w-0 flex-1">
            <p class="font-serif font-bold text-sm text-[var(--text-primary)] truncate leading-tight">
                {{ Auth::user()->name }}
            </p>

            <div class="mt-1 flex items-center gap-1.5 flex-wrap">
                {{-- Plan Badge: Free or Pro (Pro = Saffron with dark text) --}}
                @if(Auth::user()->isPro())
                    <span class="badge-pro">
                        Pro
                    </span>
                @else
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-[var(--radius-sm)] text-[10px] font-medium bg-[var(--color-surface-alt)] text-[var(--color-text-muted)] border border-[var(--color-border)]">
                        Free
                    </span>
                @endif

                {{-- Verified Badge (Tulsi green with check) --}}
                @if(Auth::user()->is_verified)
                    <span class="badge-verified">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                        <span>Verified</span>
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Menu Items in Exact Order --}}
    <div class="py-1" role="none">

        {{-- 1. My profile --}}
        <a href="{{ route('profile.show') }}"
           role="menuitem"
           tabindex="-1"
           @click="closeAccountMenu()"
           class="account-menu-item flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition">
            <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
            </svg>
            <span class="flex-1">My profile</span>
        </a>

        {{-- 2. Family dashboard (if guardian or family representative) --}}
        @if(Auth::user()->role === 'family_rep' || \App\Models\FamilyRepresentative::where('rep_user_id', Auth::id())->exists())
            <a href="{{ route('family.dashboard') }}"
               role="menuitem"
               tabindex="-1"
               @click="closeAccountMenu()"
               class="account-menu-item flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition">
                <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                </svg>
                <span class="flex-1">Family dashboard</span>
            </a>
        @endif

        {{-- 3. Settings --}}
        <a href="{{ route('profile.edit') }}"
           role="menuitem"
           tabindex="-1"
           @click="closeAccountMenu()"
           class="account-menu-item flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition">
            <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
            </svg>
            <span class="flex-1">Settings</span>
        </a>

        {{-- 4. Privacy & cookies --}}
        <a href="{{ route('settings.privacy') }}"
           role="menuitem"
           tabindex="-1"
           @click="closeAccountMenu()"
           class="account-menu-item flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition">
            <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
            </svg>
            <span class="flex-1">Privacy &amp; cookies</span>
        </a>

        {{-- 5. Membership (Pro) --}}
        <a href="{{ route('membership.index') }}"
           role="menuitem"
           tabindex="-1"
           @click="closeAccountMenu()"
           class="account-menu-item flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition">
            <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>
            </svg>
            <span class="flex-1">Membership (Pro)</span>
        </a>

        {{-- 6. Admin (if admin) --}}
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               role="menuitem"
               tabindex="-1"
               @click="closeAccountMenu()"
               class="account-menu-item flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition">
                <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                </svg>
                <span class="flex-1">Admin</span>
            </a>
        @endif

        {{-- 7. Help --}}
        <a href="{{ route('about') }}#help"
           role="menuitem"
           tabindex="-1"
           @click="closeAccountMenu()"
           class="account-menu-item flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition">
            <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3m.08 4h.01"/>
            </svg>
            <span class="flex-1">Help</span>
        </a>

        {{-- 8. Divider --}}
        <div class="my-1 border-t border-[var(--border-subtle)]" role="separator"></div>

        {{-- 9. Log out (Neutral color, NOT red, with icon) --}}
        <form method="POST" action="{{ route('logout') }}" class="w-full" role="none">
            @csrf
            <button type="submit"
                    role="menuitem"
                    tabindex="-1"
                    class="account-menu-item w-full flex items-center gap-3 px-3.5 py-2 text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus:bg-[var(--bg-subtle)] focus:text-[var(--text-primary)] focus:outline-none transition cursor-pointer text-left">
                <svg class="w-4.5 h-4.5 shrink-0 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                </svg>
                <span class="flex-1">Log out</span>
            </button>
        </form>

    </div>
</div>

{{-- Mobile Bottom Sheet Version of Account Menu --}}
<div x-show="mobileAccountOpen"
     x-cloak
     class="fixed inset-0 z-50 lg:hidden flex flex-col justify-end"
     role="dialog"
     aria-modal="true"
     aria-label="Account Settings Sheet">

    {{-- Backdrop --}}
    <div x-show="mobileAccountOpen"
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileAccountOpen = false"
         class="fixed inset-0 bg-[#171312]/70 backdrop-blur-xs"></div>

    {{-- Bottom Sheet Container --}}
    <div x-show="mobileAccountOpen"
         x-transition:enter="transition ease-out duration-250 transform"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         @click.outside="mobileAccountOpen = false"
         class="relative w-full rounded-t-2xl bg-[var(--bg-surface)] border-t border-[var(--border-default)] shadow-2xl p-4 max-h-[85vh] overflow-y-auto text-[var(--text-primary)]">

        {{-- Drag Handle --}}
        <div class="w-12 h-1.5 rounded-full bg-stone-300 dark:bg-stone-700 mx-auto mb-3"></div>

        {{-- Mobile Header Row --}}
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full overflow-hidden bg-[var(--accent-primary)] text-white font-serif font-bold text-base flex items-center justify-center shrink-0 border border-[var(--border-default)]">
                    @if(Auth::user()->primary_photo_url && !str_contains(Auth::user()->primary_photo_url, 'unsplash'))
                        <img src="{{ Auth::user()->primary_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                    @else
                        <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    @endif
                </div>
                <div class="min-w-0">
                    <p class="font-serif font-bold text-sm text-[var(--text-primary)] truncate">{{ Auth::user()->name }}</p>
                    <div class="mt-0.5 flex items-center gap-1.5">
                        @if(Auth::user()->isPro())
                            <span class="badge-pro">Pro</span>
                        @else
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-[var(--radius-sm)] text-[10px] font-medium bg-[var(--color-surface-alt)] text-[var(--color-text-muted)] border border-[var(--color-border)]">Free</span>
                        @endif
                        @if(Auth::user()->is_verified)
                            <span class="badge-verified">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Verified</span>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <button type="button" @click="mobileAccountOpen = false" class="p-2 rounded-md text-[var(--text-muted)] hover:text-[var(--text-primary)] cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile Items --}}
        <div class="py-2 space-y-1">
            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)]">
                <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                <span>My profile</span>
            </a>

            @if(Auth::user()->role === 'family_rep' || \App\Models\FamilyRepresentative::where('rep_user_id', Auth::id())->exists())
                <a href="{{ route('family.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)]">
                    <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                    <span>Family dashboard</span>
                </a>
            @endif

            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)]">
                <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/></svg>
                <span>Settings</span>
            </a>

            <a href="{{ route('settings.privacy') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)]">
                <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                <span>Privacy &amp; cookies</span>
            </a>

            <a href="{{ route('membership.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)]">
                <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>
                <span>Membership (Pro)</span>
            </a>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)]">
                    <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    <span>Admin</span>
                </a>
            @endif

            <a href="{{ route('about') }}#help" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)]">
                <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3m.08 4h.01"/></svg>
                <span>Help</span>
            </a>

            <div class="my-2 border-t border-[var(--border-subtle)]"></div>

            {{-- Log out (Neutral color, with icon) --}}
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-md text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] transition cursor-pointer text-left">
                    <svg class="w-4.5 h-4.5 text-[var(--text-muted)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                    <span>Log out</span>
                </button>
            </form>
        </div>

    </div>
</div>


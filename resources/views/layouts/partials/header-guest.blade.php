{{-- Standardized Guest / Logged-Out Header --}}
{{-- Specs: 64px desktop (h-16), 56px mobile (h-14).
     Order: Logo, "How it works", Theme toggle, "Sign in" text link, and primary "Create profile" button. --}}

<header class="bg-[var(--bg-surface)] border-b border-[var(--border-default)] shadow-xs sticky top-0 z-40 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 sm:h-16 items-center gap-4">

            {{-- Left: Logo Emblem & Brand Details --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group shrink-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] rounded-md">
                <img src="{{ asset('images/logo-emblem.png') }}"
                     alt="Global Saptapadi"
                     class="w-8 h-8 sm:w-9 sm:h-9 rounded-[var(--radius-sm)] object-cover border border-[var(--border-default)] shrink-0">
                <div>
                    <span class="font-serif font-bold text-base sm:text-lg tracking-wide text-[var(--accent-primary)] group-hover:text-[var(--accent-hover)] transition block leading-tight">
                        Global Saptapadi
                    </span>
                    <span class="text-[9px] sm:text-[10px] text-[var(--text-muted)] block font-medium">
                        Seven steps. One lifetime.
                    </span>
                </div>
            </a>

            {{-- Center/Left: "How it works" & Secondary Public Links --}}
            <nav class="hidden md:flex items-center space-x-6 text-xs sm:text-sm font-medium text-[var(--text-secondary)]">
                <a href="{{ route('home') }}#how-it-works"
                   class="hover:text-[var(--accent-primary)] transition py-2">
                    How it works
                </a>
                <a href="{{ route('home') }}#candidates"
                   class="hover:text-[var(--accent-primary)] transition py-2">
                    Candidates
                </a>
                <a href="{{ route('membership.index') }}"
                   class="hover:text-[var(--color-primary)] transition py-2 {{ request()->routeIs('membership.*') ? 'text-[var(--color-primary)] font-semibold border-b-2 border-[var(--color-accent)]' : '' }}">
                    Single Vivah Pass
                </a>
                <a href="{{ route('about') }}"
                   class="hover:text-[var(--color-primary)] transition py-2 {{ request()->routeIs('about') ? 'text-[var(--color-primary)] font-semibold border-b-2 border-[var(--color-accent)]' : '' }}">
                    About &amp; Ethics
                </a>
            </nav>

            {{-- Right Side Controls: Theme Toggle -> Sign In Text Link -> Create Profile Button --}}
            <div class="flex items-center space-x-2 sm:space-x-3 shrink-0">

                {{-- Demo Personas Quick Picker (Desktop Only) --}}
                <div class="hidden xl:flex items-center space-x-1.5 text-[11px] text-[var(--text-muted)] pr-2 border-r border-[var(--border-default)]">
                    <span class="font-medium text-[var(--text-secondary)]">Quick review:</span>
                    <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="px-2 py-1 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] hover:bg-[var(--border-default)] text-[var(--text-primary)] font-medium" title="Groom Dr. Arun">Groom</a>
                    <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="px-2 py-1 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] hover:bg-[var(--border-default)] text-[var(--text-primary)] font-medium" title="Bride Priya">Bride</a>
                    <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="px-2 py-1 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] hover:bg-[var(--border-default)] text-[var(--text-primary)] font-medium" title="Parent Subhash">Parent</a>
                </div>

                {{-- Theme Toggle (Sun/Moon), Icon-Only, 44x44px hit area --}}
                <button type="button"
                        @click="toggleTheme()"
                        class="w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-stone-500/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] transition cursor-pointer"
                        :title="isDark ? 'Switch to light theme' : 'Switch to dark theme'"
                        aria-label="Toggle theme">
                    <template x-if="isDark">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                    </template>
                    <template x-if="!isDark">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
                        </svg>
                    </template>
                </button>

                {{-- "Sign in" Text Link --}}
                <a href="{{ route('login') }}"
                   class="px-3 py-2 text-xs sm:text-sm font-semibold text-[var(--text-secondary)] hover:text-[var(--accent-primary)] transition">
                    Sign In
                </a>

                {{-- Primary "Create profile" Button --}}
                <a href="{{ route('register') }}"
                   class="btn-primary text-xs sm:text-sm font-semibold !min-h-[38px] sm:!min-h-[40px] !px-3.5 sm:!px-4">
                    Create Profile
                </a>

            </div>

        </div>
    </div>
</header>


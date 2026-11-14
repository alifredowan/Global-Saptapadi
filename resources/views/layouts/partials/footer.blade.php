<footer class="relative section--dark border-t border-[var(--color-accent)]/20 py-10 sm:py-14 text-[14px] overflow-hidden">
    <!-- Faint saffron / ivory line ornament in corner (opacity 7%) -->
    <div class="pointer-events-none absolute right-0 bottom-0 w-64 h-64 opacity-[0.06] text-[var(--color-accent)]" aria-hidden="true">
        <svg viewBox="0 0 160 160" fill="none" stroke="currentColor" stroke-width="1.2">
            <circle cx="160" cy="160" r="140" stroke-dasharray="4 6"/>
            <circle cx="160" cy="160" r="100"/>
            <circle cx="160" cy="160" r="60" stroke-dasharray="2 4"/>
            <path d="M160 20 L160 160 M20 160 L160 160"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 relative z-10">
        
        <!-- Top Row: Logo & Tagline on Left, Navigation on Middle/Right -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-8 border-b border-white/10">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="w-9 h-9 rounded-[var(--radius-sm)] border border-[var(--color-accent)]/50 p-0.5 bg-white/5 overflow-hidden shrink-0 shadow-xs">
                    <img src="{{ asset('images/logo-emblem.png') }}" alt="Global Saptapadi" class="w-full h-full object-cover rounded-[2px]">
                </div>
                <div>
                    <span class="font-serif font-bold text-xl text-white tracking-wide block leading-tight">Global Saptapadi</span>
                    <span class="text-[12px] text-[#F3E4DD] block font-medium">Seven steps. One lifetime.</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="flex flex-wrap items-center gap-x-8 gap-y-2 text-[15px] font-medium text-[#F3E4DD]">
                <a href="{{ route('home') }}#saptapadi-path" class="hover:text-[var(--color-accent)] transition py-1">The Seven Vows</a>
                <a href="{{ route('discovery.index') }}" class="hover:text-[var(--color-accent)] transition py-1">Candidates</a>
                <a href="{{ route('membership.index') }}" class="hover:text-[var(--color-accent)] transition py-1">Single Vivah Pass</a>
                <a href="{{ route('home') }}#success-stories" class="hover:text-[var(--color-accent)] transition py-1">Success Stories</a>
                <a href="{{ route('about') }}" class="hover:text-[var(--color-accent)] transition py-1">Ethics &amp; Lineage</a>
            </nav>
        </div>

        <!-- Bottom Row: Copyright on Left, Legal & Cookie settings on Right -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs sm:text-[13px] text-[#F3E4DD]/80">
            <div>
                &copy; {{ date('Y') }} Global Saptapadi. A sacred sanctuary for Hindu matrimony worldwide.
            </div>

            <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                <a href="{{ route('privacy.policy') }}" class="hover:text-white transition">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition">Terms of Service</a>
                
                @guest
                    <button type="button"
                            @click="window.dispatchEvent(new CustomEvent('open-cookie-settings'))"
                            class="hover:text-[var(--color-accent)] transition underline cursor-pointer text-left">
                        Cookie Settings
                    </button>
                @else
                    <a href="{{ route('settings.privacy') }}" class="hover:text-[var(--color-accent)] transition underline">
                        Cookie &amp; Privacy
                    </a>
                @endguest
            </div>
        </div>

    </div>
</footer>

<footer class="relative section--dark border-t border-[var(--color-accent)]/20 py-8 sm:py-10 text-[14px] overflow-hidden">
    <!-- Faint saffron / ivory line ornament in corner (opacity 7%) -->
    <div class="pointer-events-none absolute right-0 bottom-0 w-48 h-48 opacity-[0.07] text-[var(--color-accent)]" aria-hidden="true">
        <svg viewBox="0 0 160 160" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="160" cy="160" r="140" stroke-dasharray="4 6"/>
            <circle cx="160" cy="160" r="100"/>
            <circle cx="160" cy="160" r="60" stroke-dasharray="2 4"/>
            <path d="M160 20 L160 160 M20 160 L160 160"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 relative z-10">
        
        <!-- Top Row: Logo & Tagline on Left, 5-6 Clean Links in Middle/Right -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-6 border-b border-white/10">
            <!-- Brand -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-2.5 group">
                    <img src="{{ asset('images/logo-emblem.png') }}" alt="Global Saptapadi" class="w-8 h-8 rounded-[var(--radius-sm)] object-cover border border-[var(--color-accent)]/40 shrink-0">
                    <div>
                        <span class="font-serif font-bold text-lg text-white tracking-wide block leading-tight">Global Saptapadi</span>
                        <span class="text-[12px] text-[#F3E4DD] block font-medium">Seven steps. One lifetime.</span>
                    </div>
                </a>
            </div>

            <!-- Middle Navigation Links (15px, weight 500, saffron hover, 44px touch targets) -->
            <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-[15px] font-medium text-[#F3E4DD]">
                <a href="{{ route('about') }}" class="hover:text-[var(--color-accent)] transition py-1">About</a>
                <a href="{{ route('home') }}#how-it-works" class="hover:text-[var(--color-accent)] transition py-1">How it works</a>
                <a href="{{ route('membership.index') }}" class="hover:text-[var(--color-accent)] transition py-1">Pricing</a>
                <a href="{{ route('home') }}#success-stories" class="hover:text-[var(--color-accent)] transition py-1">Success stories</a>
                <a href="{{ route('about') }}#help" class="hover:text-[var(--color-accent)] transition py-1">Help</a>
                <a href="{{ route('about') }}#contact" class="hover:text-[var(--color-accent)] transition py-1">Contact</a>
            </nav>
        </div>

        <!-- Bottom Row: Copyright on Left, Legal & Cookie settings on Right -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-[14px] text-[#F3E4DD]">
            <div>
                &copy; {{ date('Y') }} Global Saptapadi. All rights reserved.
            </div>

            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-[14px]">
                <a href="{{ route('privacy.policy') }}" class="hover:text-white transition">Privacy Policy</a>
                <span class="text-white/20 hidden sm:inline">&bull;</span>
                <a href="{{ route('terms') }}" class="hover:text-white transition">Terms</a>
                <span class="text-white/20 hidden sm:inline">&bull;</span>
                
                @guest
                    <!-- Public / Logged-out Visitors: Direct Modal Reopen -->
                    <button type="button"
                            @click="window.dispatchEvent(new CustomEvent('open-cookie-settings'))"
                            class="hover:text-[var(--color-accent)] transition underline cursor-pointer text-left">
                        Cookie settings
                    </button>
                @else
                    <!-- Logged-in App Area: Direct link to Settings > Privacy -->
                    <a href="{{ route('settings.privacy') }}" class="hover:text-[var(--color-accent)] transition underline">
                        Cookie &amp; Privacy settings
                    </a>
                @endguest
            </div>
        </div>

    </div>
</footer>

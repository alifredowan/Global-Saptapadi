<footer class="bg-[#120305] text-amber-100/70 border-t border-amber-900/40 py-5 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            
            <!-- Left: Logo, Brand Name, Divider & Copyright -->
            <div class="flex items-center space-x-3.5 flex-wrap justify-center md:justify-start">
                <a href="{{ route('home') }}" class="flex items-center space-x-2.5 group">
                    <div class="w-8 h-8 rounded-xl gold-gradient text-amber-200 font-black flex items-center justify-center text-xs shadow-md shadow-amber-950/40 group-hover:scale-105 transition transform">
                        VC
                    </div>
                    <span class="font-heading font-bold text-sm sm:text-base text-white tracking-wider group-hover:text-amber-300 transition">
                        Vivah Connect
                    </span>
                </a>

                <span class="h-4 w-px bg-amber-800/60 hidden sm:inline-block"></span>

                <span class="text-amber-200/60 text-xs">
                    © 2026 Vivah Connect. All rights reserved.
                </span>
            </div>

            <!-- Right: Clean Horizontal Links with Dots -->
            <nav class="flex items-center space-x-3 sm:space-x-4 text-xs font-medium text-amber-200/80 flex-wrap justify-center">
                <a href="{{ route('home') }}#sacred-pillars" class="hover:text-white transition">
                    How It Works
                </a>
                <span class="text-amber-600/50">•</span>

                <a href="{{ route('membership.index') }}" class="hover:text-white transition">
                    Single Vivah Pass ($29)
                </a>
                <span class="text-amber-600/50">•</span>

                <a href="{{ route('about') }}#legal-compliance" class="hover:text-white transition">
                    Privacy Policy
                </a>
                <span class="text-amber-600/50">•</span>

                <a href="{{ route('about') }}#legal-compliance" class="hover:text-white transition">
                    Terms of Service
                </a>
                <span class="text-amber-600/50">•</span>

                <a href="{{ route('about') }}" class="hover:text-white transition">
                    About Us
                </a>
                <span class="text-amber-600/50">•</span>

                <a href="{{ route('about') }}#acharya-council" class="hover:text-white transition">
                    Contact & Safety
                </a>
            </nav>

        </div>
    </div>
</footer>

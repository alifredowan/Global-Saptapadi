<footer class="bg-gradient-to-b from-[#180406] via-[#130305] to-[#0c0203] text-amber-100/80 border-t border-amber-900/50 mt-16 pt-12 pb-8 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Main Footer 4-Column Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-10">
            
            <!-- Column 1: Brand & Sacred Purpose -->
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2.5 group">
                    <div class="w-8 h-8 rounded-xl gold-gradient text-amber-200 font-black flex items-center justify-center text-xs shadow-md shadow-amber-950/40 group-hover:scale-105 transition transform">
                        VC
                    </div>
                    <div>
                        <span class="font-heading font-bold text-base text-amber-100 tracking-wider block leading-tight group-hover:text-amber-300 transition">
                            VIVAH CONNECT
                        </span>
                        <span class="text-[9px] uppercase font-semibold text-amber-400/90 tracking-widest block -mt-0.5">
                            Sacred Matrimonial Union
                        </span>
                    </div>
                </a>

                <p class="text-xs text-amber-200/70 leading-relaxed pr-2">
                    A sacred digital sanctuary connecting Hindu brides, grooms, and respected families worldwide through Vedic traditions, Ashtakoota compatibility, and 100% verified trust.
                </p>

                <!-- Interactive Trust & Pass Badges -->
                <div class="space-y-2 pt-1">
                    <a href="{{ route('membership.index') }}" 
                       class="flex items-center justify-between p-2 rounded-xl bg-amber-950/50 hover:bg-amber-900/50 border border-amber-800/50 hover:border-amber-400/60 text-xs text-amber-200 transition group shadow-xs">
                        <span class="flex items-center space-x-2">
                            <span>💎</span>
                            <span class="text-[11px]"><strong>Single Vivah Pass:</strong> $29 USD</span>
                        </span>
                        <span class="text-amber-400 text-[10px] font-semibold group-hover:translate-x-0.5 transition">View Pass →</span>
                    </a>

                    <a href="{{ route('verification.index') }}" 
                       class="flex items-center justify-between p-2 rounded-xl bg-amber-950/50 hover:bg-amber-900/50 border border-amber-800/50 hover:border-amber-400/60 text-xs text-amber-200 transition group shadow-xs">
                        <span class="flex items-center space-x-2">
                            <span>🛡️</span>
                            <span class="text-[11px]"><strong>100% ID KYC Verified</strong></span>
                        </span>
                        <span class="text-amber-400 text-[10px] font-semibold group-hover:translate-x-0.5 transition">Verify →</span>
                    </a>
                </div>
            </div>

            <!-- Column 2: Sacred Platform & Journey -->
            <div>
                <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-amber-300 mb-4 pb-1 border-b border-amber-900/40">
                    Sacred Journey
                </h4>
                <ul class="space-y-2.5 text-xs">
                    <li>
                        <a href="{{ route('about') }}" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>About Our Sacred Mission</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#sacred-pillars" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>4 Sacred Stages of Vedic Union</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('discovery.index') }}" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Candidate Search & Directory</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('horoscope.edit') }}" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>36-Point Ashtakoota Milan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('family.manage') }}" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Family & Ghotok Delegation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('milestone.index') }}" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Shubho Bibaho Registry</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Customary Safeguards & Ethics -->
            <div>
                <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-amber-300 mb-4 pb-1 border-b border-amber-900/40">
                    Trust & Safeguards
                </h4>
                <ul class="space-y-2.5 text-xs">
                    <li>
                        <a href="{{ route('about') }}#legal-compliance" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Statutory Age (21 Var / 18 Kanya)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}#legal-compliance" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Zero Dowry Policy (UN CEDAW)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}#legal-compliance" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Strict Monogamy Enforcement</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('chat.index') }}" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Chaperoned 3-Way Chat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Modesty Photo Privacy Shield</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}#acharya-council" class="text-amber-200/75 hover:text-white transition flex items-center group">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500/60 mr-2 group-hover:bg-amber-300 group-hover:scale-125 transition"></span>
                            <span>Pandit Acharya Kalyan Advisory</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Payments & Global Diaspora -->
            <div class="space-y-4">
                <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-amber-300 mb-4 pb-1 border-b border-amber-900/40">
                    Payments & Diaspora
                </h4>

                <!-- Interactive Payment Checkout Card -->
                <a href="{{ route('membership.index') }}" class="block p-3 rounded-2xl bg-amber-950/40 hover:bg-amber-950/70 border border-amber-800/50 hover:border-amber-400/60 transition group space-y-2 shadow-xs">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-semibold text-amber-200">Supported Gateways</span>
                        <span class="text-[10px] text-amber-400 font-bold group-hover:underline">Checkout →</span>
                    </div>

                    <div class="flex items-center space-x-2 pt-0.5">
                        <span class="px-2.5 py-1 rounded-md bg-blue-950 border border-blue-500/40 text-blue-200 font-bold text-[11px] shadow-2xs">
                            Stripe
                        </span>
                        <span class="px-2.5 py-1 rounded-md bg-indigo-950 border border-indigo-500/40 text-indigo-200 font-bold text-[11px] shadow-2xs">
                            PayPal
                        </span>
                        <span class="text-[10px] text-amber-300/80">Cards • Apple Pay</span>
                    </div>

                    <div class="pt-1 text-[11px] text-amber-300/90 font-medium flex items-center justify-between">
                        <span>Promo Code:</span>
                        <code class="px-1.5 py-0.5 rounded bg-amber-900/80 text-amber-200 font-mono text-[10px] border border-amber-500/30">SHUBHOVIVAH ($19)</code>
                    </div>
                </a>

                <!-- Global Diaspora Coverage Badges -->
                <div class="pt-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400/80 block mb-1.5">
                        Global Dharmic Community
                    </span>
                    <div class="flex flex-wrap gap-1 text-[10px]">
                        <span class="px-2 py-0.5 rounded-md bg-stone-900/80 border border-amber-900/50 text-amber-200/90">USA</span>
                        <span class="px-2 py-0.5 rounded-md bg-stone-900/80 border border-amber-900/50 text-amber-200/90">UK</span>
                        <span class="px-2 py-0.5 rounded-md bg-stone-900/80 border border-amber-900/50 text-amber-200/90">Canada</span>
                        <span class="px-2 py-0.5 rounded-md bg-stone-900/80 border border-amber-900/50 text-amber-200/90">Australia</span>
                        <span class="px-2 py-0.5 rounded-md bg-stone-900/80 border border-amber-900/50 text-amber-200/90">India</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Clean, Non-Cluttered Bottom Bar -->
        <div class="pt-6 border-t border-amber-900/40 flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-amber-300/70">
            <div>
                © 2026 Vivah Connect. Sacred Matrimonial Union. All rights reserved.
            </div>

            <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-1.5 text-[11px]">
                <a href="{{ route('about') }}" class="hover:text-white transition">About Us</a>
                <span class="text-amber-800">•</span>
                <a href="{{ route('about') }}#legal-compliance" class="hover:text-white transition">Legal & Ethics</a>
                <span class="text-amber-800">•</span>
                <a href="{{ route('membership.index') }}" class="hover:text-white transition">Single Vivah Pass</a>
                <span class="text-amber-800">•</span>
                <a href="{{ route('milestone.index') }}" class="hover:text-white transition">Solemnized Registry</a>
                <span class="text-amber-800">•</span>
                <span class="px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-300 border border-amber-500/20 text-[10px] font-semibold">
                    USD ($) Standard
                </span>
            </div>
        </div>

    </div>
</footer>

@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-12 py-4">

    <!-- Hero Editorial Header -->
    <div class="relative section--dark rounded-2xl p-8 sm:p-14 text-white overflow-hidden border border-[var(--color-accent)]/30 shadow-sm">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs border border-white/20 text-stone-200 text-xs font-medium tracking-wide mb-4">
                <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                <span>Seven steps. One lifetime.</span>
            </div>
            <h1 class="font-serif font-bold text-3xl sm:text-5xl text-white tracking-tight leading-tight">
                Matrimony built for families, not algorithms.
            </h1>
            <p class="text-sm sm:text-base text-[#F3E4DD] mt-4 leading-relaxed max-w-2xl">
                Global Saptapadi was started by Hindu families who were tired of dating apps disguised as matrimony sites. In our tradition, marriage is not an endless swiping catalog. It is a sacred union between two individuals and two lineages.
            </p>

            <div class="mt-8 flex flex-wrap gap-2 text-xs text-stone-300">
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">Single Vivah Pass ($29 once)</span>
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">Optional 36-Point Kundli</span>
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">Human-verified government IDs</span>
                <span class="px-3 py-1 rounded-full bg-white/10 border border-white/20">Strict anti-dowry policy</span>
            </div>
        </div>
    </div>

    <!-- Editorial Story: Why We Built This -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        <div class="md:col-span-5 bg-white dark:bg-stone-900 rounded-2xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
            <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--color-accent)] block">Our Intention</span>
            <h2 class="font-serif font-bold text-2xl text-stone-900 dark:text-stone-100">
                A sanctuary for intentional marriages
            </h2>
            <p class="text-xs text-stone-600 dark:text-stone-400 leading-relaxed">
                Most matrimonial sites make their money through recurring monthly subscriptions. That means they make more profit when you stay single longer.
            </p>
            <p class="text-xs text-stone-600 dark:text-stone-400 leading-relaxed">
                We believe that financial model is fundamentally wrong for marriage. That is why we charge once for your search. When you find your partner, our work is done and we celebrate your wedding day.
            </p>
            <div class="pt-2 border-t border-stone-100 dark:border-stone-800">
                <blockquote class="font-serif italic text-stone-800 dark:text-stone-200 text-sm">
                    &ldquo;Marriage is a lifetime covenant, not a recurring subscription.&rdquo;
                </blockquote>
            </div>
        </div>

        <div class="md:col-span-7 space-y-6">
            <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-4">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--color-accent)] block">Quiet Principles</span>
                <h3 class="font-serif font-bold text-xl text-stone-900 dark:text-stone-100">
                    How we treat your family's dignity
                </h3>
                
                <div class="space-y-4 text-xs text-stone-600 dark:text-stone-400">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-lg bg-[var(--color-haldi-soft)] text-[var(--color-accent)] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <div>
                            <strong class="font-medium text-stone-900 dark:text-stone-100">Phone numbers stay private.</strong>
                            <p class="mt-0.5">Contact numbers and personal email addresses are never shown publicly on search engines or profile cards. Both sides must mutually agree before contacts are revealed.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-lg bg-[var(--color-haldi-soft)] text-[var(--color-accent)] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <div>
                            <strong class="font-medium text-stone-900 dark:text-stone-100">Parents can review candidates first.</strong>
                            <p class="mt-0.5">Parents and guardians have their own dedicated access. They can browse biodatas, exchange polite elder macros, and participate in chaperone-guided chats alongside their son or daughter.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-lg bg-[var(--color-haldi-soft)] text-[var(--color-accent)] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <div>
                            <strong class="font-medium text-stone-900 dark:text-stone-100">Horoscope matching is always optional.</strong>
                            <p class="mt-0.5">For families who practice Vedic astrology, we calculate the complete 36-point Ashtakoota Guna Milan, Gotra lineage, and Manglik balance. For families who prefer "Caste no bar" or modern matching, it is completely optional.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-lg bg-[var(--color-haldi-soft)] text-[var(--color-accent)] flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <div>
                            <strong class="font-medium text-stone-900 dark:text-stone-100">We never allow dowry demands.</strong>
                            <p class="mt-0.5">We maintain a strict zero-tolerance policy against dowry, gifts, or financial preconditions. In compliance with the Dowry Prohibition Act and UN CEDAW guidelines, violation reports are audited immediately by human safety officers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Saptapadi Path: The Seven Steps -->
    <div class="space-y-6">
        <div class="text-center max-w-xl mx-auto">
            <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--color-accent)] block mb-1">Tradition</span>
            <h2 class="font-serif font-bold text-2xl sm:text-3xl text-stone-900 dark:text-stone-100">
                The Seven Sacred Steps
            </h2>
            <p class="text-xs text-stone-600 dark:text-stone-400 mt-1">
                In a Vedic wedding, bride and groom take seven steps around the sacred Agni. Each step represents a foundational pledge for life together.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-1.5">
                <span class="text-[11px] font-bold text-[var(--color-accent)]">Step 1 &bull; Nourishment</span>
                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Food &amp; Health</h3>
                <p class="text-stone-600 dark:text-stone-400 leading-relaxed">To nourish each other, provide for the household, and support healthy living.</p>
            </div>

            <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-1.5">
                <span class="text-[11px] font-bold text-[var(--color-accent)]">Step 2 &bull; Strength</span>
                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Mental &amp; Physical</h3>
                <p class="text-stone-600 dark:text-stone-400 leading-relaxed">To stand together through adversity, protecting family and personal integrity.</p>
            </div>

            <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-1.5">
                <span class="text-[11px] font-bold text-[var(--color-accent)]">Step 3 &bull; Prosperity</span>
                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Dharmic Wealth</h3>
                <p class="text-stone-600 dark:text-stone-400 leading-relaxed">To earn honestly, share resources generously, and care for community elders.</p>
            </div>

            <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-1.5">
                <span class="text-[11px] font-bold text-[var(--color-accent)]">Step 4 &bull; Harmony</span>
                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Family &amp; Respect</h3>
                <p class="text-stone-600 dark:text-stone-400 leading-relaxed">To honor parents and in-laws with equal love, humility, and consideration.</p>
            </div>

            <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-1.5">
                <span class="text-[11px] font-bold text-[var(--color-accent)]">Step 5 &bull; Progeny</span>
                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Lineage &amp; Values</h3>
                <p class="text-stone-600 dark:text-stone-400 leading-relaxed">To raise children with kindness, education, cultural respect, and dharma.</p>
            </div>

            <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-1.5">
                <span class="text-[11px] font-bold text-[var(--color-accent)]">Step 6 &bull; Togetherness</span>
                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">All Seasons</h3>
                <p class="text-stone-600 dark:text-stone-400 leading-relaxed">To share joys and sorrows through every season and chapter of life.</p>
            </div>

            <div class="bg-white dark:bg-stone-900 p-5 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-1.5 sm:col-span-2">
                <span class="text-[11px] font-bold text-[var(--color-accent)]">Step 7 &bull; Lifelong Friendship</span>
                <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Sakha Saptapada Bhava</h3>
                <p class="text-stone-600 dark:text-stone-400 leading-relaxed">&ldquo;With seven steps we have become lifelong friends.&rdquo; The culmination of the marriage rites, sealing mutual devotion for a lifetime.</p>
            </div>
        </div>
    </div>

    <!-- Legal & Statutory Standards / Help -->
    <div id="help" class="bg-stone-100 dark:bg-stone-800/60 rounded-2xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-700/80 space-y-4">
        <h3 class="font-serif font-bold text-xl text-stone-900 dark:text-stone-100">
            Legal Safeguards &amp; Compliance Help
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-stone-600 dark:text-stone-400">
            <div>
                <strong class="text-stone-900 dark:text-stone-100 block mb-1">Age &amp; Mutual Consent</strong>
                <p>Strict enforcement of minimum statutory marriage ages (21 for men, 18 for women). Both parties must freely provide consent.</p>
            </div>
            <div>
                <strong class="text-stone-900 dark:text-stone-100 block mb-1">Zero Dowry Guarantee</strong>
                <p>In accordance with the Dowry Prohibition Act and UN CEDAW guidelines, demanding dowry or financial gifts is strictly barred.</p>
            </div>
            <div>
                <strong class="text-stone-900 dark:text-stone-100 block mb-1">Encrypted Privacy</strong>
                <p>Personal biodata and ID documents are encrypted with AES-256 and never indexed by commercial search engines.</p>
            </div>
        </div>
    </div>

    <!-- Contact & Family Care -->
    <div id="contact" class="p-6 sm:p-8 bg-[var(--color-haldi-soft)]/60 dark:bg-amber-950/20 rounded-2xl border border-[var(--color-haldi)]/30 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
        <div class="space-y-1">
            <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--color-accent)]">Support &amp; Family Care</span>
            <h3 class="font-serif font-bold text-xl text-stone-900 dark:text-stone-100">Have questions or need assistance?</h3>
            <p class="text-xs text-stone-600 dark:text-stone-400">Our family trust coordinators and Pandit consultation panel are available to help you.</p>
        </div>
        <div class="shrink-0 flex items-center gap-3">
            <a href="mailto:support@globalsaptapadi.com" class="px-4 py-2.5 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white text-xs font-semibold transition shadow-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                <span>support@globalsaptapadi.com</span>
            </a>
        </div>
    </div>

    <!-- Bottom Action CTA -->
    <div class="text-center p-8 bg-white dark:bg-stone-900 rounded-2xl border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-3">
        <h2 class="font-serif font-bold text-2xl text-stone-900 dark:text-stone-100">
            Begin your search with peace of mind
        </h2>
        <p class="text-xs text-stone-600 dark:text-stone-400 max-w-md mx-auto leading-relaxed">
            Create your biodata in minutes, verify your identity, and connect with respectful families worldwide.
        </p>
        <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white text-xs font-medium transition shadow-xs">
                Create Free Biodata
            </a>
            <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 dark:border-stone-700 text-stone-700 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 text-xs font-medium transition">
                Sign In to Account
            </a>
        </div>
    </div>

</div>
@endsection

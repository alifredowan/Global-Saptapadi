@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-12 py-4">

    <!-- Hero Header Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-red-950 via-[#28080b] to-amber-950 text-amber-100 p-8 sm:p-12 shadow-xl border border-amber-800/40 text-center">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold uppercase tracking-widest mb-3 border border-amber-400/30">
            <span>🕉️</span>
            <span>About Vivah Connect • Sacred Matrimonial Union</span>
        </div>
        <h1 class="font-heading font-extrabold text-3xl sm:text-4xl text-amber-100 max-w-3xl mx-auto leading-tight">
            Restoring Sanctity, Familial Trust, and Vedic Heritage to Matrimony
        </h1>
        <p class="text-xs sm:text-sm text-amber-200/90 mt-3 max-w-2xl mx-auto leading-relaxed">
            Vivah Connect was established to counter the commercial exploitation of matrimony. In the Vedic tradition, marriage is not a transient transaction, but a sacred covenant connecting two souls and two lineages.
        </p>

        <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-[11px] font-semibold text-amber-300">
            <span class="px-3 py-1 rounded-full bg-amber-900/50 border border-amber-700/60">💎 Single Vivah Pass ($29 USD)</span>
            <span class="px-3 py-1 rounded-full bg-amber-900/50 border border-amber-700/60">🪐 36-Point Ashtakoota Guna Milan</span>
            <span class="px-3 py-1 rounded-full bg-amber-900/50 border border-amber-700/60">🛡️ 100% ID KYC Verification</span>
            <span class="px-3 py-1 rounded-full bg-amber-900/50 border border-amber-700/60">🚫 UN CEDAW Zero-Dowry Shield</span>
        </div>
    </div>

    <!-- 1. The Sacred Genesis & Mission -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-amber-200/90 shadow-md space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-700 block">Our Sacred Genesis</span>
        <h2 class="text-xl sm:text-2xl font-bold font-heading text-red-950">
            Why Vivah Connect Was Founded
        </h2>
        <div class="text-xs sm:text-sm text-stone-700 space-y-3 leading-relaxed">
            <p>
                In today's digital landscape, modern matrimonial websites have succumbed to corporate models borrowed from casual dating apps. They profit primarily through <strong>recurring monthly subscription fees</strong>, incentivizing them financially to keep individuals searching indefinitely rather than helping them solemnize a lasting marriage.
            </p>
            <p>
                Furthermore, commercial sites are frequently rife with fake profiles, unverified marital statuses, masked commercial solicitations, and distressing dowry demands that violate statutory laws and human dignity.
            </p>
            <p>
                <strong>Vivah Connect was created as a principled alternative.</strong> Grounded in authentic Dharmic ethics, we provide an auspicious sanctuary where seekers and family guardians can explore compatibility with peace of mind, safeguarded by rigorous verification and guided by ancient astrological wisdom.
            </p>
        </div>
    </div>

    <!-- 2. The 5 Core Dharmic Pillars -->
    <div id="sacred-pillars" class="space-y-6">
        <div class="text-center max-w-2xl mx-auto space-y-1">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-700">Foundational Principles</span>
            <h2 class="text-2xl font-bold font-heading text-red-950">
                The 5 Sacred Dharmic Pillars
            </h2>
            <p class="text-xs text-stone-600">The core values that govern every feature and policy on our platform.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Pillar 1: Satya -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card space-y-2">
                <div class="w-10 h-10 rounded-xl bg-red-100 border border-red-200 text-red-900 font-bold flex items-center justify-center text-sm mb-3">
                    १
                </div>
                <h3 class="font-heading font-bold text-base text-red-950">1. Satya (Truth & Integrity)</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Every member must complete a government-issued photo ID verification combined with real-time biometric liveness verification before proposals can be exchanged. Impersonation, misrepresentation, and bot accounts are permanently barred.
                </p>
            </div>

            <!-- Pillar 2: Maryada -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card space-y-2">
                <div class="w-10 h-10 rounded-xl bg-amber-100 border border-amber-300 text-amber-900 font-bold flex items-center justify-center text-sm mb-3">
                    २
                </div>
                <h3 class="font-heading font-bold text-base text-red-950">2. Maryada (Dignity & Modesty)</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    We uphold personal modesty with optional photo shields and automated contact masking. Direct phone numbers and email addresses remain shielded until both families formally accept mutual interest.
                </p>
            </div>

            <!-- Pillar 3: Sanskar -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card space-y-2">
                <div class="w-10 h-10 rounded-xl bg-rose-100 border border-rose-200 text-rose-900 font-bold flex items-center justify-center text-sm mb-3">
                    ३
                </div>
                <h3 class="font-heading font-bold text-base text-red-950">3. Sanskar (Vedic Tradition)</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Our platform computes precise 36-Point Ashtakoota Guna Milan across all eight classical factors. We provide immediate warnings for same-Gotra (Sagotra) ancestral lineages and Manglik dosha balancing.
                </p>
            </div>

            <!-- Pillar 4: Kula Gaurav -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card space-y-2">
                <div class="w-10 h-10 rounded-xl bg-orange-100 border border-orange-200 text-orange-900 font-bold flex items-center justify-center text-sm mb-3">
                    ४
                </div>
                <h3 class="font-heading font-bold text-base text-red-950">4. Kula Gaurav (Family Reverence)</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    Marriage unites families. Parents and guardians (Ghotoks) can manage biodatas, review proposals, and participate directly in 3-way chaperoned real-time messaging with the prospective in-laws.
                </p>
            </div>

            <!-- Pillar 5: Ahimsa -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card space-y-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 border border-emerald-200 text-emerald-900 font-bold flex items-center justify-center text-sm mb-3">
                    ५
                </div>
                <h3 class="font-heading font-bold text-base text-red-950">5. Ahimsa (Anti-Dowry Shield)</h3>
                <p class="text-xs text-stone-600 leading-relaxed">
                    In compliance with the UN Convention on the Elimination of All Forms of Discrimination Against Women (CEDAW) and international anti-extortion statutes, dowry demands result in immediate profile suspension and law enforcement audit logs.
                </p>
            </div>

            <!-- Single Vivah Pass Philosophy -->
            <div class="bg-gradient-to-br from-red-950 to-[#2c090c] rounded-2xl p-6 border-2 border-amber-400 text-amber-100 shadow-md space-y-2">
                <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-300 font-bold flex items-center justify-center text-sm mb-3">
                    💎
                </div>
                <h3 class="font-heading font-bold text-base text-amber-200">Single Vivah Pass Model</h3>
                <p class="text-xs text-amber-100/90 leading-relaxed">
                    We charge a single one-time pass of <strong>$29 USD</strong> (or <strong>$19 USD</strong> with promo code <code class="text-amber-300 font-mono">SHUBHOVIVAH</code>). No monthly subscriptions. Valid until your sacred wedding is celebrated.
                </p>
            </div>
        </div>
    </div>

    <!-- 3. Why Single Vivah Pass vs Monthly Traps -->
    <div id="single-pass-ethics" class="bg-amber-50/70 rounded-3xl p-6 sm:p-10 border border-amber-300/80 space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-800 block">Pricing Ethics</span>
        <h2 class="text-xl sm:text-2xl font-bold font-heading text-red-950">
            Why We Charge Once per Marriage, Never Monthly
        </h2>
        <div class="text-xs sm:text-sm text-stone-700 space-y-3 leading-relaxed">
            <p>
                Standard commercial matrimonial platforms generate profits by extending your search period. The longer you stay unmarried, the more monthly subscription cycles ($30 to $60 USD each month) they extract from your credit card.
            </p>
            <p>
                <strong>Vivah Connect was architected with opposite incentives:</strong>
            </p>
            <ul class="list-disc list-inside space-y-1.5 pl-2">
                <li><strong>One-Time Investment:</strong> You pay $29 USD once for your entire marriage journey.</li>
                <li><strong>No Auto-Renewals:</strong> Your card is never stored for silent recurring debits.</li>
                <li><strong>Shared Success Goal:</strong> We celebrate when you find your life partner and record your Shubho Bibaho milestone.</li>
                <li><strong>Supported Globally:</strong> Seamless checkout through <strong>Stripe</strong> (Visa, Mastercard, Amex, Apple Pay, Google Pay) and <strong>PayPal</strong>.</li>
            </ul>
        </div>
    </div>

    <!-- 4. Pandit Acharya Advisory Council -->
    <div id="acharya-council" class="bg-white rounded-3xl p-6 sm:p-10 border border-amber-200/90 shadow-md space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-700 block">Spiritual & Astrological Guidance</span>
        <h2 class="text-xl sm:text-2xl font-bold font-heading text-red-950">
            Pandit Acharya Kalyan Advisory Council
        </h2>
        <div class="flex flex-col sm:flex-row items-center gap-6 pt-2">
            <div class="w-20 h-20 rounded-2xl gold-gradient flex items-center justify-center text-amber-200 text-2xl font-black shrink-0 shadow-md shadow-amber-950/20">
                🕉️
            </div>
            <div class="text-xs sm:text-sm text-stone-700 space-y-2 leading-relaxed">
                <p>
                    Our algorithmic matching engine is overseen and calibrated by traditional Vedic astrologers and Acharyas, led by <strong>Pandit Acharya Kalyan Bhattacharya</strong>.
                </p>
                <p>
                    From computing birth nakshatra padas to assessing Kuja Dosha (Manglik) cancellations and Sampradaya-specific traditions (Vaishnav, Shaiva, Shakta, Smarta), our system adheres to classical Shastric guidelines rather than superficial pop astrology.
                </p>
            </div>
        </div>
    </div>

    <!-- 5. Legal Compliance & International Standards -->
    <div id="legal-compliance" class="bg-stone-900 text-amber-100/90 rounded-3xl p-6 sm:p-10 border border-amber-900/60 shadow-xl space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-amber-400 block">International Statutory Safeguards</span>
        <h2 class="text-xl sm:text-2xl font-bold font-heading text-amber-100">
            Legal Compliance & Diaspora Standards
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-amber-200/80 leading-relaxed pt-2">
            <div class="p-4 rounded-xl bg-stone-950 border border-amber-900/40">
                <h4 class="font-bold text-amber-300 mb-1">Statutory Age & Consent</h4>
                <p>
                    Strict adherence to the UN Convention on Consent to Marriage, Minimum Age and Registration of Marriages. No candidate under 21 (groom) or 18 (bride) is permitted to register. Full mutual consent is required before any contact exchange.
                </p>
            </div>
            <div class="p-4 rounded-xl bg-stone-950 border border-amber-900/40">
                <h4 class="font-bold text-amber-300 mb-1">Zero-Dowry & Anti-Extortion</h4>
                <p>
                    Full alignment with UN CEDAW standards and national Dowry Prohibition Acts. Solicitation of cash, vehicles, or coercive wedding expenditures triggers immediate automated chat interception and permanent user ban.
                </p>
            </div>
            <div class="p-4 rounded-xl bg-stone-950 border border-amber-900/40">
                <h4 class="font-bold text-amber-300 mb-1">Strict Monogamy Enforcement</h4>
                <p>
                    Only legally single candidates (Never Married, Divorced with certified decree, or Widowed) are accepted. Polygamy or undisclosed concurrent marriages are strictly prohibited.
                </p>
            </div>
            <div class="p-4 rounded-xl bg-stone-950 border border-amber-900/40">
                <h4 class="font-bold text-amber-300 mb-1">Data Privacy (DPDP & GDPR)</h4>
                <p>
                    All personal data, biodata documents, and astrological charts are encrypted. Contact shield masking guarantees telephone numbers and emails are never displayed publicly on search engines.
                </p>
            </div>
        </div>
    </div>

    <!-- Call to Action Banner -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-3xl p-8 text-center text-amber-100 shadow-xl space-y-4">
        <h2 class="text-2xl font-bold font-heading text-amber-100">
            Begin Your Sacred Matrimonial Journey Today
        </h2>
        <p class="text-xs sm:text-sm text-amber-200/90 max-w-xl mx-auto leading-relaxed">
            Create your biodata in minutes, verify your identity, and connect with compatible Dharmic families worldwide.
        </p>
        <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl gold-gradient text-white font-bold text-xs shadow-md hover:opacity-95 transition">
                Create Sacred Biodata (Free)
            </a>
            <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl bg-amber-100/10 hover:bg-amber-100/20 text-amber-200 border border-amber-400/40 font-bold text-xs transition">
                Sign In to Portal
            </a>
        </div>
    </div>

</div>
@endsection


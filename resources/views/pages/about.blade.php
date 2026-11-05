@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-10 py-2">

    <!-- Hero Header Banner -->
    <div class="card-ledger pattern-header p-8 sm:p-12 text-white bg-[var(--accent-primary)] text-center">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-sm)] bg-white/10 border border-white/20 text-white text-xs font-bold uppercase tracking-widest mb-3">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/></svg>
            <span>About Vivah Connect &bull; Sacred Matrimonial Union</span>
        </div>
        <h1 class="font-serif font-bold text-3xl sm:text-4xl text-white max-w-3xl mx-auto leading-tight">
            Restoring Sanctity, Familial Trust, and Vedic Heritage to Matrimony
        </h1>
        <p class="text-xs sm:text-sm text-white/80 mt-3 max-w-2xl mx-auto leading-relaxed">
            Vivah Connect was established to counter the commercial exploitation of matrimony. In the Vedic tradition, marriage is not a transient transaction, but a sacred covenant connecting two souls and two lineages.
        </p>

        <div class="mt-6 flex flex-wrap items-center justify-center gap-2 text-[11px] font-semibold text-white/90">
            <span class="px-3 py-1 rounded-[var(--radius-sm)] bg-white/10 border border-white/20">Single Vivah Pass ($29 USD)</span>
            <span class="px-3 py-1 rounded-[var(--radius-sm)] bg-white/10 border border-white/20">36-Point Ashtakoota Guna Milan</span>
            <span class="px-3 py-1 rounded-[var(--radius-sm)] bg-white/10 border border-white/20">100% ID KYC Verification</span>
            <span class="px-3 py-1 rounded-[var(--radius-sm)] bg-white/10 border border-white/20">UN CEDAW Zero-Dowry Shield</span>
        </div>
    </div>

    <!-- 1. The Sacred Genesis & Mission -->
    <div class="card-ledger p-6 sm:p-10 bg-[var(--bg-surface)] space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Our Sacred Genesis</span>
        <h2 class="text-xl sm:text-2xl font-bold font-serif text-[var(--text-primary)]">
            Why Vivah Connect Was Founded
        </h2>
        <div class="text-xs sm:text-sm text-[var(--text-secondary)] space-y-3 leading-relaxed">
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
            <span class="text-xs font-bold uppercase tracking-widest text-[var(--accent-primary)]">Foundational Principles</span>
            <h2 class="text-2xl font-bold font-serif text-[var(--text-primary)]">
                The 5 Sacred Dharmic Pillars
            </h2>
            <p class="text-xs text-[var(--text-muted)]">The core values that govern every feature and policy on our platform.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Pillar 1: Satya -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-2">
                <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] font-bold flex items-center justify-center text-xs mb-3 font-mono">
                    01
                </div>
                <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">1. Satya (Truth &amp; Integrity)</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Every member must complete a government-issued photo ID verification combined with real-time biometric liveness verification before proposals can be exchanged. Impersonation, misrepresentation, and bot accounts are permanently barred.
                </p>
            </div>

            <!-- Pillar 2: Maryada -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-2">
                <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] font-bold flex items-center justify-center text-xs mb-3 font-mono">
                    02
                </div>
                <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">2. Maryada (Dignity &amp; Modesty)</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    We uphold personal modesty with optional photo shields and automated contact masking. Direct phone numbers and email addresses remain shielded until both families formally accept mutual interest.
                </p>
            </div>

            <!-- Pillar 3: Sanskar -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-2">
                <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] font-bold flex items-center justify-center text-xs mb-3 font-mono">
                    03
                </div>
                <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">3. Sanskar (Vedic Tradition)</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Our platform computes precise 36-Point Ashtakoota Guna Milan across all eight classical factors. We provide immediate warnings for same-Gotra (Sagotra) ancestral lineages and Manglik dosha balancing.
                </p>
            </div>

            <!-- Pillar 4: Kula Gaurav -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-2">
                <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] font-bold flex items-center justify-center text-xs mb-3 font-mono">
                    04
                </div>
                <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">4. Kula Gaurav (Family Reverence)</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    Marriage unites families. Parents and guardians (Ghotoks) can manage biodatas, review proposals, and participate directly in 3-way chaperoned real-time messaging with the prospective in-laws.
                </p>
            </div>

            <!-- Pillar 5: Ahimsa -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-2">
                <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] font-bold flex items-center justify-center text-xs mb-3 font-mono">
                    05
                </div>
                <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">5. Ahimsa (Anti-Dowry Shield)</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    In compliance with the UN Convention on the Elimination of All Forms of Discrimination Against Women (CEDAW) and international anti-extortion statutes, dowry demands result in immediate profile suspension and law enforcement audit logs.
                </p>
            </div>

            <!-- Single Vivah Pass Philosophy -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] border-2 border-[var(--secondary-primary)] space-y-2">
                <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] text-[var(--secondary-primary)] font-bold flex items-center justify-center text-xs mb-3">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h12l4 6-10 12L2 9Z"/><path d="M11 3 8 9l4 12 4-12-3-6"/><path d="M2 9h20"/></svg>
                </div>
                <h3 class="font-serif font-bold text-base text-[var(--secondary-text)]">Single Vivah Pass Model</h3>
                <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                    We charge a single one-time pass of <strong>$29 USD</strong> (or <strong>$19 USD</strong> with promo code <code class="font-mono text-[var(--accent-primary)]">SHUBHOVIVAH</code>). No monthly subscriptions. Valid until your sacred wedding is celebrated.
                </p>
            </div>
        </div>
    </div>

    <!-- 3. Why Single Vivah Pass vs Monthly Traps -->
    <div id="single-pass-ethics" class="card-ledger p-6 sm:p-10 bg-[var(--bg-subtle)] space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Pricing Ethics</span>
        <h2 class="text-xl sm:text-2xl font-bold font-serif text-[var(--text-primary)]">
            Why We Charge Once per Marriage, Never Monthly
        </h2>
        <div class="text-xs sm:text-sm text-[var(--text-secondary)] space-y-3 leading-relaxed">
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
    <div id="acharya-council" class="card-ledger p-6 sm:p-10 bg-[var(--bg-surface)] space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Spiritual &amp; Astrological Guidance</span>
        <h2 class="text-xl sm:text-2xl font-bold font-serif text-[var(--text-primary)]">
            Pandit Acharya Kalyan Advisory Council
        </h2>
        <div class="flex flex-col sm:flex-row items-center gap-6 pt-2">
            <div class="w-16 h-16 rounded-[var(--radius-md)] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-center justify-center text-[var(--accent-primary)] shrink-0">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/></svg>
            </div>
            <div class="text-xs sm:text-sm text-[var(--text-secondary)] space-y-2 leading-relaxed">
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
    <div id="legal-compliance" class="card-ledger p-6 sm:p-10 bg-[var(--neutral-900)] text-white space-y-4">
        <span class="text-xs font-bold uppercase tracking-wider text-[var(--secondary-border)] block">International Statutory Safeguards</span>
        <h2 class="text-xl sm:text-2xl font-bold font-serif text-white">
            Legal Compliance &amp; Diaspora Standards
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-[var(--neutral-300)] leading-relaxed pt-2">
            <div class="p-4 rounded-[var(--radius-sm)] bg-black/40 border border-white/10">
                <h3 class="font-bold text-white mb-1">Statutory Age &amp; Consent</h3>
                <p>
                    Strict adherence to the UN Convention on Consent to Marriage, Minimum Age and Registration of Marriages. No candidate under 21 (groom) or 18 (bride) is permitted to register. Full mutual consent is required before any contact exchange.
                </p>
            </div>
            <div class="p-4 rounded-[var(--radius-sm)] bg-black/40 border border-white/10">
                <h3 class="font-bold text-white mb-1">Zero-Dowry &amp; Anti-Extortion</h3>
                <p>
                    Full alignment with UN CEDAW standards and national Dowry Prohibition Acts. Solicitation of cash, vehicles, or coercive wedding expenditures triggers immediate automated chat interception and permanent user ban.
                </p>
            </div>
            <div class="p-4 rounded-[var(--radius-sm)] bg-black/40 border border-white/10">
                <h3 class="font-bold text-white mb-1">Strict Monogamy Enforcement</h3>
                <p>
                    Only legally single candidates (Never Married, Divorced with certified decree, or Widowed) are accepted. Polygamy or undisclosed concurrent marriages are strictly prohibited.
                </p>
            </div>
            <div class="p-4 rounded-[var(--radius-sm)] bg-black/40 border border-white/10">
                <h3 class="font-bold text-white mb-1">Data Privacy &amp; Essential Cookies (DPDP &amp; GDPR)</h3>
                <p>
                    All personal data, biodata documents, and astrological charts are encrypted. Contact shield masking guarantees telephone numbers and emails are never displayed publicly on search engines. We use strictly essential cookies for secure session management and CSRF protection—zero third-party tracking or advertising cookies.
                </p>
            </div>
        </div>
    </div>

    <!-- Call to Action Banner -->
    <div class="card-ledger p-8 text-center bg-[var(--bg-surface)] space-y-4">
        <h2 class="text-2xl font-bold font-serif text-[var(--text-primary)]">
            Begin Your Sacred Matrimonial Journey Today
        </h2>
        <p class="text-xs sm:text-sm text-[var(--text-secondary)] max-w-xl mx-auto leading-relaxed">
            Create your biodata in minutes, verify your identity, and connect with compatible Dharmic families worldwide.
        </p>
        <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('register') }}" class="btn-primary text-xs">
                Create Sacred Biodata (Free)
            </a>
            <a href="{{ route('login') }}" class="btn-secondary text-xs">
                Sign In to Portal
            </a>
        </div>
    </div>

</div>
@endsection

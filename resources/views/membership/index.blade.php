@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="card-ledger pattern-header p-6 sm:p-8 text-white bg-[var(--accent-primary)] text-center">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-sm)] bg-white/10 border border-white/20 text-white text-xs font-semibold uppercase tracking-wider mb-2">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h12l4 6-10 12L2 9Z"/><path d="M11 3 8 9l4 12 4-12-3-6"/><path d="M2 9h20"/></svg>
            <span>Single Vivah Pass &bull; Authentic Matrimonial Ethics</span>
        </div>
        <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white">
            One-Time Pass for Your Sacred Union
        </h1>
        <p class="text-xs sm:text-sm text-white/80 mt-2 max-w-2xl mx-auto leading-relaxed">
            <strong>No monthly recurring fees. No automatic renewals.</strong> Pay once for a single marriage search, valid until your sacred wedding rituals (Saptapadi / Shubho Drishti) are solemnized.
        </p>

        <!-- Dharmic Milestone Guarantee Banner -->
        <div class="mt-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-[var(--radius-sm)] bg-white/10 border border-white/20 text-white text-[11px]">
            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span><strong>Single Marriage Guarantee:</strong> Unlike commercial dating sites that bill you monthly to prolong your search, Vivah Connect's pass lasts until your marriage union is celebrated.</span>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 bg-[var(--color-success-bg)] border border-[var(--color-success-border)] rounded-[var(--radius-md)] text-[var(--color-success)] flex items-start gap-3 text-xs">
        <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        <div>
            <h3 class="font-bold mb-0.5">Payment Successful!</h3>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] rounded-[var(--radius-md)] text-[var(--color-danger)] flex items-start gap-3 text-xs">
        <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <div>
            <h3 class="font-bold mb-0.5">Payment Issue</h3>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    @if($user->isPro())
    <!-- ACTIVE PRO PASS DASHBOARD CARD -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border-2 border-[var(--accent-primary)] relative overflow-hidden">
        <div class="absolute top-0 right-0 bg-[var(--accent-primary)] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-bl-[var(--radius-md)]">
            Active Single Vivah Pass
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-[var(--border-subtle)]">
            <div>
                <span class="inline-block text-[11px] font-bold text-[var(--color-success)] bg-[var(--color-success-bg)] border border-[var(--color-success-border)] px-2.5 py-0.5 rounded-[var(--radius-xs)] uppercase tracking-wider mb-2">
                    Pro Member Active
                </span>
                <h2 class="text-2xl font-bold font-serif text-[var(--text-primary)]">
                    Pro Single Vivah Pass
                </h2>
                <p class="text-xs text-[var(--text-secondary)] mt-1">
                    Valid for your entire matrimonial search until your Shubho Bibaho milestone declaration.
                </p>
            </div>

            <div class="bg-[var(--bg-subtle)] p-4 rounded-[var(--radius-sm)] border border-[var(--border-subtle)] text-right">
                <span class="text-[11px] font-semibold text-[var(--text-muted)] block uppercase">Billing Cycle</span>
                <span class="text-sm font-bold text-[var(--text-primary)] block">One-Time (No Monthly Charge)</span>
                <span class="text-[11px] text-[var(--color-success)] font-medium">Auto-renewals disabled by design</span>
            </div>
        </div>

        <!-- Membership Highlights -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-6 text-xs">
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Pro Access Status</span>
                <span class="font-bold text-[var(--color-success)] text-sm mt-0.5 block">Unlimited Proposals</span>
                <span class="text-[var(--text-muted)] text-[11px]">No 5 proposals/day limit</span>
            </div>
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Photo &amp; Privacy</span>
                <span class="font-bold text-[var(--accent-primary)] text-sm mt-0.5 block">Confidential Notes</span>
                <span class="text-[var(--text-muted)] text-[11px]">Private seeker shortlisting enabled</span>
            </div>
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <span class="text-[var(--text-muted)] block text-[10px] uppercase font-bold">Next Auspicious Step</span>
                <span class="font-bold text-[var(--text-primary)] text-sm mt-0.5 block">Solemnize Union</span>
                <span class="text-[var(--text-muted)] text-[11px]">Declare wedding when matched</span>
            </div>
        </div>

        @if($latestSubscription)
        <!-- Latest Payment Receipt Details -->
        <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-xs text-[var(--text-secondary)] space-y-2">
            <h3 class="font-bold text-[var(--text-primary)] text-xs flex items-center justify-between">
                <span>Pass Issuance &amp; Payment Receipt</span>
                <span class="px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)] text-[10px] uppercase font-bold">Paid in Full</span>
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 pt-1">
                <div>
                    <span class="text-[var(--text-muted)] text-[10px] block uppercase">Gateway</span>
                    <span class="font-semibold text-[var(--text-primary)] uppercase">
                        @if($latestSubscription->payment_method === 'stripe')
                            Stripe (Card)
                        @elseif($latestSubscription->payment_method === 'paypal')
                            PayPal
                        @else
                            {{ strtoupper($latestSubscription->payment_method) }}
                        @endif
                    </span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] text-[10px] block uppercase">Transaction ID</span>
                    <span class="font-mono text-[11px] text-[var(--text-primary)] font-semibold truncate block" title="{{ $latestSubscription->transaction_id }}">
                        {{ $latestSubscription->transaction_id }}
                    </span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] text-[10px] block uppercase">Date of Activation</span>
                    <span class="font-semibold text-[var(--text-primary)]">
                        {{ $latestSubscription->created_at->format('d/m/Y') }}
                    </span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] text-[10px] block uppercase">Amount Paid</span>
                    <span class="font-bold text-[var(--accent-primary)]">
                        {{ $latestSubscription->currency }} {{ number_format($latestSubscription->amount, 2) }}
                    </span>
                </div>
            </div>
        </div>
        @endif

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('discovery.index') }}" class="btn-primary text-xs flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <span>Explore Compatible Seekers</span>
            </a>
            <a href="{{ route('milestone.index') }}" class="btn-secondary text-xs">
                Declare Shubho Bibaho Union
            </a>
        </div>
    </div>
    @endif

    <!-- Tier Comparison -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
        
        <!-- Free Explorer Tier -->
        <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] flex flex-col justify-between">
            <div>
                <span class="text-xs font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1">Standard Access</span>
                <h3 class="font-serif font-bold text-2xl text-[var(--text-primary)]">Free Explorer</h3>
                <div class="text-2xl font-bold text-[var(--text-primary)] my-4">$0 / Free Forever</div>

                <ul class="space-y-3 text-xs text-[var(--text-secondary)]">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Full verified biodata creation &amp; editing</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Vedic Ashtakoota Guna Milan calculation</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Basic discovery filters (age, city, religion)</span>
                    </li>
                    <li class="flex items-center gap-2 text-[var(--color-warning)]">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        <span>Capped at 5 interests / proposals transmitted per day</span>
                    </li>
                    <li class="flex items-center gap-2 text-[var(--color-warning)]">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        <span>Capped at 10 candidate profile views per day</span>
                    </li>
                </ul>
            </div>

            <div class="mt-8 pt-4 border-t border-[var(--border-subtle)] text-center">
                <span class="text-xs font-semibold text-[var(--text-muted)]">Default Non-Paying Tier</span>
            </div>
        </div>

        <!-- Pro Single Vivah Pass Tier -->
        <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border-2 border-[var(--accent-primary)] relative flex flex-col justify-between overflow-hidden">
            <div class="absolute top-0 right-0 bg-[var(--accent-primary)] text-white text-[10px] font-bold uppercase tracking-widest py-1 px-4 rounded-bl-[var(--radius-md)]">
                Auspicious Pass
            </div>

            <div>
                <span class="text-xs font-bold text-[var(--accent-primary)] uppercase tracking-wider block mb-1">Single Marriage Union</span>
                <h3 class="font-serif font-bold text-2xl text-[var(--text-primary)]">Pro Single Vivah Pass</h3>
                <div class="my-4 flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-[var(--accent-primary)]">$29 USD</span>
                    <span class="text-xs text-[var(--text-muted)]">/ one-time payment</span>
                </div>

                <div class="mb-4 p-2.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-[11px] text-[var(--text-secondary)] font-medium">
                    <strong>No monthly recurring fees:</strong> Pay once now, and your account maintains full Pro privileges until you finalize your marriage and declare your Shubho Bibaho milestone.
                </div>

                <ul class="space-y-3 text-xs text-[var(--text-secondary)]">
                    <li class="flex items-center gap-2 font-semibold text-[var(--text-primary)]">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><strong>Unlimited</strong> proposals &amp; interests transmitted</span>
                    </li>
                    <li class="flex items-center gap-2 font-semibold text-[var(--text-primary)]">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><strong>Unlimited</strong> candidate profile views</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Advanced Pro filters: Gotra exclusion, Sampradaya, Manglik Milan</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Private candidate shortlists with confidential family notes</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Priority KYC trust officer review &amp; verified badge verification</span>
                    </li>
                </ul>
            </div>

            @if(!auth()->user()->isPro())
            <!-- CHECKOUT GATEWAY SECTION -->
            <div class="mt-8 pt-4 border-t border-[var(--border-subtle)]" x-data="{
                paymentGateway: 'stripe',
                voucherCode: '',
                discountApplied: false,
                basePrice: 29.00,
                finalPrice: 29.00,
                applyVoucher() {
                    if (this.voucherCode.trim().toUpperCase() === 'SHUBHOVIVAH') {
                        this.discountApplied = true;
                        this.finalPrice = 19.00;
                    } else {
                        this.discountApplied = false;
                        this.finalPrice = 29.00;
                    }
                }
            }">
                <div class="mb-3">
                    <label class="block text-[11px] font-bold text-[var(--text-secondary)] uppercase mb-1.5">Choose Payment Gateway</label>
                    <div class="grid grid-cols-2 gap-2">
                        <!-- Stripe Selector -->
                        <button type="button" @click="paymentGateway = 'stripe'"
                            :class="paymentGateway === 'stripe' ? 'border-[var(--accent-primary)] bg-[var(--accent-subtle)] text-[var(--accent-text)] font-bold' : 'border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-secondary)]'"
                            class="p-2.5 rounded-[var(--radius-sm)] border flex items-center justify-center gap-2 text-xs transition cursor-pointer">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                            <span>Stripe (Card)</span>
                        </button>

                        <!-- PayPal Selector -->
                        <button type="button" @click="paymentGateway = 'paypal'"
                            :class="paymentGateway === 'paypal' ? 'border-[var(--secondary-primary)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] font-bold' : 'border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-secondary)]'"
                            class="p-2.5 rounded-[var(--radius-sm)] border flex items-center justify-center gap-2 text-xs transition cursor-pointer">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13l2.5-6H17a4 4 0 0 1 0 8h-4.5"/><path d="M6 17l2.5-6H13a4 4 0 0 1 0 8H8.5"/></svg>
                            <span>PayPal</span>
                        </button>
                    </div>
                </div>

                <!-- Voucher Code input -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-[11px] font-bold text-[var(--text-secondary)] mb-1">
                        <span>Promotional Discount Voucher</span>
                        <span class="text-[10px] text-[var(--accent-primary)] font-normal">Use code: <strong>SHUBHOVIVAH</strong> ($10 off)</span>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" x-model="voucherCode" @input="applyVoucher()" placeholder="Enter SHUBHOVIVAH"
                            class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none uppercase font-mono">
                        <button type="button" @click="applyVoucher()" class="btn-secondary text-xs shrink-0">
                            Apply
                        </button>
                    </div>
                    <template x-if="discountApplied">
                        <div class="text-[11px] text-[var(--color-success)] font-bold mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <span>Shubho Vivah Discount applied! Amount reduced to $19.00 USD</span>
                        </div>
                    </template>
                </div>

                <!-- STRIPE FORM -->
                <div x-show="paymentGateway === 'stripe'" x-transition class="space-y-3">
                    <form method="POST" action="{{ route('membership.stripe') }}" class="space-y-3" id="stripeCheckoutForm">
                        @csrf
                        <input type="hidden" name="voucher_code" :value="voucherCode">
                        
                        <div>
                            <label class="block text-[11px] font-bold text-[var(--text-secondary)] uppercase mb-1">Cardholder Name</label>
                            <input type="text" name="cardholder_name" required value="{{ auth()->user()->name }}"
                                class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none"
                                placeholder="Name as displayed on card">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-[var(--text-secondary)] uppercase mb-1">Card Number (Visa, Mastercard, Amex)</label>
                            <input type="text" required maxlength="19"
                                class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs font-mono focus:border-[var(--accent-primary)] focus:outline-none"
                                placeholder="4242 •••• •••• 4242">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-[var(--text-secondary)] uppercase mb-1">Expiry (MM/YY)</label>
                                <input type="text" required maxlength="5" placeholder="12/28"
                                    class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs font-mono focus:border-[var(--accent-primary)] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-[var(--text-secondary)] uppercase mb-1">CVC / CVV</label>
                                <input type="password" required maxlength="4" placeholder="•••"
                                    class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs font-mono focus:border-[var(--accent-primary)] focus:outline-none">
                            </div>
                        </div>

                        <div class="flex items-center gap-1.5 text-[10px] text-[var(--text-muted)] py-1">
                            <svg class="w-3.5 h-3.5 text-[var(--color-success)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <span>256-bit SSL Encrypted &bull; PCI-DSS Certified via Stripe API</span>
                        </div>

                        <button type="submit" class="btn-primary w-full text-xs flex items-center justify-center gap-2 cursor-pointer">
                            <span>Pay $<span x-text="finalPrice.toFixed(2)">29.00</span> USD via Stripe</span>
                            <span class="opacity-90 font-normal">(Single Vivah Pass)</span>
                        </button>
                    </form>
                </div>

                <!-- PAYPAL FORM -->
                <div x-show="paymentGateway === 'paypal'" x-transition class="space-y-3">
                    <form method="POST" action="{{ route('membership.paypal') }}" class="space-y-3" id="paypalDirectForm">
                        @csrf
                        <input type="hidden" name="voucher_code" :value="voucherCode">
                        
                        <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-center space-y-2">
                            <h3 class="font-bold text-[var(--text-primary)] text-sm">PayPal Express Checkout</h3>
                            <p class="text-[11px] text-[var(--text-secondary)] leading-relaxed max-w-xs mx-auto">
                                You will complete your secure one-time payment of <strong>$<span x-text="finalPrice.toFixed(2)">29.00</span> USD</strong> via PayPal balance, connected cards, or Pay in 4.
                            </p>
                            <div class="text-[10px] text-[var(--color-success)] font-semibold bg-[var(--color-success-bg)] py-1 px-2 rounded-[var(--radius-xs)] border border-[var(--color-success-border)] inline-block">
                                No recurring subscription &bull; One-time charge for 1 marriage
                            </div>
                        </div>

                        <button type="submit" class="btn-primary w-full text-xs flex items-center justify-center gap-2 cursor-pointer">
                            <span>Pay with PayPal ($<span x-text="finalPrice.toFixed(2)">29.00</span> USD)</span>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="mt-8 pt-4 border-t border-[var(--border-subtle)] text-center">
                <span class="badge-verified text-xs">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <span>Pro Member Status Active</span>
                </span>
            </div>
            @endif
        </div>
    </div>

    <!-- Past Subscriptions History (if any) -->
    @if($subscriptions->isNotEmpty())
    <div class="card-ledger p-5 bg-[var(--bg-surface)] space-y-3">
        <h3 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
            Your Single Vivah Pass Transaction History
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[var(--border-subtle)] text-[var(--text-muted)] text-[10px] uppercase">
                        <th class="py-2">Date (DD/MM/YYYY)</th>
                        <th class="py-2">Plan</th>
                        <th class="py-2">Gateway</th>
                        <th class="py-2">Amount</th>
                        <th class="py-2">Transaction ID</th>
                        <th class="py-2">Validity</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-secondary)]">
                    @foreach($subscriptions as $sub)
                    <tr>
                        <td class="py-2.5 font-medium">{{ $sub->created_at->format('d/m/Y') }}</td>
                        <td class="py-2.5 font-semibold text-[var(--text-primary)]">Pro Single Vivah Pass</td>
                        <td class="py-2.5 uppercase text-[11px] font-bold">
                            @if($sub->payment_method === 'stripe')
                                <span>Stripe</span>
                            @elseif($sub->payment_method === 'paypal')
                                <span>PayPal</span>
                            @else
                                {{ $sub->payment_method }}
                            @endif
                        </td>
                        <td class="py-2.5 font-bold text-[var(--text-primary)]">{{ $sub->currency }} {{ number_format($sub->amount, 2) }}</td>
                        <td class="py-2.5 font-mono text-[10px] text-[var(--text-muted)]">{{ $sub->transaction_id }}</td>
                        <td class="py-2.5 text-[var(--color-success)] font-semibold text-[11px]">Valid Until Marriage</td>
                        <td class="py-2.5">
                            <span class="px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--color-success-bg)] text-[var(--color-success)] text-[10px] font-bold border border-[var(--color-success-border)]">
                                {{ ucfirst($sub->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>
@endsection

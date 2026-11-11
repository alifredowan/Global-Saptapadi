@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="section--dark relative rounded-2xl p-6 sm:p-8 text-white text-center overflow-hidden border border-[var(--color-accent)]/30 shadow-sm">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-xs font-semibold tracking-wide mb-3">
            <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
            <span>Single Vivah Pass &bull; Non-Commercial Ethics</span>
        </div>
        <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">
            One Pass. Valid Until Your Wedding Day.
        </h1>
        <p class="text-xs sm:text-sm text-[#F3E4DD] mt-2 max-w-2xl mx-auto leading-relaxed">
            No recurring monthly charges. Pay $29 USD once for your single marriage search, valid until your wedding rituals are solemnized.
        </p>

        <!-- Dharmic Milestone Guarantee Banner -->
        <div class="mt-4 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white/10 backdrop-blur-xs border border-white/20 text-stone-200 text-xs">
            <svg class="w-4 h-4 text-[var(--color-accent)] shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            <span><strong>Single Marriage Guarantee:</strong> Unlike commercial dating apps that profit by keeping you single, our pass is fulfilled when your marriage is declared.</span>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 rounded-xl text-emerald-800 dark:text-emerald-300 flex items-start gap-3 text-xs">
        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <h3 class="font-bold mb-0.5">Payment Completed</h3>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 rounded-xl text-rose-800 dark:text-rose-300 flex items-start gap-3 text-xs">
        <svg class="w-5 h-5 text-rose-600 dark:text-rose-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
        <div>
            <h3 class="font-bold mb-0.5">Payment Notice</h3>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    @if($user && $user->isPro())
    <!-- ACTIVE PRO PASS DASHBOARD CARD -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 sm:p-8 border-2 border-[var(--color-primary)] dark:border-[var(--color-accent)] relative overflow-hidden shadow-xs">
        <div class="absolute top-0 right-0 bg-[var(--color-primary)] text-white text-[10px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-bl-xl">
            Active Single Vivah Pass
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-stone-200 dark:border-stone-800">
            <div>
                <span class="inline-flex items-center gap-1 text-[11px] font-medium text-[var(--color-tulsi)] bg-[var(--color-tulsi)]/10 border border-[var(--color-tulsi)]/30 px-2.5 py-0.5 rounded-full mb-2">
                    <svg class="w-3 h-3 text-[var(--color-tulsi)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Pro Member Active</span>
                </span>
                <h2 class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100">
                    Pro Single Vivah Pass
                </h2>
                <p class="text-xs text-stone-600 dark:text-stone-400 mt-1">
                    Valid for your entire matrimonial search until your Shubho Bibaho milestone declaration.
                </p>
            </div>

            <div class="bg-stone-50 dark:bg-stone-800/60 p-4 rounded-xl border border-stone-200 dark:border-stone-700/80 text-left md:text-right">
                <span class="text-[11px] font-medium text-stone-500 uppercase tracking-wider block">Billing Model</span>
                <span class="text-sm font-bold text-stone-900 dark:text-stone-100 block mt-0.5">One-Time (No Monthly Charge)</span>
                <span class="text-[11px] text-[var(--color-tulsi)] font-medium">Auto-renewals disabled by design</span>
            </div>
        </div>

        <!-- Membership Highlights -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-6 text-xs">
            <div class="p-3.5 rounded-xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/80 dark:border-stone-700/80">
                <span class="text-stone-500 dark:text-stone-400 block text-[10px] uppercase font-bold tracking-wider">Proposal Capacity</span>
                <span class="font-bold text-[var(--color-tulsi)] text-sm mt-0.5 block">Unlimited Proposals</span>
                <span class="text-stone-500 dark:text-stone-400 text-[11px]">No daily sending restriction</span>
            </div>
            <div class="p-3.5 rounded-xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/80 dark:border-stone-700/80">
                <span class="text-stone-500 dark:text-stone-400 block text-[10px] uppercase font-bold tracking-wider">Confidential Shortlists</span>
                <span class="font-bold text-[var(--color-primary)] dark:text-[var(--color-accent)] text-sm mt-0.5 block">Private Family Notes</span>
                <span class="text-stone-500 dark:text-stone-400 text-[11px]">Keep family remarks private</span>
            </div>
            <div class="p-3.5 rounded-xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/80 dark:border-stone-700/80">
                <span class="text-stone-500 dark:text-stone-400 block text-[10px] uppercase font-bold tracking-wider">Auspicious Milestone</span>
                <span class="font-bold text-stone-900 dark:text-stone-100 text-sm mt-0.5 block">Solemnize Union</span>
                <span class="text-stone-500 dark:text-stone-400 text-[11px]">Declare wedding when matched</span>
            </div>
        </div>

        @if($latestSubscription)
        <!-- Latest Payment Receipt Details -->
        <div class="p-4 rounded-xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/80 dark:border-stone-700/80 text-xs text-stone-600 dark:text-stone-300 space-y-2">
            <h3 class="font-bold text-stone-900 dark:text-stone-100 text-xs flex items-center justify-between">
                <span>Pass Issuance &amp; Payment Receipt</span>
                <span class="px-2 py-0.5 rounded-full bg-[var(--color-tulsi)]/10 text-[var(--color-tulsi)] border border-[var(--color-tulsi)]/30 text-[10px] uppercase font-bold">Paid in Full</span>
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-1">
                <div>
                    <span class="text-stone-400 dark:text-stone-500 text-[10px] block uppercase">Gateway</span>
                    <span class="font-medium text-stone-800 dark:text-stone-200">
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
                    <span class="text-stone-400 dark:text-stone-500 text-[10px] block uppercase">Transaction ID</span>
                    <span class="font-mono text-[11px] text-stone-800 dark:text-stone-200 truncate block" title="{{ $latestSubscription->transaction_id }}">
                        {{ $latestSubscription->transaction_id }}
                    </span>
                </div>
                <div>
                    <span class="text-stone-400 dark:text-stone-500 text-[10px] block uppercase">Date Activated</span>
                    <span class="font-medium text-stone-800 dark:text-stone-200">
                        {{ $latestSubscription->created_at->format('d M, Y') }}
                    </span>
                </div>
                <div>
                    <span class="text-stone-400 dark:text-stone-500 text-[10px] block uppercase">Amount Paid</span>
                    <span class="font-bold text-[var(--color-primary)] dark:text-[var(--color-accent)]">
                        {{ $latestSubscription->currency }} {{ number_format($latestSubscription->amount, 2) }}
                    </span>
                </div>
            </div>
        </div>
        @endif

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('discovery.index') }}" class="px-4 py-2 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white text-xs font-medium transition inline-flex items-center gap-1.5 shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                <span>Discover Candidates</span>
            </a>
            <a href="{{ route('milestone.index') }}" class="px-4 py-2 rounded-xl border border-stone-300 dark:border-stone-700 text-stone-700 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 text-xs font-medium transition">
                Declare Shubho Bibaho Union
            </a>
        </div>
    </div>
    @endif

    <!-- Tier Comparison -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
        
        <!-- Free Explorer Tier -->
        <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-xs flex flex-col justify-between">
            <div>
                <span class="text-[11px] font-bold text-stone-500 uppercase tracking-wider block mb-1">Standard Access</span>
                <h3 class="font-serif font-bold text-2xl text-stone-900 dark:text-stone-100">Free Explorer</h3>
                <div class="text-2xl font-serif font-bold text-stone-900 dark:text-stone-100 my-4">$0 <span class="text-xs font-sans font-normal text-stone-500">/ Free Forever</span></div>

                <ul class="space-y-3 text-xs text-stone-600 dark:text-stone-400">
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Full verified biodata creation &amp; editing</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Vedic Ashtakoota Guna Milan calculation</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Standard candidate discovery filters</span>
                    </li>
                    <li class="flex items-center gap-2.5 text-stone-500">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                        <span>Capped at 5 interests per day</span>
                    </li>
                    <li class="flex items-center gap-2.5 text-stone-500">
                        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                        <span>Capped at 10 biodata profile views per day</span>
                    </li>
                </ul>
            </div>

            <div class="mt-8 pt-4 border-t border-stone-200 dark:border-stone-800 text-center">
                <span class="text-xs font-medium text-stone-500">Default standard tier</span>
            </div>
        </div>

        <!-- Pro Single Vivah Pass Tier -->
        <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 sm:p-8 border-2 border-[var(--color-primary)] dark:border-[var(--color-accent)] relative flex flex-col justify-between overflow-hidden shadow-xs">
            <div class="absolute top-0 right-0 bg-[var(--color-primary)] text-white text-[10px] font-bold uppercase tracking-widest py-1 px-4 rounded-bl-xl">
                Auspicious Pass
            </div>

            <div>
                <span class="text-[11px] font-bold text-[var(--color-accent)] uppercase tracking-wider block mb-1">Single Marriage Union</span>
                <h3 class="font-serif font-bold text-2xl text-stone-900 dark:text-stone-100">Pro Single Vivah Pass</h3>
                <div class="my-4 flex items-baseline gap-2">
                    <span class="text-3xl font-serif font-bold text-[var(--color-primary)] dark:text-[var(--color-accent)]">$29 USD</span>
                    <span class="text-xs text-stone-500">/ one-time payment</span>
                </div>

                <div class="mb-4 p-3 rounded-xl bg-[var(--color-haldi-soft)]/70 dark:bg-amber-950/30 border border-[var(--color-haldi)]/40 text-[11px] text-stone-800 dark:text-stone-300 leading-relaxed">
                    <strong>Pay once, never billed again:</strong> Your pass remains fully active until you finalize your wedding and declare your Shubho Bibaho milestone.
                </div>

                <ul class="space-y-3 text-xs text-stone-600 dark:text-stone-400">
                    <li class="flex items-center gap-2.5 font-medium text-stone-900 dark:text-stone-100">
                        <svg class="w-4 h-4 text-[var(--color-tulsi)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span><strong>Unlimited</strong> proposals &amp; interest transmissions</span>
                    </li>
                    <li class="flex items-center gap-2.5 font-medium text-stone-900 dark:text-stone-100">
                        <svg class="w-4 h-4 text-[var(--color-tulsi)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span><strong>Unlimited</strong> candidate profile views</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[var(--color-tulsi)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Vedic Gotra exclusion &amp; Sampradaya filters</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[var(--color-tulsi)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Private candidate shortlists with confidential family notes</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[var(--color-tulsi)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Priority KYC trust officer review &amp; verification badge</span>
                    </li>
                </ul>
            </div>

            @auth
            @if(!$user->isPro())
            <!-- CHECKOUT GATEWAY SECTION -->
            <div class="mt-8 pt-4 border-t border-stone-200 dark:border-stone-800" x-data="{
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
                    <label class="block text-[11px] font-medium text-stone-600 dark:text-stone-400 uppercase tracking-wider mb-1.5">Choose Payment Gateway</label>
                    <div class="grid grid-cols-2 gap-2">
                        <!-- Stripe Selector -->
                        <button type="button" @click="paymentGateway = 'stripe'"
                            :class="paymentGateway === 'stripe' ? 'border-[var(--color-primary)] bg-[var(--color-primary-soft)] text-[var(--color-primary)] dark:text-[var(--color-accent)] font-semibold' : 'border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-600 dark:text-stone-400'"
                            class="p-2.5 rounded-xl border flex items-center justify-center gap-2 text-xs transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                            <span>Stripe (Card)</span>
                        </button>

                        <!-- PayPal Selector -->
                        <button type="button" @click="paymentGateway = 'paypal'"
                            :class="paymentGateway === 'paypal' ? 'border-[var(--color-primary)] bg-[var(--color-primary-soft)] text-[var(--color-primary)] dark:text-[var(--color-accent)] font-semibold' : 'border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-600 dark:text-stone-400'"
                            class="p-2.5 rounded-xl border flex items-center justify-center gap-2 text-xs transition cursor-pointer">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 13l2.5-6H17a4 4 0 0 1 0 8h-4.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 17l2.5-6H13a4 4 0 0 1 0 8H8.5"/></svg>
                            <span>PayPal</span>
                        </button>
                    </div>
                </div>

                <!-- Voucher Code input -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-[11px] font-medium text-stone-600 dark:text-stone-400 mb-1">
                        <span>Auspicious Voucher</span>
                        <span class="text-[10px] text-[var(--color-accent)]">Code: <strong>SHUBHOVIVAH</strong> ($10 off)</span>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" x-model="voucherCode" @input="applyVoucher()" placeholder="SHUBHOVIVAH"
                            class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 text-xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] uppercase font-mono">
                        <button type="button" @click="applyVoucher()" class="px-3.5 py-2 rounded-xl border border-stone-300 dark:border-stone-700 text-stone-700 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 text-xs font-medium shrink-0 cursor-pointer">
                            Apply
                        </button>
                    </div>
                    <template x-if="discountApplied">
                        <div class="text-[11px] text-[var(--color-tulsi)] font-medium mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
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
                            <label class="block text-[11px] font-medium text-stone-600 dark:text-stone-400 uppercase tracking-wider mb-1">Cardholder Name</label>
                            <input type="text" name="cardholder_name" required value="{{ $user->name }}"
                                class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 text-xs focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]"
                                placeholder="Name as displayed on card">
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium text-stone-600 dark:text-stone-400 uppercase tracking-wider mb-1">Card Number</label>
                            <input type="text" required maxlength="19"
                                class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 text-xs font-mono focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]"
                                placeholder="4242 •••• •••• 4242">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-medium text-stone-600 dark:text-stone-400 uppercase tracking-wider mb-1">Expiry (MM/YY)</label>
                                <input type="text" required maxlength="5" placeholder="12/28"
                                    class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 text-xs font-mono focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]">
                            </div>
                            <div>
                                <label class="block text-[11px] font-medium text-stone-600 dark:text-stone-400 uppercase tracking-wider mb-1">CVC / CVV</label>
                                <input type="password" required maxlength="4" placeholder="•••"
                                    class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 text-xs font-mono focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]">
                            </div>
                        </div>

                        <div class="flex items-center gap-1.5 text-[10px] text-stone-500 py-1">
                            <svg class="w-3.5 h-3.5 text-[var(--color-tulsi)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                            <span>256-bit SSL Encrypted &bull; PCI-DSS Certified via Stripe</span>
                        </div>

                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium text-xs shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                            <span>Pay $<span x-text="finalPrice.toFixed(2)">29.00</span> USD via Stripe</span>
                            <span class="opacity-80 font-normal">(Single Vivah Pass)</span>
                        </button>
                    </form>
                </div>

                <!-- PAYPAL FORM -->
                <div x-show="paymentGateway === 'paypal'" x-transition class="space-y-3">
                    <form method="POST" action="{{ route('membership.paypal') }}" class="space-y-3" id="paypalDirectForm">
                        @csrf
                        <input type="hidden" name="voucher_code" :value="voucherCode">
                        
                        <div class="p-4 rounded-xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/80 dark:border-stone-700/80 text-center space-y-2">
                            <h3 class="font-serif font-bold text-stone-900 dark:text-stone-100 text-sm">PayPal Express Checkout</h3>
                            <p class="text-[11px] text-stone-600 dark:text-stone-400 leading-relaxed max-w-xs mx-auto">
                                You will complete your secure one-time payment of <strong>$<span x-text="finalPrice.toFixed(2)">29.00</span> USD</strong> via PayPal balance, connected cards, or Pay in 4.
                            </p>
                            <div class="text-[10px] text-[var(--color-tulsi)] font-medium bg-[var(--color-tulsi)]/10 py-1 px-2.5 rounded-full border border-[var(--color-tulsi)]/30 inline-block">
                                No recurring subscription &bull; One-time charge for 1 marriage
                            </div>
                        </div>

                        <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium text-xs shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                            <span>Pay with PayPal ($<span x-text="finalPrice.toFixed(2)">29.00</span> USD)</span>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="mt-8 pt-4 border-t border-stone-200 dark:border-stone-800 text-center">
                <span class="inline-flex items-center gap-1.5 text-xs text-[var(--color-tulsi)] font-medium bg-[var(--color-tulsi)]/10 border border-[var(--color-tulsi)]/30 px-3 py-1 rounded-full">
                    <svg class="w-3.5 h-3.5 text-[var(--color-tulsi)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Pro Member Status Active</span>
                </span>
            </div>
            @endif
            @else
            <!-- GUEST PROMPT -->
            <div class="mt-8 pt-4 border-t border-stone-200 dark:border-stone-800 text-center space-y-3">
                <p class="text-xs text-stone-600 dark:text-stone-400">
                    Create a profile or sign in to purchase your Single Vivah Pass ($29 USD).
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-2.5">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium text-xs shadow-xs transition text-center">
                        Create Free Profile to Begin
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-stone-300 dark:border-stone-700 hover:bg-stone-50 dark:hover:bg-stone-800 text-stone-700 dark:text-stone-300 font-medium text-xs transition text-center">
                        Sign In
                    </a>
                </div>
            </div>
            @endauth
        </div>
    </div>

    <!-- Past Subscriptions History (if any) -->
    @if($subscriptions->isNotEmpty())
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-5 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-3">
        <h3 class="text-xs font-bold text-stone-900 dark:text-stone-100 uppercase tracking-wider">
            Your Single Vivah Pass Transaction History
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-stone-200 dark:border-stone-800 text-stone-400 dark:text-stone-500 text-[10px] uppercase">
                        <th class="py-2">Date</th>
                        <th class="py-2">Pass</th>
                        <th class="py-2">Gateway</th>
                        <th class="py-2">Amount</th>
                        <th class="py-2">Transaction ID</th>
                        <th class="py-2">Validity</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 dark:divide-stone-800/60 text-stone-600 dark:text-stone-300">
                    @foreach($subscriptions as $sub)
                    <tr>
                        <td class="py-2.5 font-medium">{{ $sub->created_at->format('d M, Y') }}</td>
                        <td class="py-2.5 font-serif font-bold text-stone-900 dark:text-stone-100">Pro Single Vivah Pass</td>
                        <td class="py-2.5 uppercase text-[11px] font-medium">
                            @if($sub->payment_method === 'stripe')
                                <span>Stripe</span>
                            @elseif($sub->payment_method === 'paypal')
                                <span>PayPal</span>
                            @else
                                {{ $sub->payment_method }}
                            @endif
                        </td>
                        <td class="py-2.5 font-bold text-[var(--color-primary)] dark:text-[var(--color-accent)]">{{ $sub->currency }} {{ number_format($sub->amount, 2) }}</td>
                        <td class="py-2.5 font-mono text-[10px] text-stone-400">{{ $sub->transaction_id }}</td>
                        <td class="py-2.5 text-[var(--color-tulsi)] font-medium text-[11px]">Valid Until Marriage</td>
                        <td class="py-2.5">
                            <span class="px-2 py-0.5 rounded-full bg-[var(--color-tulsi)]/10 text-[var(--color-tulsi)] text-[10px] font-medium border border-[var(--color-tulsi)]/30">
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

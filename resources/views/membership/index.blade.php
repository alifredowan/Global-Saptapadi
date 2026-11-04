@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-3xl p-6 sm:p-8 text-amber-100 shadow-md text-center relative overflow-hidden">
        <div class="absolute -right-12 -top-12 w-48 h-48 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
            <span>✨</span>
            <span>Single Vivah Pass • Authentic Matrimonial Ethics</span>
        </div>
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-amber-100">
            One-Time Pass for Your Sacred Union
        </h1>
        <p class="text-xs sm:text-sm text-amber-200/90 mt-2 max-w-2xl mx-auto leading-relaxed">
            <strong>No monthly recurring fees. No automatic renewals.</strong> Pay once for a single marriage search, valid until your sacred wedding rituals (Saptapadi / Shubho Drishti) are solemnized.
        </p>

        <!-- Dharmic Milestone Guarantee Banner -->
        <div class="mt-4 inline-flex items-center space-x-2 px-3 py-1.5 rounded-lg bg-red-900/60 border border-amber-400/30 text-amber-200 text-[11px]">
            <span>💍</span>
            <span><strong>Single Marriage Guarantee:</strong> Unlike commercial dating sites that bill you monthly to prolong your search, Vivah Connect's pass lasts until your marriage union is celebrated.</span>
        </div>
    </div>

    @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-300 rounded-2xl text-emerald-900 flex items-start space-x-3 text-xs shadow-xs">
        <span class="text-lg">🎉</span>
        <div>
            <h4 class="font-bold text-emerald-950 mb-0.5">Payment Successful!</h4>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 bg-red-50 border border-red-300 rounded-2xl text-red-900 flex items-start space-x-3 text-xs shadow-xs">
        <span class="text-lg">⚠️</span>
        <div>
            <h4 class="font-bold text-red-950 mb-0.5">Payment Issue</h4>
            <p>{{ session('error') }}</p>
        </div>
    </div>
    @endif

    @if($user->isPro())
    <!-- ACTIVE PRO PASS DASHBOARD CARD -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border-2 border-amber-400 shadow-xl relative overflow-hidden">
        <div class="absolute top-0 right-0 gold-gradient text-white text-[10px] font-extrabold uppercase tracking-widest py-1.5 px-5 rounded-bl-2xl shadow-xs">
            ⭐ Active Single Vivah Pass
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-amber-100">
            <div>
                <span class="inline-block text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-md uppercase tracking-wider mb-2">
                    ● Pro Member Active
                </span>
                <h2 class="text-2xl font-bold font-heading text-red-950">
                    Pro Single Vivah Pass
                </h2>
                <p class="text-xs text-gray-600 mt-1">
                    Valid for your entire matrimonial search until your Shubho Bibaho milestone declaration.
                </p>
            </div>

            <div class="bg-amber-50/70 p-4 rounded-2xl border border-amber-200/80 text-right">
                <span class="text-[11px] font-semibold text-gray-500 block uppercase">Billing Cycle</span>
                <span class="text-sm font-extrabold text-amber-950 block">One-Time (No Monthly Charge)</span>
                <span class="text-[11px] text-emerald-700 font-medium">Auto-renewals disabled by design</span>
            </div>
        </div>

        <!-- Membership Highlights -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-6 text-xs">
            <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200">
                <span class="text-gray-500 block text-[10px] uppercase font-bold">Pro Access Status</span>
                <span class="font-bold text-emerald-700 text-sm mt-0.5 block">Unlimited Proposals</span>
                <span class="text-gray-500 text-[11px]">No 5 proposals/day limit</span>
            </div>
            <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200">
                <span class="text-gray-500 block text-[10px] uppercase font-bold">Photo & Privacy</span>
                <span class="font-bold text-amber-900 text-sm mt-0.5 block">Confidential Notes</span>
                <span class="text-gray-500 text-[11px]">Private seeker shortlisting enabled</span>
            </div>
            <div class="p-3.5 rounded-xl bg-gray-50 border border-gray-200">
                <span class="text-gray-500 block text-[10px] uppercase font-bold">Next Auspicious Step</span>
                <span class="font-bold text-red-950 text-sm mt-0.5 block">Solemnize Union</span>
                <span class="text-gray-500 text-[11px]">Declare wedding when matched</span>
            </div>
        </div>

        @if($latestSubscription)
        <!-- Latest Payment Receipt Details -->
        <div class="p-4 rounded-2xl bg-amber-50/50 border border-amber-200 text-xs text-gray-700 space-y-2">
            <h4 class="font-bold text-red-950 text-xs flex items-center justify-between">
                <span>Pass Issuance & Payment Receipt</span>
                <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 text-[10px] uppercase font-bold">Paid in Full</span>
            </h4>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 pt-1">
                <div>
                    <span class="text-gray-500 text-[10px] block uppercase">Gateway</span>
                    <span class="font-semibold text-gray-900 uppercase">
                        @if($latestSubscription->payment_method === 'stripe')
                            💳 Stripe (Credit/Debit)
                        @elseif($latestSubscription->payment_method === 'paypal')
                            🅿️ PayPal
                        @else
                            {{ strtoupper($latestSubscription->payment_method) }}
                        @endif
                    </span>
                </div>
                <div>
                    <span class="text-gray-500 text-[10px] block uppercase">Transaction ID</span>
                    <span class="font-mono text-[11px] text-gray-800 font-semibold truncate block" title="{{ $latestSubscription->transaction_id }}">
                        {{ $latestSubscription->transaction_id }}
                    </span>
                </div>
                <div>
                    <span class="text-gray-500 text-[10px] block uppercase">Date of Activation</span>
                    <span class="font-semibold text-gray-900">
                        {{ $latestSubscription->created_at->format('d/m/Y') }}
                    </span>
                </div>
                <div>
                    <span class="text-gray-500 text-[10px] block uppercase">Amount Paid</span>
                    <span class="font-extrabold text-amber-900">
                        {{ $latestSubscription->currency }} {{ number_format($latestSubscription->amount, 2) }}
                    </span>
                </div>
            </div>
        </div>
        @endif

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('discovery.index') }}" class="px-5 py-2.5 rounded-xl gold-gradient text-white font-bold text-xs shadow-md hover:opacity-95 transition">
                🔍 Explore Compatible Seekers
            </a>
            <a href="{{ route('milestone.index') }}" class="px-5 py-2.5 rounded-xl bg-white border border-red-900/30 text-red-950 font-bold text-xs hover:bg-amber-50/50 transition">
                💍 Declare Shubho Bibaho Union
            </a>
        </div>
    </div>
    @endif

    <!-- Tier Comparison -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
        
        <!-- Free Explorer Tier -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-200 shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1">Standard Access</span>
                <h3 class="font-heading font-bold text-2xl text-gray-900">Free Explorer</h3>
                <div class="text-2xl font-extrabold text-gray-800 my-4">$0 / Free Forever</div>

                <ul class="space-y-3 text-xs text-gray-600">
                    <li class="flex items-center space-x-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Full verified biodata creation & editing</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Vedic Ashtakoota Guna Milan calculation</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Basic discovery filters (age, city, religion)</span>
                    </li>
                    <li class="flex items-center space-x-2 text-amber-900">
                        <span class="font-bold">⚠️</span>
                        <span>Capped at 5 interests / proposals transmitted per day</span>
                    </li>
                    <li class="flex items-center space-x-2 text-amber-900">
                        <span class="font-bold">⚠️</span>
                        <span>Capped at 10 candidate profile views per day</span>
                    </li>
                </ul>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-100 text-center">
                <span class="text-xs font-bold text-gray-400">Default Non-Paying Tier</span>
            </div>
        </div>

        <!-- Pro Single Vivah Pass Tier -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 border-2 border-amber-400 shadow-xl relative flex flex-col justify-between overflow-hidden">
            <div class="absolute top-0 right-0 gold-gradient text-white text-[10px] font-extrabold uppercase tracking-widest py-1 px-4 rounded-bl-xl shadow-xs">
                💍 Auspicious Lifetime Pass
            </div>

            <div>
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider block mb-1">Single Marriage Union</span>
                <h3 class="font-heading font-bold text-2xl text-red-950">Pro Single Vivah Pass</h3>
                <div class="my-4 flex items-baseline space-x-2">
                    <span class="text-3xl font-extrabold text-red-900">$29 USD</span>
                    <span class="text-xs text-gray-500">/ one-time payment</span>
                </div>

                <div class="mb-4 p-2.5 rounded-xl bg-amber-50/70 border border-amber-200 text-[11px] text-amber-900 font-medium">
                    ✨ <strong>Never Charged Monthly:</strong> Pay once now, and your account maintains full Pro privileges until you finalize your marriage and declare your Shubho Bibaho milestone.
                </div>

                <ul class="space-y-3 text-xs text-gray-700">
                    <li class="flex items-center space-x-2 font-semibold">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span><strong>Unlimited</strong> proposals & interests transmitted</span>
                    </li>
                    <li class="flex items-center space-x-2 font-semibold">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span><strong>Unlimited</strong> candidate profile views</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Advanced Pro filters: Gotra exclusion, Sampradaya, Manglik Milan</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Private candidate shortlists with confidential family notes</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span>Priority KYC trust officer review & verified badge verification</span>
                    </li>
                </ul>
            </div>

            @if(!auth()->user()->isPro())
            <!-- CHECKOUT GATEWAY SECTION -->
            <div class="mt-8 pt-4 border-t border-amber-100" x-data="{
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
                    <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1.5">Choose Payment Gateway</label>
                    <div class="grid grid-cols-2 gap-2">
                        <!-- Stripe Selector -->
                        <button type="button" @click="paymentGateway = 'stripe'"
                            :class="paymentGateway === 'stripe' ? 'border-red-800 bg-red-50/60 ring-2 ring-red-800 text-red-950 font-bold' : 'border-gray-200 bg-white text-gray-700 hover:border-gray-300'"
                            class="p-2.5 rounded-xl border flex items-center justify-center space-x-2 text-xs transition cursor-pointer">
                            <span class="text-base">💳</span>
                            <span>Stripe (Card)</span>
                        </button>

                        <!-- PayPal Selector -->
                        <button type="button" @click="paymentGateway = 'paypal'"
                            :class="paymentGateway === 'paypal' ? 'border-amber-600 bg-amber-50/60 ring-2 ring-amber-600 text-amber-950 font-bold' : 'border-gray-200 bg-white text-gray-700 hover:border-gray-300'"
                            class="p-2.5 rounded-xl border flex items-center justify-center space-x-2 text-xs transition cursor-pointer">
                            <span class="text-base">🅿️</span>
                            <span>PayPal</span>
                        </button>
                    </div>
                </div>

                <!-- Voucher Code input -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-[11px] font-bold text-gray-700 mb-1">
                        <span>Promotional Discount Voucher</span>
                        <span class="text-[10px] text-amber-700 font-normal">Use code: <strong>SHUBHOVIVAH</strong> ($10 off)</span>
                    </div>
                    <div class="flex space-x-2">
                        <input type="text" x-model="voucherCode" @input="applyVoucher()" placeholder="Enter SHUBHOVIVAH"
                            class="w-full px-3 py-2 rounded-xl border border-gray-300 text-xs focus:ring-1 focus:ring-red-800 uppercase font-mono">
                        <button type="button" @click="applyVoucher()" class="px-3 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs shrink-0 transition">
                            Apply
                        </button>
                    </div>
                    <template x-if="discountApplied">
                        <div class="text-[11px] text-emerald-700 font-bold mt-1 flex items-center space-x-1">
                            <span>✓</span>
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
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Cardholder Name</label>
                            <input type="text" name="cardholder_name" required value="{{ auth()->user()->name }}"
                                class="w-full px-3 py-2 rounded-xl border border-gray-300 text-xs focus:ring-1 focus:ring-red-800"
                                placeholder="Name as displayed on card">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Card Number (Visa, Mastercard, Amex)</label>
                            <div class="relative">
                                <input type="text" required maxlength="19"
                                    class="w-full px-3 py-2 pl-9 rounded-xl border border-gray-300 text-xs font-mono focus:ring-1 focus:ring-red-800"
                                    placeholder="4242 •••• •••• 4242">
                                <span class="absolute left-3 top-2.5 text-gray-400 text-xs">💳</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">Expiry (MM/YY)</label>
                                <input type="text" required maxlength="5" placeholder="12/28"
                                    class="w-full px-3 py-2 rounded-xl border border-gray-300 text-xs font-mono focus:ring-1 focus:ring-red-800">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-700 uppercase mb-1">CVC / CVV</label>
                                <input type="password" required maxlength="4" placeholder="•••"
                                    class="w-full px-3 py-2 rounded-xl border border-gray-300 text-xs font-mono focus:ring-1 focus:ring-red-800">
                            </div>
                        </div>

                        <div class="flex items-center space-x-1.5 text-[10px] text-gray-500 py-1">
                            <span class="text-emerald-600 font-bold">🔒</span>
                            <span>256-bit SSL Encrypted • PCI-DSS Certified via Stripe API</span>
                        </div>

                        <button type="submit" class="w-full py-3 rounded-xl gold-gradient text-white font-bold text-xs shadow-md hover:opacity-95 transition cursor-pointer flex items-center justify-center space-x-2">
                            <span>Pay $<span x-text="finalPrice.toFixed(2)">29.00</span> USD via Stripe</span>
                            <span class="text-xs opacity-90 font-normal">(Single Vivah Pass)</span>
                        </button>
                    </form>
                </div>

                <!-- PAYPAL FORM -->
                <div x-show="paymentGateway === 'paypal'" x-transition class="space-y-3">
                    <form method="POST" action="{{ route('membership.paypal') }}" class="space-y-3" id="paypalDirectForm">
                        @csrf
                        <input type="hidden" name="voucher_code" :value="voucherCode">
                        
                        <div class="p-4 rounded-xl bg-amber-50/60 border border-amber-200 text-center space-y-2">
                            <div class="flex items-center justify-center space-x-1.5">
                                <span class="text-xl">🅿️</span>
                                <span class="font-bold text-amber-950 text-sm">PayPal Express Checkout</span>
                            </div>
                            <p class="text-[11px] text-gray-600 leading-relaxed max-w-xs mx-auto">
                                You will complete your secure one-time payment of <strong>$<span x-text="finalPrice.toFixed(2)">29.00</span> USD</strong> via PayPal balance, connected cards, or Pay in 4.
                            </p>
                            <div class="text-[10px] text-emerald-800 font-semibold bg-emerald-50 py-1 px-2 rounded-lg border border-emerald-200 inline-block">
                                ✓ No recurring subscription • One-time charge for 1 marriage
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 rounded-xl bg-[#0070ba] hover:bg-[#005ea6] text-white font-bold text-xs shadow-md transition cursor-pointer flex items-center justify-center space-x-2">
                            <span>🅿️ Pay with PayPal ($<span x-text="finalPrice.toFixed(2)">29.00</span> USD)</span>
                        </button>
                    </form>
                </div>

                <!-- End Payment Methods -->
            </div>
            @else
            <div class="mt-8 pt-4 border-t border-amber-100 text-center">
                <span class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">
                    <span>✓</span>
                    <span>Pro Member Status Active</span>
                </span>
            </div>
            @endif
        </div>
    </div>

    <!-- Past Subscriptions History (if any) -->
    @if($subscriptions->isNotEmpty())
    <div class="bg-white rounded-2xl p-5 border border-gray-200 shadow-xs space-y-3">
        <h3 class="text-xs font-bold text-gray-700 uppercase tracking-wider">
            Your Single Vivah Pass Transaction History
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500 text-[10px] uppercase">
                        <th class="py-2">Date (DD/MM/YYYY)</th>
                        <th class="py-2">Plan</th>
                        <th class="py-2">Gateway</th>
                        <th class="py-2">Amount</th>
                        <th class="py-2">Transaction ID</th>
                        <th class="py-2">Validity</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @foreach($subscriptions as $sub)
                    <tr>
                        <td class="py-2.5 font-medium">{{ $sub->created_at->format('d/m/Y') }}</td>
                        <td class="py-2.5 font-semibold text-red-950">Pro Single Vivah Pass</td>
                        <td class="py-2.5 uppercase text-[11px] font-bold">
                            @if($sub->payment_method === 'stripe')
                                <span class="text-indigo-700">💳 Stripe</span>
                            @elseif($sub->payment_method === 'paypal')
                                <span class="text-blue-700">🅿️ PayPal</span>
                            @else
                                {{ $sub->payment_method }}
                            @endif
                        </td>
                        <td class="py-2.5 font-bold">{{ $sub->currency }} {{ number_format($sub->amount, 2) }}</td>
                        <td class="py-2.5 font-mono text-[10px] text-gray-500">{{ $sub->transaction_id }}</td>
                        <td class="py-2.5 text-emerald-700 font-semibold text-[11px]">Valid Until Marriage</td>
                        <td class="py-2.5">
                            <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">
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

@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto my-12 bg-white rounded-3xl shadow-xl border border-amber-200/80 overflow-hidden">
    <!-- Header with Auspicious Motif (Nikah Style) -->
    <div class="gold-gradient p-8 text-center text-amber-100">
        <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-amber-400/20 border-2 border-amber-300 flex items-center justify-center text-xl font-black font-heading shadow-inner">
            <span>🔑</span>
        </div>
        <h2 class="font-heading font-bold text-2xl text-amber-100">Welcome Back</h2>
        <p class="text-xs text-amber-200/90 mt-1 leading-relaxed">
            Sign in to review matches, proposals, and chaperoned messages.
        </p>
    </div>

    <div class="p-6 sm:p-8">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Email Address
                </label>
                <input type="email" name="email" value="{{ old('email', 'arun@example.com') }}" required 
                    placeholder="your.email@domain.com"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 focus:border-red-800 outline-none text-sm">
            </div>

            <div x-data="{ showPass: false }">
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Password
                    </label>
                    <a href="#" class="text-xs text-emerald-800 hover:text-red-900 hover:underline font-semibold">
                        Forgot password?
                    </a>
                </div>
                <div class="relative">
                    <input :type="showPass ? 'text' : 'password'" name="password" value="password123" required 
                        placeholder="••••••••"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 focus:border-red-800 outline-none text-sm pr-10">
                    <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-stone-600 cursor-pointer">
                        <span x-show="!showPass" class="text-sm">👁️</span>
                        <span x-show="showPass" x-cloak class="text-sm">🙈</span>
                    </button>
                </div>
            </div>

            <div class="flex items-center text-xs text-gray-600">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-red-900 focus:ring-red-800">
                    <span>Remember me</span>
                </label>
            </div>

            <!-- Cloudflare Turnstile CAPTCHA (Matching Reference Image) -->
            @include('layouts.partials.turnstile-captcha')

            <button type="submit" class="w-full py-3.5 rounded-xl gold-gradient text-white font-bold text-sm shadow-md hover:opacity-95 transition cursor-pointer">
                Sign In
            </button>
        </form>

        <!-- Quick One-Click Demo Access -->
        <div class="mt-8 pt-6 border-t border-dashed border-gray-200">
            <h3 class="text-xs font-bold uppercase tracking-wider text-amber-900 mb-3 text-center">⚡ Instant Quick-Test Evaluation</h3>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="p-2.5 rounded-xl border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    👨‍⚕️ <strong>Dr. Arun</strong> (Groom)
                </a>
                <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="p-2.5 rounded-xl border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    👩‍🏫 <strong>Priya</strong> (Bride)
                </a>
                <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="p-2.5 rounded-xl border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    👴 <strong>Subhash</strong> (Ghotok)
                </a>
                <a href="{{ route('demo.login', ['email' => 'pandit@vivahconnect.com']) }}" class="p-2.5 rounded-xl border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    🕉️ <strong>Pandit Kalyan</strong> (Acharya)
                </a>
                <a href="{{ route('demo.login', ['email' => 'admin@vivahconnect.com']) }}" class="col-span-2 p-2 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-center font-medium text-red-950 transition">
                    🛡️ <strong>Admin</strong> (KYC & Trust Operations)
                </a>
            </div>
        </div>

        <div class="mt-6 text-center text-xs text-gray-600">
            Looking to find a spouse?
            <a href="{{ route('register') }}" class="font-bold text-emerald-800 hover:text-red-900 hover:underline">Create a new profile</a>
        </div>
    </div>
</div>
@endsection

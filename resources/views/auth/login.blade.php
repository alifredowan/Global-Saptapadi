@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto my-10 card-ledger p-0 overflow-hidden bg-[var(--bg-surface)] border border-[var(--border-default)]">
    
    <!-- Header with Alpona Accent & Warm Ink -->
    <div class="p-8 text-center bg-[var(--bg-subtle)] border-b border-[var(--border-subtle)] relative">
        <img src="{{ asset('images/logo-emblem.png') }}" alt="Global Saptapadi" class="w-12 h-12 mx-auto mb-3 rounded-[var(--radius-sm)] object-cover border border-[var(--border-default)]">
        <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">Welcome back</h1>
        <p class="text-xs text-[var(--text-secondary)] mt-1.5 leading-relaxed max-w-xs mx-auto">
            Sign in to review candidates, manage family proposals, and read private messages.
        </p>
    </div>

    <div class="p-6 sm:p-8 space-y-5">
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                    Email address
                </label>
                <input type="email" name="email" value="{{ old('email', 'arun@example.com') }}" required 
                    placeholder="your.email@domain.com"
                    class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)] font-medium">
            </div>

            <div x-data="{ showPass: false }">
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider">
                        Password
                    </label>
                    <a href="#" class="text-xs text-[var(--accent-primary)] hover:underline font-medium">
                        Forgot password?
                    </a>
                </div>
                <div class="relative">
                    <input :type="showPass ? 'text' : 'password'" name="password" value="password123" required 
                        placeholder="••••••••"
                        class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)] pr-10">
                    <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[var(--text-muted)] hover:text-[var(--text-primary)] cursor-pointer" title="Toggle password view">
                        <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        <svg x-show="showPass" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center text-xs text-[var(--text-secondary)]">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                    <span>Remember my sign-in on this device</span>
                </label>
            </div>

            <!-- Turnstile Verification -->
            @include('layouts.partials.turnstile-captcha')

            <button type="submit" class="btn-primary w-full !h-[48px] !min-h-[48px] !text-[15px] font-semibold">
                Sign In to Account
            </button>
        </form>

        <!-- Quick Demo Switcher (Discreet & Dignified) -->
        <div class="pt-4 border-t border-[var(--border-subtle)] space-y-2">
            <span class="text-[10px] font-semibold uppercase tracking-wider text-[var(--text-muted)] block text-center">
                Quick test accounts for evaluation
            </span>
            <div class="grid grid-cols-2 gap-1.5 text-xs">
                <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:border-[var(--border-strong)] text-center text-[var(--text-primary)] font-medium transition">
                    Dr. Arun (Groom)
                </a>
                <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:border-[var(--border-strong)] text-center text-[var(--text-primary)] font-medium transition">
                    Priya (Bride)
                </a>
                <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:border-[var(--border-strong)] text-center text-[var(--text-primary)] font-medium transition">
                    Subhash (Father)
                </a>
                <a href="{{ route('demo.login', ['email' => 'pandit@globalsaptapadi.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:border-[var(--border-strong)] text-center text-[var(--text-primary)] font-medium transition">
                    Pandit Kalyan
                </a>
            </div>
        </div>

        <div class="pt-2 text-center text-xs text-[var(--text-muted)] border-t border-[var(--border-subtle)]">
            Looking for a life partner?
            <a href="{{ route('register') }}" class="font-semibold text-[var(--accent-primary)] hover:underline ml-1">Create a profile</a>
        </div>
    </div>
</div>
@endsection

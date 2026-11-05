@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto my-12 card-ledger p-0 overflow-hidden rounded-[var(--radius-md)] border border-[var(--border-default)]">
    <!-- Header with Refined Theme Bar -->
    <div class="p-8 text-center bg-[var(--bg-subtle)] border-b border-[var(--border-subtle)]">
        <div class="w-12 h-12 mx-auto mb-3 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-border)] flex items-center justify-center text-sm font-bold text-[var(--accent-primary)] font-heading">
            VC
        </div>
        <h2 class="font-heading font-bold text-2xl text-[var(--text-primary)]">Welcome Back</h2>
        <p class="text-xs text-[var(--text-secondary)] mt-1 leading-relaxed">
            Sign in to review matches, proposals, and chaperoned messages.
        </p>
    </div>

    <div class="p-6 sm:p-8 bg-[var(--bg-surface)]">
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                    Email Address
                </label>
                <input type="email" name="email" value="{{ old('email', 'arun@example.com') }}" required 
                    placeholder="your.email@domain.com"
                    class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:ring-1 focus:ring-[var(--accent-primary)] text-xs text-[var(--text-primary)]">
            </div>

            <div x-data="{ showPass: false }">
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider">
                        Password
                    </label>
                    <a href="#" class="text-xs text-[var(--accent-primary)] hover:underline font-semibold">
                        Forgot password?
                    </a>
                </div>
                <div class="relative">
                    <input :type="showPass ? 'text' : 'password'" name="password" value="password123" required 
                        placeholder="••••••••"
                        class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:ring-1 focus:ring-[var(--accent-primary)] text-xs text-[var(--text-primary)] pr-10">
                    <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[var(--text-muted)] hover:text-[var(--text-primary)] cursor-pointer">
                        <span x-show="!showPass" class="text-xs">👁️</span>
                        <span x-show="showPass" x-cloak class="text-xs">🙈</span>
                    </button>
                </div>
            </div>

            <div class="flex items-center text-xs text-[var(--text-secondary)]">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                    <span>Remember me</span>
                </label>
            </div>

            <!-- Cloudflare Turnstile CAPTCHA (Matching Reference Image) -->
            @include('layouts.partials.turnstile-captcha')

            <button type="submit" class="btn-primary w-full text-xs font-bold !py-3">
                Sign In
            </button>
        </form>

        <!-- Quick One-Click Demo Access -->
        <div class="mt-6 pt-5 border-t border-[var(--border-subtle)]">
            <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text-muted)] mb-3 text-center">⚡ Instant Quick-Test Evaluation</h3>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:bg-[var(--bg-canvas)] text-center font-medium text-[var(--text-primary)] transition">
                    <strong>Dr. Arun</strong> (Groom)
                </a>
                <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:bg-[var(--bg-canvas)] text-center font-medium text-[var(--text-primary)] transition">
                    <strong>Priya</strong> (Bride)
                </a>
                <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:bg-[var(--bg-canvas)] text-center font-medium text-[var(--text-primary)] transition">
                    <strong>Subhash</strong> (Ghotok)
                </a>
                <a href="{{ route('demo.login', ['email' => 'pandit@vivahconnect.com']) }}" class="p-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-subtle)] hover:bg-[var(--bg-canvas)] text-center font-medium text-[var(--text-primary)] transition">
                    <strong>Pandit Kalyan</strong> (Acharya)
                </a>
                <a href="{{ route('demo.login', ['email' => 'admin@vivahconnect.com']) }}" class="col-span-2 p-2 rounded-[var(--radius-sm)] border border-[var(--accent-border)] bg-[var(--accent-subtle)] text-center font-medium text-[var(--accent-text)] transition">
                    <strong>Admin</strong> (KYC & Operations)
                </a>
            </div>
        </div>

        <div class="mt-6 text-center text-xs text-[var(--text-muted)]">
            Looking to find a spouse?
            <a href="{{ route('register') }}" class="font-bold text-[var(--accent-primary)] hover:underline">Create a new profile</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto my-12 bg-white rounded-2xl shadow-xl border border-amber-200/80 overflow-hidden">
    <!-- Header with Auspicious Motif -->
    <div class="gold-gradient p-8 text-center text-amber-100">
        <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-amber-400/20 border-2 border-amber-300 flex items-center justify-center text-lg font-black font-heading">
            VC
        </div>
        <h2 class="font-heading font-bold text-2xl text-amber-100">Vivah Connect</h2>
        <p class="text-xs text-amber-200/80 mt-1 uppercase tracking-widest font-semibold">Sacred Matrimonial Union • Sign In</p>
    </div>

    <div class="p-8">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email', 'arun@example.com') }}" required 
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 focus:border-red-800 outline-none text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Password</label>
                <input type="password" name="password" value="password123" required 
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 focus:border-red-800 outline-none text-sm">
            </div>

            <div class="flex items-center justify-between text-xs text-gray-600">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-red-900 focus:ring-red-800">
                    <span>Remember my session</span>
                </label>
                <a href="#" class="text-amber-800 hover:underline">Forgot password?</a>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl gold-gradient text-white font-bold text-sm shadow-md hover:opacity-95 transition">
                Sign In to Vivah Connect
            </button>
        </form>

        <!-- Quick One-Click Demo Access -->
        <div class="mt-8 pt-6 border-t border-dashed border-gray-200">
            <h3 class="text-xs font-bold uppercase tracking-wider text-amber-900 mb-3 text-center">⚡ Instant Quick-Test Evaluation</h3>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="p-2.5 rounded-lg border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    👨‍⚕️ <strong>Dr. Arun</strong> (Groom)
                </a>
                <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="p-2.5 rounded-lg border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    👩‍🏫 <strong>Priya</strong> (Bride)
                </a>
                <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="p-2.5 rounded-lg border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    👴 <strong>Subhash</strong> (Ghotok / Family Rep)
                </a>
                <a href="{{ route('demo.login', ['email' => 'pandit@vivahconnect.com']) }}" class="p-2.5 rounded-lg border border-amber-200 bg-amber-50 hover:bg-amber-100 text-center font-medium text-amber-950 transition">
                    🕉️ <strong>Pandit Kalyan</strong> (Ghotok & Pandit)
                </a>
                <a href="{{ route('demo.login', ['email' => 'admin@vivahconnect.com']) }}" class="col-span-2 p-2 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-center font-medium text-red-950 transition">
                    🛡️ <strong>Admin</strong> (KYC & Trust Operations)
                </a>
            </div>
        </div>

        <div class="mt-6 text-center text-xs text-gray-600">
            Don't have a biodata yet?
            <a href="{{ route('register') }}" class="font-bold text-red-900 hover:underline">Register New Seeker</a>
        </div>
    </div>
</div>
@endsection


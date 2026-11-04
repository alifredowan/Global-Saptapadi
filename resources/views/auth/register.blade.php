@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto my-8 bg-white rounded-2xl shadow-xl border border-amber-200 overflow-hidden">
    <!-- Header -->
    <div class="gold-gradient p-8 text-center text-amber-100">
        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-amber-400/20 border-2 border-amber-300 flex items-center justify-center text-sm font-black font-heading">
            VC
        </div>
        <h2 class="font-heading font-bold text-2xl text-amber-100">Sacred Matrimonial Registration</h2>
        <p class="text-xs text-amber-200/80 mt-1 uppercase tracking-widest font-semibold">
            Dharmic Biodata • High Familial Trust • Anti-Dowry Enforcement
        </p>
    </div>

    <!-- Statutory Legal Notice Banner -->
    <div class="bg-amber-50 border-b border-amber-200 px-8 py-3 text-xs text-amber-950 flex items-center space-x-2">
        <span>⚖️</span>
        <span>
            <strong>Global Matrimonial Standards:</strong> Minimum legal marriage age <strong>21 for grooms</strong> and <strong>18 for brides</strong> (UN Convention on Consent to Marriage). Strict international monogamy mandate.
        </span>
    </div>

    <div class="p-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Role & Management Attribution -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Register As <span class="text-red-700">*</span>
                    </label>
                    <select name="role" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm bg-white">
                        <option value="groom" {{ old('role') == 'groom' ? 'selected' : '' }}>Groom (Seeking Bride)</option>
                        <option value="bride" {{ old('role') == 'bride' ? 'selected' : '' }}>Bride (Seeking Groom)</option>
                        <option value="family_rep" {{ old('role') == 'family_rep' ? 'selected' : '' }}>Family Representative (Guardian / Elder)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Profile Managed By <span class="text-red-700">*</span>
                    </label>
                    <select name="profile_managed_by" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm bg-white">
                        <option value="self" {{ old('profile_managed_by') == 'self' ? 'selected' : '' }}>Self (Candidate)</option>
                        <option value="father" {{ old('profile_managed_by') == 'father' ? 'selected' : '' }}>Father</option>
                        <option value="mother" {{ old('profile_managed_by') == 'mother' ? 'selected' : '' }}>Mother</option>
                        <option value="brother" {{ old('profile_managed_by') == 'brother' ? 'selected' : '' }}>Brother</option>
                        <option value="sister" {{ old('profile_managed_by') == 'sister' ? 'selected' : '' }}>Sister</option>
                        <option value="uncle" {{ old('profile_managed_by') == 'uncle' ? 'selected' : '' }}>Uncle</option>
                        <option value="aunt" {{ old('profile_managed_by') == 'aunt' ? 'selected' : '' }}>Aunt</option>
                        <option value="grandparent" {{ old('profile_managed_by') == 'grandparent' ? 'selected' : '' }}>Grandparent</option>
                        <option value="other" {{ old('profile_managed_by') == 'other' ? 'selected' : '' }}>Other Relative / Pandit</option>
                    </select>
                </div>
            </div>

            <!-- Full Name & Gender -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Candidate Full Name <span class="text-red-700">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                        placeholder="e.g. Sourav Mukherjee"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Gender <span class="text-red-700">*</span>
                    </label>
                    <select name="gender" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm bg-white">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>

            <!-- Date of Birth & Marital Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Date of Birth (DD/MM/YYYY) <span class="text-red-700">*</span>
                    </label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', '1998-05-15') }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm">
                    <p class="text-[11px] text-gray-500 mt-1">Must be ≥21 for male, ≥18 for female</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Marital Status <span class="text-red-700">*</span>
                    </label>
                    <select name="marital_status" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm bg-white">
                        <option value="never_married" {{ old('marital_status') == 'never_married' ? 'selected' : '' }}>Never Married</option>
                        <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced (Remarriage)</option>
                        <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed (Remarriage)</option>
                        <option value="annulled" {{ old('marital_status') == 'annulled' ? 'selected' : '' }}>Annulled</option>
                    </select>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Email Address <span class="text-red-700">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        placeholder="youremail@example.com"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Mobile Number (with Country Code) <span class="text-red-700">*</span>
                    </label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required 
                        placeholder="e.g. +12125550198 or +447911123456 or +919876543210"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm">
                </div>
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Password (Min 8 Characters) <span class="text-red-700">*</span>
                    </label>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Confirm Password <span class="text-red-700">*</span>
                    </label>
                    <input type="password" name="password_confirmation" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-sm">
                </div>
            </div>

            <!-- Anti-Bot & Statutory Declaration -->
            <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/80 space-y-2 text-xs text-gray-700">
                <label class="flex items-start space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="anti_bot_verified" value="1" required class="mt-0.5 rounded text-red-900 focus:ring-red-800" checked>
                    <span>
                        <strong>I solemnly affirm and declare:</strong> I am seeking a lawful Hindu / Dharmic marriage union. I understand that Vivah Connect strictly bans dowry solicitation, transnational extortion, romance fraud, and polygamy under international family conventions and Dharmic matrimonial ethics.
                    </span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl gold-gradient text-white font-bold text-base shadow-lg hover:opacity-95 transition">
                Create Sacred Biodata Account
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-gray-600">
            Already registered?
            <a href="{{ route('login') }}" class="font-bold text-red-900 hover:underline">Sign In to Account</a>
        </div>
    </div>
</div>
@endsection


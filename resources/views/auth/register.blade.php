@extends('layouts.app')

@section('content')
<div x-data="{
    step: {{ $errors->has('email') || $errors->has('phone') || $errors->has('password') || $errors->has('password_confirmation') ? 2 : ($errors->has('anti_bot_verified') ? 3 : 1) }},
    role: '{{ old('role', 'groom') }}',
    profileManagedBy: '{{ old('profile_managed_by', 'self') }}',
    gender: '{{ old('gender', 'male') }}',
    dob: '{{ old('date_of_birth', '1998-05-15') }}',
    name: '{{ old('name', '') }}',
    email: '{{ old('email', '') }}',
    phone: '{{ old('phone', '') }}',
    password: '',
    passwordConfirmation: '',
    clientError: '',

    // Auto-align role and gender when selecting who the profile is for
    onManagedByChange() {
        if (this.profileManagedBy === 'father' || this.profileManagedBy === 'mother' || this.profileManagedBy === 'brother' || this.profileManagedBy === 'sister' || this.profileManagedBy === 'uncle' || this.profileManagedBy === 'aunt' || this.profileManagedBy === 'grandparent' || this.profileManagedBy === 'other') {
            this.role = 'family_rep';
        } else {
            this.role = (this.gender === 'male') ? 'groom' : 'bride';
        }
    },

    onGenderChange() {
        if (this.profileManagedBy === 'self') {
            this.role = (this.gender === 'male') ? 'groom' : 'bride';
        }
    },

    // Calculate candidate age dynamically
    get candidateAge() {
        if (!this.dob) return null;
        const bdate = new Date(this.dob);
        if (isNaN(bdate.getTime())) return null;
        const today = new Date();
        let age = today.getFullYear() - bdate.getFullYear();
        const m = today.getMonth() - bdate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < bdate.getDate())) {
            age--;
        }
        return age;
    },

    get isAgeLegallyEligible() {
        if (this.candidateAge === null) return false;
        if (this.gender === 'male' && this.candidateAge < 21) return false;
        if (this.gender === 'female' && this.candidateAge < 18) return false;
        return true;
    },

    goToStep(target) {
        this.clientError = '';
        if (target === 2) {
            if (!this.name || !this.name.trim()) {
                this.clientError = 'Please provide the Candidate Full Name.';
                return;
            }
            if (!this.dob) {
                this.clientError = 'Please select a valid Date of Birth.';
                return;
            }
            if (!this.isAgeLegallyEligible) {
                this.clientError = this.gender === 'male'
                    ? 'Statutory minimum age for male candidates is 21 years (UN Convention on Consent to Marriage).'
                    : 'Statutory minimum age for female candidates is 18 years (UN Convention on Consent to Marriage).';
                return;
            }
        }

        if (target === 3) {
            if (!this.email || !this.email.trim() || !this.email.includes('@')) {
                this.clientError = 'Please enter a valid email address.';
                return;
            }
            if (!this.phone || !this.phone.trim()) {
                this.clientError = 'Please provide a contact phone number with country code.';
                return;
            }
            if (!this.password || this.password.length < 8) {
                this.clientError = 'Password must be at least 8 characters long.';
                return;
            }
            if (this.password !== this.passwordConfirmation) {
                this.clientError = 'Password confirmation does not match.';
                return;
            }
        }

        this.step = target;
        window.scrollTo({ top: 120, behavior: 'smooth' });
    }
}" class="max-w-2xl mx-auto my-8 bg-white rounded-3xl shadow-xl border border-amber-200 overflow-hidden">

    <!-- Header Banner -->
    <div class="gold-gradient p-8 text-center text-amber-100 relative overflow-hidden">
        <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-amber-400/20 border-2 border-amber-300 flex items-center justify-center text-sm font-black font-heading shadow-inner">
            VC
        </div>
        <h1 class="font-heading font-extrabold text-2xl text-amber-100">Sacred Matrimonial Registration</h1>
        <p class="text-xs text-amber-200/90 mt-1 uppercase tracking-widest font-semibold">
            Vedic Biodata • Chaperoned Family Trust • Zero Dowry Enforcement
        </p>

        <!-- Stepper Progress Tracker (Nikah Style) -->
        <div class="mt-6 max-w-md mx-auto">
            <div class="flex items-center justify-between text-xs font-bold text-amber-200 mb-2 px-2">
                <span :class="step >= 1 ? 'text-amber-300 font-extrabold' : 'opacity-60'">1. Candidate Biodata</span>
                <span :class="step >= 2 ? 'text-amber-300 font-extrabold' : 'opacity-60'">2. Security & Contact</span>
                <span :class="step >= 3 ? 'text-amber-300 font-extrabold' : 'opacity-60'">3. Sacred Pledge</span>
            </div>
            <div class="w-full bg-amber-950/40 rounded-full h-2 overflow-hidden border border-amber-400/30">
                <div class="bg-amber-300 h-full rounded-full transition-all duration-500 ease-out" 
                     :style="'width: ' + (step === 1 ? '33.33%' : (step === 2 ? '66.66%' : '100%'))"></div>
            </div>
        </div>
    </div>

    <!-- Statutory Legal Notice Banner -->
    <div class="bg-amber-50 border-b border-amber-200 px-6 sm:px-8 py-3 text-xs text-amber-950 flex items-center space-x-2.5">
        <span class="text-base">⚖️</span>
        <span>
            <strong>Global Matrimonial Standards:</strong> Statutory minimum marriage age <strong>21 for grooms</strong> and <strong>18 for brides</strong> (UN Convention on Consent to Marriage). Strict international monogamy mandate.
        </span>
    </div>

    <!-- Error Alerts -->
    @if($errors->any())
    <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 text-xs space-y-1">
        <div class="flex items-center space-x-2 font-bold text-red-950">
            <span>⚠️</span>
            <span>Please correct the errors below to continue:</span>
        </div>
        <ul class="list-disc pl-5 space-y-0.5 text-red-800">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Client-side Validation Error -->
    <div x-show="clientError" x-cloak class="mx-6 sm:mx-8 mt-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 text-xs flex items-center space-x-2">
        <span>⚠️</span>
        <span x-text="clientError" class="font-semibold"></span>
    </div>

    <div class="p-6 sm:p-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- ========================================================= -->
            <!-- STEP 1: CANDIDATE BIODATA & INTENT                        -->
            <!-- ========================================================= -->
            <div x-show="step === 1" class="space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-stone-200">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 block">Step 1 of 3</span>
                        <h2 class="font-heading font-bold text-lg text-stone-900">Candidate Identity & Intent</h2>
                    </div>
                    <span class="text-xs text-stone-500 font-medium">Basic biodata profile</span>
                </div>

                <!-- Profile Managed By & Register As -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Creating Profile For <span class="text-red-700">*</span>
                        </label>
                        <select name="profile_managed_by" x-model="profileManagedBy" @change="onManagedByChange()" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs bg-white">
                            <option value="self">Self (I am the seeker)</option>
                            <option value="father">Father (Creating for Son/Daughter)</option>
                            <option value="mother">Mother (Creating for Son/Daughter)</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                            <option value="uncle">Uncle (Family Elder)</option>
                            <option value="aunt">Aunt (Family Elder)</option>
                            <option value="grandparent">Grandparent</option>
                            <option value="other">Ghotok / Trusted Matchmaker</option>
                        </select>
                        <p class="text-[11px] text-stone-400 mt-1">High familial trust & chaperone representation</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Register As <span class="text-red-700">*</span>
                        </label>
                        <select name="role" x-model="role" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs bg-white">
                            <option value="groom">Groom (Seeking Bride)</option>
                            <option value="bride">Bride (Seeking Groom)</option>
                            <option value="family_rep">Family Representative (Guardian / Elder)</option>
                        </select>
                        <p class="text-[11px] text-stone-400 mt-1">Determines your personalized portal view</p>
                    </div>
                </div>

                <!-- Candidate Full Name & Gender -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Candidate Full Name <span class="text-red-700">*</span>
                        </label>
                        <input type="text" name="name" x-model="name" value="{{ old('name') }}" required 
                            placeholder="e.g. Sourav Mukherjee"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Gender <span class="text-red-700">*</span>
                        </label>
                        <select name="gender" x-model="gender" @change="onGenderChange()" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs bg-white">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <!-- Date of Birth & Live Age Validation -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Date of Birth (DD/MM/YYYY) <span class="text-red-700">*</span>
                        </label>
                        <input type="date" name="date_of_birth" x-model="dob" value="{{ old('date_of_birth', '1998-05-15') }}" required 
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs">
                        
                        <!-- Live Dynamic Age Pill -->
                        <div class="mt-1.5" x-show="candidateAge !== null">
                            <template x-if="isAgeLegallyEligible">
                                <span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-800 text-[11px] font-semibold border border-emerald-200">
                                    <span>✓</span>
                                    <span>Age: <strong x-text="candidateAge"></strong> years (Eligible for Marriage)</span>
                                </span>
                            </template>
                            <template x-if="!isAgeLegallyEligible">
                                <span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-md bg-red-50 text-red-800 text-[11px] font-semibold border border-red-200">
                                    <span>⚠️</span>
                                    <span>Underage: <strong x-text="candidateAge"></strong> years. Minimum: <span x-text="gender === 'male' ? '21 for Grooms' : '18 for Brides'"></span></span>
                                </span>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Marital Status <span class="text-red-700">*</span>
                        </label>
                        <select name="marital_status" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs bg-white">
                            <option value="never_married" {{ old('marital_status') == 'never_married' ? 'selected' : '' }}>Never Married</option>
                            <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced (Remarriage)</option>
                            <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed (Remarriage)</option>
                            <option value="annulled" {{ old('marital_status') == 'annulled' ? 'selected' : '' }}>Annulled</option>
                        </select>
                        <p class="text-[11px] text-stone-400 mt-1">Dignified second marriage support included</p>
                    </div>
                </div>

                <!-- Next Button -->
                <div class="pt-4 flex justify-end">
                    <button type="button" @click="goToStep(2)" class="px-6 py-3 rounded-xl gold-gradient text-white font-bold text-xs shadow-md hover:opacity-95 transition flex items-center space-x-1.5 cursor-pointer">
                        <span>Continue to Security & Contact</span>
                        <span>→</span>
                    </button>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- STEP 2: ACCOUNT SECURITY & CONTACT CREDENTIALS            -->
            <!-- ========================================================= -->
            <div x-show="step === 2" x-cloak class="space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-stone-200">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 block">Step 2 of 3</span>
                        <h2 class="font-heading font-bold text-lg text-stone-900">Contact Details & Account Security</h2>
                    </div>
                    <span class="text-xs text-stone-500 font-medium">Confidential credentials</span>
                </div>

                <!-- Email & Phone with International Standards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Email Address <span class="text-red-700">*</span>
                        </label>
                        <input type="email" name="email" x-model="email" value="{{ old('email') }}" required 
                            placeholder="youremail@example.com"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs">
                        <p class="text-[11px] text-stone-400 mt-1">Used for private login and proposal alerts</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Mobile Number (with Country Code) <span class="text-red-700">*</span>
                        </label>
                        <input type="text" name="phone" x-model="phone" value="{{ old('phone') }}" required 
                            placeholder="e.g. +12125550198 or +447911123456 or +919876543210"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs">
                        <p class="text-[11px] text-stone-400 mt-1">Kept 100% masked until mutual family acceptance</p>
                    </div>
                </div>

                <!-- Password & Confirm Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Create Password (Min 8 Characters) <span class="text-red-700">*</span>
                        </label>
                        <input type="password" name="password" x-model="password" required 
                            placeholder="••••••••"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Confirm Password <span class="text-red-700">*</span>
                        </label>
                        <input type="password" name="password_confirmation" x-model="passwordConfirmation" required 
                            placeholder="••••••••"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-800 outline-none text-xs">
                        
                        <!-- Live Password Match Indicator -->
                        <div class="mt-1" x-show="password.length > 0 && passwordConfirmation.length > 0">
                            <span x-show="password === passwordConfirmation" class="text-[11px] text-emerald-700 font-semibold flex items-center space-x-1">
                                <span>✓</span>
                                <span>Passwords match</span>
                            </span>
                            <span x-show="password !== passwordConfirmation" class="text-[11px] text-red-700 font-semibold flex items-center space-x-1">
                                <span>⚠️</span>
                                <span>Passwords do not match yet</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Step Navigation Controls -->
                <div class="pt-4 flex items-center justify-between border-t border-stone-100">
                    <button type="button" @click="step = 1" class="px-4 py-2.5 rounded-xl border border-stone-300 text-stone-700 font-bold text-xs hover:bg-stone-50 transition cursor-pointer">
                        ← Back to Step 1
                    </button>
                    <button type="button" @click="goToStep(3)" class="px-6 py-3 rounded-xl gold-gradient text-white font-bold text-xs shadow-md hover:opacity-95 transition flex items-center space-x-1.5 cursor-pointer">
                        <span>Continue to Sacred Pledge</span>
                        <span>→</span>
                    </button>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- STEP 3: SACRED VOWS & ANTI-DOWRY AFFIRMATION             -->
            <!-- ========================================================= -->
            <div x-show="step === 3" x-cloak class="space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-stone-200">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 block">Step 3 of 3</span>
                        <h2 class="font-heading font-bold text-lg text-stone-900">Sacred Vows & Legal Code of Conduct</h2>
                    </div>
                    <span class="text-xs text-stone-500 font-medium">Solemn declarations</span>
                </div>

                <!-- Dharmic Ethical Commitments Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-3.5 rounded-2xl bg-amber-50/80 border border-amber-200 text-xs space-y-1">
                        <div class="text-amber-900 font-bold flex items-center space-x-1.5">
                            <span>🚫</span>
                            <span>Zero Dowry</span>
                        </div>
                        <p class="text-[11px] text-stone-600">Strictly banned under UN CEDAW and Dharmic marriage codes.</p>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-amber-50/80 border border-amber-200 text-xs space-y-1">
                        <div class="text-amber-900 font-bold flex items-center space-x-1.5">
                            <span>💍</span>
                            <span>Strict Monogamy</span>
                        </div>
                        <p class="text-[11px] text-stone-600">Bigamy and polygamy are barred under international family law.</p>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-amber-50/80 border border-amber-200 text-xs space-y-1">
                        <div class="text-amber-900 font-bold flex items-center space-x-1.5">
                            <span>🛡️</span>
                            <span>Modesty Shield</span>
                        </div>
                        <p class="text-[11px] text-stone-600">Candidate photos and contact numbers are protected with privacy veils.</p>
                    </div>
                </div>

                <!-- Solemn Affirmation Declaration Checkbox -->
                <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-300 space-y-2 text-xs text-stone-800">
                    <label class="flex items-start space-x-3 cursor-pointer">
                        <input type="checkbox" name="anti_bot_verified" value="1" required class="mt-0.5 rounded text-red-900 focus:ring-red-800 w-4 h-4 cursor-pointer" checked>
                        <span class="text-[11px] leading-relaxed">
                            <strong>I solemnly affirm and declare:</strong> I am seeking a lawful, authentic Hindu / Dharmic matrimonial union. I understand and agree that Vivah Connect strictly prohibits dowry demands, transnational matrimonial fraud, deceitful profiles, and polygamy. I declare all submitted candidate particulars to be genuine.
                        </span>
                    </label>
                </div>

                <!-- Step Navigation Controls -->
                <div class="pt-4 flex items-center justify-between border-t border-stone-100">
                    <button type="button" @click="step = 2" class="px-4 py-2.5 rounded-xl border border-stone-300 text-stone-700 font-bold text-xs hover:bg-stone-50 transition cursor-pointer">
                        ← Back to Step 2
                    </button>
                    <button type="submit" class="px-7 py-3.5 rounded-xl gold-gradient text-white font-bold text-sm shadow-lg hover:opacity-95 transition flex items-center space-x-2 cursor-pointer">
                        <span>✨</span>
                        <span>Complete Registration & Build Biodata</span>
                    </button>
                </div>
            </div>

        </form>

        <div class="mt-6 pt-4 border-t border-stone-100 text-center text-xs text-gray-600">
            Already registered?
            <a href="{{ route('login') }}" class="font-bold text-red-900 hover:underline">Sign In to Account</a>
        </div>
    </div>
</div>
@endsection

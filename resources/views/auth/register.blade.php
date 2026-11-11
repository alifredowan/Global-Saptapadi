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

    onManagedByChange() {
        if (['father', 'mother', 'brother', 'sister', 'uncle', 'aunt', 'grandparent', 'other'].includes(this.profileManagedBy)) {
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
                this.clientError = 'Please provide the candidate full name.';
                return;
            }
            if (!this.dob) {
                this.clientError = 'Please select a valid date of birth.';
                return;
            }
            if (!this.isAgeLegallyEligible) {
                this.clientError = this.gender === 'male'
                    ? 'Statutory minimum age for male candidates is 21 years.'
                    : 'Statutory minimum age for female candidates is 18 years.';
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
}" class="max-w-2xl mx-auto my-8 card-ledger p-0 overflow-hidden bg-[var(--bg-surface)] border border-[var(--border-default)]">

    <!-- Header Banner -->
    <div class="p-6 sm:p-8 text-center bg-[var(--bg-subtle)] border-b border-[var(--border-subtle)] relative overflow-hidden">
        <img src="{{ asset('images/logo-emblem.png') }}" alt="Global Saptapadi" class="w-12 h-12 mx-auto mb-3 rounded-[var(--radius-sm)] object-cover border border-[var(--border-default)]">
        <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">Create Free Candidate Profile</h1>
        <p class="text-xs text-[var(--text-secondary)] mt-1 max-w-sm mx-auto">
            Seven steps. One lifetime. Join with dignity and family peace of mind.
        </p>

        <!-- Saptapadi 3-Stage Progress Tracker -->
        <div class="mt-5 max-w-md mx-auto">
            <div class="flex items-center justify-between text-xs font-semibold text-[var(--text-secondary)] mb-2 px-1">
                <span :class="step >= 1 ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-muted)]'">1. Candidate</span>
                <span :class="step >= 2 ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-muted)]'">2. Contact</span>
                <span :class="step >= 3 ? 'text-[var(--accent-primary)] font-bold' : 'text-[var(--text-muted)]'">3. Pledge</span>
            </div>
            <div class="w-full bg-[var(--border-default)] rounded-full h-1.5 overflow-hidden">
                <div class="bg-[var(--accent-primary)] h-full rounded-full transition-all duration-300 ease-out" 
                     :style="'width: ' + (step === 1 ? '33.33%' : (step === 2 ? '66.66%' : '100%'))"></div>
            </div>
        </div>
    </div>

    <!-- Statutory Notice (Quiet Trust Signal) -->
    <div class="bg-[var(--secondary-subtle)] border-b border-[var(--secondary-border)] px-6 py-2.5 text-xs text-[var(--secondary-text)] flex items-center gap-2">
        <svg class="w-4 h-4 shrink-0 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5"/></svg>
        <span>
            Minimum age: <strong>21 for grooms</strong>, <strong>18 for brides</strong>. Strict anti-dowry policy.
        </span>
    </div>

    <!-- Error Alerts -->
    @if($errors->any())
    <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] text-[var(--color-danger)] text-xs space-y-1">
        <div class="font-semibold">Please review the following requirements:</div>
        <ul class="list-disc pl-5 space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Client-side Validation Error -->
    <div x-show="clientError" x-cloak class="mx-6 sm:mx-8 mt-6 p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] text-[var(--color-danger)] text-xs flex items-center space-x-2 font-medium">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span x-text="clientError"></span>
    </div>

    <div class="p-6 sm:p-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- ========================================================= -->
            <!-- STEP 1: CANDIDATE IDENTITY & FAMILY ROLE                  -->
            <!-- ========================================================= -->
            <div x-show="step === 1" class="space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 1 of 3</span>
                        <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">Candidate Identity</h2>
                    </div>
                    <span class="text-xs text-[var(--text-muted)] font-medium">Basic biodata setup</span>
                </div>

                <!-- Profile Managed By & Register As -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Creating profile for <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <select name="profile_managed_by" x-model="profileManagedBy" @change="onManagedByChange()" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)] font-medium">
                            <option value="self">Self (I am the candidate)</option>
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                            <option value="uncle">Uncle (Family Elder)</option>
                            <option value="aunt">Aunt (Family Elder)</option>
                            <option value="grandparent">Grandparent</option>
                            <option value="other">Trusted Family Matchmaker</option>
                        </select>
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">Parents and family members can join free</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Register as <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <select name="role" x-model="role" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)] font-medium">
                            <option value="groom">Groom (Seeking Bride)</option>
                            <option value="bride">Bride (Seeking Groom)</option>
                            <option value="family_rep">Family Representative (Guardian / Elder)</option>
                        </select>
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">Sets your portal and dashboard view</p>
                    </div>
                </div>

                <!-- Candidate Full Name & Gender -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Candidate full name <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <input type="text" name="name" x-model="name" value="{{ old('name') }}" required 
                            placeholder="e.g. Aarav Sharma or Ananya Iyer"
                            class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)] font-medium">
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">As stated on government photo ID</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Candidate gender <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <select name="gender" x-model="gender" @change="onGenderChange()" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)] font-medium">
                            <option value="male">Male (Groom / Var)</option>
                            <option value="female">Female (Bride / Kanya)</option>
                        </select>
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">Opposite-gender matching is maintained</p>
                    </div>
                </div>

                <!-- Date of Birth & Live Age Calculation -->
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                        Candidate date of birth <span class="text-[var(--color-danger)]">*</span>
                    </label>
                    <input type="date" name="date_of_birth" x-model="dob" value="{{ old('date_of_birth', '1998-05-15') }}" required 
                        max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                        class="w-full sm:w-1/2 px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)] font-medium">

                    <!-- Live Age Feedback -->
                    <div class="mt-2 text-xs">
                        <template x-if="candidateAge !== null">
                            <span :class="isAgeLegallyEligible ? 'text-[var(--color-success)] font-semibold' : 'text-[var(--color-danger)] font-semibold'">
                                Age: <span x-text="candidateAge"></span> years old
                                <span x-show="!isAgeLegallyEligible">
                                    (Minimum age is 21 for grooms and 18 for brides)
                                </span>
                            </span>
                        </template>
                    </div>
                </div>

                <!-- Step Navigation Controls -->
                <div class="pt-4 flex items-center justify-end border-t border-[var(--border-subtle)]">
                    <button type="button" @click="goToStep(2)" class="btn-primary !h-[48px] !px-6 !text-[15px] font-semibold cursor-pointer">
                        <span>Continue to Contact &amp; Security</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- STEP 2: CONTACT & SECURITY CREDENTIALS                    -->
            <!-- ========================================================= -->
            <div x-show="step === 2" x-cloak class="space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 2 of 3</span>
                        <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">Contact &amp; Account Security</h2>
                    </div>
                    <span class="text-xs text-[var(--text-muted)] font-medium">Kept private by default</span>
                </div>

                <!-- Email & Mobile -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Email address <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <input type="email" name="email" x-model="email" value="{{ old('email') }}" required 
                            placeholder="youremail@example.com"
                            class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)]">
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">Used for private account sign-in</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Mobile with country dial code <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <input type="text" name="phone" x-model="phone" value="{{ old('phone') }}" required 
                            placeholder="e.g. +1 415 555 0192 or +44 20 7946 0912 or +91 98765 43210"
                            class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)]">
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">Phone numbers stay private until both families approve</p>
                    </div>
                </div>

                <!-- Password & Confirm Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Password (minimum 8 characters) <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <input type="password" name="password" x-model="password" required 
                            placeholder="••••••••"
                            class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)]">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">
                            Confirm password <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <input type="password" name="password_confirmation" x-model="passwordConfirmation" required 
                            placeholder="••••••••"
                            class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:outline-none focus:border-[var(--accent-primary)] text-xs text-[var(--text-primary)]">
                        
                        <div class="mt-1" x-show="password.length > 0 && passwordConfirmation.length > 0">
                            <span x-show="password === passwordConfirmation" class="text-[11px] text-[var(--color-success)] font-medium flex items-center space-x-1">
                                <span>✓ Passwords match</span>
                            </span>
                            <span x-show="password !== passwordConfirmation" class="text-[11px] text-[var(--color-danger)] font-medium flex items-center space-x-1">
                                <span>Passwords do not match yet</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Step Navigation Controls -->
                <div class="pt-4 flex items-center justify-between border-t border-[var(--border-subtle)]">
                    <button type="button" @click="step = 1" class="btn-secondary !h-[48px] !px-5 !text-[15px] font-semibold cursor-pointer">
                        &larr; Back
                    </button>
                    <button type="button" @click="goToStep(3)" class="btn-primary !h-[48px] !px-6 !text-[15px] font-semibold cursor-pointer">
                        <span>Continue to Sacred Pledge</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                    </button>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- STEP 3: SACRED VOWS & ZERO DOWRY PLEDGE                   -->
            <!-- ========================================================= -->
            <div x-show="step === 3" x-cloak class="space-y-5">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 3 of 3</span>
                        <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">Sacred Vows &amp; Ethical Pledge</h2>
                    </div>
                    <span class="text-xs text-[var(--text-muted)] font-medium">Solemn affirmation</span>
                </div>

                <!-- Ethical Commitments Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-xs space-y-1">
                        <div class="text-[var(--accent-primary)] font-bold flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                            <span>Zero Dowry</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)] leading-relaxed">Zero dowry tolerance under civil law and Dharmic ethics.</p>
                    </div>

                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-xs space-y-1">
                        <div class="text-[var(--accent-primary)] font-bold flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/></svg>
                            <span>Lifelong Union</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)] leading-relaxed">Dedicated exclusively to authentic matrimonial seekers.</p>
                    </div>

                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-xs space-y-1">
                        <div class="text-[var(--accent-primary)] font-bold flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                            <span>Photo Privacy</span>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)] leading-relaxed">Portraits can remain veiled until mutual family acceptance.</p>
                    </div>
                </div>

                <!-- Solemn Affirmation Declaration Checkbox -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-border)] space-y-2 text-xs text-[var(--text-primary)]">
                    <label class="flex items-start space-x-3 cursor-pointer">
                        <input type="checkbox" name="anti_bot_verified" value="1" required class="mt-0.5 rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)] w-4 h-4 cursor-pointer" checked>
                        <span class="text-[11px] leading-relaxed">
                            <strong>I solemnly declare:</strong> I am registering to pursue an authentic Hindu marriage. I confirm that all submitted candidate particulars are truthful and accurate.
                        </span>
                    </label>
                </div>

                <!-- Cloudflare Turnstile CAPTCHA -->
                @include('layouts.partials.turnstile-captcha')

                <!-- Step Navigation Controls -->
                <div class="pt-4 flex items-center justify-between border-t border-[var(--border-subtle)]">
                    <button type="button" @click="step = 2" class="btn-secondary !h-[48px] !px-5 !text-[15px] font-semibold cursor-pointer">
                        &larr; Back
                    </button>
                    <button type="submit" class="btn-primary !h-[48px] !px-6 !text-[15px] font-semibold cursor-pointer">
                        <span>Complete Registration</span>
                    </button>
                </div>
            </div>

        </form>

        <div class="mt-6 pt-4 border-t border-[var(--border-subtle)] text-center text-xs text-[var(--text-muted)]">
            Already registered?
            <a href="{{ route('login') }}" class="font-semibold text-[var(--accent-primary)] hover:underline ml-1">Sign In to Account</a>
        </div>
    </div>
</div>
@endsection

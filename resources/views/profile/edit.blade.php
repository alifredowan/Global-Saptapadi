@extends('layouts.app')

@section('content')
<div x-data="{ 
    activeTab: (new URLSearchParams(window.location.search)).get('tab') || 'basic',
    tabs: ['basic', 'education', 'religion', 'lifestyle', 'family', 'photos', 'narrative'],
    nextTab() {
        const idx = this.tabs.indexOf(this.activeTab);
        if (idx < this.tabs.length - 1) {
            this.activeTab = this.tabs[idx + 1];
            window.scrollTo({ top: 100, behavior: 'smooth' });
        }
    },
    prevTab() {
        const idx = this.tabs.indexOf(this.activeTab);
        if (idx > 0) {
            this.activeTab = this.tabs[idx - 1];
            window.scrollTo({ top: 100, behavior: 'smooth' });
        }
    }
}" class="max-w-4xl mx-auto space-y-6">

    <!-- Top Header & Completeness Progress Bar -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-3 border-b border-[var(--border-subtle)]">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[11px] font-bold text-[var(--accent-primary)] uppercase tracking-wider mb-1">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/></svg>
                    <span>Sacred Matrimonial Biodata Builder</span>
                </div>
                <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">
                    Create &amp; Polish Your Sacred Profile
                </h1>
                <p class="text-xs text-[var(--text-secondary)]">
                    A comprehensive, multi-step profile builder honoring Vedic lineage, personal modesty, and family values.
                </p>
            </div>
            
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('profile.show') }}" class="btn-secondary text-xs flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>Preview Live Biodata</span>
                </a>
            </div>
        </div>

        <!-- Profile Completeness Progress Tracker -->
        @php
            $completeness = $profile->profile_completeness_pct ?? 60;
        @endphp
        <div class="space-y-1.5">
            <div class="flex items-center justify-between text-xs">
                <span class="font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                    <span>Biodata Completeness:</span>
                    <strong class="text-[var(--accent-primary)] font-bold">{{ $completeness }}%</strong>
                </span>
                <span class="text-[11px] text-[var(--text-muted)]">
                    {{ $completeness >= 80 ? 'Excellent Profile Strength' : 'Complete all 7 steps for maximum compatibility' }}
                </span>
            </div>
            <div class="w-full bg-[var(--border-default)] rounded-full h-2 overflow-hidden">
                <div class="bg-[var(--accent-primary)] h-full rounded-full transition-all duration-300" style="width: {{ $completeness }}%"></div>
            </div>
        </div>

        <!-- Multi-Step Interactive Navigation Tabs -->
        <div class="pt-2 flex items-center gap-1.5 overflow-x-auto pb-1 no-scrollbar text-xs font-semibold">
            <button type="button" @click="activeTab = 'basic'"
                    :class="activeTab === 'basic' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>1. Basic & Physical</span>
            </button>

            <button type="button" @click="activeTab = 'education'"
                    :class="activeTab === 'education' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>2. Education & Job</span>
            </button>

            <button type="button" @click="activeTab = 'religion'"
                    :class="activeTab === 'religion' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>3. Gotra & Heritage</span>
            </button>

            <button type="button" @click="activeTab = 'lifestyle'"
                    :class="activeTab === 'lifestyle' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>4. Lifestyle & Sanskar</span>
            </button>

            <button type="button" @click="activeTab = 'family'"
                    :class="activeTab === 'family' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>5. Family Roots</span>
            </button>

            <button type="button" @click="activeTab = 'photos'"
                    :class="activeTab === 'photos' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>6. Photos & Modesty</span>
            </button>

            <button type="button" @click="activeTab = 'narrative'"
                    :class="activeTab === 'narrative' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>7. Bio & Preferences</span>
            </button>
        </div>
    </div>

    <!-- Main Multi-Step Biodata Form -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- STEP 1: BASIC & PHYSICAL ATTRIBUTES -->
        <div x-show="activeTab === 'basic'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Step 1 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Basic Details, Physical Attributes &amp; Location
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <!-- Height -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Height (cm)</label>
                    <input type="number" name="height_cm" value="{{ old('height_cm', $profile->height_cm) }}" placeholder="e.g. 175" min="120" max="230" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                    <p class="text-[10px] text-[var(--text-muted)] mt-1">Approx {{ $profile->height_cm ? round($profile->height_cm / 30.48, 1) . ' ft' : '5.8 ft' }}</p>
                </div>

                <!-- Weight -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Weight (kg)</label>
                    <input type="number" name="weight_kg" value="{{ old('weight_kg', $profile->weight_kg) }}" placeholder="e.g. 68" min="35" max="200" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Complexion -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Complexion</label>
                    <select name="complexion" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="">Select Complexion</option>
                        <option value="Very Fair" {{ old('complexion', $profile->complexion) == 'Very Fair' ? 'selected' : '' }}>Very Fair</option>
                        <option value="Fair" {{ old('complexion', $profile->complexion) == 'Fair' ? 'selected' : '' }}>Fair</option>
                        <option value="Wheatish" {{ old('complexion', $profile->complexion) == 'Wheatish' ? 'selected' : '' }}>Wheatish</option>
                        <option value="Dusky" {{ old('complexion', $profile->complexion) == 'Dusky' ? 'selected' : '' }}>Dusky</option>
                    </select>
                </div>

                <!-- Country -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Country of Residence</label>
                    <input type="text" name="country" value="{{ old('country', $profile->country ?? 'United States') }}" placeholder="e.g. United States, Canada, India" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Citizenship -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Citizenship</label>
                    <input type="text" name="citizenship" value="{{ old('citizenship', $profile->citizenship ?? 'United States') }}" placeholder="e.g. United States, Canadian" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Mother Tongue -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Mother Tongue</label>
                    <input type="text" name="mother_tongue" value="{{ old('mother_tongue', $profile->mother_tongue ?? 'Bengali') }}" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- City -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">City / Residential Area</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" placeholder="e.g. New York, London, Toronto" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Marital Status -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Marital Status (Strict Monogamy)</label>
                    <select name="marital_status" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="never_married" {{ old('marital_status', $user->marital_status) == 'never_married' ? 'selected' : '' }}>Never Married</option>
                        <option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced (Remarriage)</option>
                        <option value="widowed" {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed (Remarriage)</option>
                        <option value="annulled" {{ old('marital_status', $user->marital_status) == 'annulled' ? 'selected' : '' }}>Annulled</option>
                    </select>
                </div>

                <!-- Dependent Children -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Dependent Children</label>
                    <input type="number" name="dependent_children" value="{{ old('dependent_children', $profile->dependent_children ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <!-- Step Action Buttons -->
            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <span></span>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs">
                        Save Changes
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs">
                        Next: Education &amp; Job &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 2: EDUCATION & PROFESSION -->
        <div x-show="activeTab === 'education'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Step 2 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Education, Career &amp; Financial Profile
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Highest Qualification</label>
                    <input type="text" name="qualification_level" value="{{ old('qualification_level', $profile->qualification_level) }}" placeholder="e.g. MS, MBA, B.Tech" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Profession / Designation</label>
                    <input type="text" name="profession" value="{{ old('profession', $profile->profession) }}" placeholder="e.g. Software Architect" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Organization Type</label>
                    <select name="organization_type" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="">Select Organization</option>
                        <option value="Private Corporation" {{ old('organization_type', $profile->organization_type) == 'Private Corporation' ? 'selected' : '' }}>Private Corporation</option>
                        <option value="Public / Government Sector" {{ old('organization_type', $profile->organization_type) == 'Public / Government Sector' ? 'selected' : '' }}>Public / Government Sector</option>
                        <option value="Healthcare / Hospital" {{ old('organization_type', $profile->organization_type) == 'Healthcare / Hospital' ? 'selected' : '' }}>Healthcare / Hospital</option>
                        <option value="Business / Entrepreneur" {{ old('organization_type', $profile->organization_type) == 'Business / Entrepreneur' ? 'selected' : '' }}>Business / Entrepreneur</option>
                        <option value="Academia / Research" {{ old('organization_type', $profile->organization_type) == 'Academia / Research' ? 'selected' : '' }}>Academia / Research</option>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Annual Gross Income Range (USD / $)</label>
                    <input type="text" name="annual_income_range" value="{{ old('annual_income_range', $profile->annual_income_range) }}" placeholder="e.g. $60,000 - $85,000 USD / year" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Education &amp; Career Achievements Narrative</label>
                <textarea name="education_detail" rows="3" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none" placeholder="Degrees obtained, universities attended, professional milestones...">{{ old('education_detail', $profile->education_detail) }}</textarea>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs">
                    &larr; Back: Basic Details
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs">
                        Save Changes
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs">
                        Next: Gotra &amp; Lineage &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 3: RELIGION, SAMPRADAYA & GOTRA LINEAGE -->
        <div x-show="activeTab === 'religion'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Step 3 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Spiritual Tradition, Sampradaya &amp; Ancestral Gotra
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Religion</label>
                    <select name="religion" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="Hindu" {{ old('religion', $profile->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Jain" {{ old('religion', $profile->religion) == 'Jain' ? 'selected' : '' }}>Jain</option>
                        <option value="Sikh" {{ old('religion', $profile->religion) == 'Sikh' ? 'selected' : '' }}>Sikh</option>
                        <option value="Buddhist" {{ old('religion', $profile->religion) == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Sampradaya (Tradition)</label>
                    <select name="sampradaya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="">Select Tradition</option>
                        <option value="Vaishnav" {{ old('sampradaya', $profile->sampradaya) == 'Vaishnav' ? 'selected' : '' }}>Vaishnav</option>
                        <option value="Shaiva" {{ old('sampradaya', $profile->sampradaya) == 'Shaiva' ? 'selected' : '' }}>Shaiva</option>
                        <option value="Shakta" {{ old('sampradaya', $profile->sampradaya) == 'Shakta' ? 'selected' : '' }}>Shakta</option>
                        <option value="Smarta" {{ old('sampradaya', $profile->sampradaya) == 'Smarta' ? 'selected' : '' }}>Smarta</option>
                        <option value="ISKCON" {{ old('sampradaya', $profile->sampradaya) == 'ISKCON' ? 'selected' : '' }}>ISKCON</option>
                        <option value="Arya Samaj" {{ old('sampradaya', $profile->sampradaya) == 'Arya Samaj' ? 'selected' : '' }}>Arya Samaj</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Caste / Jati</label>
                    <input type="text" name="caste_jati" value="{{ old('caste_jati', $profile->caste_jati) }}" placeholder="e.g. Brahmin, Kayastha, Baidya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Regional Sub-Caste</label>
                    <input type="text" name="sub_caste" value="{{ old('sub_caste', $profile->sub_caste) }}" placeholder="e.g. Rarhi Kulin, Barendra" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Paternal Gotra <span class="text-[var(--color-danger)]">*</span></label>
                    <input type="text" name="gotra" value="{{ old('gotra', $profile->gotra) }}" placeholder="e.g. Shandilya, Kashyapa" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs font-semibold focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Maternal Gotra (Nanihal)</label>
                    <input type="text" name="nanihal_gotra" value="{{ old('nanihal_gotra', $profile->nanihal_gotra) }}" placeholder="e.g. Alambayan, Vatsa" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs font-semibold focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-[var(--text-primary)]">
                    <input type="checkbox" name="caste_no_bar" value="1" {{ $profile->caste_no_bar ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                    <span><strong>Caste No Bar:</strong> Open to compatible seekers across all Dharmic communities regardless of jati.</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs">
                    &larr; Back: Education &amp; Job
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs">
                        Save Changes
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs">
                        Next: Lifestyle &amp; Sanskar &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 4: LIFESTYLE, DIET & DEVOTIONAL SANSKAR -->
        <div x-show="activeTab === 'lifestyle'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Step 4 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Dietary Practices, Habits &amp; Spiritual Rhythm
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Dietary Practice</label>
                    <select name="diet" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="vegetarian" {{ old('diet', $profile->diet) == 'vegetarian' ? 'selected' : '' }}>Vegetarian (Sattvic)</option>
                        <option value="jain" {{ old('diet', $profile->diet) == 'jain' ? 'selected' : '' }}>Jain (No Root Veg)</option>
                        <option value="vegan" {{ old('diet', $profile->diet) == 'vegan' ? 'selected' : '' }}>Vegan</option>
                        <option value="eggetarian" {{ old('diet', $profile->diet) == 'eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                        <option value="non_vegetarian" {{ old('diet', $profile->diet) == 'non_vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Smoking Habits</label>
                    <select name="smoking" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="never" {{ old('smoking', $profile->smoking) == 'never' ? 'selected' : '' }}>Never</option>
                        <option value="occasionally" {{ old('smoking', $profile->smoking) == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                        <option value="regularly" {{ old('smoking', $profile->smoking) == 'regularly' ? 'selected' : '' }}>Regularly</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Alcohol Consumption</label>
                    <select name="alcohol" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="never" {{ old('alcohol', $profile->alcohol) == 'never' ? 'selected' : '' }}>Never</option>
                        <option value="occasionally" {{ old('alcohol', $profile->alcohol) == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Puja &amp; Prayer Frequency</label>
                    <select name="puja_frequency" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="daily" {{ old('puja_frequency', $profile->puja_frequency) == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ old('puja_frequency', $profile->puja_frequency) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="festivals_only" {{ old('puja_frequency', $profile->puja_frequency) == 'festivals_only' ? 'selected' : '' }}>Festivals Only</option>
                        <option value="rarely" {{ old('puja_frequency', $profile->puja_frequency) == 'rarely' ? 'selected' : '' }}>Rarely</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Temple Visits &amp; Fasting (Vrata)</label>
                    <input type="text" name="temple_visits" value="{{ old('temple_visits', $profile->temple_visits ?? 'Weekly') }}" placeholder="e.g. Weekly temple visits, Ekadashi" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Spiritual Lineage / Guru</label>
                    <input type="text" name="guru_lineage" value="{{ old('guru_lineage', $profile->guru_lineage) }}" placeholder="e.g. Ramakrishna Mission, Family Guru" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs">
                    &larr; Back: Gotra &amp; Lineage
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs">
                        Save Changes
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs">
                        Next: Family Details &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 5: FAMILY BACKGROUND & STRUCTURE -->
        <div x-show="activeTab === 'family'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Step 5 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Family Heritage, Structure &amp; Occupations
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Family Structure</label>
                    <select name="family_structure" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="nuclear" {{ old('family_structure', $profile->family_structure) == 'nuclear' ? 'selected' : '' }}>Nuclear Family</option>
                        <option value="joint" {{ old('family_structure', $profile->family_structure) == 'joint' ? 'selected' : '' }}>Joint Family</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Family Values</label>
                    <select name="family_values" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="traditional" {{ old('family_values', $profile->family_values) == 'traditional' ? 'selected' : '' }}>Traditional (Rooted in customs)</option>
                        <option value="moderate" {{ old('family_values', $profile->family_values) == 'moderate' ? 'selected' : '' }}>Moderate (Balanced blend)</option>
                        <option value="liberal" {{ old('family_values', $profile->family_values) == 'liberal' ? 'selected' : '' }}>Liberal</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Living Arrangements Post-Marriage</label>
                    <select name="living_arrangements_preference" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="with_parents" {{ old('living_arrangements_preference', $profile->living_arrangements_preference) == 'with_parents' ? 'selected' : '' }}>With Parents</option>
                        <option value="separate" {{ old('living_arrangements_preference', $profile->living_arrangements_preference) == 'separate' ? 'selected' : '' }}>Independent Residence</option>
                        <option value="flexible" {{ old('living_arrangements_preference', $profile->living_arrangements_preference) == 'flexible' ? 'selected' : '' }}>Flexible / Discussion Open</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Father's Occupation</label>
                    <input type="text" name="father_occupation" value="{{ old('father_occupation', $profile->father_occupation) }}" placeholder="e.g. Retired Advocate, Businessman" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Mother's Occupation</label>
                    <input type="text" name="mother_occupation" value="{{ old('mother_occupation', $profile->mother_occupation) }}" placeholder="e.g. Homemaker, Professor" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Brothers Count</label>
                    <input type="number" name="brothers_count" value="{{ old('brothers_count', $profile->brothers_count ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Sisters Count</label>
                    <input type="number" name="sisters_count" value="{{ old('sisters_count', $profile->sisters_count ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Native Ancestry / Heritage Roots</label>
                    <input type="text" name="native_ancestry" value="{{ old('native_ancestry', $profile->native_ancestry) }}" placeholder="e.g. Kolkata, Varanasi, Gujarat" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs">
                    &larr; Back: Lifestyle &amp; Sanskar
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs">
                        Save Changes
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs">
                        Next: Photos &amp; Modesty Shield &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 6: PHOTOS & MODESTY PRIVACY SHIELD -->
        <div x-show="activeTab === 'photos'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-6">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Step 6 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Photographs &amp; Modesty Privacy Shield
                    </h2>
                </div>
            </div>

            <!-- Modesty Shield Level Selector -->
            <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] space-y-3 text-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <div>
                        <h3 class="font-bold text-[var(--text-primary)] text-sm">Three-Tier Photo Privacy (Modesty Protection)</h3>
                        <p class="text-[var(--text-secondary)]">Preserve personal modesty and protect your photographs from unauthorized public viewing.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                    <label class="p-3 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'blur_until_mutual' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] font-bold text-[var(--accent-text)]' : 'bg-[var(--bg-surface)] border-[var(--border-default)] text-[var(--text-primary)]' }}">
                        <input type="radio" name="photo_privacy" value="blur_until_mutual" {{ $profile->photo_privacy === 'blur_until_mutual' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="block mt-1 text-xs font-bold">Blurred Until Mutual</span>
                        <span class="block text-[10px] text-[var(--text-muted)] font-normal">Photos are blurred and only unlock upon mutual proposal acceptance.</span>
                    </label>

                    <label class="p-3 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'public' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] font-bold text-[var(--accent-text)]' : 'bg-[var(--bg-surface)] border-[var(--border-default)] text-[var(--text-primary)]' }}">
                        <input type="radio" name="photo_privacy" value="public" {{ $profile->photo_privacy === 'public' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="block mt-1 text-xs font-bold">Fully Public</span>
                        <span class="block text-[10px] text-[var(--text-muted)] font-normal">Visible to all registered, verified matrimonial seekers.</span>
                    </label>

                    <label class="p-3 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'restricted' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] font-bold text-[var(--accent-text)]' : 'bg-[var(--bg-surface)] border-[var(--border-default)] text-[var(--text-primary)]' }}">
                        <input type="radio" name="photo_privacy" value="restricted" {{ $profile->photo_privacy === 'restricted' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="block mt-1 text-xs font-bold">Restricted</span>
                        <span class="block text-[10px] text-[var(--text-muted)] font-normal">Strictly viewable only upon individual manual photo permission grant.</span>
                    </label>
                </div>
            </div>

            <!-- Photo Upload Area -->
            <div>
                <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Upload Profile &amp; Gallery Photos (Max 6)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-[var(--border-default)] border-dashed rounded-[var(--radius-md)] bg-[var(--bg-subtle)]">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-8 w-8 text-[var(--text-muted)]" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-xs text-[var(--text-secondary)]">
                            <input type="file" name="photos[]" multiple accept="image/*" class="text-xs text-[var(--text-secondary)] file:mr-3 file:py-1.5 file:px-3 file:rounded-[var(--radius-sm)] file:border-0 file:text-xs file:font-semibold file:btn-primary cursor-pointer">
                        </div>
                        <p class="text-[10px] text-[var(--text-muted)]">PNG, JPG, WEBP up to 5MB each. Modest portrait photographs recommended.</p>
                    </div>
                </div>
            </div>

            <!-- Existing Photos Gallery -->
            @if($photos->isNotEmpty())
                <div class="space-y-2 pt-2">
                    <span class="text-xs font-bold text-[var(--text-primary)] block">Current Uploaded Photographs ({{ $photos->count() }} / 6):</span>
                    <div class="grid grid-cols-2 sm:grid-cols-6 gap-3">
                        @foreach($photos as $p)
                            <div class="relative group rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border-subtle)] h-28 bg-[var(--neutral-900)]">
                                <img src="{{ asset($p->photo_path) }}" alt="Photo" class="w-full h-full object-cover">
                                @if($p->is_primary)
                                    <span class="absolute top-1 left-1 bg-[var(--accent-primary)] text-white text-[9px] font-bold px-1.5 py-0.5 rounded-[var(--radius-xs)]">Primary</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs">
                    &larr; Back: Family Roots
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs">
                        Save Changes
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs">
                        Next: Bio &amp; Expectations &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 7: NARRATIVE BIO & PARTNER PREFERENCES -->
        <div x-show="activeTab === 'narrative'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-6">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Step 7 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Personal Bio &amp; Partner Expectations
                    </h2>
                </div>
            </div>

            <div>
                <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">About Myself (Personal Narrative Bio)</label>
                <textarea name="about_me" rows="4" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none leading-relaxed" placeholder="Introduce your character, cultural upbringing, spiritual values, hobbies, and personal outlook on life...">{{ old('about_me', $profile->about_me) }}</textarea>
                <p class="text-[10px] text-[var(--text-muted)] mt-1">A thoughtful narrative bio significantly increases proposal interest from compatible families.</p>
            </div>

            <div>
                <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Partner Preferences &amp; Expectations</label>
                <textarea name="partner_preferences_bio" rows="4" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none leading-relaxed" placeholder="Describe the qualities, cultural alignment, educational background, and shared Dharmic values you seek in a life partner...">{{ old('partner_preferences_bio', $profile->partner_preferences_bio) }}</textarea>
            </div>

            <!-- Field-Level Masking Controls -->
            <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] space-y-2 text-xs">
                <span class="font-bold text-[var(--text-primary)] text-xs uppercase tracking-wider block">
                    Confidential Field-Level Masking Controls
                </span>
                <p class="text-[var(--text-secondary)] text-[11px]">
                    Hide sensitive financial or caste details from initial public discovery:
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-[var(--text-primary)]">
                        <input type="checkbox" name="mask_income" value="1" {{ $profile->mask_income ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="text-[11px]">Mask Annual Income</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer text-[var(--text-primary)]">
                        <input type="checkbox" name="mask_gotra" value="1" {{ $profile->mask_gotra ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="text-[11px]">Mask Gotra until mutual interest</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer text-[var(--text-primary)]">
                        <input type="checkbox" name="mask_caste" value="1" {{ $profile->mask_caste ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="text-[11px]">Mask Caste ("Caste No Bar")</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs">
                    &larr; Back: Photos &amp; Modesty
                </button>
                <button type="submit" class="btn-primary text-xs">
                    Save &amp; Finalize Sacred Biodata
                </button>
            </div>
        </div>

    </form>

    <!-- Account Lifecycle & Erasure Controls -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-3 text-xs">
        <h3 class="font-bold text-sm text-[var(--text-primary)] uppercase tracking-wider">Account Lifecycle &amp; Privacy Rights</h3>
        <p class="text-[var(--text-secondary)]">
            Compliant with DPDP and GDPR privacy frameworks. You can temporarily deactivate your profile or permanently erase all account data.
        </p>

        <div class="flex flex-wrap gap-3 pt-1">
            <form method="POST" action="{{ route('profile.deactivate') }}" onsubmit="return confirm('Are you sure you want to temporarily deactivate your profile? You will be hidden from discovery until you sign in again.')">
                @csrf
                <button type="submit" class="btn-secondary text-xs">
                    Temporarily Deactivate Profile
                </button>
            </form>

            <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('WARNING: This permanently erases all biodata, photos, proposals, and logs. This action is irreversible.')">
                @csrf
                <button type="submit" class="btn-outline text-xs text-[var(--color-danger)] border-[var(--color-danger-border)] hover:bg-[var(--color-danger-bg)]">
                    Permanently Delete Account &amp; Data
                </button>
            </form>
        </div>
    </div>

</div>
@endsection

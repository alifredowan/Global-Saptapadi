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
                <div class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[var(--secondary-text)] uppercase tracking-wider mb-1">
                    <svg class="w-3.5 h-3.5 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                    <span>Biodata Editor</span>
                </div>
                <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">
                    Edit Candidate Biodata
                </h1>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                    Your family can review and update details at any time. Take your time to complete each section.
                </p>
            </div>
            
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('profile.show') }}" class="btn-secondary text-xs flex items-center gap-1.5 !min-h-[36px] !px-3">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>View Public Biodata</span>
                </a>
            </div>
        </div>

        <!-- Profile Completeness Progress Tracker -->
        @php
            $completeness = $profile->profile_completeness_pct ?? 60;
        @endphp
        <div class="space-y-1.5">
            <div class="flex items-center justify-between text-xs">
                <span class="font-medium text-[var(--text-primary)] flex items-center gap-1.5">
                    <span>Profile strength:</span>
                    <strong class="text-[var(--accent-primary)] font-bold">{{ $completeness }}%</strong>
                </span>
                <span class="text-[11px] text-[var(--text-muted)]">
                    {{ $completeness >= 80 ? 'Comprehensive details help families connect with confidence.' : 'Adding family roots and lifestyle details improves matches.' }}
                </span>
            </div>
            <div class="w-full bg-[var(--border-default)] rounded-full h-1.5 overflow-hidden">
                <div class="bg-[var(--accent-primary)] h-full rounded-full transition-all duration-300" style="width: {{ $completeness }}%"></div>
            </div>
        </div>

        <!-- Multi-Step Interactive Navigation Tabs -->
        <div class="pt-2 flex items-center gap-1.5 overflow-x-auto pb-1 no-scrollbar text-xs font-medium">
            <button type="button" @click="activeTab = 'basic'"
                    :class="activeTab === 'basic' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>1. Basic &amp; Location</span>
            </button>

            <button type="button" @click="activeTab = 'education'"
                    :class="activeTab === 'education' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>2. Education &amp; Career</span>
            </button>

            <button type="button" @click="activeTab = 'religion'"
                    :class="activeTab === 'religion' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>3. Gotra &amp; Heritage</span>
            </button>

            <button type="button" @click="activeTab = 'lifestyle'"
                    :class="activeTab === 'lifestyle' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>4. Lifestyle &amp; Sanskar</span>
            </button>

            <button type="button" @click="activeTab = 'family'"
                    :class="activeTab === 'family' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>5. Family Roots</span>
            </button>

            <button type="button" @click="activeTab = 'photos'"
                    :class="activeTab === 'photos' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>6. Photos &amp; Privacy</span>
            </button>

            <button type="button" @click="activeTab = 'narrative'"
                    :class="activeTab === 'narrative' ? 'bg-[var(--accent-primary)] text-white border-[var(--accent-primary)]' : 'bg-[var(--bg-surface)] text-[var(--text-secondary)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]'"
                    class="px-3 py-1.5 rounded-[var(--radius-sm)] border transition shrink-0 cursor-pointer">
                <span>7. Bio &amp; Partner Preferences</span>
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
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 1 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Basic Details, Physical Attributes &amp; Location
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <!-- Height -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Height (cm)</label>
                    <input type="number" name="height_cm" value="{{ old('height_cm', $profile->height_cm) }}" placeholder="e.g. 175" min="120" max="230" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                    <p class="text-[10px] text-[var(--text-muted)] mt-1">Approx {{ $profile->height_cm ? round($profile->height_cm / 30.48, 1) . ' ft' : '5.8 ft' }}</p>
                </div>

                <!-- Weight -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Weight (kg)</label>
                    <input type="number" name="weight_kg" value="{{ old('weight_kg', $profile->weight_kg) }}" placeholder="e.g. 68" min="35" max="200" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Complexion -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Complexion</label>
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
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Country of Residence</label>
                    <input type="text" name="country" value="{{ old('country', $profile->country ?? 'United States') }}" placeholder="e.g. United Kingdom, USA, Canada, UAE, India, Bangladesh, Nepal" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Citizenship -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Citizenship</label>
                    <input type="text" name="citizenship" value="{{ old('citizenship', $profile->citizenship ?? 'United States') }}" placeholder="e.g. British, American, Canadian, Indian, Bangladeshi" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Mother Tongue -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Mother Tongue</label>
                    <input type="text" name="mother_tongue" value="{{ old('mother_tongue', $profile->mother_tongue ?? 'English') }}" placeholder="e.g. English, Hindi, Bengali, Gujarati, Tamil, Marathi" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- City -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">City / Region</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" placeholder="e.g. London, Toronto, Dubai, Houston, Singapore, Kolkata" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <!-- Marital Status -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Marital Status</label>
                    <select name="marital_status" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="never_married" {{ old('marital_status', $user->marital_status) == 'never_married' ? 'selected' : '' }}>Never Married</option>
                        <option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced (Remarriage)</option>
                        <option value="widowed" {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed (Remarriage)</option>
                        <option value="annulled" {{ old('marital_status', $user->marital_status) == 'annulled' ? 'selected' : '' }}>Annulled</option>
                    </select>
                </div>

                <!-- Dependent Children -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Dependent Children</label>
                    <input type="number" name="dependent_children" value="{{ old('dependent_children', $profile->dependent_children ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <!-- Step Action Buttons -->
            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <span></span>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs !min-h-[38px]">
                        Save Draft
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs !min-h-[38px]">
                        <span>Next: Education &amp; Career</span>
                        &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 2: EDUCATION & PROFESSION -->
        <div x-show="activeTab === 'education'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 2 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Education &amp; Profession
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Highest Qualification</label>
                    <input type="text" name="qualification_level" value="{{ old('qualification_level', $profile->qualification_level) }}" placeholder="e.g. MS, MBA, MBBS, B.Tech" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Profession / Role</label>
                    <input type="text" name="profession" value="{{ old('profession', $profile->profession) }}" placeholder="e.g. Physician, Software Engineer" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Organization Type</label>
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
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Annual Gross Income Range (Optional)</label>
                    <input type="text" name="annual_income_range" value="{{ old('annual_income_range', $profile->annual_income_range) }}" placeholder="e.g. $70,000 - $90,000 USD / year" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Education Background &amp; College Details</label>
                <textarea name="education_detail" rows="3" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none leading-relaxed" placeholder="Universities attended, degrees earned, or areas of academic interest...">{{ old('education_detail', $profile->education_detail) }}</textarea>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs !min-h-[38px]">
                    &larr; Back: Basic Details
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs !min-h-[38px]">
                        Save Draft
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs !min-h-[38px]">
                        <span>Next: Gotra &amp; Lineage</span>
                        &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 3: RELIGION, SAMPRADAYA & GOTRA LINEAGE -->
        <div x-show="activeTab === 'religion'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 3 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Spiritual Tradition, Sampradaya &amp; Gotra Lineage
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Religion</label>
                    <select name="religion" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="Hindu" {{ old('religion', $profile->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Jain" {{ old('religion', $profile->religion) == 'Jain' ? 'selected' : '' }}>Jain</option>
                        <option value="Sikh" {{ old('religion', $profile->religion) == 'Sikh' ? 'selected' : '' }}>Sikh</option>
                        <option value="Buddhist" {{ old('religion', $profile->religion) == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Sampradaya (Tradition)</label>
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
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Community / Caste</label>
                    <input type="text" name="caste_jati" value="{{ old('caste_jati', $profile->caste_jati) }}" placeholder="e.g. Brahmin, Kayastha, Baidya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Regional Sub-Caste</label>
                    <input type="text" name="sub_caste" value="{{ old('sub_caste', $profile->sub_caste) }}" placeholder="e.g. Rarhi Kulin, Barendra" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Paternal Gotra (Ancestral Lineage) <span class="text-[var(--color-danger)]">*</span></label>
                    <input type="text" name="gotra" value="{{ old('gotra', $profile->gotra) }}" placeholder="e.g. Shandilya, Kashyapa, Bharadwaj" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs font-semibold focus:border-[var(--accent-primary)] focus:outline-none">
                    <p class="text-[10px] text-[var(--text-muted)] mt-1">Prevents same-Gotra (Sagotra) ancestral overlap</p>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Maternal Gotra (Nanihal Ancestry)</label>
                    <input type="text" name="nanihal_gotra" value="{{ old('nanihal_gotra', $profile->nanihal_gotra) }}" placeholder="e.g. Alambayan, Vatsa, Gautam" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs font-semibold focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <!-- Caste No Bar note -->
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <label class="flex items-center gap-2.5 cursor-pointer text-xs text-[var(--text-primary)]">
                    <input type="checkbox" name="caste_no_bar" value="1" {{ $profile->caste_no_bar ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                    <span><strong>Caste no bar is a fine choice:</strong> Open to compatible candidates across all Hindu communities.</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs !min-h-[38px]">
                    &larr; Back: Education &amp; Career
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs !min-h-[38px]">
                        Save Draft
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs !min-h-[38px]">
                        <span>Next: Lifestyle &amp; Sanskar</span>
                        &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 4: LIFESTYLE, DIET & DEVOTIONAL SANSKAR -->
        <div x-show="activeTab === 'lifestyle'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 4 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Dietary Practices &amp; Spiritual Lifestyle
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Dietary Practice</label>
                    <select name="diet" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="vegetarian" {{ old('diet', $profile->diet) == 'vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                        <option value="jain" {{ old('diet', $profile->diet) == 'jain' ? 'selected' : '' }}>Jain (Sattvic)</option>
                        <option value="vegan" {{ old('diet', $profile->diet) == 'vegan' ? 'selected' : '' }}>Vegan</option>
                        <option value="eggetarian" {{ old('diet', $profile->diet) == 'eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                        <option value="non_vegetarian" {{ old('diet', $profile->diet) == 'non_vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Smoking</label>
                    <select name="smoking" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="never" {{ old('smoking', $profile->smoking) == 'never' ? 'selected' : '' }}>Never</option>
                        <option value="occasionally" {{ old('smoking', $profile->smoking) == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                        <option value="regularly" {{ old('smoking', $profile->smoking) == 'regularly' ? 'selected' : '' }}>Regularly</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Alcohol Consumption</label>
                    <select name="alcohol" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="never" {{ old('alcohol', $profile->alcohol) == 'never' ? 'selected' : '' }}>Never</option>
                        <option value="occasionally" {{ old('alcohol', $profile->alcohol) == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Daily Prayer / Puja</label>
                    <select name="puja_frequency" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="daily" {{ old('puja_frequency', $profile->puja_frequency) == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ old('puja_frequency', $profile->puja_frequency) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="festivals_only" {{ old('puja_frequency', $profile->puja_frequency) == 'festivals_only' ? 'selected' : '' }}>Festivals Only</option>
                        <option value="rarely" {{ old('puja_frequency', $profile->puja_frequency) == 'rarely' ? 'selected' : '' }}>Rarely</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Temple Visits &amp; Vrata</label>
                    <input type="text" name="temple_visits" value="{{ old('temple_visits', $profile->temple_visits ?? 'Weekly') }}" placeholder="e.g. Weekly temple visits, Ekadashi" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Spiritual Lineage / Guru (Optional)</label>
                    <input type="text" name="guru_lineage" value="{{ old('guru_lineage', $profile->guru_lineage) }}" placeholder="e.g. Ramakrishna Math, Family Guru" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs !min-h-[38px]">
                    &larr; Back: Gotra &amp; Lineage
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs !min-h-[38px]">
                        Save Draft
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs !min-h-[38px]">
                        <span>Next: Family Roots</span>
                        &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 5: FAMILY BACKGROUND & STRUCTURE -->
        <div x-show="activeTab === 'family'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-5">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 5 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Family Roots &amp; Heritage
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Family Structure</label>
                    <select name="family_structure" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="nuclear" {{ old('family_structure', $profile->family_structure) == 'nuclear' ? 'selected' : '' }}>Nuclear Family</option>
                        <option value="joint" {{ old('family_structure', $profile->family_structure) == 'joint' ? 'selected' : '' }}>Joint Family</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Family Outlook</label>
                    <select name="family_values" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="traditional" {{ old('family_values', $profile->family_values) == 'traditional' ? 'selected' : '' }}>Traditional</option>
                        <option value="moderate" {{ old('family_values', $profile->family_values) == 'moderate' ? 'selected' : '' }}>Moderate (Balanced)</option>
                        <option value="liberal" {{ old('family_values', $profile->family_values) == 'liberal' ? 'selected' : '' }}>Liberal</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Residence After Marriage</label>
                    <select name="living_arrangements_preference" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                        <option value="with_parents" {{ old('living_arrangements_preference', $profile->living_arrangements_preference) == 'with_parents' ? 'selected' : '' }}>With Parents</option>
                        <option value="separate" {{ old('living_arrangements_preference', $profile->living_arrangements_preference) == 'separate' ? 'selected' : '' }}>Independent Residence</option>
                        <option value="flexible" {{ old('living_arrangements_preference', $profile->living_arrangements_preference) == 'flexible' ? 'selected' : '' }}>Open to Discussion</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Father's Profession</label>
                    <input type="text" name="father_occupation" value="{{ old('father_occupation', $profile->father_occupation) }}" placeholder="e.g. Retired Professor, Businessman" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Mother's Profession</label>
                    <input type="text" name="mother_occupation" value="{{ old('mother_occupation', $profile->mother_occupation) }}" placeholder="e.g. Homemaker, Teacher" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Brothers</label>
                    <input type="number" name="brothers_count" value="{{ old('brothers_count', $profile->brothers_count ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Sisters</label>
                    <input type="number" name="sisters_count" value="{{ old('sisters_count', $profile->sisters_count ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Native Ancestry &amp; District</label>
                    <input type="text" name="native_ancestry" value="{{ old('native_ancestry', $profile->native_ancestry) }}" placeholder="e.g. Sylhet / Dhaka / Kolkata / Varanasi" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none">
                </div>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs !min-h-[38px]">
                    &larr; Back: Lifestyle &amp; Sanskar
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs !min-h-[38px]">
                        Save Draft
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs !min-h-[38px]">
                        <span>Next: Photos &amp; Privacy</span>
                        &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 6: PHOTOS & PRIVACY -->
        <div x-show="activeTab === 'photos'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-6">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 6 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Candidate Photographs &amp; Privacy
                    </h2>
                </div>
            </div>

            <!-- Privacy Selector -->
            <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] space-y-3 text-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                    <div>
                        <h3 class="font-serif font-bold text-[var(--text-primary)] text-sm">Photo Privacy Settings</h3>
                        <p class="text-[var(--text-secondary)] text-[11px]">Choose when prospective candidates and their parents can view your photos.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                    <label class="p-3 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'blur_until_mutual' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] text-[var(--accent-text)] font-semibold' : 'bg-[var(--bg-surface)] border-[var(--border-default)] text-[var(--text-primary)]' }}">
                        <input type="radio" name="photo_privacy" value="blur_until_mutual" {{ $profile->photo_privacy === 'blur_until_mutual' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="block mt-1 text-xs font-semibold">Shared Upon Mutual Interest</span>
                        <span class="block text-[10px] text-[var(--text-muted)] font-normal mt-0.5">Photos stay gently blurred and reveal only when both families accept interest.</span>
                    </label>

                    <label class="p-3 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'public' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] text-[var(--accent-text)] font-semibold' : 'bg-[var(--bg-surface)] border-[var(--border-default)] text-[var(--text-primary)]' }}">
                        <input type="radio" name="photo_privacy" value="public" {{ $profile->photo_privacy === 'public' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="block mt-1 text-xs font-semibold">Visible to Verified Members</span>
                        <span class="block text-[10px] text-[var(--text-muted)] font-normal mt-0.5">Visible to registered candidates and families who have completed ID verification.</span>
                    </label>

                    <label class="p-3 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'restricted' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] text-[var(--accent-text)] font-semibold' : 'bg-[var(--bg-surface)] border-[var(--border-default)] text-[var(--text-primary)]' }}">
                        <input type="radio" name="photo_privacy" value="restricted" {{ $profile->photo_privacy === 'restricted' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="block mt-1 text-xs font-semibold">Private (Permission Only)</span>
                        <span class="block text-[10px] text-[var(--text-muted)] font-normal mt-0.5">Photos are shown only after you grant individual photo access request.</span>
                    </label>
                </div>
            </div>

            <!-- Photo Upload Area -->
            <div>
                <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Upload Photographs (Up to 6)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border border-dashed border-[var(--border-strong)] rounded-[var(--radius-sm)] bg-[var(--bg-subtle)]">
                    <div class="space-y-2 text-center">
                        <svg class="mx-auto h-8 w-8 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                        <div class="text-xs text-[var(--text-secondary)]">
                            <input type="file" name="photos[]" multiple accept="image/*" class="text-xs text-[var(--text-secondary)] file:mr-3 file:py-1.5 file:px-3 file:rounded-[var(--radius-sm)] file:border-0 file:text-xs file:font-semibold file:btn-primary cursor-pointer">
                        </div>
                        <p class="text-[10px] text-[var(--text-muted)]">PNG, JPG or WEBP up to 5MB. Traditional or modest portrait photographs are recommended.</p>
                    </div>
                </div>
            </div>

            <!-- Existing Photos Gallery -->
            @if($photos->isNotEmpty())
                <div class="space-y-2 pt-2">
                    <span class="text-xs font-semibold text-[var(--text-primary)] block">Current Photographs ({{ $photos->count() }} of 6):</span>
                    <div class="grid grid-cols-2 sm:grid-cols-6 gap-3">
                        @foreach($photos as $p)
                            <div class="relative group rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border-default)] h-28 bg-[var(--bg-subtle)]">
                                <img src="{{ asset($p->photo_path) }}" alt="Candidate photo" class="w-full h-full object-cover">
                                @if($p->is_primary)
                                    <span class="absolute top-1 left-1 bg-[var(--accent-primary)] text-white text-[9px] font-semibold px-1.5 py-0.5 rounded-[var(--radius-xs)]">Primary</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs !min-h-[38px]">
                    &larr; Back: Family Roots
                </button>
                <div class="flex items-center gap-2">
                    <button type="submit" class="btn-secondary text-xs !min-h-[38px]">
                        Save Draft
                    </button>
                    <button type="button" @click="nextTab()" class="btn-primary text-xs !min-h-[38px]">
                        <span>Next: Bio &amp; Preferences</span>
                        &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- STEP 7: NARRATIVE BIO & PARTNER PREFERENCES -->
        <div x-show="activeTab === 'narrative'" x-cloak class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] space-y-6">
            <div class="pb-3 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Step 7 of 7</span>
                    <h2 class="font-serif font-bold text-lg text-[var(--text-primary)]">
                        Personal Narrative &amp; Partner Preferences
                    </h2>
                </div>
            </div>

            <div>
                <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">About Myself</label>
                <textarea name="about_me" rows="4" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none leading-relaxed" placeholder="Write a few sincere sentences about your character, upbringing, spiritual habits, hobbies, and family life...">{{ old('about_me', $profile->about_me) }}</textarea>
                <p class="text-[10px] text-[var(--text-muted)] mt-1">A genuine introduction written by you or your parents helps compatible families respond warmly.</p>
            </div>

            <div>
                <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Partner Expectations</label>
                <textarea name="partner_preferences_bio" rows="4" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:outline-none leading-relaxed" placeholder="Describe the qualities, cultural background, educational outlook, and values you hope to share in a life partner...">{{ old('partner_preferences_bio', $profile->partner_preferences_bio) }}</textarea>
            </div>

            <!-- Field-Level Masking Controls -->
            <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] space-y-2 text-xs">
                <span class="font-semibold text-[var(--text-primary)] text-xs uppercase tracking-wider block">
                    Confidential Privacy Controls
                </span>
                <p class="text-[var(--text-secondary)] text-[11px]">
                    You can keep sensitive details shielded until you feel comfortable sharing them directly:
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-[var(--text-primary)]">
                        <input type="checkbox" name="mask_income" value="1" {{ $profile->mask_income ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="text-[11px]">Keep income private</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer text-[var(--text-primary)]">
                        <input type="checkbox" name="mask_gotra" value="1" {{ $profile->mask_gotra ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="text-[11px]">Keep Gotra private until mutual note</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer text-[var(--text-primary)]">
                        <input type="checkbox" name="mask_caste" value="1" {{ $profile->mask_caste ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="text-[11px]">Caste no bar (Mask caste)</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-between">
                <button type="button" @click="prevTab()" class="btn-secondary text-xs !min-h-[38px]">
                    &larr; Back: Photos &amp; Privacy
                </button>
                <button type="submit" class="btn-primary text-xs !min-h-[38px]">
                    Save Biodata
                </button>
            </div>
        </div>

    </form>

    <!-- Account Lifecycle & Privacy Rights -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-3 text-xs">
        <h3 class="font-semibold text-sm text-[var(--text-primary)] uppercase tracking-wider">Account &amp; Data Rights</h3>
        <p class="text-[var(--text-secondary)] leading-relaxed">
            You maintain complete control over your personal data. You can pause your profile from public discovery at any time or permanently delete all biodata and photographs.
        </p>

        <div class="flex flex-wrap gap-3 pt-1">
            <form method="POST" action="{{ route('profile.deactivate') }}" onsubmit="return confirm('Are you sure you want to pause your profile? Your biodata will be hidden from discovery until you sign in again.')">
                @csrf
                <button type="submit" class="btn-secondary text-xs !min-h-[36px]">
                    Temporarily Pause Profile
                </button>
            </form>

            <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('Please confirm: This permanently removes all candidate details, photos, proposals, and chats. This cannot be undone.')">
                @csrf
                <button type="submit" class="px-3.5 py-2 rounded-[var(--radius-sm)] text-xs font-semibold text-[var(--color-danger)] border border-[var(--color-danger-border)] hover:bg-[var(--color-danger-bg)] transition cursor-pointer">
                    Permanently Delete Account
                </button>
            </form>
        </div>
    </div>

</div>
@endsection

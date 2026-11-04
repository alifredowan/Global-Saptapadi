@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center space-x-1.5 text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">
                <span>📋</span>
                <span>Biodata Management</span>
            </div>
            <h1 class="font-heading font-bold text-2xl text-gray-900">Edit Sacred Matrimonial Profile</h1>
        </div>
        <a href="{{ route('profile.show') }}" class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50 text-xs font-bold text-gray-700 transition">
            Preview Live Biodata →
        </a>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- 1. Physical & Location Attributes -->
        <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>👤</span>
                <span>Physical Attributes & Location</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Height (cm)</label>
                    <input type="number" name="height_cm" value="{{ old('height_cm', $profile->height_cm) }}" placeholder="e.g. 175" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Weight (kg)</label>
                    <input type="number" name="weight_kg" value="{{ old('weight_kg', $profile->weight_kg) }}" placeholder="e.g. 68" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Complexion</label>
                    <select name="complexion" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="">Select Complexion</option>
                        <option value="Very Fair" {{ old('complexion', $profile->complexion) == 'Very Fair' ? 'selected' : '' }}>Very Fair</option>
                        <option value="Fair" {{ old('complexion', $profile->complexion) == 'Fair' ? 'selected' : '' }}>Fair</option>
                        <option value="Wheatish" {{ old('complexion', $profile->complexion) == 'Wheatish' ? 'selected' : '' }}>Wheatish</option>
                        <option value="Dusky" {{ old('complexion', $profile->complexion) == 'Dusky' ? 'selected' : '' }}>Dusky</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Mother Tongue</label>
                    <input type="text" name="mother_tongue" value="{{ old('mother_tongue', $profile->mother_tongue ?? 'Bengali') }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">City / Residential Area</label>
                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" placeholder="e.g. Dhaka (Gulshan)" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Marital Status</label>
                    <select name="marital_status" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="never_married" {{ old('marital_status', $user->marital_status) == 'never_married' ? 'selected' : '' }}>Never Married</option>
                        <option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced (Remarriage)</option>
                        <option value="widowed" {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed (Remarriage)</option>
                        <option value="annulled" {{ old('marital_status', $user->marital_status) == 'annulled' ? 'selected' : '' }}>Annulled</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 2. Heritage, Gotra & Community (FR-2.3, FR-2.4) -->
        <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>🪔</span>
                <span>Religion, Sampradaya & Gotra Lineage</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Religion</label>
                    <select name="religion" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="Hindu" {{ old('religion', $profile->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Jain" {{ old('religion', $profile->religion) == 'Jain' ? 'selected' : '' }}>Jain</option>
                        <option value="Sikh" {{ old('religion', $profile->religion) == 'Sikh' ? 'selected' : '' }}>Sikh</option>
                        <option value="Buddhist" {{ old('religion', $profile->religion) == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Sampradaya (Spiritual Tradition)</label>
                    <select name="sampradaya" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="">Select Tradition</option>
                        <option value="Vaishnav" {{ old('sampradaya', $profile->sampradaya) == 'Vaishnav' ? 'selected' : '' }}>Vaishnav</option>
                        <option value="Shaiva" {{ old('sampradaya', $profile->sampradaya) == 'Shaiva' ? 'selected' : '' }}>Shaiva</option>
                        <option value="Shakta" {{ old('sampradaya', $profile->sampradaya) == 'Shakta' ? 'selected' : '' }}>Shakta</option>
                        <option value="Smarta" {{ old('sampradaya', $profile->sampradaya) == 'Smarta' ? 'selected' : '' }}>Smarta</option>
                        <option value="ISKCON" {{ old('sampradaya', $profile->sampradaya) == 'ISKCON' ? 'selected' : '' }}>ISKCON</option>
                        <option value="Arya Samaj" {{ old('sampradaya', $profile->sampradaya) == 'Arya Samaj' ? 'selected' : '' }}>Arya Samaj</option>
                        <option value="Other" {{ old('sampradaya', $profile->sampradaya) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Caste / Jati</label>
                    <input type="text" name="caste_jati" value="{{ old('caste_jati', $profile->caste_jati) }}" placeholder="e.g. Brahmin, Kayastha, Baidya" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Sub-Caste (Regional Tradition)</label>
                    <input type="text" name="sub_caste" value="{{ old('sub_caste', $profile->sub_caste) }}" placeholder="e.g. Rarhi, Barendra, Kulin" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Paternal Gotra</label>
                    <input type="text" name="gotra" value="{{ old('gotra', $profile->gotra) }}" placeholder="e.g. Shandilya, Kashyapa, Bharadwaja" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Maternal Lineage (Nanihal Gotra)</label>
                    <input type="text" name="nanihal_gotra" value="{{ old('nanihal_gotra', $profile->nanihal_gotra) }}" placeholder="e.g. Alambayan, Vatsa" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center space-x-2 cursor-pointer text-xs text-gray-700">
                    <input type="checkbox" name="caste_no_bar" value="1" {{ $profile->caste_no_bar ? 'checked' : '' }} class="rounded text-red-900 focus:ring-red-800">
                    <span class="font-bold">Caste No Bar (Open to all Dharmic communities)</span>
                </label>
            </div>
        </div>

        <!-- 3. Education & Profession (FR-2.2) -->
        <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>🎓</span>
                <span>Education & Career Profile</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Highest Qualification</label>
                    <input type="text" name="qualification_level" value="{{ old('qualification_level', $profile->qualification_level) }}" placeholder="e.g. MBBS, M.Sc, MBA, B.Tech" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Profession / Designation</label>
                    <input type="text" name="profession" value="{{ old('profession', $profile->profession) }}" placeholder="e.g. Consultant Physician, Software Architect" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Annual Gross Income Range</label>
                    <input type="text" name="annual_income_range" value="{{ old('annual_income_range', $profile->annual_income_range) }}" placeholder="e.g. $40,000 - $65,000 USD / year" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1 text-xs">Education & Career Narrative</label>
                <textarea name="education_detail" rows="2" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs" placeholder="Degrees obtained, universities, notable achievements...">{{ old('education_detail', $profile->education_detail) }}</textarea>
            </div>
        </div>

        <!-- 4. Lifestyle & Spiritual Habits (FR-2.5, FR-2.6) -->
        <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>🥗</span>
                <span>Dietary Practice & Devotional Routine</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Dietary Practice</label>
                    <select name="diet" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="vegetarian" {{ old('diet', $profile->diet) == 'vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                        <option value="eggetarian" {{ old('diet', $profile->diet) == 'eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                        <option value="non_vegetarian" {{ old('diet', $profile->diet) == 'non_vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                        <option value="jain" {{ old('diet', $profile->diet) == 'jain' ? 'selected' : '' }}>Jain</option>
                        <option value="vegan" {{ old('diet', $profile->diet) == 'vegan' ? 'selected' : '' }}>Vegan</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Smoking Habits</label>
                    <select name="smoking" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="never" {{ old('smoking', $profile->smoking) == 'never' ? 'selected' : '' }}>Never</option>
                        <option value="occasionally" {{ old('smoking', $profile->smoking) == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                        <option value="regularly" {{ old('smoking', $profile->smoking) == 'regularly' ? 'selected' : '' }}>Regularly</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Alcohol Consumption</label>
                    <select name="alcohol" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="never" {{ old('alcohol', $profile->alcohol) == 'never' ? 'selected' : '' }}>Never</option>
                        <option value="occasionally" {{ old('alcohol', $profile->alcohol) == 'occasionally' ? 'selected' : '' }}>Occasionally</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Puja Observance Frequency</label>
                    <select name="puja_frequency" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="daily" {{ old('puja_frequency', $profile->puja_frequency) == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ old('puja_frequency', $profile->puja_frequency) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="festivals_only" {{ old('puja_frequency', $profile->puja_frequency) == 'festivals_only' ? 'selected' : '' }}>Festivals Only</option>
                        <option value="rarely" {{ old('puja_frequency', $profile->puja_frequency) == 'rarely' ? 'selected' : '' }}>Rarely</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Temple Visits & Fasting</label>
                    <input type="text" name="temple_visits" value="{{ old('temple_visits', $profile->temple_visits ?? 'Weekly') }}" placeholder="e.g. Weekly visits, Ekadashi fasting" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Guru Lineage / Affiliation</label>
                    <input type="text" name="guru_lineage" value="{{ old('guru_lineage', $profile->guru_lineage) }}" placeholder="e.g. Ramakrishna Mission, ISKCON, Family Guru" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
            </div>
        </div>

        <!-- 5. Family Details (FR-2.7) -->
        <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>🏡</span>
                <span>Family Structure & Heritage</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Family Structure</label>
                    <select name="family_structure" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="nuclear" {{ old('family_structure', $profile->family_structure) == 'nuclear' ? 'selected' : '' }}>Nuclear Family</option>
                        <option value="joint" {{ old('family_structure', $profile->family_structure) == 'joint' ? 'selected' : '' }}>Joint Family</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Family Values</label>
                    <select name="family_values" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="traditional" {{ old('family_values', $profile->family_values) == 'traditional' ? 'selected' : '' }}>Traditional</option>
                        <option value="moderate" {{ old('family_values', $profile->family_values) == 'moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="liberal" {{ old('family_values', $profile->family_values) == 'liberal' ? 'selected' : '' }}>Liberal</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Father's Occupation</label>
                    <input type="text" name="father_occupation" value="{{ old('father_occupation', $profile->father_occupation) }}" placeholder="e.g. Advocate, Doctor, Business" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Mother's Occupation</label>
                    <input type="text" name="mother_occupation" value="{{ old('mother_occupation', $profile->mother_occupation) }}" placeholder="e.g. Homemaker, Professor" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Brothers Count</label>
                    <input type="number" name="brothers_count" value="{{ old('brothers_count', $profile->brothers_count ?? 0) }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Sisters Count</label>
                    <input type="number" name="sisters_count" value="{{ old('sisters_count', $profile->sisters_count ?? 0) }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
            </div>
        </div>

        <!-- 6. Narrative Bio & Partner Expectations (FR-2.8) -->
        <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>✍️</span>
                <span>Narrative Bio & Partner Preferences</span>
            </h2>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1 text-xs">Personal Narrative Bio</label>
                <textarea name="about_me" rows="3" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs" placeholder="Introduce yourself, your cultural upbringing, and your Dharmic aspirations...">{{ old('about_me', $profile->about_me) }}</textarea>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1 text-xs">Partner Preferences Expectations</label>
                <textarea name="partner_preferences_bio" rows="3" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs" placeholder="Describe the qualities, cultural alignment, and shared values you seek in a life partner...">{{ old('partner_preferences_bio', $profile->partner_preferences_bio) }}</textarea>
            </div>
        </div>

        <!-- 7. Photo Privacy & Gallery Management (FR-4.1 to FR-4.4) -->
        <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>🔒</span>
                <span>Photo Privacy Controls & Gallery Uploads (Up to 6)</span>
            </h2>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1 text-xs">Three-Tier Photo Privacy (FR-4.2)</label>
                <select name="photo_privacy" class="w-full sm:w-1/2 px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                    <option value="blur_until_mutual" {{ $profile->photo_privacy == 'blur_until_mutual' ? 'selected' : '' }}>
                        Blurred until mutual interest accepted (Default for female candidates)
                    </option>
                    <option value="public" {{ $profile->photo_privacy == 'public' ? 'selected' : '' }}>
                        Fully Public (Visible to all registered seekers)
                    </option>
                    <option value="restricted" {{ $profile->photo_privacy == 'restricted' ? 'selected' : '' }}>
                        Restricted (Explicit grant per user required)
                    </option>
                </select>
                <p class="text-[11px] text-gray-500 mt-1">
                    Automatic server-side Gaussian blur prevents photo leakage to non-consenting parties.
                </p>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1 text-xs">Upload Additional Gallery Photographs</label>
                <input type="file" name="photos[]" multiple accept="image/*" class="w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:gold-gradient file:text-white hover:file:opacity-90">
            </div>

            <!-- Existing photos list -->
            @if($photos->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-6 gap-3 pt-3">
                @foreach($photos as $p)
                <div class="relative group rounded-xl overflow-hidden border border-gray-200 h-28 bg-gray-50">
                    <img src="{{ asset($p->photo_path) }}" alt="Photo" class="w-full h-full object-cover">
                    @if($p->is_primary)
                    <span class="absolute top-1 left-1 bg-amber-400 text-black text-[9px] font-extrabold px-1.5 py-0.5 rounded">Primary</span>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- 8. Selective Field-Level Masking (FR-12.3) -->
        <div class="bg-amber-50/70 rounded-2xl p-6 border border-amber-200/90 space-y-3 text-xs">
            <h3 class="font-heading font-bold text-sm text-amber-950 uppercase tracking-wider">
                🛡️ Selective Field-Level Masking Controls (FR-12.3)
            </h3>
            <p class="text-gray-600">
                You may choose to hide sensitive financial or caste details from initial search results.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="mask_income" value="1" {{ $profile->mask_income ? 'checked' : '' }} class="rounded text-red-900 focus:ring-red-800">
                    <span>Mask Annual Income from general search</span>
                </label>

                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="mask_gotra" value="1" {{ $profile->mask_gotra ? 'checked' : '' }} class="rounded text-red-900 focus:ring-red-800">
                    <span>Mask Gotra until mutual interest</span>
                </label>

                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="mask_caste" value="1" {{ $profile->mask_caste ? 'checked' : '' }} class="rounded text-red-900 focus:ring-red-800">
                    <span>Mask Caste ("Caste No Bar" badge)</span>
                </label>
            </div>
        </div>

        <!-- Save Button -->
        <button type="submit" class="w-full py-3.5 rounded-xl gold-gradient text-white font-bold text-sm shadow-md hover:opacity-95 transition">
            Save & Update Biodata
        </button>
    </form>

    <!-- Account Lifecycle Controls (FR-12.2) -->
    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm space-y-4">
        <h3 class="font-heading font-bold text-sm text-gray-800 uppercase tracking-wider">Account Lifecycle & Privacy Erasure (FR-12.2)</h3>
        <p class="text-xs text-gray-500">
            In compliance with DPDP Act 2023 and GDPR privacy codes, you maintain full control over your biodata lifecycle.
        </p>

        <div class="flex flex-wrap gap-4 pt-2">
            <form method="POST" action="{{ route('profile.deactivate') }}" onsubmit="return confirm('Are you sure you want to temporarily deactivate your profile? You will be hidden from discovery until you sign in again.')">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-xl border border-amber-300 text-amber-900 hover:bg-amber-50 text-xs font-semibold">
                    Temporarily Deactivate Profile
                </button>
            </form>

            <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('WARNING: This permanently erases all biodata, photos, proposals, and logs. This action is irreversible.')">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-xl bg-red-100 text-red-900 hover:bg-red-200 text-xs font-bold">
                    Permanently Delete Account & Data
                </button>
            </form>
        </div>
    </div>
</div>
@endsection


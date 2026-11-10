<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Physical & Personal
            'height_cm' => ['nullable', 'integer', 'min:120', 'max:230'],
            'weight_kg' => ['nullable', 'integer', 'min:35', 'max:200'],
            'complexion' => ['nullable', 'string', 'max:50'],
            'mother_tongue' => ['nullable', 'string', 'max:100'],
            'citizenship' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'marital_status' => ['nullable', 'in:never_married,divorced,widowed,annulled'],
            'dependent_children' => ['nullable', 'integer', 'min:0'],

            // Education & Profession
            'qualification_level' => ['nullable', 'string', 'max:100'],
            'education_detail' => ['nullable', 'string', 'max:1000'],
            'profession' => ['nullable', 'string', 'max:100'],
            'organization_type' => ['nullable', 'string', 'max:100'],
            'annual_income_range' => ['nullable', 'string', 'max:100'],

            // Religion & Lineage
            'religion' => ['nullable', 'string', 'max:50'],
            'sampradaya' => ['nullable', 'string', 'max:50'],
            'caste_jati' => ['nullable', 'string', 'max:100'],
            'sub_caste' => ['nullable', 'string', 'max:100'],
            'caste_no_bar' => ['nullable', 'boolean'],
            'gotra' => ['nullable', 'string', 'max:100'],
            'nanihal_gotra' => ['nullable', 'string', 'max:100'],

            // Lifestyle & Habits
            'diet' => ['nullable', 'in:vegetarian,eggetarian,non_vegetarian,jain,vegan'],
            'smoking' => ['nullable', 'in:never,occasionally,regularly'],
            'alcohol' => ['nullable', 'in:never,occasionally,regularly'],

            // Spiritual Practice
            'puja_frequency' => ['nullable', 'string', 'max:50'],
            'temple_visits' => ['nullable', 'string', 'max:100'],
            'fasting_vrata' => ['nullable', 'string', 'max:100'],
            'scripture_study' => ['nullable', 'string', 'max:100'],
            'guru_lineage' => ['nullable', 'string', 'max:100'],
            'tilak_preference' => ['nullable', 'string', 'max:100'],
            'post_marriage_customs' => ['nullable', 'string', 'max:100'],

            // Family
            'family_structure' => ['nullable', 'in:nuclear,joint'],
            'family_values' => ['nullable', 'in:traditional,moderate,liberal'],
            'father_occupation' => ['nullable', 'string', 'max:100'],
            'mother_occupation' => ['nullable', 'string', 'max:100'],
            'brothers_count' => ['nullable', 'integer', 'min:0'],
            'sisters_count' => ['nullable', 'integer', 'min:0'],
            'living_arrangements_preference' => ['nullable', 'string', 'max:50'],
            'native_ancestry' => ['nullable', 'string', 'max:150'],

            // Bio & Preferences
            'about_me' => ['nullable', 'string', 'max:2500'],
            'partner_preferences_bio' => ['nullable', 'string', 'max:2500'],

            // Privacy & Masking Controls
            'mask_income' => ['nullable', 'boolean'],
            'mask_gotra' => ['nullable', 'boolean'],
            'mask_caste' => ['nullable', 'boolean'],
            'photo_privacy' => ['nullable', 'in:public,blur_until_mutual,restricted'],

            // Photos upload
            'photos' => ['nullable', 'array', 'max:6'],
            'photos.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // 5MB max per image
        ];
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'caste_no_bar' => 'boolean',
        'mask_income' => 'boolean',
        'mask_gotra' => 'boolean',
        'mask_caste' => 'boolean',
        'mask_kundli' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateCompleteness(): int
    {
        $fields = [
            $this->height_cm,
            $this->city,
            $this->qualification_level,
            $this->profession,
            $this->annual_income_range,
            $this->religion,
            $this->sampradaya,
            $this->gotra,
            $this->diet,
            $this->puja_frequency,
            $this->family_structure,
            $this->father_occupation,
            $this->about_me,
            $this->partner_preferences_bio,
        ];

        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($field)) {
                $filled++;
            }
        }

        $pct = (int) round(($filled / count($fields)) * 100);
        $this->update(['profile_completeness_pct' => $pct]);
        return $pct;
    }
}


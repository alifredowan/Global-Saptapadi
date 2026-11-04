<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerPreference extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'marital_status' => 'array',
        'religions' => 'array',
        'sampradayas' => 'array',
        'dietary_preferences' => 'array',
        'preferred_cities' => 'array',
        'preferred_education' => 'array',
        'caste_no_bar' => 'boolean',
        'gotra_exclusion' => 'boolean',
        'nanihal_gotra_exclusion' => 'boolean',
        'min_guna_milan_score' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


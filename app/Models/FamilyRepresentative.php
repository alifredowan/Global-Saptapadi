<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyRepresentative extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function seekerUser()
    {
        return $this->belongsTo(User::class, 'seeker_user_id');
    }

    public function representativeUser()
    {
        return $this->belongsTo(User::class, 'rep_user_id');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VivahMilestone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'wedding_date' => 'date',
        'published_to_stories' => 'boolean',
        'confirmed_at' => 'datetime',
    ];

    public function spouseA()
    {
        return $this->belongsTo(User::class, 'spouse_a_user_id');
    }

    public function spouseB()
    {
        return $this->belongsTo(User::class, 'spouse_b_user_id');
    }
}


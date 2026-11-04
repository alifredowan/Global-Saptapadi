<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactExchangeRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'user_a_consent' => 'boolean',
        'user_b_consent' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function userA()
    {
        return $this->belongsTo(User::class, 'user_a_id');
    }

    public function userB()
    {
        return $this->belongsTo(User::class, 'user_b_id');
    }
}


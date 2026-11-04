<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'activity_date' => 'date',
        'interests_sent_count' => 'integer',
        'profiles_viewed_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


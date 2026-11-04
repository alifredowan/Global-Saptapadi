<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kundli extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'birth_date' => 'date',
        'charan' => 'integer',
        'horoscope_opt_out' => 'boolean',
        'chart_verified_by_pandit' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoAccessGrant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'granted_at' => 'datetime',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function grantee()
    {
        return $this->belongsTo(User::class, 'grantee_user_id');
    }
}


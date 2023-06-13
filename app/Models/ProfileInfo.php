<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum',
        'profile_pic',
        'phone_number',
        'services',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

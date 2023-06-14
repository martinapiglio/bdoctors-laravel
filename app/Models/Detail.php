<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
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

    public function specs()
    {
        return $this->belongsToMany(Spec::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;
    
    public function details()
    {
        return $this->belongsToMany(Detail::class)->withPivot('start_date', 'end_date');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferenceFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'about',
        'capacity',
        'price',
        'image'
    ];
}

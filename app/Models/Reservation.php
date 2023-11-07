<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'facility_id',
        'reference_number',
        'source',
        'client_name',
        'client_id',
        'client_country',
        'client_phone',
        'check_in',
        'check_out',
        'status',
        'total_cost',
    ];
}

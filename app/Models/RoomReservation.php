<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomReservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference_number',
        'source',
        'guest_name',
        'guest_id',
        'country',
        'phone',
        'room_id',
        'check_in',
        'check_out',
        'time_in',
        'time_out',
        'special_requests',
        'status',
        'total_cost',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

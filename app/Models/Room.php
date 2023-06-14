<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'number',
        'name',
        'description',
        'adults',
        'children',
        'price',
        'image',
        'status',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type');
    }

    public function reservations()
    {
        return $this->hasMany(RoomReservation::class);
    }
}

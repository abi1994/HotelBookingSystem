<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Booking;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

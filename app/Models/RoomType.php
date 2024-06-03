<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'capacity', 'description'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

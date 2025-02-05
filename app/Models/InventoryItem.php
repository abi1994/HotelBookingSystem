<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['item_name', 'quantity', 'room_id', 'description'];



    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}


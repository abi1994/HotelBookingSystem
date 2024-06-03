<?php

namespace App\Models;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'selected_customer_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'total_adults',
        'total_children',
        'checkin_date',
        'checkout_date',
        'ref',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'selected_customer_id');
    }
}

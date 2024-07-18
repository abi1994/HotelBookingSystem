<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id', 'user_id', 'response',
    ];

    public function contact() {
        return $this->belongsTo(Contact::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}


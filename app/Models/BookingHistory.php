<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;
    protected $table = 'booking_histories';
    protected $fillable = [
        'guest_id','mode','nights','arrival','room_category_id','room_id'
    ];
}

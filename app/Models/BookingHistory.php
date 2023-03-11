<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;
    protected $table = 'booking_histories';
    protected $fillable = [
        'uuid','mode','nights','arrival','room_category_id','room_id',
        'firstname','lastname','email','phone','address','title','gender','departure',
    ];

    protected $casts = [
        'arrival' => 'date',
        'departure' => 'date'
    ];

    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

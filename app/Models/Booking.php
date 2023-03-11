<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_id','mode','nights','arrival','room_category_id','room_id','departure',
        'payment_done',
    ];
    protected $casts = [
        'arrival' => 'date'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
    public function scopeSearch($query,$term)
    {
        $searchTerm = "%$term%";
        return $query->with('guest')
            ->where('mode','LIKE',$searchTerm)
            ->orWhere('arrival','LIKE',$searchTerm)
            ->orWhereHas('guest', function ($q) use ($searchTerm){
                $q->where('firstname','LIKE',$searchTerm)
                    ->orWhere('lastname','LIKE',$searchTerm)
                    ->orWhere('email','LIKE',$searchTerm)
                    ->orWhere('address','LIKE',$searchTerm);
            })->orWhereHas('room', function ($q1) use ($searchTerm){
                $q1->where('room_number','LIKE',$searchTerm)
                    ->orWhere('title','LIKE',$searchTerm)
                    ->orWhere('is_available','LIKE',$searchTerm);
            })->orWhereHas('room_category', function ($q2) use ($searchTerm){
                $q2->where('name','LIKE',$searchTerm)
                    ->orWhere('description','LIKE',$searchTerm);
            });
    }

}

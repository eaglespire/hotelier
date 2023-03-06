<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','description','room_number',
        'is_available','is_clean','extra','price','room_category_id','first_image','second_image','third_image',
        'fourth_image','fifth_image','sixth_image','meta_title','meta_description','meta_keywords'
    ];

    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'room_tag');
    }
    public function features()
    {
        return $this->belongsToMany(Feature::class,'feature_room');
    }
}

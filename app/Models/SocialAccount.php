<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','fb','wh','lk','tw','in'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

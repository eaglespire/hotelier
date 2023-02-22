<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\Concerns\HasRoles;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','staff_number','photo','street','city','state','country','zip',
        'dob','doe','age','gender','role',
    ];

    protected $casts = [
        'doe' => 'date',
        'dob' => 'date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $emailExists = User::where('email',$row[2])->exists();
        $email = Str::lower(Str::random(8)).'@mail.com';
        return new User([
            'firstname' => $row[0],
            'lastname' => $row[1],
            'email' => $emailExists ? $email : $row[2],
            'password' => Hash::make('password'),
            'slug' => Str::slugger($emailExists ? $email : $row[2])
        ]);

    }



}

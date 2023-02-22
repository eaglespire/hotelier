<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'password' => Hash::make('moderator'),
            'email' => 'moderator@site.test',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => md5('moderator@site.test'),
            'status' => true
        ]);
        DB::table('users')->insert([
            'firstname' => 'Mike',
            'lastname' => 'Novick',
            'password' => Hash::make('password'),
            'email' => 'mike@site.test',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => md5('mike@site.test')
        ]);
        DB::table('users')->insert([
            'firstname' => 'Selena',
            'lastname' => 'Kyle',
            'password' => Hash::make('password'),
            'email' => 'selena234@site.test',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => md5('selena234@site.test')
        ]);
    }
}

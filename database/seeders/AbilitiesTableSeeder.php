<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Bouncer;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'ban-users',
            'title' => 'Ban users',
        ]);
        $access_staff = Bouncer::ability()->firstOrCreate([
            'name' => 'access-staff',
            'title' => 'Access Staff',
        ]);
        $alter_staff = Bouncer::ability()->firstOrCreate([
            'name' => 'alter-staff',
            'title' => 'Alter Staff',
        ]);
        $access_users = Bouncer::ability()->firstOrCreate([
            'name' => 'access-users',
            'title' => 'Access Users',
        ]);
        $alter_users = Bouncer::ability()->firstOrCreate([
            'name' => 'alter-users',
            'title' => 'Alter Users',
        ]);
    }
}

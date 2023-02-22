<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Bouncer;



class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moderator = Bouncer::role()->firstOrCreate([
            'name' => 'moderator',
            'title' => 'Moderator',
        ]);
        $visitor = Bouncer::role()->firstOrCreate([
            'name' => 'visitor',
            'title' => 'Visitor',
        ]);
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);
        $manager = Bouncer::role()->firstOrCreate([
            'name' => 'manager',
            'title' => 'Manager',
        ]);
        $accountant = Bouncer::role()->firstOrCreate([
            'name' => 'accountant',
            'title' => 'Accountant',
        ]);
        $receptionist = Bouncer::role()->firstOrCreate([
            'name' => 'receptionist',
            'title' => 'Receptionist',
        ]);
    }
}

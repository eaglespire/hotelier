<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::create([
            'name' => 'Home Page 1',
            'slug' => 'home-page-1'
        ]);
        Template::create([
            'name' => 'Home Page 2',
            'slug' => 'home-page-2'
        ]);
        Template::create([
            'name' => 'Home Page 3',
            'slug' => 'home-page-3'
        ]);
        Template::create([
            'name' => 'Home Page 4',
            'slug' => 'home-page-4'
        ]);
    }
}

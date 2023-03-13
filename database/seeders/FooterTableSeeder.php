<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Footer::create([
            'header_type' => 'text',
            'title' => 'lorem ipsum',
            'header' => 'Header 1',
            'column' => 'one'
        ]);
        Footer::create([
            'header_type' => 'text',
            'title' => 'lorem ipsum',
            'header' => 'Header 2',
            'column' => 'Two'
        ]);
        Footer::create([
            'header_type' => 'text',
            'title' => 'lorem ipsum',
            'header' => 'Header 3',
            'column' => 'Three'
        ]);
        Footer::create([
            'is_newsletter' => true,
            'newsletter_text' => 'lorem ipsum',
            'newsletter_placeholder' => 'lorem ipsum',
            'column' => 'Four'
        ]);
    }
}

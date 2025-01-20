<?php

namespace Database\Seeders;

use App\Models\Header;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HeaderSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Header::create([
            'user_id' => 1,
            'template_id'=>1,
            'home_url' => '/',
            'logo_text' => 'HELLO WORLD',
            'menu_links' => json_encode([
                ['url' => '#home', 'text' => 'Home'],
                ['url' => '#about-us', 'text' => 'About Us'],
                ['url' => '#service', 'text' => 'Services'],
                ['url' => '#blog', 'text' => 'Blog'],
                ['url' => '#contact-us', 'text' => 'Contact Us']
            ]),
            'social_links' => json_encode([
                ['url' => 'https://facebook.com', 'icon' => 'fa fa-facebook'],
                ['url' => 'https://twitter.com', 'icon' => 'fa fa-twitter'],
                ['url' => 'https://instagram.com', 'icon' => 'fa fa-instagram'],
                ['url' => 'https://youtube.com', 'icon' => 'fa fa-youtube-play']
            ]),
            'phone_number' => '+91 9330613955'
        ]);
    }
}

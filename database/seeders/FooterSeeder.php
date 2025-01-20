<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Footer::create([
            'user_id' => 1,
            'template_id' => 472,
            'about_us_title' => 'About Us',
            'about_us_text' => 'Welcome to our website! We are dedicated to providing top-notch services to our customers.',
            'footer_logo' => 'https://example.com/logo.png', // Replace with your logo URL
            'email' => 'info@yourdomain.com',
            'phone' => '+91 9876543210',
            'address' => '123 Your Street, Your City, Your Country',
            'useful_links' => json_encode([
                ['text' => 'Home', 'url' => '/home'],
                ['text' => 'About', 'url' => '/about'],
                ['text' => 'Services', 'url' => '/services'],
                ['text' => 'Contact', 'url' => '/contact'],
            ]),
            'social_links' => json_encode([
                ['icon' => 'fa fa-facebook', 'url' => 'https://facebook.com'],
                ['icon' => 'fa fa-twitter', 'url' => 'https://twitter.com'],
                ['icon' => 'fa fa-linkedin', 'url' => 'https://linkedin.com'],
            ]),
            'footer_text' => 'Developed by:',
            'developer_name' => 'Your Developer Name',
            'developer_link' => 'https://developer-website.com',
        ]);

    }
}

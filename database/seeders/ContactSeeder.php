<?php

namespace Database\Seeders;


use App\Models\ContactTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       ContactTemplate::create([
            'user_id' => 1,
            'template_id' => 1,
            'company_name' => 'Your Company Name',
            'cin_no' => 'ABC123XYZ',
            'registration_no' => '123456789',
            'address' => '123, Main Street, City, Country',
            'email' => 'info@yourdomain.com',
            'phone' => '+91 9876543210',
            'map_embed_url' => 'https://www.google.com/maps/embed?...',
        ]);
    }
}

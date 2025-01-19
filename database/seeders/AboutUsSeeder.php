<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Example user and template IDs
       $userId = 1; // Replace with a valid user ID from your database
       $templateId = 1; // Replace with a valid template ID from your database

       DB::table('about_us')->insert([
           [
               'user_id' => $userId,
               'template_id' => $templateId,
               'our_story' => 'We started our journey to provide the best pest control solutions in the industry.',
               'mission' => 'To create a pest-free environment for all our clients.',
               'vision' => 'To be the most trusted name in pest management across the globe.',
               'image_path' => 'https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
               'created_at' => now(),
               'updated_at' => now(),
           ],
       ]);

    }
}

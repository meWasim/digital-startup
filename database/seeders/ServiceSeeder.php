<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run()
    {
        // Example user and template IDs
        $userId = 1; // Replace with a valid user ID from your database
        $templateId = 1; // Replace with a valid template ID from your database

        DB::table('services')->insert([
            [
                'user_id' => $userId,
                'template_id' => $templateId,
                'title' => 'Pest Control',
                'subtitle' => 'Safe and Effective Pest Solutions',
                'image_path' => 'https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'extra_class' => 'pest-control',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'template_id' => $templateId,
                'title' => 'Termite Treatment',
                'subtitle' => 'Protect Your Home from Termites',
                'image_path' => 'https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'extra_class' => 'termite-treatment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'template_id' => $templateId,
                'title' => 'Rodent Control',
                'subtitle' => 'Efficient Rodent Management',
                'image_path' => 'https://plus.unsplash.com/premium_photo-1683865776032-07bf70b0add1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'extra_class' => 'rodent-control',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}

<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Testimonial::factory()->count(20)->create();;
    }
}

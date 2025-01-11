<?php

namespace Database\Factories;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feature>
 */
class FeatureFactory extends Factory
{
    protected $model = Feature::class;

    public function definition()
    {
        return [
            'user_id' => 1, // Replace with a valid user ID or use a random one
            'template_id' => 472, // Replace with a valid template ID
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'image_path' => 'https://plus.unsplash.com/premium_vector-1730726594747-ce94f7980cd3?q=80&w=1800&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Use a default or fake image path
        ];
    }
}

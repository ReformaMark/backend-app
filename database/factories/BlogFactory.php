<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class BlogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => User::factory(), // creates a user if none exists
            'image' => null, // optional, you can add fake image paths if needed
        ];
    }
}

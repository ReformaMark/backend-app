<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;

class BlogsSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure at least one user exists
        $user = User::first() ?? User::factory()->create();

        // Create 50 blogs tied to that user
        Blog::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);
    }
}

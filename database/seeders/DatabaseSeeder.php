<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Raiden',
            'email' => 'cool@example.com',
            'image' => 'images/defaults/dummy.svg',
            'cimage' => 'images/defaults/not found.jpg',
            'bio' => 'Cool user is very cool & legend bio'
        ]);
        User::factory()->create([
            'name' => 'Peter',
            'email' => 'test@example.com',
            'image' => 'images/defaults/dummy.svg',
            'cimage' => 'images/defaults/not found.jpg',
            'bio' => 'Test user very cool & legend bio'
        ]);
        User::factory()->create([
            'name' => 'Venom',
            'email' => 'test1@example.com',
            'image' => 'images/defaults/dummy.svg',
            'cimage' => 'images/defaults/not found.jpg',
            'bio' => 'Test user 1 very cool & legend bio'
        ]);
        User::factory()->create([
            'name' => 'Ryo',
            'email' => 'test2@example.com',
            'image' => 'images/defaults/dummy.svg',
            'cimage' => 'images/defaults/not found.jpg',
            'bio' => 'Test user 2 very cool & legend bio'
        ]);

        $categories = ['All', 'Translearner', 'Technology', 'Sport', 'Science', 'Politics', 'Entertainment'];
        foreach ($categories as $category) {
          Category::create(['name' => $category]);
        };

        // Post::factory(10)->create();
    }
}

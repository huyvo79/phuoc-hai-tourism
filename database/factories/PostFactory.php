<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence(6);
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'summary' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(5, true),
            'thumbnail' => 'https://picsum.photos/640/480?random=' . rand(1, 1000),
            'priority' => rand(0, 10),
            'latitude' => $this->faker->latitude(10.3, 10.9),
            'longitude' => $this->faker->longitude(106.5, 107.2),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
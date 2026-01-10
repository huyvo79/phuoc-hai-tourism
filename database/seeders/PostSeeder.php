<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::factory()->count(50)->create()->each(function ($post) {
            $relatedPosts = Post::where('id', '!=', $post->id)
                ->inRandomOrder()
                ->take(3)
                ->pluck('id');
            
            $post->relatedPosts()->attach($relatedPosts);
        });
    }
}
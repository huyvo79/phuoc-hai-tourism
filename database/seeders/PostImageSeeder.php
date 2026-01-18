<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostImage;
use App\Models\Post;

class PostImageSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();

        if ($posts->isEmpty()) {
            $this->command->info('Không có posts nào, tạo posts trước...');
            $this->call(PostSeeder::class);
            $posts = Post::all();
        }

        foreach ($posts as $post) {
            $imageCount = rand(1,1 );

            for ($i = 0; $i < $imageCount; $i++) {
                PostImage::factory()->create([
                    'post_id' => $post->id,
                ]);
            }
        }

        $this->command->info('Đã tạo ' . PostImage::count() . ' hình ảnh cho bài viết.');
    }
}
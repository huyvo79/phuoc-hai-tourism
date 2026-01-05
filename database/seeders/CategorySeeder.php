<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Chưa phân loại', 
            ],
            [
                'id' => 2,
                'name' => 'Du lịch',
            ],
            [
                'id' => 3,
                'name' => 'Ẩm thực',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['id' => $cat['id']], 
                [
                    'name' => $cat['name'],
                    'slug' => Str::slug($cat['name']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
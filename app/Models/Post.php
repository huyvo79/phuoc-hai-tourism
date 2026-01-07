<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'slug', 
        'summary', 
        'content', 
        'thumbnail', 
        'priority', 
        'category_id',
        'latitude', 
        'longitude' 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function relatedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_related', 'post_id', 'related_post_id');
    }
}
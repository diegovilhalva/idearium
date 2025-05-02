<?php

  

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
        'image',
        'published_at',
    ];

    
    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug)) {
               $post->slug = Str::slug($post->title) . '-' . uniqid();

            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function readTime($wordsPerMinute = 200)
    {
        $wordCount =str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / $wordsPerMinute);

        return $minutes;
    }
}


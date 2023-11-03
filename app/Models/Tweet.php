<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    // 134-29
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // 225-06
    public function images()
    {
        return $this->belongsToMany(Image::class, 'tweet_images')
        ->using(TweetImage::class);
    }
}

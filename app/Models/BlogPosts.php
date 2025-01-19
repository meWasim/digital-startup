<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPosts extends Model
{
    protected $table = 'blog_posts';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'user_id',
      'template_id' ,
        'title',
        'content',
        'image_url',
        'published_at',
    ];

    // Optional: Specify the date fields
    protected $dates = ['published_at'];

    // Optional: Use timestamps
    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'about_us_title',
        'about_us_text',
        'footer_logo',
        'email',
        'phone',
        'address',
        'useful_links',
        'social_links',
        'footer_text',
        'developer_name',
        'developer_link',
    ];

    protected $casts = [
        'useful_links' => 'array',
        'social_links' => 'array',
    ];
}

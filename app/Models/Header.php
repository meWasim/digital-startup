<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{

    protected $table = 'header';
    protected $fillable = [
        'user_id','template_id',
        'home_url', 'logo_text', 'menu_links', 'social_links', 'phone_number'
    ];

    protected $casts = [
        'menu_links' => 'array',
        'social_links' => 'array',
    ];
}

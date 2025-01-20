<?php

namespace App\Models;

use App\Models\User;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'user_id',
        'template_id', // Fillable for template_id
        'our_story',
        'mission',
        'vision',
        'image_path',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'template_id',
        'title',
        'description',
        'image_path',
    ];

    /**
     * Get the user that owns the feature.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the template associated with the feature.
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'template_id',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Template model
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}

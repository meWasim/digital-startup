<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'company_name',
        'website_url',
        'project_budget',
        'services',
        'image',
    ];

    protected $casts = [
        'services' => 'array',
    ];
}

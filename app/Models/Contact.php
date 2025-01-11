<?php

namespace App\Models;

use App\Models\User;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'company_name',
        'cin_no',
        'registration_no',
        'address',
        'email',
        'phone',
        'map_embed_url',
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

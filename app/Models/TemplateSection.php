<?php

namespace App\Models;

use App\Models\Template;
use Illuminate\Database\Eloquent\Model;

class TemplateSection extends Model
{
    protected $fillable = ['template_id', 'section_name', 'content', 'image','user_id'];

    // Relationship to Template
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}

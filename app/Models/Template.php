<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name', 'folder', 'thumbnail', 'description'];


    public function carts()
{
    return $this->hasMany(Cart::class);
}
}

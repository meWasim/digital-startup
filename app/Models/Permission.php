<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'guard_name', 'description'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define relationships (if needed).
     */
    // Example: Permissions belong to many roles (many-to-many relationship)

    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }

    /**
     * If you want to scope by guard_name, you can add the following:
     */
    public function scopeWebGuard($query)
    {
        return $query->where('guard_name', 'web');
    }
}

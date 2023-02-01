<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permissions');
    }

    public function child()
    {
        return $this->hasMany(Self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Self::class, 'parent_id', 'id');
    }

    public function scopeParent($query)
    {
        return $query->whereParentId(0);
    }
}
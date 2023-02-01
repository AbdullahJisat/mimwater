<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(Admin::class, 'users_roles');
    }

    /**
     * Get all of the permissionRoles for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissionRoles()
    {
        return $this->hasMany(Permission::class);
    }
}

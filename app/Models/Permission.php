<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * @desc JOIN  ke table Role_Permission
     */
    public function roles()
    {

        return $this->belongsToMany(Role::class, 'roles_permissions');
    }


    /**
     * @desc JOIN  ke table User_Role
     */
    public function users()
    {

        return $this->belongsToMany(User::class, 'users_permissions');
    }
}

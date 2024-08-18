<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Permission extends Model
{
    use HasFactory;
    protected $table = "permissions";

    // Define the inverse relationship if needed
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role-permissions', 'permission_id', 'role_id');
    }
    

    // public static function hasPermission($slug, $role_id)
    // {
    //     return self::where('slug', $slug)
    //                 ->whereHas('roles', function($query) use ($role_id) {
    //                     $query->where('role_id', $role_id);
    //                 })
    //                 ->exists();
    // }

    public static function hasPermission($slug, $role_id)
    {
        return cache()->remember("role_{$role_id}_permission_{$slug}", 60, function () use ($slug, $role_id) {
            return self::where('slug', $slug)
                ->whereHas('roles', function ($query) use ($role_id) {
                    $query->where('role_id', $role_id);
                })
                ->exists();
        });
    }
    
}


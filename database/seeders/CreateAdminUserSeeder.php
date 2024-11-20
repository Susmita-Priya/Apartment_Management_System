<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'susmita@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $role = Role::create(['name' => 'Super Admin']);

        $permissions = Permission::pluck('id')->toArray();

        foreach ($permissions as $permissionId) {
            DB::table('role-permissions')->insert([
                'role_id' => $role->id,
                'permission_id' => $permissionId,
            ]);
        }
    

        DB::table('users')->update([
            'role_id' => $role->id,
        ]);

    }
}

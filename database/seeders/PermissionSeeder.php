<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            //For User
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

              //For roll and permission
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

             //For Role and permission
            'role-and-permission-list',


            //dashboard
            'dashboard',


            //add new
            'add-new',


            //property management

            'property-management',

            'building-list',
            'building-create',
            'building-edit',
            'building-delete',
            'building-view',


            'block-list',
            'block-create',
            'block-edit',
            'block-delete',
            'block-view',


            'floor-list',
            'floor-create',
            'floor-edit',
            'floor-delete',
            'floor-view',


            'unit-list',
            'unit-create',
            'unit-edit',
            'unit-delete',
            'unit-view',


            'common-area-list',
            'common-area-create',
            'common-area-edit',
            'common-area-delete',
            'common-area-view',


            // parking management

            'parking-management',

            'vehicle-list',
            'vehicle-create',
            'vehicle-edit',
            'vehicle-delete',
            'vehicle-assign',


            'parker-list',
            'parker-create',
            'parker-edit',
            'parker-delete',
            'parker-assign',


            'stall-list',
            'stall-create',
            'stall-edit',
            'stall-delete',
            'stall-view',
            'stall-assign-vehicle-parker',


            //tenant management

            'tenant-management',

            'tenant-list',
            'tenant-create',
            'tenant-edit',
            'tenant-delete',
            'tenant-view',
            'tenant-view-unit',

            //landlord management

            'landlord-management',

            'landlord-list',
            'landlord-create',
            'landlord-edit',
            'landlord-delete',
            'landlord-view',
            'landlord-view-unit',


            //access control

            'access-control',

        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
 
    }
}

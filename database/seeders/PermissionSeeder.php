<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //user management

            'list-user',
            'create-user',
            'edit-user',
            'delete-user',
            'view-user',

            'list-role',
            'create-role',
            'edit-role',
            'delete-role',
            'view-role',

            'assign-permission',


            //dashboard

            'dashboard',


            //add new

            'add-new',


            //property management

            'property-management',

            'list-building',
            'create-building',
            'edit-building',
            'delete-building',
            'enter-building',

            'list-block',
            'create-block',
            'edit-block',
            'delete-block',
            'view-block',

            'list-floor',
            'create-floor',
            'edit-floor',
            'delete-floor',
            'view-floor',

            'list-unit',
            'create-unit',
            'edit-unit',
            'delete-unit',
            'view-unit',

            'list-common-area',
            'create-common-area',
            'edit-common-area',
            'delete-common-area',
            'view-common-area',


            // parking management

            'parking-management',

            'create-vehicle',
            'edit-vehicle',
            'delete-vehicle',
            'assign-vehicle',

            'create-parker',
            'edit-parker',
            'delete-parker',
            'assign-parker',

            'create-stall',
            'edit-stall',
            'delete-stall',
            'view-stall',
            'assign-vehicle-parker',


            //tenant management

            'tenant-management',

            'list-tenant',
            'create-tenant',
            'edit-tenant',
            'delete-tenant',
            'view-tenant',
            'view-tenant-unit',


            //landlord management

            'landlord-management',

            'list-landlord',
            'create-landlord',
            'edit-landlord',
            'delete-landlord',
            'view-landlord',
            'view-landlord-unit',


            //access control

            'access-control',

        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission, 'guard_name' => 'web'], // Unique identifier
                ['created_at' => now(), 'updated_at' => now()]   // Additional fields
            );
        }
 
    }
}

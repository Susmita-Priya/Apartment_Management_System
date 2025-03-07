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
            
            //access control
            'access-control',

            //For User
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',


            //For role
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',


            //dashboard
            'dashboard',


            //add new
            'add-new',


            // Pendending Request

            'pending-request-list',
            'building-request',
            'building-request-approve',
            'building-request-reject',
            'building-reject-list',
            'building-reject',


            //property management

            'property-management',

            'building-list',
            'building-create',
            'building-edit',
            'building-delete',
            'building-view',


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


            'room-type-management',
            'room-type-list',
            'room-type-create',
            'room-type-edit',
            'room-type-delete',

            
            'room-list',
            'room-view',
            'room-create',
            'room-edit',
            'room-delete',


            'stall-list',
            'stall-create',
            'stall-edit',
            'stall-delete',
            'stall-view',

            
            //common area management
            'common-area-management',

            'common-area-list',
            'common-area-create',
            'common-area-edit',
            'common-area-delete',
            'common-area-view',


            'amenities-management',

            'amenities-list',
            'amenities-create',
            'amenities-edit',
            'amenities-delete',
            'amenities-view',

            

            // parking management

            'parking-management',

            'stall-list',
            'stall-create',
            'stall-edit',
            'stall-delete',
            'stall-view',


            'vehicle-type-management',
            'vehicle-type-list',
            'vehicle-type-create',
            'vehicle-type-edit',
            'vehicle-type-delete',
            

            'vehicle-list',
            'vehicle-create',
            'vehicle-edit',
            'vehicle-delete',
            'vehicle-view',


            'parker-list',
            'parker-create',
            'parker-edit',
            'parker-delete',
            'parker-assign',


            //tenant management

            'tenant-management',
            'tenant-list',
            'tenant-create',
            'tenant-edit',
            'tenant-delete',
            'tenant-view',
            'tenant-registration',

            //tenant agreement

            'tenant-agreement-list',
            'tenant-agreement-create',
            'tenant-agreement-delete',
            'tenant-agreement-pending',
            'agreement-request-approve',
            'agreement-request-reject',
            'tenant-agreement-reject',


            //landlord management

            'landlord-management',
            'landlord-list',
            'landlord-create',
            'landlord-edit',
            'landlord-delete',
            'landlord-view',
            'landlord-registration',
            'landlord-agreement-create',


            //landlord agreement

            'landlord-agreement-management',
            'landlord-agreement-list',
            'landlord-agreement-create',
            'landlord-agreement-edit',
            'landlord-agreement-delete',
            'landlord-agreement-view',


            //service management

            'service-management',
            'service-list',
            'service-create',
            'service-edit',
            'service-delete',
            'service-view',


            //service holder management

            'service-holder-management',
            'service-holder-list',
            'service-holder-create',
            'service-holder-edit',
            'service-holder-delete',
            'service-holder-view',


            //maintenance management

            'maintenance-management',
            'maintenance-request',
            'maintenance-list',
            'maintenance-create',
            'maintenance-edit',
            'maintenance-delete',
            'maintenance-view',


        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
 
    }
}

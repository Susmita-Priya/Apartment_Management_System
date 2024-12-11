<?php

  
use App\Http\Controllers\HomeController;

use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CommonAreaController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\LeaseRequestController;
use App\Http\Controllers\ParkerController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SaasPlatform\WebsiteController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StallLockerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UnitAssignController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitLandlordController;
use App\Http\Controllers\UnitLeaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Middleware\AdminUserMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [AuthController::class, 'login'])->name("login");
Route::post('login/form/submit', [AuthController::class, 'doLogin'])->name("do_login");
Route::post('/logout', [AuthController::class, 'logout'])->name("logout");


Route::middleware('auth')->group(callback: function () {

        Route::get('/index', [IndexController::class, 'index'])->name("index");


        // Role and User Route
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);



        //building
        Route::get('building/index', [BuildingController::class, 'index'])->name("building");
        Route::get('building/create', [BuildingController::class, 'create'])->name("building.create");
        Route::post('building/create', [BuildingController::class, 'store'])->name("building.store");
        Route::get('building/show/{id}', [BuildingController::class, 'show'])->name("building.show");
        Route::get('building/edit/{id}', [BuildingController::class, 'edit'])->name("building.edit");
        Route::post('building/edit/{id}', [BuildingController::class, 'update'])->name("building.update");
        Route::get('building/delete/{id}', [BuildingController::class, 'destroy'])->name("building.delete");

        Route::get('building/pending', [BuildingController::class, 'pending'])->name("building.pending");
        Route::get('building/approve/{id}', [BuildingController::class, 'approve'])->name("building.approve");
        Route::get('building/reject/{id}', [BuildingController::class, 'reject'])->name("building.reject");



        // //block
        // Route::get('block/index', [BlockController::class, 'index'])->name("block.index");
        // Route::get('block/create', [BlockController::class, 'create'])->name("block.create");
        // Route::post('block/create', [BlockController::class, 'store'])->name("block.store");
        // Route::get('block/show/{id}', [BlockController::class, 'show'])->name("block.show");
        // Route::get('block/edit/{id}', [BlockController::class, 'edit'])->name("block.edit");
        // Route::post('block/edit/{id}', [BlockController::class, 'update'])->name("block.update");
        // Route::get('block/delete/{id}', [BlockController::class, 'destroy'])->name("block.delete");



        //get data using jquery
        // Route::get('/buildings/{id}', [GetController::class, 'getBuildings'])->name('getbuildings');  // get blocks by building id  
        Route::get('/buildings/{buildingId}/floorsno', [GetController::class, 'getFloorsNo']);  // get registered floors no by block id   
        Route::get('/buildings/{buildingId}/floors', [GetController::class, 'getFloors']);  //get floors by block id    
        Route::get('/floors/{floorId}/units', [GetController::class, 'getUnits']);  //get units by floor id
        Route::get('/units/{unitId}/rooms', [GetController::class, 'getRooms']);  //get rooms by unit id
        Route::get('/units/{unitId}/roomsno', [GetController::class, 'getAmenities']);  //get rooms no by unit id
        


        //floor
        Route::get('floor/index', [FloorController::class, 'index'])->name("floor.index");
        Route::get('floor/create', [FloorController::class, 'create'])->name("floor.create");
        Route::post('floor/create', [FloorController::class, 'store'])->name("floor.store");
        Route::get('floor/show/{id}', [FloorController::class, 'show'])->name("floor.show");
        Route::get('floor/edit/{id}', [FloorController::class, 'edit'])->name("floor.edit");
        Route::post('floor/edit/{id}', [FloorController::class, 'update'])->name("floor.update");
        Route::get('floor/delete/{id}', [FloorController::class, 'destroy'])->name("floor.delete");

        
        // unit
        Route::get('unit/index', [UnitController::class, 'index'])->name("unit.index");
        Route::get('unit/create', [UnitController::class, 'create'])->name("unit.create");
        Route::post('unit/create', [UnitController::class, 'store'])->name("unit.store");
        Route::get('unit/show/{id}', [UnitController::class, 'show'])->name("unit.show");
        Route::get('unit/edit/{id}', [UnitController::class, 'edit'])->name("unit.edit");
        Route::post('unit/edit/{id}', [UnitController::class, 'update'])->name("unit.update");
        Route::get('unit/delete/{id}', [UnitController::class, 'destroy'])->name("unit.delete");


        // amenities
        Route::get('amenities/index', [AmenitiesController::class, 'index'])->name("amenities.index");
        Route::get('amenities/create', [AmenitiesController::class, 'create'])->name("amenities.create");
        Route::post('amenities/create', [AmenitiesController::class, 'store'])->name("amenities.store");
        Route::get('amenities/show/{id}', [AmenitiesController::class, 'show'])->name("amenities.show");
        Route::get('amenities/edit/{id}', [AmenitiesController::class, 'edit'])->name("amenities.edit");
        Route::post('amenities/edit/{id}', [AmenitiesController::class, 'update'])->name("amenities.update");
        Route::get('amenities/delete/{id}', [AmenitiesController::class, 'destroy'])->name("amenities.delete");
        


        // room type
        Route::get('roomType/index', [RoomTypeController::class, 'index'])->name("roomType.index");
        Route::get('roomType/create', [RoomTypeController::class, 'create'])->name("roomType.create");
        Route::post('roomType/create', [RoomTypeController::class, 'store'])->name("roomType.store");
        Route::get('roomType/show/{id}', [RoomTypeController::class, 'show'])->name("roomType.show");
        Route::get('roomType/edit/{id}', [RoomTypeController::class, 'edit'])->name("roomType.edit");
        Route::post('roomType/edit/{id}', [RoomTypeController::class, 'update'])->name("roomType.update");
        Route::get('roomType/delete/{id}', [RoomTypeController::class, 'destroy'])->name("roomType.delete");


        //room
        Route::get('room/index', [RoomController::class, 'index'])->name("room.index");
        Route::get('room/create', [RoomController::class, 'create'])->name("room.create");
        Route::post('room/create', [RoomController::class, 'store'])->name("room.store");
        Route::get('room/show/{id}', [RoomController::class, 'show'])->name("room.show");
        Route::get('room/edit/{id}', [RoomController::class, 'edit'])->name("room.edit");
        Route::post('room/edit/{id}', [RoomController::class, 'update'])->name("room.update");
        Route::get('room/delete/{id}', [RoomController::class, 'destroy'])->name("room.delete");



        //common area
        Route::get('commonArea/index', [CommonAreaController::class, 'index'])->name("commonArea.index");
        Route::get('commonArea/create', [CommonAreaController::class, 'create'])->name("commonArea.create");
        Route::post('commonArea/create', [CommonAreaController::class, 'store'])->name("commonArea.store");
        Route::get('commonArea/show/{id}', [CommonAreaController::class, 'show'])->name("commonArea.show");
        Route::get('commonArea/edit/{id}', [CommonAreaController::class, 'edit'])->name("commonArea.edit");
        Route::post('commonArea/edit/{id}', [CommonAreaController::class, 'update'])->name("commonArea.update");
        Route::get('commonArea/delete/{id}', [CommonAreaController::class, 'destroy'])->name("commonArea.delete");








        

        // assign landlord to unit

        Route::get('unit/{id}/assign', [UnitLandlordController::class, 'create'])->name('assign.create');

        Route::post('unit/{id}/assign', [UnitLandlordController::class, 'store'])->name('assign.store');

        Route::get('unit/removeLandlord/{Id}', [UnitLandlordController::class, 'removeLandlord'])->name('landlord.remove');




        Route::post('/lease-request', [LeaseRequestController::class, 'store'])->name('lease-request.store');

        Route::get('/lease-rqst-list', [LeaseRequestController::class, 'index'])->name('lease.index');

        Route::get('/lease-aggrement', [LeaseRequestController::class, 'agreement'])->name('lease.agreement');

        Route::get('/send-aggrement/{id}', [LeaseRequestController::class, 'sendagreement'])->name('send.agreement');

        Route::post('/aggrement-form/{id}', [LeaseRequestController::class, 'agreementform'])->name('agreement.form');

        Route::get('/agreement/download/{id}', [LeaseRequestController::class, 'downloadAgreement'])->name('download.agreement');

        Route::get('/agreement/accept/{id}', [LeaseRequestController::class, 'accept'])->name('agreement.accept');

        Route::get('/agreement/reject/{id}', [LeaseRequestController::class, 'reject'])->name('agreement.reject');






        Route::get('stall/index', [StallLockerController::class, 'index'])->name("stall.index");

        Route::get('stall/create', [StallLockerController::class, 'create'])->name("stall.create");

        Route::post('stall/create', [StallLockerController::class, 'store'])->name("stall.store");

        Route::get('stall/show/{id}', [StallLockerController::class, 'show'])->name("stall.show");

        Route::get('stall/edit/{id}', [StallLockerController::class, 'edit'])->name("stall.edit");

        Route::post('stall/edit/{id}', [StallLockerController::class, 'update'])->name("stall.update");

        Route::get('stall/delete/{id}', [StallLockerController::class, 'destroy'])->name("stall.delete");




        Route::get('vehicle/index', [VehicleController::class, 'index'])->name("vehicle.index");

        Route::get('vehicle/create', [VehicleController::class, 'create'])->name("vehicle.create");

        Route::post('vehicle/store', [VehicleController::class, 'store'])->name("vehicle.store");

        Route::get('vehicle/show/{id}', [VehicleController::class, 'show'])->name("vehicle.show");

        Route::get('vehicle/edit/{id}', [VehicleController::class, 'edit'])->name("vehicle.edit");

        Route::post('vehicle/edit/{id}', [VehicleController::class, 'update'])->name("vehicle.update");

        Route::get('vehicle/delete/{id}', [VehicleController::class, 'destroy'])->name("vehicle.delete");




        Route::get('parker/index', [ParkerController::class, 'index'])->name("parker.index");

        Route::get('parker/create', [ParkerController::class, 'create'])->name("parker.create");

        Route::post('parker/store', [ParkerController::class, 'store'])->name("parker.store");

        Route::get('parker/edit/{id}', [ParkerController::class, 'edit'])->name("parker.edit");

        Route::post('parker/edit/{id}', [ParkerController::class, 'update'])->name("parker.update");

        Route::get('parker/delete/{id}', [ParkerController::class, 'destroy'])->name("parker.delete");




        Route::get('parkings', [ParkingController::class, 'listparking'])->name('parking.list');

        Route::get('parking/{id}/assign', [ParkingController::class, 'create'])->name('parking.create');

        Route::post('parking/{id}/assign', [ParkingController::class, 'store'])->name('parking.store');

        Route::post('parking/removeVehicle/{vehicleId}', [ParkingController::class, 'removeVehicle'])->name('vehicle.remove');

        Route::post('parking/removeParker/{parkerId}', [ParkingController::class, 'removeParker'])->name('parker.remove');




        Route::get('tenants/index', [TenantController::class, 'index'])->name("tenants.index");

        Route::get('tenants/create', [TenantController::class, 'create'])->name("tenants.create");

        Route::post('tenants/store', [TenantController::class, 'store'])->name("tenants.store");

        // Route::get('tenants/show/{id}', [TenantController::class, 'show'])->name("tenants.show");

        Route::get('tenants/edit/{id}', [TenantController::class, 'edit'])->name("tenants.edit");

        Route::post('tenants/edit/{id}', [TenantController::class, 'update'])->name("tenants.update");

        Route::get('tenants/delete/{id}', [TenantController::class, 'destroy'])->name("tenants.delete");



        Route::get('landlord/index', [LandlordController::class, 'index'])->name("landlord.index");

        Route::get('landlord/create', [LandlordController::class, 'create'])->name("landlord.create");

        Route::post('landlord/store', [LandlordController::class, 'store'])->name("landlord.store");

        Route::get('landlord/edit/{id}', [LandlordController::class, 'edit'])->name("landlord.edit");

        Route::post('landlord/edit/{id}', [LandlordController::class, 'update'])->name("landlord.update");

        Route::get('landlord/delete/{id}', [LandlordController::class, 'destroy'])->name("landlord.delete");
});


/////////////////////////// selim  ///////////////////////////


include('payroll.php');
include('account.php');
include('bank_management.php');
include('saas_platform.php');

Route::get('setting/create_edit', [SettingController::class, 'create_edit'])->name("setting.create_edit");
Route::post('setting/update/{id}', [SettingController::class, 'update'])->name("setting.update");
Route::post('setting/store', [SettingController::class, 'store'])->name("setting.store");
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

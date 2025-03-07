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
use App\Http\Controllers\LandlordAgreementController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\LeaseRequestController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ParkerController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SaasPlatform\WebsiteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceHolderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\StallLockerController;
use App\Http\Controllers\TenantAgreementController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UnitAssignController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitLandlordController;
use App\Http\Controllers\UnitLeaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Middleware\AdminUserMiddleware;
use App\Models\tenantAgreement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [AuthController::class, 'login'])->name("login");
Route::post('login/form/submit', [AuthController::class, 'doLogin'])->name("do_login");
Route::post('/logout', [AuthController::class, 'logout'])->name("logout");
Route::get('/register', [AuthController::class, 'register'])->name("register");
Route::post('/do_register', [AuthController::class, 'do_register'])->name("do_register");


Route::middleware('auth')->group(callback: function () {

        Route::get('/index', [IndexController::class, 'adminIndex'])->name("index");


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



        //building approval
        Route::get('building/pending', [BuildingController::class, 'pending'])->name("building.pending");
        Route::get('building/approve/{id}', [BuildingController::class, 'approve'])->name("building.approve");
        Route::get('building/rejectList', [BuildingController::class, 'rejectList'])->name("building.rejectList");
        Route::post('building/reject/{id}', [BuildingController::class, 'reject'])->name("building.reject");



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
        Route::get('/buildings/{buildingId}/floorsUpper', [GetController::class, 'getFloorsUpper']);
        Route::get('/buildings/{buildingId}/floorsUnderground', [GetController::class, 'getFloorsUnderground']);     
        Route::get('/floors/{floorId}/units', [GetController::class, 'getUnits']);  //get units by floor id
        Route::get('/units/{unitId}/rooms', [GetController::class, 'getRooms']);  //get rooms by unit id
        Route::get('/units/{unitId}/roomsno', [GetController::class, 'getAmenities']);  //get rooms no by unit id
        Route::get('/floors/{floorId}/stalls', [GetController::class, 'getStalls']);  //get stalls by floor id
        


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
        


        // tenant
        Route::get('tenants/index', [TenantController::class, 'index'])->name("tenants.index");
        Route::get('tenant-registration/{type?}/{id?}', [TenantController::class, 'tenantRegistration'])->name('tenant.create');
        Route::post('tenant-registration/{type?}/{id?}', [TenantController::class, 'tenantRegistration'])->name('tenant.store');
        Route::get('tenant/show/{id}', [TenantController::class, 'show'])->name("tenant.show");
        Route::get('tenant/delete/{id}', [TenantController::class, 'destroy'])->name("tenant.delete");



        // tenant agreement
        Route::get('tenantAgreement/index', [TenantAgreementController::class, 'index'])->name("tenant.agreement.index");
        Route::get('tenantAgreement/create', [TenantAgreementController::class, 'create'])->name("tenant.agreement.create");
        Route::post('tenantAgreement/create', [TenantAgreementController::class, 'store'])->name("tenant.agreement.store");
        Route::get('tenantAgreement/pending', [TenantAgreementController::class, 'pending'])->name("tenant.agreement.pending");
        Route::get('tenantAgreement/approve/{id}', [TenantAgreementController::class, 'approve'])->name("tenant.agreement.approve");
        Route::get('tenantAgreement/reject/{id}', [TenantAgreementController::class, 'reject'])->name("tenant.agreement.reject");
        Route::get('tenantAgreement/rejectList', [TenantAgreementController::class, 'rejectList'])->name("tenant.agreement.rejectList");



        // maintenance
        Route::get('maintenance/index', [MaintenanceController::class, 'index'])->name("maintenance.index");
        Route::get('maintenance/create', [MaintenanceController::class, 'create'])->name("maintenance.create");
        Route::post('maintenance/create', [MaintenanceController::class, 'store'])->name("maintenance.store");
        Route::get('maintenance/show/{id}', [MaintenanceController::class, 'show'])->name("maintenance.show");
        Route::get('maintenance/edit/{id}', [MaintenanceController::class, 'edit'])->name("maintenance.edit");
        Route::post('maintenance/edit/{id}', [MaintenanceController::class, 'update'])->name("maintenance.update");
        Route::get('maintenance/delete/{id}', [MaintenanceController::class, 'destroy'])->name("maintenance.delete");
        



        // stall
        Route::get('stall/index', [StallController::class, 'index'])->name("stall.index");
        Route::get('stall/create', [StallController::class, 'create'])->name("stall.create");
        Route::post('stall/create', [StallController::class, 'store'])->name("stall.store");
        Route::get('stall/show/{id}', [StallController::class, 'show'])->name("stall.show");
        Route::get('stall/edit/{id}', [StallController::class, 'edit'])->name("stall.edit");
        Route::post('stall/edit/{id}', [StallController::class, 'update'])->name("stall.update");
        Route::get('stall/delete/{id}', [StallController::class, 'destroy'])->name("stall.delete");



        //parker
        Route::get('parker/index', [ParkerController::class, 'index'])->name("parker.index");
        Route::get('parker/create', [ParkerController::class, 'create'])->name("parker.create");
        Route::post('parker/store', [ParkerController::class, 'store'])->name("parker.store");
        Route::get('parker/edit/{id}', [ParkerController::class, 'edit'])->name("parker.edit");
        Route::post('parker/edit/{id}', [ParkerController::class, 'update'])->name("parker.update");
        Route::get('parker/delete/{id}', [ParkerController::class, 'destroy'])->name("parker.delete");



        // vehicle type
        Route::get('vehicleType/index', [VehicleTypeController::class, 'index'])->name("vehicleType.index");
        Route::get('vehicleType/create', [VehicleTypeController::class, 'create'])->name("vehicleType.create");
        Route::post('vehicleType/create', [VehicleTypeController::class, 'store'])->name("vehicleType.store");
        Route::get('vehicleType/show/{id}', [VehicleTypeController::class, 'show'])->name("vehicleType.show");
        Route::get('vehicleType/edit/{id}', [VehicleTypeController::class, 'edit'])->name("vehicleType.edit");
        Route::post('vehicleType/edit/{id}', [VehicleTypeController::class, 'update'])->name("vehicleType.update");
        Route::get('vehicleType/delete/{id}', [VehicleTypeController::class, 'destroy'])->name("vehicleType.delete");



        //vehicle
        Route::get('vehicle/index', [VehicleController::class, 'index'])->name("vehicle.index");
        Route::get('vehicle/create', [VehicleController::class, 'create'])->name("vehicle.create");
        Route::post('vehicle/store', [VehicleController::class, 'store'])->name("vehicle.store");
        Route::get('vehicle/show/{id}', [VehicleController::class, 'show'])->name("vehicle.show");
        Route::get('vehicle/edit/{id}', [VehicleController::class, 'edit'])->name("vehicle.edit");
        Route::post('vehicle/edit/{id}', [VehicleController::class, 'update'])->name("vehicle.update");
        Route::get('vehicle/delete/{id}', [VehicleController::class, 'destroy'])->name("vehicle.delete");



        //service
        Route::get('service/index', [ServiceController::class, 'index'])->name("service.index");
        Route::get('service/create', [ServiceController::class, 'create'])->name("service.create");
        Route::post('service/create', [ServiceController::class, 'store'])->name("service.store");
        Route::get('service/show/{id}', [ServiceController::class, 'show'])->name("service.show");
        Route::get('service/edit/{id}', [ServiceController::class, 'edit'])->name("service.edit");
        Route::post('service/edit/{id}', [ServiceController::class, 'update'])->name("service.update");
        Route::get('service/delete/{id}', [ServiceController::class, 'destroy'])->name("service.delete");



        //service holder
        Route::get('serviceHolder/index', [ServiceHolderController::class, 'index'])->name("serviceHolder.index");
        Route::get('serviceHolder/create', [ServiceHolderController::class, 'create'])->name("serviceHolder.create");
        Route::post('serviceHolder/create', [ServiceHolderController::class, 'store'])->name("serviceHolder.store");
        Route::get('serviceHolder/show/{id}', [ServiceHolderController::class, 'show'])->name("serviceHolder.show");
        Route::get('serviceHolder/edit/{id}', [ServiceHolderController::class, 'edit'])->name("serviceHolder.edit");
        Route::post('serviceHolder/edit/{id}', [ServiceHolderController::class, 'update'])->name("serviceHolder.update");
        Route::get('serviceHolder/delete/{id}', [ServiceHolderController::class, 'destroy'])->name("serviceHolder.delete");



        //landlord
        Route::get('landlord/index', [LandlordController::class, 'index'])->name("landlord.index");
        Route::get('landlord/create', [LandlordController::class, 'create'])->name("landlord.create");
        Route::post('landlord/create', [LandlordController::class, 'store'])->name("landlord.store");
        Route::get('landlord/show/{id}', [LandlordController::class, 'show'])->name("landlord.show");
        Route::get('landlord/edit/{id}', [LandlordController::class, 'edit'])->name("landlord.edit");
        Route::post('landlord/edit/{id}', [LandlordController::class, 'update'])->name("landlord.update");
        Route::get('landlord/delete/{id}', [LandlordController::class, 'destroy'])->name("landlord.delete");




        // landlord agreement
        Route::get('landlordAgreement/index', [LandlordAgreementController::class, 'index'])->name("landlord.agreement.index");
        Route::get('landlordAgreement/create', [LandlordAgreementController::class, 'create'])->name("landlord.agreement.create");
        Route::post('landlordAgreement/create', [LandlordAgreementController::class, 'store'])->name("landlord.agreement.store");
        Route::get('landlordAgreement/show/{id}', [LandlordAgreementController::class, 'show'])->name("landlord.agreement.show");
        Route::get('landlordAgreement/edit/{id}', [LandlordAgreementController::class, 'edit'])->name("landlord.agreement.edit");
        Route::post('landlordAgreement/edit/{id}', [LandlordAgreementController::class, 'update'])->name("landlord.agreement.update");
        Route::get('landlordAgreement/delete/{id}', [LandlordAgreementController::class, 'destroy'])->name("landlord.agreement.delete");


});


/////////////////////////// selim  ///////////////////////////


// include('payroll.php');
// include('account.php');
// include('bank_management.php');
// include('saas_platform.php');

// Route::get('setting/create_edit', [SettingController::class, 'create_edit'])->name("setting.create_edit");
// Route::post('setting/update/{id}', [SettingController::class, 'update'])->name("setting.update");
// Route::post('setting/store', [SettingController::class, 'store'])->name("setting.store");
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



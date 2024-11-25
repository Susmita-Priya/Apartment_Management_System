<?php

  
use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdroomController;
use App\Http\Controllers\AmroomController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ComareaController;
use App\Http\Controllers\ComroomController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\LeaseRequestController;
use App\Http\Controllers\MechroomController;
use App\Http\Controllers\ParkerController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResroomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaasPlatform\WebsiteController;
use App\Http\Controllers\SerroomController;
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
use App\Models\Asset;
use App\Models\Landlord;
use App\Models\LeaseRequest;
use App\Models\Parker;
use App\Models\Permission;
use App\Models\Tenant;
use App\Models\Unit_landlord;
use App\Models\Vehicle;
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



        Route::get('building/index', [BuildingController::class, 'index'])->name("building");

        Route::get('building/create', [BuildingController::class, 'create'])->name("building.create");

        Route::post('building/create', [BuildingController::class, 'store'])->name("building.store");

        Route::get('building/show/{id}', [BuildingController::class, 'show'])->name("building.show");

        Route::get('building/edit/{id}', [BuildingController::class, 'edit'])->name("building.edit");

        Route::post('building/edit/{id}', [BuildingController::class, 'update'])->name("building.update");

        Route::get('building/delete/{id}', [BuildingController::class, 'destroy'])->name("building.delete");




        Route::get('block/index', [BlockController::class, 'index'])->name("block.index");

        Route::get('block/create', [BlockController::class, 'create'])->name("block.create");

        Route::post('block/create', [BlockController::class, 'store'])->name("block.store");

        Route::get('block/show/{id}', [BlockController::class, 'show'])->name("block.show");

        Route::get('block/edit/{id}', [BlockController::class, 'edit'])->name("block.edit");

        Route::post('block/edit/{id}', [BlockController::class, 'update'])->name("block.update");

        Route::get('block/delete/{id}', [BlockController::class, 'destroy'])->name("block.delete");

        
        Route::get('/blocks/{id}', [BlockController::class, 'getBlocks'])->name('blocks.get');




        Route::get('floor/index', [FloorController::class, 'index'])->name("floor.index");

        Route::get('floor/create', [FloorController::class, 'create'])->name("floor.create");

        Route::post('floor/create', [FloorController::class, 'store'])->name("floor.store");

        Route::get('floor/show/{id}', [FloorController::class, 'show'])->name("floor.show");

        Route::get('floor/edit/{id}', [FloorController::class, 'edit'])->name("floor.edit");

        Route::post('floor/edit/{id}', [FloorController::class, 'update'])->name("floor.update");

        Route::get('floor/delete/{id}', [FloorController::class, 'destroy'])->name("floor.delete");

        Route::get('/blocks/{block}/floors', [FloorController::class, 'getFloors']);





        Route::get('unit/index', [UnitController::class, 'index'])->name("unit.index");

        Route::get('unit/create', [UnitController::class, 'create'])->name("unit.create");

        Route::post('unit/create', [UnitController::class, 'store'])->name("unit.store");

        Route::get('unit/show/{id}', [UnitController::class, 'show'])->name("unit.show");

        Route::get('unit/edit/{id}', [UnitController::class, 'edit'])->name("unit.edit");

        Route::post('unit/edit/{id}', [UnitController::class, 'update'])->name("unit.update");

        Route::get('unit/delete/{id}', [UnitController::class, 'destroy'])->name("unit.delete");



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




        Route::get('resroom/create', [ResroomController::class, 'create'])->name("resroom.create");

        Route::post('resroom/create', [ResroomController::class, 'store'])->name("resroom.store");

        Route::get('resroom/show/{id}/{room_type}', [ResroomController::class, 'show'])->name('resroom.show');

        Route::get('resroom/edit/{id}', [ResroomController::class, 'edit'])->name("resroom.edit");

        Route::post('resroom/edit/{id}', [ResroomController::class, 'update'])->name("resroom.update");

        Route::get('resroom/delete/{id}', [ResroomController::class, 'destroy'])->name("resroom.delete");



        Route::get('comroom/create', [ComroomController::class, 'create'])->name("comroom.create");

        Route::post('comroom/create', [ComroomController::class, 'store'])->name("comroom.store");

        Route::get('comroom/show/{id}/{room_type}', [ComroomController::class, 'show'])->name('comroom.show');

        Route::get('comroom/edit/{id}', [ComroomController::class, 'edit'])->name("comroom.edit");

        Route::post('comroom/edit/{id}', [ComroomController::class, 'update'])->name("comroom.update");

        Route::get('comroom/delete/{id}', [ComroomController::class, 'destroy'])->name("comroom.delete");




        Route::get('mechroom/create', [MechroomController::class, 'create'])->name("mechroom.create");

        Route::post('mechroom/create', [MechroomController::class, 'store'])->name("mechroom.store");

        Route::get('mechroom/show/{id}/{room_type}', [MechroomController::class, 'show'])->name("mechroom.show");

        Route::get('mechroom/edit/{id}', [MechroomController::class, 'edit'])->name("mechroom.edit");

        Route::post('mechroom/edit/{id}', [MechroomController::class, 'update'])->name("mechroom.update");

        Route::get('mechroom/delete/{id}', [MechroomController::class, 'destroy'])->name("mechroom.delete");




        Route::get('adroom/create', [AdroomController::class, 'create'])->name("adroom.create");

        Route::post('adroom/create', [AdroomController::class, 'store'])->name("adroom.store");

        Route::get('adroom/show/{id}/{room_type}', [AdroomController::class, 'show'])->name("adroom.show");

        Route::get('adroom/edit/{id}', [AdroomController::class, 'edit'])->name("adroom.edit");

        Route::post('adroom/edit/{id}', [AdroomController::class, 'update'])->name("adroom.update");

        Route::get('adroom/delete/{id}', [AdroomController::class, 'destroy'])->name("adroom.delete");




        Route::get('amroom/create', [AmroomController::class, 'create'])->name("amroom.create");

        Route::post('amroom/create', [AmroomController::class, 'store'])->name("amroom.store");

        Route::get('amroom/show/{id}/{room_type}', [AmroomController::class, 'show'])->name("amroom.show");

        Route::get('amroom/edit/{id}', [AmroomController::class, 'edit'])->name("amroom.edit");

        Route::post('amroom/edit/{id}', [AmroomController::class, 'update'])->name("amroom.update");

        Route::get('amroom/delete/{id}', [AmroomController::class, 'destroy'])->name("amroom.delete");




        Route::get('serroom/create', [SerroomController::class, 'create'])->name("serroom.create");

        Route::post('serroom/create', [SerroomController::class, 'store'])->name("serroom.store");

        Route::get('serroom/show/{id}/{room_type}', [SerroomController::class, 'show'])->name("serroom.show");

        Route::get('serroom/edit/{id}', [SerroomController::class, 'edit'])->name("serroom.edit");

        Route::post('serroom/edit/{id}', [SerroomController::class, 'update'])->name("serroom.update");

        Route::get('serroom/delete/{id}', [SerroomController::class, 'destroy'])->name("serroom.delete");




        Route::get('comarea/index', [ComareaController::class, 'index'])->name("comarea.index");

        Route::get('comarea/create', [ComareaController::class, 'create'])->name("comarea.create");

        Route::post('comarea/create', [ComareaController::class, 'store'])->name("comarea.store");

        Route::get('comarea/show/{id}', [ComareaController::class, 'show'])->name("comarea.show");

        Route::get('comarea/edit/{id}', [ComareaController::class, 'edit'])->name("comarea.edit");

        Route::post('comarea/edit/{id}', [ComareaController::class, 'update'])->name("comarea.update");

        Route::get('comarea/delete/{id}', [ComareaController::class, 'destroy'])->name("comarea.delete");




        Route::get('asset/create', [AssetController::class, 'create'])->name("asset.create");

        Route::post('asset/store', [AssetController::class, 'store'])->name("asset.store");

        Route::get('asset/show/{id}', [AssetController::class, 'show'])->name("asset.show");

        Route::get('asset/edit/{id}', [AssetController::class, 'edit'])->name("asset.edit");

        Route::post('asset/edit/{id}', [AssetController::class, 'update'])->name("asset.update");

        Route::get('asset/delete/{id}', [AssetController::class, 'destroy'])->name("asset.delete");




        Route::get('stall_locker/index', [StallLockerController::class, 'index'])->name("stall_locker.index");

        Route::get('stall_locker/create', [StallLockerController::class, 'create'])->name("stall_locker.create");

        Route::post('stall_locker/create', [StallLockerController::class, 'store'])->name("stall_locker.store");

        Route::get('stall_locker/show/{id}', [StallLockerController::class, 'show'])->name("stall_locker.show");

        Route::get('stall_locker/edit/{id}', [StallLockerController::class, 'edit'])->name("stall_locker.edit");

        Route::post('stall_locker/edit/{id}', [StallLockerController::class, 'update'])->name("stall_locker.update");

        Route::get('stall_locker/delete/{id}', [StallLockerController::class, 'destroy'])->name("stall_locker.delete");




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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

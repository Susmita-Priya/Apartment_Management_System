<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ComroomController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResroomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminUserMiddleware;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// }); 


// Route::group(['middleware' => 'useradmin'],function(){
//     Route::get('useradmin',function(){
//         return view('admin_dashboard.index');
//     });
// });


Route::get('/index', function () {
 
    return view('admin_dashboard.index');
});


Route::get('/property', function () {
 
    return view('property.property_list');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Route::post('/logout', [AuthController::class,'logout']);


Route::get('/', [AuthController::class,'login']);

Route::post('/', [AuthController::class,'auth_login']);



Route::get('tenants', [TenantsController::class,'index'])->name("tenants.index");

Route::get('tenants/create', [TenantsController::class,'create'])->name("tenants.create");

Route::post('tenants/create', [TenantsController::class,'store']);

Route::get('tenants/show/{id}', [TenantsController::class,'show'])->name("tenants.show");

Route::get('tenants/edit/{id}', [TenantsController::class,'edit'])->name("tenants.edit");

Route::post('tenants/edit/{id}', [TenantsController::class,'update'])->name("tenants.update");

Route::get('tenants/delete/{id}', [TenantsController::class,'destroy'])->name("tenants.delete");




Route::get('user', [UserController::class,'index'])->name("user.index");

Route::get('user/create', [UserController::class,'create'])->name("user.create");

Route::post('user/create', [UserController::class,'store']);

Route::get('user/show/{id}', [UserController::class,'show'])->name("user.show");

Route::get('user/edit/{id}', [UserController::class,'edit'])->name("user.edit");

Route::post('user/edit/{id}', [UserController::class,'update'])->name("user.update");

Route::get('user/delete/{id}', [UserController::class,'destroy'])->name("user.delete");




Route::get('role', [RoleController::class,'index'])->name("role.index");

Route::get('role/create', [RoleController::class,'create'])->name("role.create");

Route::post('role/create', [RoleController::class,'store']);

Route::get('role/show/{id}', [RoleController::class,'show'])->name("role.show");

Route::get('role/edit/{id}', [RoleController::class,'edit'])->name("role.edit");

Route::post('role/edit/{id}', [RoleController::class,'update'])->name("role.update");

Route::get('role/delete/{id}', [RoleController::class,'destroy'])->name("role.delete");



Route::get('permission', [PermissionController::class,'index'])->name("permission.index");

Route::get('permission/create', [PermissionController::class,'create'])->name("permission.create");

Route::post('permission/create', [PermissionController::class,'store']);

// Route::get('role/show/{id}', [AccessController::class,'show'])->name("role.show");

Route::get('permission/edit/{id}', [PermissionController::class,'edit'])->name("permission.edit");

Route::post('permission/edit/{id}', [PermissionController::class,'update'])->name("permission.update");

Route::get('permission/delete/{id}', [PermissionController::class,'destroy'])->name("permission.delete");


// Route::middleware(['auth'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });




Route::get('building', [BuildingController::class,'index'])->name("building.index");

Route::get('building/create', [BuildingController::class,'create'])->name("building.create");

Route::post('building/create', [BuildingController::class,'store']);

Route::get('building/show/{id}', [BuildingController::class,'show'])->name("building.show");

Route::get('building/edit/{id}', [BuildingController::class,'edit'])->name("building.edit");

Route::post('building/edit/{id}', [BuildingController::class,'update'])->name("building.update");

Route::get('building/delete/{id}', [BuildingController::class,'destroy'])->name("building.delete");




Route::get('block/create', [BlockController::class,'create'])->name("block.create");

Route::post('block/create', [BlockController::class,'store']);

Route::get('block/show/{id}', [BlockController::class,'show'])->name("block.show");

Route::get('block/edit/{id}', [BlockController::class,'edit'])->name("block.edit");

Route::post('block/edit/{id}', [BlockController::class,'update'])->name("block.update");

Route::get('block/delete/{id}', [BlockController::class,'destroy'])->name("block.delete");




Route::get('floor/create', [FloorController::class,'create'])->name("floor.create");

Route::post('floor/create', [FloorController::class,'store'])->name("floor.store");

Route::get('floor/show/{id}', [FloorController::class,'show'])->name("floor.show");

Route::get('floor/edit/{id}', [FloorController::class,'edit'])->name("floor.edit");

Route::post('floor/edit/{id}', [FloorController::class,'update'])->name("floor.update");

Route::get('floor/delete/{id}', [FloorController::class,'destroy'])->name("floor.delete");



Route::get('unit/create', [UnitController::class,'create'])->name("unit.create");

Route::post('unit/create', [UnitController::class,'store'])->name("unit.store");

Route::get('unit/show/{id}', [UnitController::class,'show'])->name("unit.show");

Route::get('unit/edit/{id}', [UnitController::class,'edit'])->name("unit.edit");

Route::post('unit/edit/{id}', [UnitController::class,'update'])->name("unit.update");

Route::get('unit/delete/{id}', [UnitController::class,'destroy'])->name("unit.delete");



Route::get('unit/create', [UnitController::class,'create'])->name("unit.create");

Route::post('unit/create', [UnitController::class,'store'])->name("unit.store");

Route::get('unit/show/{id}', [UnitController::class,'show'])->name("unit.show");

Route::get('unit/edit/{id}', [UnitController::class,'edit'])->name("unit.edit");

Route::post('unit/edit/{id}', [UnitController::class,'update'])->name("unit.update");

Route::get('unit/delete/{id}', [UnitController::class,'destroy'])->name("unit.delete");



Route::get('resroom/create', [ResroomController::class, 'create'])->name("resroom.create");

Route::post('resroom/create', [ResroomController::class, 'store'])->name("resroom.store");

Route::get('resroom/show/{id}', [ResroomController::class, 'show'])->name("resroom.show");

Route::get('resroom/edit/{id}', [ResroomController::class, 'edit'])->name("resroom.edit");

Route::post('resroom/edit/{id}', [ResroomController::class, 'update'])->name("resroom.update");

Route::get('resroom/delete/{id}', [ResroomController::class, 'destroy'])->name("resroom.delete");



Route::get('comroom/create', [ComroomController::class, 'create'])->name("comroom.create");

Route::post('comroom/create', [ComroomController::class, 'store'])->name("comroom.store");

Route::get('comroom/show/{id}', [ComroomController::class, 'show'])->name("comroom.show");

Route::get('comroom/edit/{id}', [ComroomController::class, 'edit'])->name("comroom.edit");

Route::post('comroom/edit/{id}', [ComroomController::class, 'update'])->name("comroom.update");

Route::get('comroom/delete/{id}', [ComroomController::class, 'destroy'])->name("comroom.delete");
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TenantsController;
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

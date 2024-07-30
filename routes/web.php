<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('admin_dashboard.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('user', [UsersController::class,'index'])->name("user.show");

Route::get('user/create', [UsersController::class,'create'])->name("user.create");

Route::post('user/create', [UsersController::class,'store']);

Route::get('user/edit/{id}', [UsersController::class,'edit'])->name("user.edit");

Route::post('user/edit/{id}', [UsersController::class,'update'])->name("user.update");

Route::get('user/delete/{id}', [UsersController::class,'destroy'])->name("user.delete");
<?php

use App\Http\Controllers\SaasPlatform\CustomerController;
use App\Http\Controllers\SaasPlatform\SubscriptionPackageController;
use App\Http\Controllers\SaasPlatform\SubscriptionPackageDurationController;
use App\Http\Controllers\SaasPlatform\WebsiteController;
use Illuminate\Support\Facades\Route;

// package
Route::get('subscription/package/delete/{id}', [SubscriptionPackageController::class, 'destroy'])->name('subscription_package.delete');
Route::resource('subscription_package', SubscriptionPackageController::class);

// package-duration
Route::get('subscription/package/duration/delete/{id}', [SubscriptionPackageDurationController::class, 'destroy'])->name('subscription_package_duration.delete');
Route::resource('subscription_package_duration', SubscriptionPackageDurationController::class);


// customer
Route::get('customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');
Route::get('customer/index', [CustomerController::class, 'index'])->name('customer.index');
Route::get('customer/approve/{id}', [CustomerController::class, 'approve'])->name('customer.approve');
Route::get('customer/reject/{id}', [CustomerController::class, 'reject'])->name('customer.reject');


// register
Route::get('/username/validation/check/ajax', [WebsiteController::class, 'username_validation'])->name("username_validation_check_ajax");
Route::get('/emailCheck', [WebsiteController::class, 'emailCheck'])->name("emailCheck");
Route::get('/register', [WebsiteController::class, 'register'])->name("register");
Route::post('/do_registration', [WebsiteController::class, 'do_registration'])->name("do_registration");

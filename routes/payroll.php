<?php


use App\Http\Controllers\Payroll\DepartmentController;
use App\Http\Controllers\Payroll\DesignationController;
use App\Http\Controllers\Payroll\EmployeeController;
use App\Http\Controllers\Payroll\EmployeeTypeController;
use App\Http\Controllers\Payroll\JobLocationController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\Payroll\SalaryHeadController;
use Illuminate\Support\Facades\Route;


// ----------------  payroll management -------------------------- //

// department
Route::get('department/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');
Route::resource('department', DepartmentController::class);


// designaiton
Route::get('designaiton/delete/{id}', [DesignationController::class, 'destroy'])->name('designaiton.delete');
Route::resource('designaiton', DesignationController::class);

// job_location
Route::get('job/location/delete/{id}', [JobLocationController::class, 'destroy'])->name('job_location.delete');
Route::resource('job_location', JobLocationController::class);


// employee type
Route::get('employee/type/delete/{id}', [EmployeeTypeController::class, 'destroy'])->name('employee_type.delete');
Route::resource('employee_type', EmployeeTypeController::class);


// employee
Route::get('employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');
Route::resource('employee', EmployeeController::class);


// salary head
Route::get('salary/head/delete/{id}', [SalaryHeadController::class, 'destroy'])->name('salary_head.delete');
Route::resource('salary_head', SalaryHeadController::class);


// payroll
Route::get('payroll/delete/{id}', [PayrollController::class, 'destroy'])->name('payroll.delete');
Route::get('payroll/generate', [PayrollController::class, 'generate'])->name('payroll.generate');
Route::resource('payroll', PayrollController::class);


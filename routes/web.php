<?php

use App\Http\Controllers\Accounts\AccountController;
use App\Http\Controllers\Accounts\AccountGroupController;
use App\Http\Controllers\Accounts\AccountingReportController;
use App\Http\Controllers\Accounts\JournalEntryController;
use App\Http\Controllers\AdroomController;
use App\Http\Controllers\AmroomController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Bank\BankTransactionController;
use App\Http\Controllers\Bank\BankTransactionTypeController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ComareaController;
use App\Http\Controllers\ComroomController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MechroomController;
use App\Http\Controllers\Payroll\DepartmentController;
use App\Http\Controllers\Payroll\DesignationController;
use App\Http\Controllers\Payroll\EmployeeController;
use App\Http\Controllers\Payroll\EmployeeTypeController;
use App\Http\Controllers\Payroll\JobLocationController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\Payroll\SalaryHeadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ResroomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SerroomController;
use App\Http\Controllers\StallLockerController;
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

Route::get('/index', [IndexController::class, 'index'])->name("index");


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Route::post('/logout', [AuthController::class, 'logout'])->name("logout");


Route::get('/', [AuthController::class, 'login'])->name("login");

Route::post('/', [AuthController::class, 'auth_login']);



Route::get('tenants', [TenantsController::class, 'index'])->name("tenants.index");

Route::get('tenants/create', [TenantsController::class, 'create'])->name("tenants.create");

Route::post('tenants/create', [TenantsController::class, 'store']);

Route::get('tenants/show/{id}', [TenantsController::class, 'show'])->name("tenants.show");

Route::get('tenants/edit/{id}', [TenantsController::class, 'edit'])->name("tenants.edit");

Route::post('tenants/edit/{id}', [TenantsController::class, 'update'])->name("tenants.update");

Route::get('tenants/delete/{id}', [TenantsController::class, 'destroy'])->name("tenants.delete");




Route::get('user', [UserController::class, 'index'])->name("user.index");

Route::get('user/create', [UserController::class, 'create'])->name("user.create");

Route::post('user/create', [UserController::class, 'store']);

Route::get('user/show/{id}', [UserController::class, 'show'])->name("user.show");

Route::get('user/edit/{id}', [UserController::class, 'edit'])->name("user.edit");

Route::post('user/edit/{id}', [UserController::class, 'update'])->name("user.update");

Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name("user.delete");




Route::get('role', [RoleController::class, 'index'])->name("role.index");

Route::get('role/create', [RoleController::class, 'create'])->name("role.create");

Route::post('role/create', [RoleController::class, 'store']);

Route::get('role/show/{id}', [RoleController::class, 'show'])->name("role.show");

Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name("role.edit");

Route::post('role/edit/{id}', [RoleController::class, 'update'])->name("role.update");

Route::get('role/delete/{id}', [RoleController::class, 'destroy'])->name("role.delete");




Route::get('permission', [PermissionController::class, 'index'])->name("permission.index");

Route::get('permission/create', [PermissionController::class, 'create'])->name("permission.create");

Route::post('permission/create', [PermissionController::class, 'store']);

// Route::get('role/show/{id}', [AccessController::class,'show'])->name("role.show");

Route::get('permission/edit/{id}', [PermissionController::class, 'edit'])->name("permission.edit");

Route::post('permission/edit/{id}', [PermissionController::class, 'update'])->name("permission.update");

Route::get('permission/delete/{id}', [PermissionController::class, 'destroy'])->name("permission.delete");




Route::get('building', [BuildingController::class, 'index'])->name("building");

Route::get('building/create', [BuildingController::class, 'create'])->name("building.create");

Route::post('building/create', [BuildingController::class, 'store'])->name("building.store");

Route::get('building/show/{id}', [BuildingController::class, 'show'])->name("building.show");

Route::get('building/edit/{id}', [BuildingController::class, 'edit'])->name("building.edit");

Route::post('building/edit/{id}', [BuildingController::class, 'update'])->name("building.update");

Route::get('building/delete/{id}', [BuildingController::class, 'destroy'])->name("building.delete");



Route::get('block/create', [BlockController::class, 'create'])->name("block.create");

Route::post('block/create', [BlockController::class, 'store'])->name("block.store");

Route::get('block/show/{id}', [BlockController::class, 'show'])->name("block.show");

Route::get('block/edit/{id}', [BlockController::class, 'edit'])->name("block.edit");

Route::post('block/edit/{id}', [BlockController::class, 'update'])->name("block.update");

Route::get('block/delete/{id}', [BlockController::class, 'destroy'])->name("block.delete");




Route::get('floor/create', [FloorController::class, 'create'])->name("floor.create");

Route::post('floor/create', [FloorController::class, 'store'])->name("floor.store");

Route::get('floor/show/{id}', [FloorController::class, 'show'])->name("floor.show");

Route::get('floor/edit/{id}', [FloorController::class, 'edit'])->name("floor.edit");

Route::post('floor/edit/{id}', [FloorController::class, 'update'])->name("floor.update");

Route::get('floor/delete/{id}', [FloorController::class, 'destroy'])->name("floor.delete");



Route::get('unit/create', [UnitController::class, 'create'])->name("unit.create");

Route::post('unit/create', [UnitController::class, 'store'])->name("unit.store");

Route::get('unit/show/{id}', [UnitController::class, 'show'])->name("unit.show");

Route::get('unit/edit/{id}', [UnitController::class, 'edit'])->name("unit.edit");

Route::post('unit/edit/{id}', [UnitController::class, 'update'])->name("unit.update");

Route::get('unit/delete/{id}', [UnitController::class, 'destroy'])->name("unit.delete");




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

Route::get('mechroom/show/{id}', [MechroomController::class, 'show'])->name("mechroom.show");

Route::get('mechroom/edit/{id}', [MechroomController::class, 'edit'])->name("mechroom.edit");

Route::post('mechroom/edit/{id}', [MechroomController::class, 'update'])->name("mechroom.update");

Route::get('mechroom/delete/{id}', [MechroomController::class, 'destroy'])->name("mechroom.delete");



Route::get('adroom/create', [AdroomController::class, 'create'])->name("adroom.create");

Route::post('adroom/create', [AdroomController::class, 'store'])->name("adroom.store");

Route::get('adroom/show/{id}', [AdroomController::class, 'show'])->name("adroom.show");

Route::get('adroom/edit/{id}', [AdroomController::class, 'edit'])->name("adroom.edit");

Route::post('adroom/edit/{id}', [AdroomController::class, 'update'])->name("adroom.update");

Route::get('adroom/delete/{id}', [AdroomController::class, 'destroy'])->name("adroom.delete");


Route::get('amroom/create', [AmroomController::class, 'create'])->name("amroom.create");

Route::post('amroom/create', [AmroomController::class, 'store'])->name("amroom.store");

Route::get('amroom/show/{id}', [AmroomController::class, 'show'])->name("amroom.show");

Route::get('amroom/edit/{id}', [AmroomController::class, 'edit'])->name("amroom.edit");

Route::post('amroom/edit/{id}', [AmroomController::class, 'update'])->name("amroom.update");

Route::get('amroom/delete/{id}', [AmroomController::class, 'destroy'])->name("amroom.delete");



Route::get('serroom/create', [SerroomController::class, 'create'])->name("serroom.create");

Route::post('serroom/create', [SerroomController::class, 'store'])->name("serroom.store");

Route::get('serroom/show/{id}', [SerroomController::class, 'show'])->name("serroom.show");

Route::get('serroom/edit/{id}', [SerroomController::class, 'edit'])->name("serroom.edit");

Route::post('serroom/edit/{id}', [SerroomController::class, 'update'])->name("serroom.update");

Route::get('serroom/delete/{id}', [SerroomController::class, 'destroy'])->name("serroom.delete");



Route::get('stall_locker/create', [StallLockerController::class, 'create'])->name("stall_locker.create");

Route::post('stall_locker/create', [StallLockerController::class, 'store'])->name("stall_locker.store");

Route::get('stall_locker/show/{id}', [StallLockerController::class, 'show'])->name("stall_locker.show");

Route::get('stall_locker/edit/{id}', [StallLockerController::class, 'edit'])->name("stall_locker.edit");

Route::post('stall_locker/edit/{id}', [StallLockerController::class, 'update'])->name("stall_locker.update");

Route::get('stall_locker/delete/{id}', [StallLockerController::class, 'destroy'])->name("stall_locker.delete");



Route::get('comarea/create', [ComareaController::class, 'create'])->name("comarea.create");

Route::post('comarea/create', [ComareaController::class, 'store'])->name("comarea.store");

Route::get('comarea/show/{id}', [ComareaController::class, 'show'])->name("comarea.show");

Route::get('comarea/edit/{id}', [ComareaController::class, 'edit'])->name("comarea.edit");

Route::post('comarea/edit/{id}', [ComareaController::class, 'update'])->name("comarea.update");

Route::get('comarea/delete/{id}', [ComareaController::class, 'destroy'])->name("comarea.delete");



Route::get('asset/create/{id}/{count}/{room_type}', [AssetController::class, 'create'])->name('asset.create');

Route::post('asset/store', [AssetController::class, 'store'])->name("asset.store");

Route::get('asset/show/{id}', [AssetController::class, 'show'])->name("asset.show");

Route::get('asset/edit/{id}', [AssetController::class, 'edit'])->name("asset.edit");

Route::post('asset/edit/{id}', [AssetController::class, 'update'])->name("asset.update");

Route::get('asset/delete/{id}', [AssetController::class, 'destroy'])->name("asset.delete");



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



// ---------------- accounting -------------------------- //

Route::get('account/delete/{id}', [AccountController::class, 'destroy'])->name('account.delete');
Route::resource('account', AccountController::class);

Route::get('account/group/delete/{id}', [AccountGroupController::class, 'destroy'])->name('account-group.delete');
Route::resource('account-group', AccountGroupController::class);

Route::get('journal/entry/delete/{id}', [JournalEntryController::class, 'destroy'])->name('journal-entry.delete');
Route::resource('journal-entry', JournalEntryController::class);

Route::get('journal-add-more-input', [JournalEntryController::class, 'addMoreInput']);

// report
Route::get('general/ledger/report', [AccountingReportController::class, 'generalLedger'])->name('general-ledger-report');
Route::get('balance/sheet', [AccountingReportController::class, 'balance_sheet'])->name('balance_sheet');


// ----------------  bank management -------------------------- //

// transaction type 
Route::get('bank/transaction/type/delete/{id}', [BankTransactionTypeController::class, 'destroy'])->name('bank_transaction_type.delete');
Route::resource('bank_transaction_type', BankTransactionTypeController::class);


// bank transaction
Route::get('bank/transaction/delete/{id}', [BankTransactionController::class, 'destroy'])->name('bank_transaction.delete');
Route::get('bank/transaction/report', [BankTransactionController::class, 'transactionReport'])->name('bank_transaction_report');
Route::resource('bank_transaction', BankTransactionController::class);


<?php

use App\Models\Banner;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ChartbortController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/user/logout', [App\Http\Controllers\Auth\LoginController::class, 'userlogout'])->name('user.logout');


// Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
// });


Route::group(['prefix' => 'admin'], function () {

	
	Route::group(['middleware' => 'admin.guest'], function () {
		Route::view('/login', 'admin.login')->name('admin.login');
		Route::post('/login', [App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.auth');
	});
	
	// Admin
	Route::group(['middleware' => 'admin.auth'], function () {

		Route::resource('roles', RoleController::class);
		Route::resource('permissions', PermissionController::class);


		Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
		Route::get('/passchang', [App\Http\Controllers\PasschangdController::class, 'passchang'])->name('admin.passchang');
		Route::post('/passedit/{id}', [App\Http\Controllers\PasschangdController::class, 'passedit'])->name('admin.passedit');
		Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

		// Employee Routes
		Route::get('/editEmployee/{id}', [EmployeeController::class,'editEmployee'])->name('employees.edit');
		Route::DELETE('/deleteEmployee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('employees.destroy');
        Route::get('/addEmployee', [EmployeeController::class, 'addEmployee'])->name('employee.add');
		Route::POST('/storeEmployee', [EmployeeController::class, 'storeEmployee'])->name('employee.store');
		Route::POST('/employeeStatus', [EmployeeController::class, 'employeeStatus'])->name('employee.status');
		
		Route::group(['prefix' => 'profile'], function () {
			Route::get('index', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index.profile');
			Route::get('editpro', [\App\Http\Controllers\ProfileController::class, 'editpro'])->name('editpro.profile');
			Route::POST('update/{id}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('update.profile');
		});
		Route::group(['prefix' => 'sittings'], function () {
			Route::get('index', [\App\Http\Controllers\SittingController::class, 'index'])->name('index.sitting');
			Route::get('editpro', [\App\Http\Controllers\SittingController::class, 'editpro'])->name('editpro.sitting');
			Route::POST('update/{id}', [\App\Http\Controllers\SittingController::class, 'update'])->name('update.sitting');
		});
	});

	// User
	Route::group(['middleware' => 'user.auth'], function () {

		Route::resource('roles', RoleController::class);
		Route::resource('permissions', PermissionController::class);


		Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');
		Route::get('/passchang', [App\Http\Controllers\PasschangdController::class, 'passchang'])->name('admin.passchang');
		Route::post('/passedit/{id}', [App\Http\Controllers\PasschangdController::class, 'passedit'])->name('admin.passedit');

		// Employee Routes
		Route::get('/editEmployee/{id}', [EmployeeController::class,'editEmployee'])->name('employees.edit');
		Route::DELETE('/deleteEmployee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('employees.destroy');
        Route::get('/addEmployee', [EmployeeController::class, 'addEmployee'])->name('employee.add');
		Route::POST('/storeEmployee', [EmployeeController::class, 'storeEmployee'])->name('employee.store');
		Route::POST('/employeeStatus', [EmployeeController::class, 'employeeStatus'])->name('employee.status');
		
		Route::group(['prefix' => 'profile'], function () {
			Route::get('index', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index.profile');
			Route::get('editpro', [\App\Http\Controllers\ProfileController::class, 'editpro'])->name('editpro.profile');
			Route::POST('update/{id}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('update.profile');
		});
		Route::group(['prefix' => 'sittings'], function () {
			Route::get('index', [\App\Http\Controllers\SittingController::class, 'index'])->name('index.sitting');
			Route::get('editpro', [\App\Http\Controllers\SittingController::class, 'editpro'])->name('editpro.sitting');
			Route::POST('update/{id}', [\App\Http\Controllers\SittingController::class, 'update'])->name('update.sitting');
		});
	});
});

Route::group(['prefix' => "user"], function() {
	Route::group(['middleware' => 'user.guest'], function () {
		Route::post('/register', [UserController::class, 'store'])->name('user.register');
	   Route::view('/login', 'admin.login')->name('user.login');
	   Route::view('/login', 'user.login')->name('user.login');
	   Route::post('/login', [App\Http\Controllers\UserController::class, 'loginUser'])->name('user.auth');
	   Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('user.logout');	
	});
});

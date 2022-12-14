<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/home', '/admin/dashboard');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => '/admin', 'as' => 'admin.'], function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::delete('/permissions/destroy', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
        Route::resource('/permissions', PermissionController::class);

        Route::delete('/roles/destroy', [RoleController::class, 'massDestroy'])->name('roles.massDestroy');
        Route::resource('/roles', RoleController::class);

        Route::get('/users/update/status', [UserController::class, 'updateStatus'])->name('users.update.status');
        Route::delete('/users/destroy', [UserController::class, 'massDestroy'])->name('users.massDestroy');
        Route::resource('/users', UserController::class);

        Route::get('/sliders/update/status', [SliderController::class, 'updateStatus'])->name('sliders.update.status');
        Route::delete('/sliders/destroy', [SliderController::class, 'massDestroy'])->name('sliders.massDestroy');
        Route::resource('/sliders', SliderController::class);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

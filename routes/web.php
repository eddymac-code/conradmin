<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;

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
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return redirect('/home');

});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// for Users
Route::group(['prefix' => 'users'], function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('data', 'index')->name('users');
        Route::get('create', 'create')->name('users.create');
        Route::post('create', 'store');
        Route::get('{user}/show', 'show')->name('users.show');
        Route::get('{user}/edit', 'edit')->name('users.edit');
        Route::put('{user}/edit', 'update');
        Route::delete('{user}/delete', 'destroy')->name('users.delete');
    });

    // For Roles
    Route::group(['prefix' => 'roles'], function(){
        Route::controller(RoleController::class)->group(function(){
            Route::get('data', 'index')->name('roles');
            Route::get('create', 'create')->name('roles.create');
            Route::post('create', 'store');
            Route::get('{role}/show', 'show')->name('roles.show');
            Route::get('{role}/edit', 'edit')->name('roles.edit');
            Route::put('{role}/edit', 'update');
            Route::delete('{role}/delete', 'destroy')->name('roles.delete');
            Route::post('{role}/assign-user', 'toUser')->name('assign');
            Route::get('{role}/assign-permissions', 'assignPermissionsIndex')->name('role.assign.permissions');
            Route::post('{role}/assign-permissions', 'assignPermissionsGo');
        });
    });

    // For Permissions
    Route::group(['prefix' => 'permissions'], function(){
        Route::controller(PermissionController::class)->group(function(){
            Route::get('data', 'index')->name('permissions');
            Route::get('create', 'create')->name('permissions.create');
            Route::post('create', 'store');
            Route::get('{permission}/show', 'show')->name('permissions.show');
            Route::get('{permission}/edit', 'edit')->name('permissions.edit');
            Route::put('{permission}/edit', 'update');
            Route::delete('{permission}/delete', 'destroy')->name('permissions.delete');
        });
    });
});

Route::group(['prefix' => 'setting'], function(){
    Route::controller(SettingController::class)->group(function(){
        Route::get('data', 'index')->name('settings');
        Route::put('edit', 'update')->name('settings.edit');
    });
});
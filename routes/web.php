<?php

use App\Http\Controllers\AmenityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;

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

Route::group(['prefix' => 'services'], function(){
    Route::group(['prefix' => 'rooms'], function(){
        Route::group(['prefix' => 'type'], function(){
            Route::controller(RoomTypeController::class)->group(function(){
                Route::get('data', 'index')->name('rooms.types');
                Route::get('create', 'create')->name('rooms.types.create');
                Route::post('create', 'store');
                Route::get('{roomType}/show', 'show')->name('rooms.types.show');
                Route::get('{roomType}/edit', 'edit')->name('rooms.types.edit');
                Route::put('{roomType}/edit', 'update');
                Route::delete('{roomType}/delete', 'destroy')->name('rooms.types.delete');

            });

            Route::group(['prefix' => 'amenity'], function(){
                Route::controller(AmenityController::class)->group(function(){
                    Route::get('data', 'index')->name('amenities');
                    Route::get('create', 'create')->name('amenities.create');
                    Route::post('create', 'store');
                    Route::get('{amenity}/assign', 'show')->name('amenities.assign');
                    Route::post('{amenity}/assign', 'assignRoomTypes');
                    Route::get('{amenity}/edit', 'edit')->name('amenities.edit');
                    Route::put('{amenity}/edit', 'update');
                    Route::delete('{amenity}/delete', 'destroy')->name('amenities.delete');
    
                });
            });
        });

        Route::controller(RoomController::class)->group(function(){
            Route::get('data', 'index')->name('rooms');
            Route::get('create', 'create')->name('rooms.create');
            Route::post('create', 'store');
            Route::get('{room}/show', 'show')->name('rooms.show');
            Route::get('{room}/edit', 'edit')->name('rooms.edit');
            Route::put('{room}/edit', 'update');
            Route::delete('{room}/delete', 'destroy')->name('rooms.delete');
        });
    });
});

Route::group(['prefix' => 'setting'], function(){
    Route::controller(SettingController::class)->group(function(){
        Route::get('data', 'index')->name('settings');
        Route::put('edit', 'update')->name('settings.edit');
    });
});
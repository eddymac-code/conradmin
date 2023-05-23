<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\BarController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\Client\HomePageController;
use App\Http\Controllers\Client\RoomPageController;
use App\Http\Controllers\Client\ContactsPageController;
use App\Http\Controllers\Client\FunAndFitnessPageController;
use App\Http\Controllers\Client\OpenAirEventsPageController;
use App\Http\Controllers\Client\RestaurantAndBarPageController;
use App\Http\Controllers\Client\ConferenceFacilitiesPageController;
use App\Http\Controllers\RestaurantController;
use App\Models\ConferenceFacility;

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

Route::get('/', [HomePageController::class, 'index'])->name('client.home');
Route::get('/rooms', [RoomPageController::class, 'index'])->name('client.rooms');
Route::get('/restaurants-bars', [RestaurantAndBarPageController::class, 'index'])->name('client.restaurantbar');
Route::get('/conference-facilities', [ConferenceFacilitiesPageController::class, 'index'])->name('client.conferences');
Route::get('/fun-fitness', [FunAndFitnessPageController::class, 'index'])->name('client.funfitness');
Route::get('open-air-events', [OpenAirEventsPageController::class, 'index'])->name('client.openairevents');
Route::get('/contacts', [ContactsPageController::class, 'index'])->name('client.contacts');

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

    Route::group(['prefix' => 'bars'], function(){
        Route::controller(BarController::class)->group(function(){
            Route::get('data', 'index')->name('bars');
            Route::get('create', 'create')->name('bars.create');
            Route::post('create', 'store');
            Route::get('{bar}/show', 'show')->name('bars.show');
            Route::get('{bar}/edit', 'edit')->name('bars.edit');
            Route::put('{bar}/edit', 'update');
            Route::delete('{bar}/delete', 'destroy')->name('bars.delete');
        });
    });

    Route::group(['prefix' => 'restaurant'], function(){
        Route::controller(RestaurantController::class)->group(function(){
            Route::get('data', 'index')->name('restaurants');
            Route::get('create', 'create')->name('restaurants.create');
            Route::post('create', 'store');
            Route::get('{restaurant}/show', 'show')->name('restaurants.show');
            Route::get('{restaurant}/edit', 'edit')->name('restaurants.edit');
            Route::put('{restaurant}/edit', 'update');
            Route::delete('{restaurant}/delete', 'destroy')->name('restaurants.delete');
        });
    });

    Route::group(['prefix' => 'conference-facilities'], function(){
        Route::controller(ConferenceFacility::class)->group(function(){
            Route::get('data', 'index')->name('facilities');
            Route::get('create', 'create')->name('facilities.create');
            Route::post('create', 'store');
            Route::get('{conferenceFacility}/show', 'show')->name('facilities.show');
            Route::get('{conferenceFacility}/edit', 'edit')->name('facilities.edit');
            Route::put('{conferenceFacility}/edit', 'update');
            Route::delete('{conferenceFacility}/delete', 'destroy')->name('facilities.delete');
        });
    });
});

Route::group(['prefix' => 'setting'], function(){
    Route::controller(SettingController::class)->group(function(){
        Route::get('data', 'index')->name('settings');
        Route::put('edit', 'update')->name('settings.edit');
    });
});

Route::group(['prefix' => 'pages'], function(){
    Route::controller(PageController::class)->group(function(){
        Route::get('data', 'index')->name('pages');
        Route::get('create', 'create')->name('pages.create');
        Route::post('create', 'store');
        Route::get('{id}/show', 'show')->name('pages.show');
        Route::get('{id}/edit', 'edit')->name('pages.edit');
        Route::put('{id}/edit', 'update');
        Route::delete('{id}/delete', 'destroy')->name('pages.delete');
    });
});
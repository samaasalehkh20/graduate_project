<?php

use App\Http\Controllers\Dashboard\AssetController;
use App\Http\Controllers\Dashboard\AssetLocationController;
use App\Http\Controllers\Dashboard\AssetNameController;
use App\Http\Controllers\Dashboard\AssetTypeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\GroupController;
use App\Http\Controllers\Dashboard\MeasurementUnitController;
use App\Http\Controllers\Dashboard\SubdivisionController;
use App\Http\Controllers\Dashboard\SystemConstantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/', function () {
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->prefix(LaravelLocalization::setLocale().'/dashboard')->group(callback: function() {

    Route::get('/', function() {
        return view('dashboard');
    })->name('home');

    // Start Category Route
    Route::controller(CategoryController::class)
        ->prefix('categories')
        ->as('category.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Category Route

    // Start Subdivision Route
    Route::controller(SubdivisionController::class)
        ->prefix('subdivisions')
        ->as('subdivision.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Subdivision Route

    // Start Group Route
    Route::controller(GroupController::class)
        ->prefix('groups')
        ->as('group.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Group Route

    // Start Asset Type Route
    Route::controller(AssetTypeController::class)
        ->prefix('asset_types')
        ->as('asset_type.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Asset Type Route

    // Start Asset Name Route
    Route::controller(AssetNameController::class)
        ->prefix('asset_names')
        ->as('asset_name.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Asset Name Route

    // Start Asset Location Route
    Route::controller(AssetLocationController::class)
        ->prefix('asset_locations')
        ->as('asset_location.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Asset Location Route

    // Start Measurement Unit Route
    Route::controller(MeasurementUnitController::class)
        ->prefix('measurement_units')
        ->as('measurement_unit.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End Measurement Unit Route

    // Start Asset Route
    Route::controller(AssetController::class)
        ->prefix('assets')
        ->as('asset.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');

            // Alter Routes
            Route::get('/getSubdivision', 'getSubdivision')->name('getSubdivision');
            Route::get('/getGroup', 'getGroup')->name('getGroup');
            Route::get('/getSubGroup', 'getSubGroup')->name('getSubGroup');
            Route::get('/getAssetType', 'getAssetType')->name('getAssetType');
        });
    // End Asset Route

    // Start System Constant Route
    Route::controller(SystemConstantController::class)
        ->prefix('system_constants')
        ->as('system_constant.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit','edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    // End System Constant Route

});


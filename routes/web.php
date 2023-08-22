<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SpecialServiceOrderController;
use App\Http\Controllers\Admin\MaintenanceTechnicianController;

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

Route::get('/xclear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'cleared';
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/client/{client}/get-location', [ClientController::class, 'getLocation']);
    Route::get('/join-requests', [MaintenanceTechnicianController::class, 'joinRequests']);
    Route::get('/get-location', [MaintenanceTechnicianController::class, 'getLocation']);
    Route::post('/reject/{maintenanceTechnician}', [MaintenanceTechnicianController::class, 'reject']);
    Route::post('/approve/{maintenanceTechnician}', [MaintenanceTechnicianController::class, 'approve']);
    Route::resource('clients', ClientController::class);
    Route::resource('maintenance-technicians', MaintenanceTechnicianController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('special-service-orders', SpecialServiceOrderController::class);
});

require __DIR__ . '/auth.php';

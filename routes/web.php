<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
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

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/clear', 'clear');
    });
    Route::controller(ClientController::class)->group(function () {
        Route::get('/client/get-location', 'getLocation');
    });
    Route::controller(MaintenanceTechnicianController::class)->group(function () {
        Route::get('/maintenance-technician/get-location', 'getLocation');
        Route::get('/join-requests', 'joinRequests');
        Route::post('/reject/{maintenanceTechnician}', 'reject');
        Route::post('/approve/{maintenanceTechnician}', 'approve');
    });
    Route::resource('clients', ClientController::class);
    Route::resource('maintenance-technicians', MaintenanceTechnicianController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('special-service-orders', SpecialServiceOrderController::class);
});

require __DIR__ . '/auth.php';

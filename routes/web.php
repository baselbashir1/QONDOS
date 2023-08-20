<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaintenanceTechnicianController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubCategoryController;

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
    Route::resource('clients', ClientController::class);
    Route::resource('maintenance-technicians', MaintenanceTechnicianController::class);
    Route::get('/join-requests', [MaintenanceTechnicianController::class, 'joinRequests']);
    Route::post('/approve/{maintenanceTechnician}', [MaintenanceTechnicianController::class, 'approve']);
    Route::post('/reject/{maintenanceTechnician}', [MaintenanceTechnicianController::class, 'reject']);
    Route::get('/get-location', [MaintenanceTechnicianController::class, 'getLocation']);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('orders', OrderController::class);
});

require __DIR__ . '/auth.php';

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\MaintenanceTechnicianController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SubCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/client/login', [ClientController::class, 'login']);
Route::post('/client/register', [ClientController::class, 'register']);
Route::middleware(['auth:api-client', 'scopes:client'])->group(function () {
    Route::get('/client/logout', [ClientController::class, 'logout']);
    Route::get('/client/profile', [ClientController::class, 'getProfile']);
    Route::post('/client/makeOrder', [ClientController::class, 'makeOrder']);
    Route::post('/client/request-special-service', [ClientController::class, 'requestSpecialService']);
    Route::post('/client/set-location', [ClientController::class, 'setLocation']);
    Route::get('/client/locations', [ClientController::class, 'getLocations']);
    Route::post('/client/{clientAddress}/choose-location', [ClientController::class, 'chooseLocation']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('sub-categories', SubCategoryController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('orders', OrderController::class);
});

// Route::post('/client/login', [ClientController::class, 'login']);
// Route::post('/client/register', [ClientController::class, 'register']);
// Route::middleware(['auth:api-client', 'scopes:client'])->group(function () {
//     Route::get('/client/logout', [ClientController::class, 'logout']);
//     Route::get('/client/profile', [ClientController::class, 'getProfile']);
//     Route::post('/client/makeOrder', [ClientController::class, 'makeOrder']);
//     Route::apiResource('categories', CategoryController::class);
//     Route::apiResource('sub-categories', SubCategoryController::class);
//     Route::apiResource('services', ServiceController::class);
//     Route::apiResource('orders', OrderController::class);
// });

Route::post('/maintenance-technician/login', [MaintenanceTechnicianController::class, 'login']);
Route::post('/maintenance-technician/register', [MaintenanceTechnicianController::class, 'register']);
Route::middleware(['auth:api-maintenance-technician', 'scopes:maintenance-technician'])->group(function () {
    Route::get('/maintenance-technician/profile', [MaintenanceTechnicianController::class, 'getProfile']);
    Route::get('/maintenance-technician/logout', [MaintenanceTechnicianController::class, 'logout']);
    Route::get('/show-orders', [MaintenanceTechnicianController::class, 'showOrders']);
});

Route::apiResource('clients', ClientController::class);
Route::apiResource('maintenance-technicians', MaintenanceTechnicianController::class);

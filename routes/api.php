<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\MaintenanceTechnicianController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:api')->get('/client', function (Request $request) {
//     return $request->user();
// });

Route::post('/client/login', [ClientController::class, 'login']);
Route::middleware(['auth:api-client', 'scopes:client'])->group(function () {
    Route::get('/client/logout', [ClientController::class, 'logout']);
    Route::get('/client/profile', [ClientController::class, 'getProfile']);
    // Route::post('/client/{service}/makeOrder', [ClientController::class, 'makeOrder']);
    Route::post('/client/makeOrder', [ClientController::class, 'makeOrder']);
    // Route::get('/client/main-categories', [ClientController::class, 'index']);
    // Route::apiResource('clients', ClientController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('sub-categories', SubCategoryController::class);
    Route::apiResource('services', ServiceController::class);
});

Route::post('/maintenance-technician/login', [MaintenanceTechnicianController::class, 'login']);
Route::middleware(['auth:api-maintenance-technician', 'scopes:maintenance-technician'])->group(function () {
    Route::get('/maintenance-technician/profile', [MaintenanceTechnicianController::class, 'getProfile']);
    Route::get('/maintenance-technician/logout', [MaintenanceTechnicianController::class, 'logout']);
});

Route::apiResource('clients', ClientController::class);
Route::apiResource('maintenance-technicians', MaintenanceTechnicianController::class);

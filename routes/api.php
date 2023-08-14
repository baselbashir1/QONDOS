<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\MaintenanceTechnicianController;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/client', function (Request $request) {
    return $request->user();
});

Route::post('/client/login', [ClientController::class, 'login']);
Route::get('/client/profile', [ClientController::class, 'getProfile'])->middleware(['auth:api-client', 'scopes:client']);
Route::get('/client/logout', [ClientController::class, 'logout'])->middleware(['auth:api-client', 'scopes:client']);

Route::post('/maintenance-technician/login', [MaintenanceTechnicianController::class, 'login']);
Route::get('/maintenance-technician/profile', [MaintenanceTechnicianController::class, 'getProfile'])->middleware(['auth:api-maintenance-technician', 'scopes:maintenance-technician']);
Route::get('/maintenance-technician/logout', [MaintenanceTechnicianController::class, 'logout'])->middleware(['auth:api-maintenance-technician', 'scopes:maintenance-technician']);

// Route::get('list/categories', [CategoryController::class], 'list');
// Route::apiResource('categories', [CategoryController::class]);

Route::apiResource('clients', ClientController::class);

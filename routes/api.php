<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DistanceController;
use App\Http\Controllers\API\MaintenanceTechnicianController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SettingController;
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

Route::controller(ClientController::class)->group(function () {
    Route::prefix('client')->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
    });
});

Route::middleware(['auth:api-client', 'scopes:client'])->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::prefix('client')->group(function () {
            Route::get('/logout', 'logout');
            Route::get('/profile', 'getProfile');
            Route::post('/update-profile', 'updateProfile');
            Route::post('/make-order', 'makeOrder');
            Route::post('/request-special-service', 'requestSpecialService');
            Route::post('/set-location', 'setLocation');
            Route::get('/locations', 'getLocations');
            Route::post('/choose-location/{clientAddress}', 'chooseLocation');
            Route::get('/show-order-offers/{order}', 'showOrderOffers');
            Route::post('/update-offer-order-status', 'updateOfferAndOrderStatus');
            Route::post('/evaluate-maintenance', 'evaluateMaintenance');
            Route::post('/send-message', 'sendMessage');
        });
    });
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('offers', OfferController::class);
});

Route::controller(MaintenanceTechnicianController::class)->group(function () {
    Route::prefix('maintenance-technician')->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
    });
});

Route::middleware(['auth:api-maintenance-technician', 'scopes:maintenance-technician'])->group(function () {
    Route::controller(MaintenanceTechnicianController::class)->group(function () {
        Route::prefix('maintenance-technician')->group(function () {
            Route::get('/logout', 'logout');
            Route::get('/profile', 'getProfile');
            Route::post('/update-profile', 'updateProfile');
            Route::get('/show-orders', 'showOrders');
            Route::post('/send-offer/{order}', 'sendOffer');
            Route::post('/update-offer-order-status', 'updateOfferAndOrderStatus');
            Route::post('/send-offer-to-special-order/{specialServiceOrder}', 'sendOfferToSpecialOrder');
        });
    });
});

Route::apiResource('clients', ClientController::class);
Route::apiResource('maintenance-technicians', MaintenanceTechnicianController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('sub-categories', SubCategoryController::class);
Route::apiResource('services', ServiceController::class);

Route::post('/set-distance', [DistanceController::class, 'setDistance']);
Route::post('/update-settings', [SettingController::class, 'updateSettings']);

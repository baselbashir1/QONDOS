<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DistanceController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SpecialServiceOrderController;
use App\Http\Controllers\Admin\MaintenanceTechnicianController;
use App\Http\Controllers\Admin\SettingController;

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
        Route::get('/get-sub-category/{id}', 'getSubCategory');
        Route::get('/get-main-category/{id}', 'getMainCategory');
    });
    Route::controller(ClientController::class)->group(function () {
        Route::get('/client/get-location', 'getLocation');
        Route::post('/accept-offer/{offer}', 'acceptOffer');
        Route::post('/reject-offer/{offer}', 'rejectOffer');
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
    Route::resource('contacts', ContactController::class);
    Route::resource('offers', OfferController::class);

    Route::get('/message-send-replay/{contact}', [ContactController::class, 'messageSendReply']);
    Route::post('/message-replay/{contact}', [ContactController::class, 'messageReply']);
    Route::get('/order-offers/{order}', [OrderController::class, 'orderOffers']);

    Route::get('/settings', [SettingController::class, 'index']);
    Route::post('/update-settings', [SettingController::class, 'updateSettings']);
});

require __DIR__ . '/auth.php';

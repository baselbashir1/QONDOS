<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MaintenanceTechnicianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', function () {
        return view('index');
    });
    Route::resource('clients', ClientController::class);
    Route::resource('maintenance-technicians', MaintenanceTechnicianController::class);
});

require __DIR__ . '/auth.php';

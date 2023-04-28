<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeterReadingController;
use App\Http\Controllers\WaterMeterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function ($router) {
    $router->post('/login', 'login');
    $router->post('/register', 'register');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    /** Provide all meter readings for all meters of a specific customer */
    Route::prefix('/customers')->controller(CustomerController::class)->group(function ($router) {
        $router->get('/{customer}', 'userMeterReadings');
    });

    /** CURD */
    Route::prefix('/water-meters')->controller(WaterMeterController::class)->group(function ($router) {
        $router->get('/', 'index');
        $router->post('/', 'store');
        $router->get('/{waterMeter}', 'show');
        $router->put('update/{waterMeter}', 'update');
        $router->delete('/destroy/{waterMeter}', 'destroy');
    });

    /** CURD */
    Route::prefix('/meter-readings')->controller(MeterReadingController::class)->group(function ($router) {
        $router->get('/', 'index');
        $router->post('/', 'store');
        $router->get('/{meterReading}', 'show');
        $router->put('update/{meterReading}', 'update');
        $router->delete('/destroy/{meterReading}', 'destroy');
    });
});

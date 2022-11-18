<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\PhisicalResourceController;
use App\Http\Controllers\ReservationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('service-providers', ServiceProviderController::class);
Route::get('service-providers-search/{page?}/{keyword?}', [ServiceProviderController::class, 'search']);
Route::get('service-providers/{provider_id}/phisical-resources', [ServiceProviderController::class, 'get_phisical_resources']);

Route::apiResource('phisical-resources', PhisicalResourceController::class);
Route::get('phisical-resources-search/{page?}/{keyword?}', [PhisicalResourceController::class, 'search']);

Route::apiResource('reservations', ReservationController::class);
Route::get('reservations-search/{page?}/{keyword?}/{start_time?}/{end_time?}', [ReservationController::class, 'search']);

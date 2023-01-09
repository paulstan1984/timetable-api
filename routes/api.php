<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\PhisicalResourceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use \App\Http\Middleware\ValidateAccessToken;

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

Route::middleware(['access_token'])->group(function () {
    Route::apiResource('service-providers', ServiceProviderController::class);
    Route::get('service-providers-search/{page?}/{keyword?}', [ServiceProviderController::class, 'search']);
    Route::get('service-providers/{provider_id}/phisical-resources', [ServiceProviderController::class, 'get_phisical_resources']);

    Route::apiResource('phisical-resources', PhisicalResourceController::class);
    Route::get('phisical-resources-search/{page?}/{keyword?}/{service_provider_id?}', [PhisicalResourceController::class, 'search']);

    Route::apiResource('reservations', ReservationController::class);
    Route::get('reservations-search/{page?}/{keyword?}/{start_time?}/{end_time?}', [ReservationController::class, 'search']);
});

Route::withoutMiddleware([ValidateAccessToken::class])->group(function () {

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
});

/***
 * To Do:
 *  - create a middleware to read and validate the access_token
 */

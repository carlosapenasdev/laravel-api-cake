<?php

use App\Http\Controllers\Api\{
    CakeController,
    LeadController
};
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});

Route::apiResource('cake', CakeController::class);
Route::apiResource('lead', LeadController::class);

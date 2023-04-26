<?php

use App\Http\Controllers\InviteController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TileController;
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

Route::post('/signup', [SignupController::class, 'signup']);

Route::post('/admin/invite', [InviteController::class, 'inviteAdmin']);
Route::post('/invite', [InviteController::class, 'inviteUser']);
Route::post('/accept/{email}/{token}', [InviteController::class, 'accept']);

Route::apiResource('shops', ShopController::class);

Route::apiResource('locations', LocationsController::class)->only([
    'index', 'show'
]);

Route::apiResource('maps', MapController::class)->only([
    'index', 'show'
]);

Route::apiResource('tiles', TileController::class)->only([
    'index', 'show'
]);

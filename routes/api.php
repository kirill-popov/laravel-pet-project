<?php

use App\Http\Controllers\InviteController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TileController;
use App\Http\Controllers\UserController;
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
Route::post('/login', [LoginController::class, 'login']);

Route::get('/accept/{id}/{token}', [InviteController::class, 'view_prefill_data'])
    ->middleware('invite.valid');
Route::post('/accept/{id}/{token}', [InviteController::class, 'accept'])
    ->middleware('invite.valid')
    ->name('invite.accept');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::post('/admin/invite', [InviteController::class, 'inviteAdmin']);
    Route::post('/invite', [InviteController::class, 'inviteUser']);

    Route::apiResource('shops', ShopController::class)
    ->only([
        'index', 'show'
    ]);
    Route::get('shops/search/{name}', [ShopController::class, 'search']);

    Route::get('admin/users', [UserController::class, 'adminsIndex']);
    Route::get('admin/users/invited', [UserController::class, 'adminsInvitedIndex']);
});




Route::apiResource('locations', LocationsController::class)->only([
    'index', 'show'
]);

Route::apiResource('maps', MapController::class)->only([
    'index', 'show'
]);

Route::apiResource('tiles', TileController::class)->only([
    'index', 'show'
]);

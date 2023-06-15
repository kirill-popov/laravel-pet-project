<?php

use App\Http\Controllers\InviteController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminRole;
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

Route::get('invite/accept/{token}', [InviteController::class, 'viewPrefillData'])
    ->middleware('invite.valid');
Route::post('invite/accept/{token}', [InviteController::class, 'accept'])
    ->middleware('invite.valid')
    ->name('invite.accept');

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware([AdminRole::class])->group(function () {
        Route::get('admin/users', [UserController::class, 'adminsIndex']);
        Route::get('admin/users/invited', [UserController::class, 'adminsInvitedIndex']);

        Route::post('admin/invite', [InviteController::class, 'inviteAdmin']);

        Route::apiResource('shops', ShopController::class)
        ->only([
            'index', 'show'
        ]);
        Route::get('shops/search/{name}', [ShopController::class, 'search']);
    });

    Route::post('logout', [LoginController::class, 'logout']);

    Route::post('invite', [InviteController::class, 'inviteUser']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/invited', [UserController::class, 'indexInvited']);

    Route::apiResource('locations', LocationsController::class);

    Route::apiResource('map', MapController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);

    Route::apiResource('tiles', TileController::class)->only([
        'index', 'show', 'store'
    ]);
});

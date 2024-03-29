<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('shop', 'ShopCrudController');
    Route::crud('tile', 'TileCrudController');
    Route::crud('invite', 'InviteCrudController');
    Route::crud('location', 'LocationCrudController');
    Route::crud('map', 'MapCrudController');
    Route::crud('photo', 'PhotoCrudController');
    Route::crud('prefecture', 'PrefectureCrudController');
    Route::crud('social', 'SocialCrudController');
    Route::crud('transaction', 'TransactionCrudController');
}); // this should be the absolute last line of this file
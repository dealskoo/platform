<?php

use Illuminate\Support\Facades\Route;
use Dealskoo\Platform\Http\Controllers\Seller\PlatformController;

Route::middleware(['web', 'seller_locale'])->prefix(config('seller.route.prefix'))->name('seller.')->group(function () {

    Route::middleware(['guest:seller'])->group(function () {

    });

    Route::middleware(['auth:seller', 'verified:seller.verification.notice', 'seller_active', 'subscription:advanced'])->group(function () {

        Route::resource('platforms', PlatformController::class)->except(['show']);

        Route::middleware(['password.confirm:seller.password.confirm'])->group(function () {

        });
    });
});

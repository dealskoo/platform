<?php

use Dealskoo\Platform\Http\Controllers\Admin\PlatformController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'admin_locale'])->prefix(config('admin.route.prefix'))->name('admin.')->group(function () {

    Route::middleware(['guest:admin'])->group(function () {

    });

    Route::middleware(['auth:admin', 'admin_active'])->group(function () {
        Route::resource('platforms', PlatformController::class)->except(['create', 'store']);
    });

});

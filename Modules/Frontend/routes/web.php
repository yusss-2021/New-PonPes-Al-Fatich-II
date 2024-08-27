<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Http\Controllers\BlogController;
use Modules\Frontend\Http\Controllers\DonasiController;
use Modules\Frontend\Http\Controllers\FrontendController;
use Modules\Frontend\Http\Controllers\ProfileController;
use Modules\Frontend\Http\Controllers\WakafController;

Route::middleware('web')->group(function () {
    Route::controller(FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('frontend.index');
        Route::get('/handle_payment', 'handle_payment')->name('payment.handle');
        Route::get('/get_status_payment/{id}', 'get_status_payment')->name('payment.status');
        Route::post('/update_status_payment/{id}', 'update_status_payment')->name('payment.update');
    });

    Route::controller(BlogController::class)->prefix('berita')->group(function () {
        Route::get('/', 'index')->name('frontend.blog.index');
        Route::get('/{id}', 'show')->name('frontend.blog.show');
    });

    Route::controller(WakafController::class)->prefix('wakaf')->group(function () {
        Route::get('/', 'index')->name('frontend.wakaf.index');
        Route::get('/{id}', 'show')->name('frontend.wakaf.show');
        Route::get('/{id}/donate', 'donate')->name('frontend.wakaf.donate');
        Route::post('/getSnapToken/{id}', 'getSnapToken')->name('frontend.wakaf.payment');
    });

    Route::controller(DonasiController::class)->prefix('donasi')->group(function () {
        Route::get('/', 'index')->name('frontend.donasi.index');
        Route::get('/action/{id}', 'donate')->name('frontend.donasi.action');
        Route::post('/getSnapTokenDonasi{id}', 'getSnapToken')->name('frontend.donasi.payment');
    });

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/tantang_kami', 'index')->name('frontend.profile.abount-me');
        Route::get('/gallery', 'gallery')->name('frontend.profile.gallery');
    });
});

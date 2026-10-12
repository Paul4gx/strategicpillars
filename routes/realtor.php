<?php

use App\Http\Controllers\Realtor\DashboardController;
use App\Http\Controllers\Realtor\EstateController;
use App\Http\Controllers\Realtor\OnboardingController;
use App\Http\Controllers\Realtor\PropertyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'realtor'])->prefix('realtor')->name('realtor.')->group(function () {
    Route::get('onboarding', [OnboardingController::class, 'edit'])->name('onboarding.edit');
    Route::put('onboarding', [OnboardingController::class, 'update'])->name('onboarding.update');

    Route::middleware(['realtor.profile'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('properties/store-data', [PropertyController::class, 'storeData'])->name('properties.store-data');
        Route::post('properties/store-images/{property}', [PropertyController::class, 'storeImages'])->name('properties.store-images');
        Route::post('properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('properties/update-data/{property}', [PropertyController::class, 'updateData'])->name('properties.update-data');
        Route::put('properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('properties/image/{image}', [PropertyController::class, 'deleteImage'])->name('properties.deleteImage');

        Route::get('estates', [EstateController::class, 'index'])->name('estates.index');
        Route::get('estates/create', [EstateController::class, 'create'])->name('estates.create');
        Route::post('estates', [EstateController::class, 'store'])->name('estates.store');
        Route::get('estates/{estate}/edit', [EstateController::class, 'edit'])->name('estates.edit');
        Route::put('estates/{estate}', [EstateController::class, 'update'])->name('estates.update');
        Route::delete('estates/image/{id}', [EstateController::class, 'deleteImage'])->name('estates.deleteImage');
    });
});

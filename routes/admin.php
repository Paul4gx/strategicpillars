<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class);
    
    // Two-step property creation routes
    Route::post('properties/store-data', [App\Http\Controllers\Admin\PropertyController::class, 'storeData'])->name('properties.store-data');
    Route::post('properties/store-images/{property}', [App\Http\Controllers\Admin\PropertyController::class, 'storeImages'])->name('properties.store-images');
    
    // Two-step property editing routes
    Route::put('properties/update-data/{property}', [App\Http\Controllers\Admin\PropertyController::class, 'updateData'])->name('properties.update-data');
    
    // Other admin routes will go here
    Route::delete('properties/image/{id}', [App\Http\Controllers\Admin\PropertyController::class, 'deleteImage'])->name('properties.deleteImage');
    Route::resource('estates', App\Http\Controllers\Admin\EstateController::class);
    Route::delete('estates/image/{id}', [App\Http\Controllers\Admin\EstateController::class, 'deleteImage'])->name('estates.deleteImage');
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
    Route::post('bookings/block-dates/{propertyId}', [App\Http\Controllers\Admin\BookingController::class, 'blockDates'])->name('bookings.blockDates');
    Route::resource('team', App\Http\Controllers\Admin\TeamMemberController::class);
}); 
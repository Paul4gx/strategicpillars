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
    Route::delete('properties/image/{image}', [App\Http\Controllers\Admin\PropertyController::class, 'deleteImage'])->name('properties.deleteImage');
    Route::resource('estates', App\Http\Controllers\Admin\EstateController::class);
    Route::delete('estates/image/{id}', [App\Http\Controllers\Admin\EstateController::class, 'deleteImage'])->name('estates.deleteImage');
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
    Route::post('bookings/block-dates/{propertyId}', [App\Http\Controllers\Admin\BookingController::class, 'blockDates'])->name('bookings.blockDates');
    Route::patch('team/{team}/listing-account', [App\Http\Controllers\Admin\TeamMemberController::class, 'toggleListingAccount'])->name('team.toggle-listing-account');
    Route::patch('team/{team}/visibility', [App\Http\Controllers\Admin\TeamMemberController::class, 'toggleVisibility'])->name('team.toggle-visibility');
    Route::post('team/{team}/resend-invite', [App\Http\Controllers\Admin\TeamMemberController::class, 'resendInvite'])->name('team.resend-invite');
    Route::resource('team', App\Http\Controllers\Admin\TeamMemberController::class);
    Route::get('team-invite', [App\Http\Controllers\Admin\RealtorInviteController::class, 'create'])->name('team.invite.create');
    Route::post('team-invite', [App\Http\Controllers\Admin\RealtorInviteController::class, 'store'])->name('team.invite.store');
}); 
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PropertyController as FrontPropertyController;
use App\Http\Controllers\ShortletController;
use App\Http\Controllers\EstateController as FrontEstateController;
use App\Http\Controllers\InteriorController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/homes', [HomeController::class, 'homes'])->name('homes');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::prefix('company')->name('company.')->group(function () {
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
});
// Route::post('/company/contact', [ContactController::class, 'send'])->name('company.contact.send');
Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
Route::get('/properties/home', [FrontPropertyController::class, 'home'])->name('properties.home');
Route::get('/properties', [FrontPropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [FrontPropertyController::class, 'show'])->name('properties.show');
Route::get('/shortlets', [ShortletController::class, 'index'])->name('shortlets.index');
Route::get('/shortlets/{slug}', [ShortletController::class, 'show'])->name('shortlets.show');
Route::get('/estates', [FrontEstateController::class, 'index'])->name('estates.index');
Route::get('/estates/{slug}', [FrontEstateController::class, 'show'])->name('estates.show');
Route::get('/interiors', [InteriorController::class, 'index'])->name('interiors.index');
Route::get('/interiors/{slug}', [InteriorController::class, 'show'])->name('interiors.show');
Route::post('/newsletter/subscribe', [InteriorController::class, 'index'])->name('newsletter.subscribe');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ThemeController;
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/uslugi', [SiteController::class, 'services'])->name('services');
Route::get('/flota', [SiteController::class, 'fleet'])->name('fleet');
Route::get('/cennik', [SiteController::class, 'pricing'])->name('pricing');
Route::get('/faq', [SiteController::class, 'faq'])->name('faq');
Route::get('/kontakt', [SiteController::class, 'contact'])->name('contact');
Route::get('/rezerwacja', [BookingController::class, 'form'])->name('booking.form');
Route::post('/rezerwacja', [BookingController::class, 'send'])->middleware('throttle:5,1')->name('booking.send');
Route::post('/theme/toggle', [ThemeController::class, 'toggle'])->name('theme.toggle');

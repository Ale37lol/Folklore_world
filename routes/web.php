<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\DeityController;
use App\Http\Controllers\CreatureController;
use App\Http\Controllers\LegendController;

Route::redirect('/', '/folklore-world');
Route::get('/cultures/{culture}', [CultureController::class, 'show']);
Route::get('/folklore-world', [HomeController::class, 'index'])->name('home');
Route::get('/map', [HomeController::class, 'map'])->name('map');
Route::resource('cultures', CultureController::class)->only(['index', 'show']);
Route::get('/creatures/search', [CreatureController::class, 'search'])->name('creatures.search');
Route::resource('creatures', CreatureController::class)->only(['index', 'show']);
Route::get('/deities/search', [DeityController::class, 'search'])->name('deities.search');
Route::resource('deities', DeityController::class)->only(['index', 'show']);
Route::get('/legends/search', [LegendController::class, 'search'])->name('legends.search');
Route::resource('legends', LegendController::class)->only(['index', 'show']);
Route::get('/cultures/{culture}/details', [CultureController::class, 'details'])->name('cultures.details');
Route::get('/deities/{deity}', [DeityController::class, 'show'])->name('deities.show');
Route::get('/legends/{legend}', [LegendController::class, 'show'])->name('legends.show');

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CultureApiController;
use App\Http\Controllers\CreatureApiController;
use App\Http\Controllers\DeityApiController;
use App\Http\Controllers\HomeApiController;
use App\Http\Controllers\LegendApiController;

Route::get('/home', [HomeApiController::class, 'index']);
Route::get('/cultures', [CultureApiController::class, 'index']);
Route::get('/creatures', [CreatureApiController::class, 'index']);
Route::get('/deities', [DeityApiController::class, 'index']);
Route::get('/legends', [LegendApiController::class, 'index']);

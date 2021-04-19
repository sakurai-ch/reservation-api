<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\StoresController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ReservationsController;

use Illuminate\Support\Facades\Route;


// Route::apiResource('/v1/store', StoresController::class);
Route::get('/v1/store', [StoresController::class, 'index']);
Route::get('/v1/store/{store_id}', [StoresController::class, 'show']);
Route::post('/v1/user', [UsersController::class, 'post']);
Route::get('/v1/user', [UsersController::class, 'get']);
Route::post('/v1/login', [LoginController::class, 'post']);
Route::post('/v1/logout', [LogoutController::class, 'post']);
Route::post('/v1/favorite', [FavoritesController::class, 'post']);
Route::delete('/v1/favorite', [FavoritesController::class, 'delete']);
Route::get('/v1/favorite', [FavoritesController::class, 'get']);
Route::post('/v1/reservation', [ReservationsController::class, 'post']);
Route::delete('/v1/reservation', [ReservationsController::class, 'delete']);
Route::get('/v1/reservation', [ReservationsController::class, 'get']);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

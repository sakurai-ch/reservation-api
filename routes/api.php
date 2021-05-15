<?php

use App\Http\Controllers\StoresController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;


Route::get('/v1/store', [StoresController::class, 'index']);
Route::get('/v1/store/{id}', [StoresController::class, 'show']);
Route::post('/v1/user', [UsersController::class, 'post']);
// Route::group(['middleware' => 'auth:api'],function () {
// Route::group(['middleware' => 'api'], function () {
  Route::get('/v1/user', [UsersController::class, 'get']);
  Route::post('/v1/logout', [LogoutController::class, 'post']);
// });
Route::post('/v1/login', [LoginController::class, 'post']);
Route::post('/v1/favorite', [FavoritesController::class, 'post']);
Route::delete('/v1/favorite', [FavoritesController::class, 'delete']);
Route::post('/v1/reservation', [ReservationsController::class, 'post']);
Route::delete('/v1/reservation', [ReservationsController::class, 'delete']);
Route::get('/v1/reservation', [ReservationsController::class, 'get']);
Route::patch('/v1/reservation', [ReservationsController::class, 'patch']);
Route::get('/v1/area', [AreasController::class, 'get']);
Route::get('/v1/genre', [GenresController::class, 'get']);

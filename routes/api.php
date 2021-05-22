<?php

use App\Http\Controllers\StoresController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;


Route::get('/v1/store', [StoresController::class, 'index']);
Route::get('/v1/store/{id}', [StoresController::class, 'show']);
Route::get('/v1/area', [AreasController::class, 'get']);
Route::get('/v1/genre', [GenresController::class, 'get']);

Route::post('/v1/user', [UsersController::class, 'post']);
Route::post('/v1/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
  Route::post('/v1/logout', [AuthController::class, 'logout']);
  Route::post('/v1/reservation', [ReservationsController::class, 'post']);
  Route::delete('/v1/reservation', [ReservationsController::class, 'delete']);
  Route::get('/v1/reservation', [ReservationsController::class, 'get']);
  Route::patch('/v1/reservation', [ReservationsController::class, 'patch']);
  Route::post('/v1/favorite', [FavoritesController::class, 'post']);
  Route::delete('/v1/favorite', [FavoritesController::class, 'delete']);
});

Route::patch('/v1/store/{id}', [StoresController::class, 'update']);
Route::get('/v1/manager', [ManagerController::class, 'get']);

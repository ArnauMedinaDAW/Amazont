<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionController;

// Ruta para obtener el usuario autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('login', AutenticacionController::class);

Route::apiResource('login', [AutenticacionController::class, 'login']);

Route::apiResource('register', [AutenticacionController::class, 'register']);


Route::get('/hello', function () {
    return "Hello World!";
  });


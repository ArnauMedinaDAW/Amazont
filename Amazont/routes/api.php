<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\MetodoPagoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('auth', UserController::class);
Route::apiResource('products', ProductController::class);
Route::get('products/categoria/{categoriaId}', [ProductController::class, 'getByCategoria']);

Route::apiResource('categories', CategoriaController::class);

Route::apiResource('carrito', CarritoController::class);
Route::post('/carrito/updateCantidadPrecio', [CarritoController::class, 'actualizarCantidad']);
Route::get('/carrito/activo/{iduser}', [CarritoController::class, 'carritoActivo']);
Route::get('/carrito/historial/{iduser}', [CarritoController::class, 'historial']);
Route::put('/carrito/finalizar/{iduser}', [CarritoController::class, 'finalizarCompra']);
Route::delete('/carritos/eliminar-varios', [CarritoController::class, 'eliminarVarios']);



Route::post('auth/login', [UserController::class, 'login']);
Route::get('carrito/user/{userId}', [CarritoController::class, 'userCarrito']);

Route::apiResource('opiniones', OpinionController::class);
Route::apiResource('valoraciones', ValoracionController::class);

Route::apiResource('metodoPago', MetodoPagoController::class);

Route::get('productos/{id}/opiniones', [ProductController::class, 'opiniones']);
Route::get('productos/{id}/valoraciones', [ProductController::class, 'valoraciones']);
Route::get('productos/{id}/valoraciones', [ProductController::class, 'valoraciones']);
Route::get('productos/{id}/valoraciones', [ProductController::class, 'valoraciones']);

Route::post('auth/actualizar-perfil', [UserController::class, 'actualizarPerfil']);

Route::post('auth/actualizar-contra', [UserController::class, 'actualizarContra']);
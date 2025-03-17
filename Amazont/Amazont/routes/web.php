<?php
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AutenticacionController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AutenticacionController::class, 'login']);

Route::post('/logout', [AutenticacionController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    // Otras rutas protegidas
    Route::get('/profile', [UserController::class, 'profile']);
});

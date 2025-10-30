<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Reservas - Sistema completo de reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::get('/reservas/pista/{pista}', [ReservaController::class, 'mostrarPista'])->name('reservas.pista');
Route::get('/reservas/pista/{pista}/horarios', [ReservaController::class, 'obtenerHorarios'])->name('reservas.horarios');

// Catálogo
Route::get('/catalogo', function () {
    return view('catalogo');
})->name('catalogo');

// Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas personalizadas de X3 Pádel
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])->name('mis-reservas');
    
    // Rutas de reservas (requieren autenticación)
    Route::post('/reservas/crear', [ReservaController::class, 'crear'])->name('reservas.crear');
    Route::delete('/reservas/{reserva}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');
});

// Rutas de administración (protegidas con middleware admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/search', [App\Http\Controllers\AdminController::class, 'searchUsers'])->name('admin.users.search');
    Route::patch('/users/{user}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::patch('/users/{user}/toggle-admin', [App\Http\Controllers\AdminController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');
});

require __DIR__.'/auth.php';

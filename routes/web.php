<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Reservas
Route::get('/reservas', function () {
    return view('reservas');
})->name('reservas');

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
    Route::get('/mis-reservas', function () {
        return view('mis-reservas');
    })->name('mis-reservas');
});

require __DIR__.'/auth.php';

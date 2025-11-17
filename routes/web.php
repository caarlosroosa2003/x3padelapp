<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use Illuminate\Http\Request;
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
Route::get('/catalogo', function (Request $request) {
    $categoriaSeleccionada = $request->input('categoria', 'Todas');
    $terminoBusqueda = trim((string) $request->input('q', ''));
    $ordenSeleccionado = $request->input('orden', 'recientes');

    $productosQuery = \App\Models\Product::activos()->select([
        'id',
        'nombre',
        'precio',
        'categoria',
        'imagen',
        'stock',
        'descripcion',
        'created_at',
    ]);

    if ($categoriaSeleccionada && $categoriaSeleccionada !== 'Todas') {
        $productosQuery->porCategoria($categoriaSeleccionada);
    }

    if ($terminoBusqueda !== '') {
        $productosQuery->where(function ($query) use ($terminoBusqueda) {
            $query->where('nombre', 'like', '%' . $terminoBusqueda . '%')
                ->orWhere('descripcion', 'like', '%' . $terminoBusqueda . '%');
        });
    }

    switch ($ordenSeleccionado) {
        case 'precio_menor':
            $productosQuery->orderBy('precio', 'asc');
            break;
        case 'precio_mayor':
            $productosQuery->orderBy('precio', 'desc');
            break;
        case 'nombre_asc':
            $productosQuery->orderBy('nombre', 'asc');
            break;
        case 'nombre_desc':
            $productosQuery->orderBy('nombre', 'desc');
            break;
        default:
            $productosQuery->latest('created_at');
            break;
    }

    $productos = $productosQuery->get();
    $categorias = ['Todas', 'Palas', 'Calzado', 'Accesorios', 'Ropa', 'Otros'];

    return view('catalogo', compact(
        'productos',
        'categorias',
        'categoriaSeleccionada',
        'terminoBusqueda',
        'ordenSeleccionado'
    ));
})->name('catalogo');

// Detalle público de producto
Route::get('/producto/{product}', function (\App\Models\Product $product) {
    abort_unless($product->activo, 404);
    return view('producto', compact('product'));
})->name('producto.show');

// Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Rutas protegidas para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Personalizadas de X3 Pádel
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])->name('mis-reservas');

    // Acciones de reservas
    Route::post('/reservas/crear', [ReservaController::class, 'crear'])->name('reservas.crear');
    Route::delete('/reservas/{reserva}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');
    Route::post('/reservas/{reserva}/check-in', [ReservaController::class, 'checkIn'])->name('reservas.check-in');
});

// Panel de administración (protegido con middleware admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/users/search', [App\Http\Controllers\AdminController::class, 'searchUsers'])->name('users.search');
    Route::patch('/users/{user}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
    Route::patch('/users/{user}/toggle-admin', [App\Http\Controllers\AdminController::class, 'toggleAdmin'])->name('users.toggle-admin');

    // CRUD de productos
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

    // Reservas (panel admin)
    Route::get('/reservas', [App\Http\Controllers\AdminController::class, 'reservations'])->name('reservas.index');
    
    // Procesar reservas completadas (para administradores o comando programado)
    Route::post('/reservas/procesar-completadas', [ReservaController::class, 'procesarReservasCompletadas'])->name('reservas.procesar-completadas');
});

require __DIR__.'/auth.php';

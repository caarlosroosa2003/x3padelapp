# 🔐 Instalar Sistema de Autenticación Completo

## ¿Qué hemos hecho?

✅ **Arreglado el error "Route [register] not defined"**

Se han creado:
- Rutas temporales para `/login`, `/register` y `/logout`
- Vistas temporales que muestran formularios pero no funcionan aún
- Un mensaje informativo indicando que la autenticación está pendiente

## Estado Actual

Las páginas de login y register ahora son **accesibles** pero **no funcionales**. Puedes verlas en:
- http://localhost:8000/login
- http://localhost:8000/register

Los formularios están deshabilitados con un mensaje que indica cómo instalar la autenticación completa.

---

## 📦 Instalar Laravel Breeze (Sistema Completo)

### ¿Qué es Laravel Breeze?

Laravel Breeze es un paquete oficial de Laravel que incluye:
- ✅ Sistema completo de registro
- ✅ Sistema de login/logout
- ✅ Recuperación de contraseña
- ✅ Verificación de email
- ✅ Gestión de perfil
- ✅ Protección de rutas con middleware
- ✅ Todo ya diseñado y funcional

### Pasos de Instalación

#### 1. Instalar Laravel Breeze

```bash
cd "C:\Users\carom\Documents\X3 Padel\x3padelapp"
composer require laravel/breeze --dev
```

#### 2. Instalar Breeze con Blade (no React ni Vue)

```bash
php artisan breeze:install blade
```

**Te preguntará:**
- **Dark mode support?** → Puedes elegir `no` (o `yes` si lo prefieres)
- **Which testing framework?** → Puedes elegir `Pest` o `PHPUnit` (recomiendo PHPUnit)

#### 3. Configurar la Base de Datos

**Opción A - SQLite (más fácil, ya configurado):**
Ya tienes un archivo `database.sqlite` en `database/`, así que:

```bash
php artisan migrate
```

**Opción B - MySQL (si prefieres):**

1. Edita el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=x3padel
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

2. Crea la base de datos:
```sql
CREATE DATABASE x3padel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. Ejecuta las migraciones:
```bash
php artisan migrate
```

#### 4. Compilar los Assets

```bash
npm run dev
```

#### 5. Iniciar el Servidor

```bash
php artisan serve
```

---

## 🎨 Personalizar las Vistas de Breeze

Después de instalar Breeze, las vistas se crearán en:
```
resources/views/auth/
├── login.blade.php          # Reemplazará la temporal
├── register.blade.php       # Reemplazará la temporal
├── forgot-password.blade.php
├── reset-password.blade.php
└── verify-email.blade.php
```

### Aplicar el Estilo de X3 Pádel

Para que las páginas de autenticación tengan el mismo diseño que el resto de tu aplicación, necesitarás:

1. **Cambiar el color principal** en las vistas de Breeze:
   - Buscar `indigo` y reemplazar por `[#C3E617]`
   - Buscar `blue` y reemplazar por `[#C3E617]` donde corresponda

2. **Usar el layout de X3 Pádel:**
   Las vistas de Breeze usan un layout llamado `guest.blade.php`. Puedes:
   - Modificar `resources/views/layouts/guest.blade.php` para usar el mismo diseño
   - O cambiar `@extends('layouts.guest')` por `@extends('layouts.app')` en cada vista

---

## 🔄 Actualizar las Rutas Existentes

Después de instalar Breeze, **ELIMINA** las rutas temporales en `routes/web.php`:

```php
// ❌ ELIMINAR estas líneas:
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/logout', function () {
    return redirect('/');
})->name('logout');
```

Breeze ya habrá añadido sus propias rutas en `routes/auth.php`.

---

## 📝 Añadir Campos Personalizados

Si quieres añadir campos adicionales al registro (como teléfono, dirección, etc.):

### 1. Crear una migración:
```bash
php artisan make:migration add_phone_to_users_table
```

### 2. Editar la migración:
```php
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('telefono')->nullable()->after('email');
        $table->boolean('is_admin')->default(false)->after('password');
        $table->integer('reservas_count')->default(0)->after('is_admin');
        $table->integer('reservas_gratis_disponibles')->default(0)->after('reservas_count');
    });
}
```

### 3. Ejecutar la migración:
```bash
php artisan migrate
```

### 4. Actualizar el formulario de registro:
Edita `resources/views/auth/register.blade.php` y añade el campo teléfono.

### 5. Actualizar el controlador:
Edita `app/Http/Controllers/Auth/RegisteredUserController.php`:
```php
$request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'telefono' => ['nullable', 'string', 'max:20'], // ← Añadir
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'telefono' => $request->telefono, // ← Añadir
    'password' => Hash::make($request->password),
]);
```

### 6. Actualizar el modelo User:
Edita `app/Models/User.php`:
```php
protected $fillable = [
    'name',
    'email',
    'telefono',      // ← Añadir
    'password',
    'is_admin',
    'reservas_count',
    'reservas_gratis_disponibles',
];
```

---

## 🛡️ Proteger Rutas

Una vez instalada la autenticación, puedes proteger rutas:

```php
// Solo usuarios autenticados
Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])
    ->middleware('auth')
    ->name('mis-reservas');

// Solo administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('admin/productos', ProductoController::class);
});
```

Para el middleware de admin, crea:
```bash
php artisan make:middleware IsAdmin
```

En `app/Http/Middleware/IsAdmin.php`:
```php
public function handle(Request $request, Closure $next)
{
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403, 'No autorizado');
    }
    return $next($request);
}
```

Registra el middleware en `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\IsAdmin::class,
    ]);
})
```

---

## 🎯 Resumen Rápido

```bash
# Instalar Breeze
composer require laravel/breeze --dev
php artisan breeze:install blade

# Migrar base de datos
php artisan migrate

# Compilar assets
npm run dev

# Iniciar servidor
php artisan serve
```

¡Listo! Tu aplicación X3 Pádel tendrá autenticación completa y funcional. 🎾✨



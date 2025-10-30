# ✅ Sistema de Autenticación Completo - X3 Pádel

## 🎉 ¡Todo Listo!

El sistema de autenticación completo ha sido instalado y configurado con éxito. Aquí está lo que se ha implementado:

## 📋 Lo que se ha completado

### 1. **Laravel Breeze Instalado** ✅
- Sistema completo de autenticación
- Registro de usuarios
- Inicio de sesión
- Cierre de sesión
- Recuperación de contraseña
- Verificación de email

### 2. **Base de Datos Configurada** ✅
- Migración de usuarios con campos personalizados:
  - `name` - Nombre del usuario
  - `email` - Email (único)
  - `telefono` - Teléfono (opcional)
  - `password` - Contraseña (encriptada)
  - `is_admin` - Si es administrador (default: false)
  - `reservas_count` - Contador de reservas (default: 0)
  - `reservas_gratis_disponibles` - Reservas gratis acumuladas (default: 0)

### 3. **Vistas Personalizadas** ✅
- Login con diseño de X3 Pádel
- Registro con:
  - Campo de teléfono
  - Información del programa de recompensas
  - Diseño con colores corporativos (#C3E617)

### 4. **Rutas Configuradas** ✅
```
GET /register        - Formulario de registro
POST /register       - Procesar registro
GET /login           - Formulario de login
POST /login          - Procesar login
POST /logout         - Cerrar sesión
GET /forgot-password - Recuperar contraseña
...y más
```

### 5. **Sección "Nosotros" Eliminada** ✅
- Ruta eliminada
- Vista eliminada
- Enlaces del navbar removidos

---

## 🚀 Cómo Usar el Sistema

### Acceder a las Páginas

**Registro:**
```
http://localhost:8000/register
```

**Login:**
```
http://localhost:8000/login
```

**Dashboard (solo autenticados):**
```
http://localhost:8000/dashboard
```

### Crear el Primer Usuario

1. Inicia el servidor: `php artisan serve`
2. Visita: http://localhost:8000/register
3. Completa el formulario:
   - Nombre
   - Email
   - Teléfono (opcional)
   - Contraseña
   - Confirmar contraseña
4. Clic en "Registrarse"
5. ¡Listo! Serás redirigido al dashboard automáticamente

---

## 👤 Crear el Primer Administrador

### Opción 1: Desde la Base de Datos (HeidiSQL)

1. Abre HeidiSQL
2. Conéctate a tu base de datos
3. Selecciona la base de datos `x3padel`
4. Ve a la tabla `users`
5. Encuentra el usuario que quieres hacer administrador
6. Edita el registro y cambia `is_admin` de `0` a `1`
7. Guarda los cambios

### Opción 2: Desde Tinker (Terminal)

```bash
php artisan tinker
```

Luego ejecuta:
```php
$user = User::where('email', 'tu@email.com')->first();
$user->is_admin = true;
$user->save();
exit
```

---

## 🔐 Proteger Rutas

### Solo Usuarios Autenticados

En `routes/web.php`:

```php
Route::middleware('auth')->group(function () {
    Route::get('/mis-reservas', function () {
        return view('mis-reservas');
    })->name('mis-reservas');
});
```

### Solo Administradores

**Paso 1:** Crear el middleware

```bash
php artisan make:middleware IsAdmin
```

**Paso 2:** Editar `app/Http/Middleware/IsAdmin.php`:

```php
public function handle(Request $request, Closure $next)
{
    if (!auth()->check() || !auth()->user()->is_admin) {
        abort(403, 'Acceso no autorizado');
    }
    return $next($request);
}
```

**Paso 3:** Registrar en `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\IsAdmin::class,
    ]);
})
```

**Paso 4:** Usar en rutas:

```php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
```

---

## 📊 Usar los Datos del Usuario

### En las Vistas (Blade)

```blade
@auth
    <p>Bienvenido, {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    <p>Teléfono: {{ Auth::user()->telefono ?? 'No proporcionado' }}</p>
    <p>Reservas realizadas: {{ Auth::user()->reservas_count }}</p>
    <p>Reservas gratis disponibles: {{ Auth::user()->reservas_gratis_disponibles }}</p>
    
    @if(Auth::user()->is_admin)
        <p>Eres administrador</p>
    @endif
@endauth
```

### En los Controladores

```php
$user = auth()->user();
$userName = $user->name;
$isAdmin = $user->is_admin;
```

---

## 🎁 Sistema de Recompensas

Para implementar el sistema de "5 reservas = 1 gratis":

```php
// Cuando se crea una reserva
$user = auth()->user();
$user->reservas_count++;

if ($user->reservas_count % 5 == 0) {
    $user->reservas_gratis_disponibles++;
}

$user->save();
```

```php
// Cuando se usa una reserva gratis
if ($user->reservas_gratis_disponibles > 0) {
    $user->reservas_gratis_disponibles--;
    $user->save();
    // No cobrar
} else {
    // Cobrar normalmente
}
```

---

## 🗄️ Configurar MySQL con HeidiSQL

Si aún no has configurado MySQL:

1. **Crear la base de datos en HeidiSQL:**
   - Nombre: `x3padel`
   - Conjunto de caracteres: `utf8mb4`
   - Cotejamiento: `utf8mb4_unicode_ci`

2. **Editar `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=x3padel
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

3. **Ejecutar migraciones:**
```bash
php artisan migrate
```

---

## 🎨 Personalización Adicional

### Cambiar el Color de los Botones

Edita `resources/views/components/primary-button.blade.php`

### Modificar el Logo

Reemplaza `public/images/logo.svg` con tu logo

### Añadir Más Campos al Registro

1. Crea una nueva migración:
```bash
php artisan make:migration add_direccion_to_users_table --table=users
```

2. Añade el campo al formulario de registro
3. Actualiza el controlador `RegisteredUserController`
4. Actualiza el modelo `User` (`$fillable`)

---

## 📝 Rutas Disponibles

| Ruta | Descripción | Requiere Auth |
|------|-------------|---------------|
| `/` | Página de inicio | No |
| `/reservas` | Ver pistas disponibles | No |
| `/catalogo` | Catálogo de productos | No |
| `/contacto` | Formulario de contacto | No |
| `/register` | Registro | No (solo guests) |
| `/login` | Inicio de sesión | No (solo guests) |
| `/dashboard` | Panel de usuario | Sí |
| `/profile` | Editar perfil | Sí |
| `/mis-reservas` | Ver mis reservas | Sí |

---

## ✨ Próximos Pasos Sugeridos

1. **Crear el sistema de reservas** (Base de datos + Controladores + Vistas)
2. **Implementar el catálogo de productos** (CRUD completo)
3. **Panel de administración** (Dashboard con estadísticas)
4. **Sistema de notificaciones por email**
5. **Implementar el pago de reservas**

---

## 🐛 Solución de Problemas

### "Route [dashboard] not defined"
Asegúrate de que la ruta dashboard esté definida en `routes/web.php`

### "Unauthenticated"
Verifica que el usuario esté autenticado con `auth()->check()`

### Los cambios no se reflejan
```bash
php artisan view:clear
php artisan config:clear
php artisan cache:clear
npm run build
```

---

¡El sistema de autenticación está completamente funcional! 🎉

Puedes comenzar a registrar usuarios y probar todas las funcionalidades.




# 🎯 Panel de Administración - X3 Pádel

## 📋 Descripción

El panel de administración de X3 Pádel permite gestionar usuarios, ver estadísticas y administrar el sistema de manera centralizada.

## 🔐 Acceso al Panel

### URL de acceso
```
http://localhost:8000/admin
```

### Requisitos
- Tener una cuenta registrada
- Tener permisos de administrador (`is_admin = true`)

## 🚀 Crear un Administrador

### Método 1: Comando Artisan (Recomendado)

```bash
php artisan user:make-admin email@ejemplo.com
```

**Ejemplo:**
```bash
php artisan user:make-admin admin@x3padel.com
```

### Método 2: Manualmente en la Base de Datos

1. Abre tu gestor de base de datos (phpMyAdmin, TablePlus, etc.)
2. Ve a la tabla `users`
3. Encuentra el usuario que quieres hacer administrador
4. Cambia el campo `is_admin` de `0` a `1`
5. Guarda los cambios

### Método 3: Usando Tinker

```bash
php artisan tinker
```

Luego ejecuta:
```php
$user = User::where('email', 'admin@x3padel.com')->first();
$user->is_admin = true;
$user->save();
```

## 📊 Funcionalidades del Panel

### 1. Dashboard Principal (`/admin`)
- **Estadísticas generales:**
  - Total de usuarios registrados
  - Nuevos usuarios del mes
  - Total de administradores
- **Usuarios recientes:** Lista de los 5 últimos usuarios registrados
- **Accesos rápidos:** Enlaces directos a secciones importantes

### 2. Gestión de Usuarios (`/admin/users`)

#### Características:
- ✅ Ver lista completa de usuarios con paginación
- ✅ Buscar usuarios por nombre, email o teléfono
- ✅ Editar información de usuarios
- ✅ Conceder/revocar permisos de administrador
- ✅ Administrar reservas gratis disponibles
- ✅ Eliminar usuarios
- ✅ Protección: no puedes modificar tu propia cuenta de admin

#### Información visible por usuario:
- Nombre y avatar (inicial)
- Email y teléfono
- Total de reservas realizadas
- Reservas gratis disponibles
- Estado (Usuario / Admin)
- Fecha de registro

#### Acciones disponibles:
1. **Editar** - Modificar nombre, email, teléfono, reservas gratis y estado de admin
2. **Toggle Admin** - Convertir usuario normal en admin o viceversa
3. **Eliminar** - Eliminar usuario del sistema (con confirmación)

## 🛡️ Seguridad

### Middleware `IsAdmin`
Todas las rutas de administración están protegidas por el middleware `admin` que verifica:

1. **Autenticación:** El usuario debe estar logueado
2. **Permisos:** El usuario debe tener `is_admin = true`

**Ubicación del middleware:** `app/Http/Middleware/IsAdmin.php`

### Protecciones implementadas:
- ❌ No puedes eliminar tu propia cuenta de administrador
- ❌ No puedes quitarte tus propios permisos de administrador
- ✅ Acceso denegado (403) si intentas acceder sin permisos
- ✅ Redirección al login si no estás autenticado
- ✅ Confirmación antes de eliminar usuarios

## 🎨 Diseño

El panel de administración utiliza:
- **Paleta de colores de X3 Pádel:**
  - Verde principal: `#C3E617`
  - Verde hover: `#d4f73a`
  - Negro/Gris para navegación
  
- **Componentes UI:**
  - Tarjetas de estadísticas con iconos
  - Tablas responsivas
  - Modales para edición
  - Badges de estado
  - Animaciones suaves (hover, transitions)

## 📁 Estructura de Archivos

```
app/
├── Console/
│   └── Commands/
│       └── MakeUserAdmin.php          # Comando para crear admins
├── Http/
│   ├── Controllers/
│   │   └── AdminController.php        # Controlador principal del admin
│   └── Middleware/
│       └── IsAdmin.php                # Middleware de protección
└── Models/
    └── User.php                        # Modelo con campo is_admin

resources/
└── views/
    └── admin/
        ├── dashboard.blade.php         # Vista del dashboard
        └── users.blade.php             # Vista de gestión de usuarios

routes/
└── web.php                            # Rutas protegidas con middleware

bootstrap/
└── app.php                            # Registro del middleware 'admin'
```

## 🔗 Rutas Disponibles

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/admin` | `admin.dashboard` | Dashboard principal |
| GET | `/admin/users` | `admin.users` | Lista de usuarios |
| GET | `/admin/users/search` | `admin.users.search` | Buscar usuarios |
| PATCH | `/admin/users/{user}` | `admin.users.update` | Actualizar usuario |
| DELETE | `/admin/users/{user}` | `admin.users.delete` | Eliminar usuario |
| PATCH | `/admin/users/{user}/toggle-admin` | `admin.users.toggle-admin` | Cambiar permisos admin |

## 🎯 Próximas Funcionalidades (Sugerencias)

- [ ] Gestión de reservas desde el panel admin
- [ ] Gestión de pistas (crear, editar, eliminar)
- [ ] Estadísticas avanzadas (gráficos)
- [ ] Sistema de notificaciones
- [ ] Gestión de productos del catálogo
- [ ] Logs de actividad
- [ ] Exportar datos (CSV, PDF)
- [ ] Configuración del sistema

## 💡 Consejos de Uso

1. **Primer administrador:** Crea al menos un usuario administrador usando el comando artisan después de registrarte.
2. **Búsqueda rápida:** Usa la barra de búsqueda para encontrar usuarios específicos por nombre, email o teléfono.
3. **Reservas gratis:** Puedes ajustar manualmente las reservas gratis de cualquier usuario desde el panel.
4. **Navegación:** El enlace "Panel Admin" aparece automáticamente en el menú si eres administrador.

## 🐛 Solución de Problemas

### No puedo acceder al panel de administración
- ✅ Verifica que estés logueado
- ✅ Verifica que tu usuario tenga `is_admin = true` en la base de datos
- ✅ Limpia la caché: `php artisan cache:clear`

### Error 403 - Forbidden
- Tu usuario no tiene permisos de administrador
- Usa el comando `php artisan user:make-admin tu@email.com`

### No veo el enlace "Panel Admin" en la navegación
- Solo aparece si tu usuario tiene `is_admin = true`
- Cierra sesión y vuelve a iniciar sesión

## 📞 Soporte

Si tienes problemas o sugerencias para mejorar el panel de administración, contacta al equipo de desarrollo.

---

**Desarrollado para X3 Pádel** 🎾


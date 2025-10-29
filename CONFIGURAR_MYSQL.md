# 🗄️ Configurar MySQL con HeidiSQL para X3 Pádel

## Paso 1: Crear la Base de Datos en HeidiSQL

1. **Abre HeidiSQL**
2. **Conéctate a tu servidor MySQL/MariaDB**
3. **Crea una nueva base de datos:**
   - Clic derecho en tu conexión
   - Selecciona "Crear nueva" → "Base de datos"
   - Nombre: `x3padel`
   - Conjunto de caracteres: `utf8mb4`
   - Cotejamiento: `utf8mb4_unicode_ci`
   - Clic en "OK"

## Paso 2: Configurar el archivo .env

Abre el archivo `.env` en la raíz del proyecto (`x3padelapp/.env`) y modifica estas líneas:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=x3padel
DB_USERNAME=root
DB_PASSWORD=tu_contraseña_aqui
```

**IMPORTANTE:** Reemplaza `tu_contraseña_aqui` con la contraseña de tu MySQL/MariaDB.

## Paso 3: Ejecutar las Migraciones

Una vez configurado el `.env`, ejecuta:

```bash
cd "C:\Users\carom\Documents\X3 Padel\x3padelapp"
php artisan migrate
```

Esto creará todas las tablas necesarias:
- `users` - Usuarios del sistema
- `password_reset_tokens` - Para recuperar contraseñas
- `sessions` - Sesiones de usuarios
- `cache` - Para mejorar el rendimiento
- `jobs` - Para tareas en segundo plano

## Paso 4: Ver las Tablas en HeidiSQL

Después de ejecutar las migraciones:

1. En HeidiSQL, haz clic derecho en la base de datos `x3padel`
2. Selecciona "Refrescar"
3. Verás todas las tablas creadas

## Solución de Problemas

### Error: "Access denied for user"
- Verifica que el usuario y contraseña en `.env` sean correctos
- Verifica que el servidor MySQL esté corriendo

### Error: "Unknown database 'x3padel'"
- Asegúrate de haber creado la base de datos en HeidiSQL primero

### Error: "Connection refused"
- Verifica que MySQL esté corriendo
- Verifica que el puerto sea el correcto (por defecto 3306)

## Añadir Campos Adicionales a la Tabla Users

Las siguientes modificaciones ya están listas para implementar. Ejecuta:

```bash
php artisan migrate
```

Esto añadirá los campos personalizados:
- `telefono` - Teléfono del usuario
- `is_admin` - Si es administrador (default: false)
- `reservas_count` - Contador de reservas (default: 0)
- `reservas_gratis_disponibles` - Reservas gratis acumuladas (default: 0)

---

**Nota:** Si prefieres usar SQLite (más simple, sin necesidad de HeidiSQL), el proyecto ya está configurado por defecto y solo necesitas ejecutar `php artisan migrate`.



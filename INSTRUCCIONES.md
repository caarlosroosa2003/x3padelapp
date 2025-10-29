# 🎾 Instrucciones para Ejecutar X3 Pádel

## 📋 Pasos Rápidos para Iniciar el Proyecto

### 1️⃣ Configurar Variables de Entorno

Si aún no has configurado el archivo `.env`:

```bash
# Copia el archivo de ejemplo
copy .env.example .env
```

**IMPORTANTE:** Edita el archivo `.env` y configura tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=x3padel
DB_USERNAME=root
DB_PASSWORD=tu_contraseña_aqui
```

### 2️⃣ Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 3️⃣ Compilar Assets (Tailwind CSS)

**Opción A - Modo Desarrollo (recomendado para trabajar):**
```bash
npm run dev
```
Este comando quedará ejecutándose y compilará automáticamente los cambios.

**Opción B - Compilar una sola vez:**
```bash
npm run build
```

### 4️⃣ Iniciar Servidor de Laravel

**En una nueva terminal** (si usaste `npm run dev`):

```bash
php artisan serve
```

### 5️⃣ Abrir el Navegador

Visita: **http://localhost:8000**

---

## 🚀 Comandos Útiles

### Ver todas las rutas disponibles:
```bash
php artisan route:list
```

### Limpiar caché:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Cuando crees las migraciones:
```bash
php artisan migrate
```

### Revertir migraciones:
```bash
php artisan migrate:rollback
```

### Crear migraciones nuevas:
```bash
php artisan make:migration nombre_de_la_migracion
```

### Crear modelos:
```bash
php artisan make:model NombreModelo -m  # -m crea también la migración
```

### Crear controladores:
```bash
php artisan make:controller NombreController
```

---

## 📁 Estructura de Páginas Actuales

| Ruta | Descripción |
|------|-------------|
| `/` | Página de inicio |
| `/reservas` | Sistema de reservas de pistas |
| `/catalogo` | Catálogo de productos |
| `/nosotros` | Información del centro |
| `/contacto` | Formulario de contacto |

---

## 🎨 Personalización del Logo

Si quieres reemplazar el logo SVG temporal:

1. Coloca tu logo en: `public/images/logo.svg` o `logo.png`
2. Si usas PNG, actualiza las referencias en:
   - `resources/views/layouts/app.blade.php` (líneas 10, 35, 138)
   - `resources/views/home.blade.php` (línea 33)

---

## 🛠️ Solución de Problemas

### Error: "Target class [Controller] does not exist"
```bash
composer dump-autoload
```

### Los estilos no se aplican:
```bash
# Detén npm run dev y vuelve a ejecutarlo
npm run dev
```

### Error de base de datos:
1. Verifica que MySQL esté ejecutándose
2. Verifica las credenciales en `.env`
3. Crea la base de datos manualmente:
```sql
CREATE DATABASE x3padel;
```

---

## ✅ Checklist de Inicio

- [ ] Archivo `.env` configurado
- [ ] Clave de aplicación generada (`php artisan key:generate`)
- [ ] Dependencias instaladas (`composer install` y `npm install`)
- [ ] Assets compilados (`npm run dev`)
- [ ] Servidor Laravel ejecutándose (`php artisan serve`)
- [ ] Navegador abierto en `http://localhost:8000`

---

## 📞 ¿Necesitas Ayuda?

Si encuentras algún problema:
1. Revisa que todos los servicios estén corriendo (MySQL, PHP, Node)
2. Verifica los logs en `storage/logs/laravel.log`
3. Limpia las cachés con los comandos mencionados arriba

¡Disfruta desarrollando X3 Pádel! 🎾✨



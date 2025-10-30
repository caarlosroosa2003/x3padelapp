# 🚀 Guía Rápida: Panel de Administración X3 Pádel

## ⚡ Inicio Rápido (3 pasos)

### 1️⃣ Registra un usuario
Ve a: `http://localhost:8000/register` y crea una cuenta.

### 2️⃣ Convierte el usuario en administrador
Abre una terminal en el directorio del proyecto y ejecuta:

```bash
php artisan user:make-admin tu@email.com
```

**Ejemplo:**
```bash
php artisan user:make-admin admin@x3padel.com
```

### 3️⃣ Accede al panel de administración
Ve a: `http://localhost:8000/admin`

---

## 📊 ¿Qué puedes hacer en el Panel Admin?

### 🏠 Dashboard (`/admin`)
- Ver estadísticas del sistema:
  - Total de usuarios
  - Nuevos usuarios del mes
  - Total de administradores
- Ver los 5 usuarios más recientes
- Accesos rápidos a otras secciones

### 👥 Gestión de Usuarios (`/admin/users`)
- ✅ Ver lista completa de todos los usuarios
- ✅ Buscar usuarios por nombre, email o teléfono
- ✅ Editar información de usuarios
- ✅ Modificar reservas gratis disponibles
- ✅ Dar o quitar permisos de administrador
- ✅ Eliminar usuarios (con confirmación)

---

## 🎨 Capturas del Panel

### Dashboard Principal
- Tarjetas de estadísticas con iconos
- Tabla de usuarios recientes
- Diseño moderno con los colores de X3 Pádel

### Gestión de Usuarios
- Tabla completa con información detallada
- Búsqueda en tiempo real
- Modal de edición elegante
- Acciones rápidas (editar, toggle admin, eliminar)

---

## 🔒 Seguridad

El panel está protegido por:
- **Autenticación requerida:** Debes estar logueado
- **Permisos de administrador:** Solo usuarios con `is_admin = true`
- **Protección contra auto-modificación:** No puedes eliminar tu cuenta ni quitarte permisos
- **Confirmaciones:** Todas las acciones destructivas requieren confirmación

---

## 🎯 Casos de Uso Comunes

### Hacer que otro usuario sea administrador
1. Ve a `/admin/users`
2. Busca el usuario
3. Haz clic en el icono del escudo 🛡️
4. El usuario ahora es admin

### Dar reservas gratis a un usuario
1. Ve a `/admin/users`
2. Busca el usuario
3. Haz clic en el icono de editar ✏️
4. Modifica "Reservas Gratis Disponibles"
5. Guarda los cambios

### Buscar un usuario específico
1. Ve a `/admin/users`
2. Usa la barra de búsqueda
3. Escribe nombre, email o teléfono
4. Haz clic en "Buscar"

---

## 📱 Navegación

Cuando eres administrador, verás automáticamente:
- En el menú de usuario: **"Panel Admin"**
- Este enlace te lleva a `/admin`

---

## 🐛 Problemas Comunes

### No veo el enlace "Panel Admin"
**Solución:** Asegúrate de que tu usuario tenga `is_admin = true`. Cierra sesión y vuelve a iniciar sesión.

### Error 403 al acceder a `/admin`
**Solución:** Tu usuario no tiene permisos. Ejecuta:
```bash
php artisan user:make-admin tu@email.com
```

### El comando no funciona
**Solución:** Asegúrate de estar en el directorio correcto:
```bash
cd x3padelapp
php artisan user:make-admin tu@email.com
```

---

## 💡 Tips Pro

1. **Búsqueda rápida:** La búsqueda funciona con email, nombre y teléfono
2. **Paginación:** Si tienes muchos usuarios, usa la paginación en la parte inferior
3. **Protección:** No puedes modificar tu propia cuenta de admin por seguridad
4. **Confirmaciones:** Todas las eliminaciones piden confirmación

---

## 🎨 Personalización

El panel usa los colores oficiales de X3 Pádel:
- **Verde principal:** `#C3E617`
- **Verde hover:** `#d4f73a`
- **Negro:** Para navegación y texto

---

## 📞 ¿Necesitas Ayuda?

Lee la documentación completa en: `PANEL_ADMINISTRACION.md`

---

**¡Disfruta gestionando X3 Pádel!** 🎾


# X3 Pádel - Aplicación Web de Gestión de Reservas

## Descripción

Aplicación web desarrollada en Laravel para la gestión de reservas en un centro deportivo especializado en pádel. La aplicación gestiona 4 pistas disponibles en distintos horarios e incluye un catálogo de productos.

## Características

### Funcionalidades Implementadas (Fase 1)

- ✅ Página de inicio moderna y atractiva
- ✅ Sistema de navegación responsive
- ✅ Página de Reservas con información de pistas y tarifas
- ✅ Catálogo de productos con categorías
- ✅ Sección "Nosotros" con información del centro
- ✅ Formulario de contacto
- ✅ Diseño responsive con Tailwind CSS
- ✅ Footer con información de contacto y redes sociales

### Características del Sistema

#### Para Usuarios Estándar:
- Visualización de disponibilidad de pistas
- Sistema de reservas online
- Catálogo de productos
- Programa de recompensas (5 reservas = 1 gratis)
- Perfil de usuario

#### Para Administradores:
- Panel de control administrativo
- Gestión de usuarios
- Gestión de reservas
- Gestión del catálogo de productos
- Estadísticas del centro

## Instalación y Configuración

### Requisitos Previos

- PHP >= 8.2
- Composer
- Node.js y NPM
- MySQL o PostgreSQL

### Pasos de Instalación

1. **Instalar dependencias de PHP:**
```bash
cd x3padelapp
composer install
```

2. **Instalar dependencias de Node.js:**
```bash
npm install
```

3. **Configurar el archivo .env:**
```bash
# Copia el archivo de ejemplo
copy .env.example .env

# Genera la clave de aplicación
php artisan key:generate
```

4. **Configurar la base de datos en .env:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=x3padel
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. **Ejecutar las migraciones (cuando estén creadas):**
```bash
php artisan migrate
```

6. **Compilar los assets:**
```bash
# Para desarrollo
npm run dev

# Para producción
npm run build
```

7. **Iniciar el servidor de desarrollo:**
```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

## Estructura del Proyecto

```
x3padelapp/
├── app/
│   ├── Http/Controllers/     # Controladores (pendiente)
│   └── Models/               # Modelos de datos
├── database/
│   ├── migrations/           # Migraciones de BD
│   └── seeders/              # Seeders
├── public/
│   └── images/               # Imágenes (logo)
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php # Layout principal
│   │   ├── home.blade.php    # Página de inicio
│   │   ├── reservas.blade.php # Página de reservas
│   │   ├── catalogo.blade.php # Catálogo de productos
│   │   ├── nosotros.blade.php # Sobre nosotros
│   │   └── contacto.blade.php # Contacto
│   ├── css/
│   └── js/
└── routes/
    └── web.php               # Rutas de la aplicación
```

## Paleta de Colores

- **Color Principal:** #C3E617 (Verde lima brillante)
- **Color Secundario:** #000000 (Negro)
- **Backgrounds:** Gradientes de negro a gris
- **Texto:** Grises variados

## Próximos Pasos de Desarrollo

### Fase 2: Autenticación y Usuario
- [ ] Implementar sistema de registro
- [ ] Implementar sistema de login
- [ ] Crear middleware de autenticación
- [ ] Crear perfil de usuario
- [ ] Diferenciar usuarios estándar y administrador

### Fase 3: Sistema de Reservas
- [ ] Crear modelo y migraciones para Reservas
- [ ] Crear modelo y migraciones para Pistas
- [ ] Implementar calendario de disponibilidad
- [ ] Sistema de selección de pista y horario
- [ ] Gestión de reservas (crear, cancelar)
- [ ] Sistema de recompensas (5 reservas = 1 gratis)

### Fase 4: Catálogo de Productos
- [ ] Crear modelo y migraciones para Productos
- [ ] Crear modelo para Categorías
- [ ] Sistema de búsqueda y filtrado
- [ ] Detalle de productos
- [ ] (Opcional) Sistema de compra online

### Fase 5: Panel Administrativo
- [ ] Dashboard con estadísticas
- [ ] CRUD de usuarios
- [ ] Gestión de reservas
- [ ] CRUD de productos
- [ ] Reportes y estadísticas

### Fase 6: Mejoras y Optimización
- [ ] Sistema de notificaciones por email
- [ ] Recordatorios de reservas
- [ ] Optimización de rendimiento
- [ ] Testing (Unit y Feature tests)
- [ ] Despliegue en producción

## Tarifas del Centro

- **Horario Diurno (8:00 - 16:00):** 15€/hora
- **Horario Normal (16:00 - 20:00):** 20€/hora
- **Horario Nocturno (20:00 - 23:00):** 18€/hora

## Pistas Disponibles

El centro cuenta con **4 pistas profesionales** con:
- Césped artificial premium
- Iluminación LED profesional
- Cristal panorámico
- Mantenimiento diario

## Contacto

- **Email:** info@x3padel.com
- **Teléfono:** +34 123 456 789
- **Horario:** Lunes a Domingo, 8:00 - 23:00

## Licencia

Este proyecto es propiedad de X3 Pádel.

---

**Desarrollado con ❤️ usando Laravel y Tailwind CSS**


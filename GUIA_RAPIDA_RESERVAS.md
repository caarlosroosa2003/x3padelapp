# 🚀 Guía Rápida - Sistema de Reservas X3 Pádel

## ✅ ¡Sistema Completado!

El sistema de reservas está **100% funcional** y listo para usar.

---

## 📊 ¿Qué se ha creado?

### Base de Datos
- ✅ Tabla `pistas` - 4 pistas creadas
- ✅ Tabla `reservas` - Sistema de reservas

### Funcionalidades
- ✅ Selección de pista (4 disponibles)
- ✅ Calendario interactivo
- ✅ Horarios disponibles en tiempo real
- ✅ Reservas de 1h 30min
- ✅ Centro cerrado 14:00 - 17:00
- ✅ Programa de recompensas (5 reservas = 1 gratis)
- ✅ Cancelación de reservas

---

## 🎯 Cómo Usar

### 1. Acceder al Sistema
```
URL: http://localhost:8000/reservas
```

### 2. Flujo de Reserva
```
1. Ver las 4 pistas disponibles
2. Click en "Ver Horarios"
3. Seleccionar fecha en el calendario
4. Elegir horario disponible (verde)
5. Confirmar reserva
6. ¡Listo! Aparece en "Mis Reservas"
```

---

## ⏰ Horarios del Sistema

### Horarios de Apertura
- **Mañana:** 8:00 - 14:00
- **CERRADO:** 14:00 - 17:00 ⛔
- **Tarde:** 17:00 - 23:30

### Configuración
- **Duración:** 1h 30min por sesión
- **Precio:** 30€ por sesión
- **Intervalos:** Cada 1h 30min

### Ejemplo de Horarios
```
Mañana:
- 8:00 - 9:30
- 9:30 - 11:00
- 11:00 - 12:30
- 12:30 - 14:00

Tarde:
- 17:00 - 18:30
- 18:30 - 20:00
- 20:00 - 21:30
- 21:30 - 23:00
- 23:00 - 00:30 (termina a las 0:30)
```

---

## 🏟️ Las 4 Pistas

| Pista | Tipo | Descripción |
|-------|------|-------------|
| **Pista 1** | Exterior | Iluminación excelente |
| **Pista 2** | Exterior | Césped artificial premium |
| **Pista 3** | Cubierta | Climatizada, todo el año |
| **Pista 4** | Exterior | Vistas panorámicas |

---

## 🎁 Sistema de Recompensas

```
Cada 5 reservas → 1 GRATIS

Ejemplo:
1ra reserva → Contador: 1
2da reserva → Contador: 2
3ra reserva → Contador: 3
4ta reserva → Contador: 4
5ta reserva → Contador: 5 → ¡PREMIO! 1 reserva gratis

Siguiente reserva puedes usar la gratis (0€)
```

---

## 📁 Archivos Importantes

### Backend
```
app/Models/
├── Pista.php
└── Reserva.php

app/Http/Controllers/
└── ReservaController.php
```

### Frontend
```
resources/views/reservas/
├── index.blade.php ............ Lista de pistas
└── calendario.blade.php ....... Calendario y horarios
```

### Base de Datos
```
database/migrations/
├── create_pistas_table.php
└── create_reservas_table.php

database/seeders/
└── PistaSeeder.php
```

---

## 🛠️ Comandos Útiles

### Ver Pistas
```bash
php artisan tinker
Pista::all()
```

### Ver Reservas
```bash
php artisan tinker
Reserva::all()
```

### Recrear Pistas
```bash
php artisan db:seed --class=PistaSeeder
```

### Ver Rutas
```bash
php artisan route:list --path=reservas
```

---

## 🎨 Características Visuales

### Vista de Pistas
- Cards modernas para cada pista
- Badge de tipo (Exterior/Cubierta)
- Precio visible
- Botón "Ver Horarios"
- Estadísticas del usuario (si está logueado)

### Vista de Calendario
- Calendario de selección de fecha
- Horarios divididos en Mañana/Tarde
- Indicadores de disponibilidad (verde/rojo)
- Precio por horario
- Modal de confirmación elegante
- Opción de usar reserva gratis

---

## 🔒 Seguridad

- ✅ Autenticación requerida para reservar
- ✅ Usuarios solo pueden ver/cancelar sus reservas
- ✅ Validación de disponibilidad
- ✅ Prevención de reservas pasadas
- ✅ Protección CSRF

---

## 🧪 Prueba el Sistema

### Test 1: Hacer una Reserva
```
1. Iniciar sesión
2. Ir a /reservas
3. Click en "Ver Horarios" (Pista 1)
4. Seleccionar mañana
5. Click en horario 8:00 - 9:30
6. Confirmar
7. Verificar en "Mis Reservas"
```

### Test 2: Obtener Reserva Gratis
```
1. Hacer 5 reservas
2. En la 5ta, ver mensaje de premio
3. Hacer 6ta reserva
4. Marcar "Usar reserva gratis"
5. Precio debe ser 0€
```

### Test 3: Cancelar Reserva
```
1. Ir a "Mis Reservas"
2. Click en "Cancelar" en una reserva futura
3. Confirmar cancelación
4. Verificar estado "Cancelada"
```

---

## 📊 Rutas del Sistema

```
GET    /reservas                         → Lista de pistas
GET    /reservas/pista/{id}             → Calendario
GET    /reservas/pista/{id}/horarios    → Horarios AJAX
POST   /reservas/crear                  → Crear reserva
DELETE /reservas/{id}/cancelar          → Cancelar reserva
```

---

## 💡 Tips

### Para el Usuario
- Las reservas gratis se otorgan automáticamente cada 5 reservas
- Puedes cancelar reservas futuras cuando quieras
- El sistema muestra en tiempo real qué horarios están ocupados
- Los horarios de mañana y tarde están separados visualmente

### Para el Desarrollador
- Los horarios se generan dinámicamente
- La disponibilidad se verifica en tiempo real
- Sistema modular y fácil de extender
- Código limpio y comentado

---

## 🐛 Solución de Problemas

### No aparecen las pistas
```bash
php artisan db:seed --class=PistaSeeder
```

### No aparecen horarios
- Verificar que la fecha sea futura
- Verificar consola del navegador por errores JS
- Verificar que la pista esté disponible

### Error al reservar
- Verificar que estés logueado
- Verificar que el horario siga disponible
- Revisar logs: `storage/logs/laravel.log`

---

## 📖 Documentación Completa

Para más detalles, consulta:
📄 `SISTEMA_RESERVAS.md`

---

## ✨ Próximos Pasos

1. **Probar el sistema** en http://localhost:8000/reservas
2. **Crear algunas reservas** de prueba
3. **Verificar el sistema** de recompensas
4. **Personalizar** según necesites (precios, horarios, etc.)

---

**🎾 ¡El Sistema de Reservas está Listo!**
**Disfruta reservando en X3 Pádel**





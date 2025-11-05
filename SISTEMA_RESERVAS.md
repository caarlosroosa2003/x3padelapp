# 🎾 Sistema de Reservas - X3 Pádel

## 📋 Descripción General

Sistema completo de reservas de pistas con calendario interactivo, selección de horarios y gestión automática de disponibilidad.

---

## ✨ Características Principales

### 🏟️ Gestión de Pistas
- ✅ 4 pistas disponibles (3 exteriores + 1 cubierta)
- ✅ Información detallada de cada pista
- ✅ Estado de disponibilidad en tiempo real
- ✅ Imágenes y descripciones

### 📅 Sistema de Reservas
- ✅ Calendario interactivo
- ✅ Selección de fecha y hora
- ✅ Horarios de 1h 30min
- ✅ Visualización de disponibilidad en tiempo real
- ✅ Confirmación inmediata

### ⏰ Horarios
- **Mañana:** 8:00 - 14:00
- **CERRADO:** 14:00 - 17:00
- **Tarde:** 17:00 - 23:30
- **Duración:** 1h 30min por sesión
- **Precio:** 30€ por sesión

### 🎁 Programa de Recompensas
- ✅ Cada 5 reservas → 1 reserva GRATIS
- ✅ Contador automático de reservas
- ✅ Sistema de reservas gratis disponibles
- ✅ Opción de usar reserva gratis en el checkout

---

## 🗄️ Estructura de Base de Datos

### Tabla: `pistas`
```sql
- id (bigint)
- nombre (string) - Ej: "Pista 1"
- descripcion (text, nullable)
- tipo (string) - 'exterior' | 'cubierta'
- disponible (boolean) - default: true
- imagen (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### Tabla: `reservas`
```sql
- id (bigint)
- user_id (foreignId) → users.id
- pista_id (foreignId) → pistas.id
- fecha (date)
- hora_inicio (time)
- hora_fin (time)
- precio (decimal 8,2)
- es_gratis (boolean) - default: false
- estado (enum) - 'confirmada' | 'cancelada' | 'completada'
- notas (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)

Índices:
- (pista_id, fecha, hora_inicio)
- (user_id, fecha)
```

---

## 🎯 Flujo de Reserva

### 1. Selección de Pista
```
Usuario → /reservas
↓
Ve las 4 pistas disponibles
↓
Selecciona una pista
↓
Click en "Ver Horarios"
```

### 2. Selección de Fecha
```
Usuario → /reservas/pista/{id}
↓
Ve calendario
↓
Selecciona una fecha
↓
Sistema carga horarios disponibles (AJAX)
```

### 3. Selección de Horario
```
Sistema muestra horarios:
├─ Mañana (8:00-14:00)
│  ├─ 8:00 - 9:30 ✅ Disponible
│  ├─ 9:30 - 11:00 ❌ Ocupado
│  └─ ...
└─ Tarde (17:00-23:30)
   ├─ 17:00 - 18:30 ✅ Disponible
   └─ ...

Usuario selecciona horario disponible
```

### 4. Confirmación
```
Modal de confirmación muestra:
- Pista seleccionada
- Fecha
- Horario
- Precio (30€)
- Opción de usar reserva gratis (si tiene)

Usuario confirma
↓
Sistema crea reserva
↓
Incrementa contador de reservas
↓
Si es múltiplo de 5 → otorga reserva gratis
```

---

## 📁 Archivos del Sistema

### Modelos
```
app/Models/
├── Pista.php ......................... Modelo de pistas
│   ├── hasMany(Reserva)
│   └── estaDisponible($fecha, $horaInicio, $horaFin)
│
└── Reserva.php ....................... Modelo de reservas
    ├── belongsTo(User)
    ├── belongsTo(Pista)
    ├── scopeConfirmadas()
    ├── scopeFuturas()
    ├── esHoy()
    └── haPasado()
```

### Controlador
```
app/Http/Controllers/
└── ReservaController.php
    ├── index() ...................... Lista de pistas
    ├── mostrarPista($id) ............ Calendario y horarios
    ├── obtenerHorarios($id) ......... Horarios AJAX
    ├── crear() ...................... Crear reserva
    ├── cancelar($id) ................ Cancelar reserva
    └── generarHorariosDisponibles() . Lógica de horarios
```

### Vistas
```
resources/views/reservas/
├── index.blade.php .................. Selección de pista
└── calendario.blade.php ............. Calendario y horarios
```

### Migraciones
```
database/migrations/
├── 2025_10_30_110959_create_pistas_table.php
└── 2025_10_30_111007_create_reservas_table.php
```

### Seeder
```
database/seeders/
└── PistaSeeder.php .................. Crear 4 pistas
```

---

## 🛣️ Rutas

### Públicas
```php
GET  /reservas                           → Listar pistas
GET  /reservas/pista/{pista}            → Calendario
GET  /reservas/pista/{pista}/horarios   → Obtener horarios (AJAX)
```

### Autenticadas (requiere login)
```php
POST   /reservas/crear                  → Crear reserva
DELETE /reservas/{reserva}/cancelar     → Cancelar reserva
```

---

## ⚙️ Lógica de Horarios

### Generación de Horarios
```php
Horarios de Mañana:
- Inicio: 8:00
- Fin: 14:00
- Intervalo: 1h 30min
- Resultado: 8:00, 9:30, 11:00, 12:30

Horarios de Tarde:
- Inicio: 17:00
- Fin: 23:30
- Intervalo: 1h 30min
- Resultado: 17:00, 18:30, 20:00, 21:30, 23:00
```

### Verificación de Disponibilidad
```php
Para cada horario:
1. Verificar que la pista esté disponible
2. Buscar reservas existentes en esa fecha
3. Verificar solapamiento de horarios:
   - hora_inicio entre rango
   - hora_fin entre rango
   - rango completo contenido
4. Si no hay solapamiento → Disponible
5. Si hay solapamiento → Ocupado
```

---

## 🎁 Sistema de Recompensas

### Mecánica
```
Cada reserva realizada:
├─ Incrementa reservas_count
├─ Si reservas_count % 5 == 0
│  └─ Incrementa reservas_gratis_disponibles
└─ Muestra mensaje de felicitación
```

### Uso de Reserva Gratis
```
En el checkout:
├─ Si user.reservas_gratis_disponibles > 0
│  ├─ Mostrar checkbox "Usar reserva gratis"
│  └─ Si marcado:
│     ├─ precio = 0
│     ├─ es_gratis = true
│     └─ decrementa reservas_gratis_disponibles
└─ Crear reserva
```

---

## 🔄 Cancelación de Reservas

### Reglas
```
✅ Permitido:
- Reservas futuras
- Reservas del mismo día (antes de la hora)
- Propias reservas

❌ NO Permitido:
- Reservas pasadas
- Reservas de otros usuarios
```

### Proceso
```
Al cancelar:
1. Verificar permisos
2. Verificar que no haya pasado
3. Si es_gratis → devolver reserva gratis
4. Decrementar reservas_count
5. Cambiar estado a 'cancelada'
```

---

## 🎨 Interfaz de Usuario

### Vista de Pistas
```
┌─────────────────────────────────────────┐
│  RESERVA TU PISTA                       │
│  Elige tu pista favorita                │
└─────────────────────────────────────────┘

┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐
│ Pista 1  │  │ Pista 2  │  │ Pista 3  │  │ Pista 4  │
│ Exterior │  │ Exterior │  │ Cubierta │  │ Exterior │
│          │  │          │  │          │  │          │
│ 30€/1h30 │  │ 30€/1h30 │  │ 30€/1h30 │  │ 30€/1h30 │
│ [Ver]    │  │ [Ver]    │  │ [Ver]    │  │ [Ver]    │
└──────────┘  └──────────┘  └──────────┘  └──────────┘
```

### Vista de Calendario
```
┌─────────────────────┬───────────────────────────┐
│ SELECCIONA FECHA    │ HORARIOS DISPONIBLES      │
│                     │                           │
│ [Calendario]        │ Mañana (8:00 - 14:00)    │
│ Fecha: 30/10/2025   │ ┌─────────────────────┐  │
│                     │ │ 8:00 - 9:30    30€  │  │
│ Horarios:           │ │ ✅ Disponible       │  │
│ • Mañana: 8-14      │ └─────────────────────┘  │
│ • Tarde: 17-23:30   │ ┌─────────────────────┐  │
│ • Duración: 1h30    │ │ 9:30 - 11:00   30€  │  │
│                     │ │ ❌ Ocupado          │  │
│ ¿Tienes reservas    │ └─────────────────────┘  │
│ gratis?             │                           │
│ ✅ 1 disponible     │ Tarde (17:00 - 23:30)    │
│                     │ [...]                     │
└─────────────────────┴───────────────────────────┘
```

### Modal de Confirmación
```
┌─────────────────────────────────┐
│     CONFIRMAR RESERVA      │
│                                 │
│  Pista: Pista 1                 │
│  Fecha: 30 de octubre 2025      │
│  Horario: 8:00 - 9:30           │
│  Precio: 30€                    │
│                                 │
│  ☐ Usar reserva gratis (1)      │
│                                 │
│  [Cancelar]  [Confirmar]        │
└─────────────────────────────────┘
```

---

## 💾 Instalación y Configuración

### 1. Ejecutar Migraciones
```bash
php artisan migrate
```

### 2. Crear Pistas
```bash
php artisan db:seed --class=PistaSeeder
```

### 3. Verificar Rutas
```bash
php artisan route:list --path=reservas
```

---

## 🧪 Pruebas

### Probar Flujo Completo
```
1. Acceder a /reservas
2. Verificar que aparecen 4 pistas
3. Click en "Ver Horarios" de cualquier pista
4. Seleccionar fecha en el calendario
5. Verificar que aparecen horarios
6. Intentar reservar horario disponible
7. Confirmar reserva
8. Verificar que aparece en "Mis Reservas"
```

### Probar Recompensas
```
1. Hacer 4 reservas
2. Hacer 5ta reserva
3. Verificar mensaje: "¡Has ganado una reserva gratis!"
4. Verificar contador de reservas gratis
5. Hacer nueva reserva y usar reserva gratis
6. Verificar que precio = 0€
```

### Probar Cancelación
```
1. Crear una reserva
2. Ir a "Mis Reservas"
3. Click en "Cancelar"
4. Verificar que estado = 'cancelada'
5. Verificar que contador de reservas disminuyó
6. Si era gratis, verificar que se devolvió
```

---

## 📊 Estadísticas y Métricas

### Por Usuario
```
- reservas_count ................... Total de reservas realizadas
- reservas_gratis_disponibles ..... Reservas gratis pendientes
```

### Por Pista
```
SELECT COUNT(*) 
FROM reservas 
WHERE pista_id = ? 
  AND estado = 'confirmada'
```

### Por Fecha
```
SELECT pista_id, COUNT(*) as total
FROM reservas
WHERE fecha = ?
GROUP BY pista_id
```

---

## 🔧 Personalización

### Cambiar Duración de Sesión
```php
// En ReservaController.php, método generarHorariosDisponibles()

$horaActual->addMinutes(90); // Cambiar 90 por tu valor
```

### Cambiar Horarios de Apertura
```php
// Horario de mañana
$horaActual = Carbon::createFromTime(8, 0);   // Cambiar hora inicio
$horaCierre = Carbon::createFromTime(14, 0);  // Cambiar hora cierre

// Horario de tarde
$horaActual = Carbon::createFromTime(17, 0);  // Cambiar hora inicio
$horaCierre = Carbon::createFromTime(23, 30); // Cambiar hora cierre
```

### Cambiar Precio
```php
// En el array de horarios
'precio' => 30.00 // Cambiar precio base
```

### Cambiar Programa de Recompensas
```php
// En ReservaController.php, método crear()

if ($user->reservas_count % 5 == 0) // Cambiar 5 por tu valor
```

---

## 🎯 Próximas Mejoras Sugeridas

- [ ] Pago en línea (Stripe, PayPal)
- [ ] Recordatorios por email/SMS
- [ ] Reservas recurrentes
- [ ] Lista de espera
- [ ] Descuentos por horario
- [ ] Gestión de torneos
- [ ] Calificación de pistas
- [ ] Sistema de parejas/grupos

---

## 📞 Soporte

Para dudas o problemas:
1. Revisar documentación
2. Verificar migraciones ejecutadas
3. Verificar que las pistas existan en BD
4. Verificar rutas con `php artisan route:list`

---

**✅ Sistema de Reservas Completo y Funcional**
**🎾 X3 Pádel - Reserva fácil, juega más**





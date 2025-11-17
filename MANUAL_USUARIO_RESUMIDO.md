# 📘 Manual de Usuario - X3 Pádel
## Estructura Resumida (Versión Esencial)

---

## 📋 ÍNDICE DEL MANUAL

### 1. INTRODUCCIÓN

### 2. REGISTRO E INICIO DE SESIÓN
- 2.1. Crear una Cuenta
- 2.2. Iniciar Sesión
- 2.3. Recuperar Contraseña

### 3. REALIZAR UNA RESERVA
- 3.1. Seleccionar Pista
- 3.2. Elegir Fecha y Horario
- 3.3. Confirmar Reserva
- 3.4. Usar Reserva Gratis (si aplica)

### 4. GESTIÓN DE RESERVAS
- 4.1. Ver Mis Reservas
- 4.2. Cancelar una Reserva
- 4.3. Historial de Reservas

### 5. PROGRAMA DE RECOMPENSAS
- 5.1. Cómo Funciona (5 reservas = 1 gratis)
- 5.2. Ver Reservas Gratis Disponibles
- 5.3. Usar una Reserva Gratis

### 6. PERFIL DE USUARIO
- 6.1. Editar Información Personal
- 6.2. Cambiar Contraseña
- 6.3. Ver Estadísticas

### 7. CATÁLOGO DE PRODUCTOS
- 7.1. Navegar el Catálogo
- 7.2. Ver Detalles de Productos
- 7.3. Buscar Productos

### 8. CONTACTO
- 8.1. Formulario de Contacto
- 8.2. Información de Contacto

### 9. PANEL DE ADMINISTRACIÓN (Solo Administradores)
- 9.1. Dashboard
- 9.2. Gestión de Usuarios
- 9.3. Gestión de Reservas
- 9.4. Gestión de Productos

### 10. PREGUNTAS FRECUENTES
- 10.1. Preguntas sobre Reservas
- 10.2. Preguntas sobre Recompensas
- 10.3. Problemas Técnicos

### 11. SOLUCIÓN DE PROBLEMAS
- 11.1. Problemas de Acceso
- 11.2. Problemas con Reservas
- 11.3. Contacto de Soporte

---

## 📝 DESARROLLO DE CONTENIDO POR SECCIÓN

### 1. INTRODUCCIÓN

**Bienvenido a X3 Pádel**, una plataforma web que permite reservar pistas de pádel de forma online las 24 horas del día. El sistema funciona desde cualquier navegador web actualizado (Chrome, Firefox, Edge, Safari, Opera) con conexión a internet y JavaScript habilitado, sin necesidad de instalar aplicaciones adicionales. Para comenzar, debe crear una cuenta o iniciar sesión si ya posee una. El sistema permite reservar pistas eligiendo fecha y horario (mañana 8:00-14:00 o tarde 17:00-23:30), gestionar sus reservas, participar en el programa de recompensas (cada 5 reservas = 1 gratis), explorar el catálogo de productos de pádel y mantener su perfil actualizado. **Información clave:** las reservas requieren mínimo 1 día de antelación, cada sesión dura 1 hora y 30 minutos, el precio es de 30€ por sesión (o gratis con reserva de recompensa), y el sistema es completamente responsive para móviles, tablets y ordenadores.

---

**Capturas necesarias:**
- Página de inicio
- Menú principal

---

### 2. REGISTRO E INICIO DE SESIÓN

#### 2.1. Crear una Cuenta

**Acceso al formulario:**
- Haga clic en el botón **"Registrarse"** desde la página de inicio o enlace **"¿No tienes cuenta?"** desde la página de login

**Campos requeridos:**
- **Nombre** (obligatorio): Nombre completo, máximo 255 caracteres
- **Email** (obligatorio): Dirección de correo válida y única. **Importante:** No se puede cambiar después del registro
- **Teléfono** (opcional): Número de teléfono, puede incluir código de país (ejemplo: +34 123 456 789)
- **Contraseña** (obligatorio): Mínimo 8 caracteres, recomendado incluir mayúsculas, minúsculas, números y símbolos
- **Confirmar Contraseña** (obligatorio): Debe coincidir exactamente con la contraseña

**Validaciones:**
- El sistema valida automáticamente que todos los campos obligatorios estén completos, el email sea válido y no esté duplicado, y que las contraseñas coincidan
- Si hay errores, aparecerán mensajes debajo de cada campo

**Proceso:**
1. Complete el formulario
2. Haga clic en **"Registrarse"**
3. Si es exitoso, será iniciado sesión automáticamente y redirigido a la página principal

**Beneficios de registrarse:** Reservas online 24/7, programa de recompensas (5 reservas = 1 gratis), historial de reservas y perfil personalizado

---

#### 2.2. Iniciar Sesión

**Acceso al formulario:**
- Haga clic en el botón **"Iniciar Sesión"** o enlace **"¿Ya estás registrado?"** desde la página de registro

**Campos:**
- **Email** (obligatorio): Email utilizado al registrarse
- **Contraseña** (obligatorio): Contraseña de su cuenta
- **Recuérdame** (opcional): Mantiene la sesión activa después de cerrar el navegador (solo en dispositivos personales y seguros)

**Seguridad:**
- Límite de 5 intentos de inicio de sesión para prevenir ataques
- Si excede el límite, debe esperar antes de intentar nuevamente

**Proceso:**
1. Ingrese email y contraseña
2. (Opcional) Marque "Recuérdame"
3. Haga clic en **"Iniciar Sesión"**
4. Si las credenciales son correctas, será redirigido a la página principal

**Mensajes de error:**
- "Estas credenciales no coinciden con nuestros registros" - Email y/o contraseña incorrectos
- "Demasiados intentos de inicio de sesión" - Debe esperar antes de intentar de nuevo

---

#### 2.3. Recuperar Contraseña

**Proceso de recuperación:**

1. **Solicitar enlace:**
   - Desde la página de login, haga clic en **"¿Olvidaste tu contraseña?"**
   - Ingrese su email
   - Haga clic en **"Enviar enlace de recuperación"**
   - Revise su email (incluida la carpeta de spam)

2. **Restablecer contraseña:**
   - Abra el email recibido y haga clic en el enlace de recuperación
   - Ingrese su nueva contraseña dos veces para confirmar
   - Haga clic en **"Restablecer Contraseña"**

**Notas importantes:**
- Los enlaces de recuperación son únicos y temporales (expiran después de un tiempo)
- Si no recibe el email, revise spam o solicite un nuevo enlace
- Si el enlace expiró, solicite uno nuevo

---

#### 2.4. Navegación Después del Login

**Menú principal disponible:**
- **Inicio** - Página principal
- **Reservas** - Sistema de reservas
- **Mis Reservas** - Gestión de reservas
- **Perfil** - Información personal
- **Catálogo** - Productos de pádel
- **Contacto** - Soporte

**Información visible:** En la esquina superior derecha verá su nombre/email, menú de perfil y opción para cerrar sesión

**Cerrar sesión:** Haga clic en su nombre/email → **"Cerrar Sesión"**

**Notas:** Si marcó "Recuérdame", permanecerá conectado. Para mayor seguridad, cierre sesión en computadoras compartidas

---

**Capturas necesarias:**
- Formulario de registro
- Formulario de inicio de sesión
- Página de recuperación de contraseña
- Página de restablecimiento de contraseña
- Página principal después del login (menú de usuario)

---

### 3. REALIZAR UNA RESERVA
**Contenido:**
- **Paso 1: Ver Pistas Disponibles**
  - Acceso a /reservas
  - Información de cada pista (tipo, precio)
- **Paso 2: Seleccionar Pista**
  - Click en "Ver Horarios"
- **Paso 3: Elegir Fecha**
  - Calendario interactivo
  - Restricción: mínimo 1 día de antelación
- **Paso 4: Elegir Horario**
  - Horarios de mañana (8:00-14:00)
  - Horarios de tarde (17:00-23:30)
  - Indicadores de disponibilidad
- **Paso 5: Confirmar**
  - Modal de confirmación
  - Resumen de reserva
  - Opción de usar reserva gratis
  - Confirmar o cancelar

**Capturas necesarias:**
- Listado de pistas
- Calendario con horarios
- Modal de confirmación
- Mensaje de éxito

---

### 4. GESTIÓN DE RESERVAS
**Contenido:**
- **Acceso a "Mis Reservas"**
  - Desde el menú de usuario
- **Próximas Reservas**
  - Visualización de reservas futuras
  - Información: pista, fecha, hora, precio
  - Estadísticas: total reservas, gratis disponibles
- **Cancelar Reserva**
  - Cuándo se puede cancelar
  - Proceso de cancelación
  - Confirmación
- **Historial**
  - Reservas pasadas
  - Estados: confirmada, cancelada, completada

**Capturas necesarias:**
- Página "Mis Reservas"
- Proceso de cancelación

---

### 5. PROGRAMA DE RECOMPENSAS
**Contenido:**
- **Mecánica:**
  - Cada 5 reservas = 1 reserva gratis
  - Otorgamiento automático
- **Ver Reservas Gratis:**
  - Contador en perfil
  - Indicador en calendario
  - Estadísticas en "Mis Reservas"
- **Usar Reserva Gratis:**
  - Durante la confirmación de reserva
  - Checkbox "Usar reserva gratis"
  - Precio se muestra como "GRATIS"

**Capturas necesarias:**
- Indicador de reservas gratis
- Checkbox en modal de confirmación
- Reserva con precio "GRATIS"

---

### 6. PERFIL DE USUARIO
**Contenido:**
- **Editar Información:**
  - Nombre y teléfono (editable)
  - Email (no editable)
  - Guardar cambios
- **Cambiar Contraseña:**
  - Requisitos de contraseña
  - Confirmación de contraseña actual
- **Estadísticas:**
  - Total de reservas realizadas
  - Reservas gratis disponibles

**Capturas necesarias:**
- Página de perfil
- Formulario de edición

---

### 7. CATÁLOGO DE PRODUCTOS
**Contenido:**
- **Navegación:**
  - Acceso al catálogo
  - Filtros por categoría (Todas, Palas, Calzado, Accesorios)
- **Visualización:**
  - Grid de productos
  - Información: nombre, precio, valoración, stock
- **Detalle de Producto:**
  - Información completa
  - Descripción
- **Búsqueda:**
  - Barra de búsqueda
  - Filtros y ordenamiento

**Capturas necesarias:**
- Página del catálogo
- Detalle de producto

---

### 8. CONTACTO
**Contenido:**
- **Formulario de Contacto:**
  - Campos: nombre, email, asunto, mensaje
  - Envío del mensaje
- **Información de Contacto:**
  - Dirección, teléfono, email
  - Horario de atención
  - Redes sociales

**Capturas necesarias:**
- Página de contacto

---

### 9. PANEL DE ADMINISTRACIÓN
**Contenido:**
- **Acceso:**
  - Requisitos (ser administrador)
  - URL: /admin
- **Dashboard:**
  - Estadísticas generales
  - Usuarios recientes
- **Gestión de Usuarios:**
  - Listado y búsqueda
  - Editar usuarios
  - Gestionar permisos de admin
  - Gestionar reservas gratis
- **Gestión de Reservas:**
  - Ver todas las reservas
  - Filtros y búsqueda
- **Gestión de Productos:**
  - CRUD completo (crear, editar, eliminar)
  - Gestión de stock

**Capturas necesarias:**
- Dashboard de administración
- Gestión de usuarios
- Gestión de productos

---

### 10. PREGUNTAS FRECUENTES
**Contenido:**
- **Sobre Reservas:**
  - ¿Cuánto tiempo de antelación necesito? (1 día mínimo)
  - ¿Puedo cancelar una reserva? (Sí, reservas futuras)
  - ¿Cuánto dura una sesión? (1h 30min)
  - ¿Cuáles son los horarios? (Mañana: 8-14h, Tarde: 17-23:30h)
- **Sobre Recompensas:**
  - ¿Cómo obtengo reservas gratis? (Cada 5 reservas)
  - ¿Cuándo puedo usarlas? (En cualquier reserva)
- **Problemas Técnicos:**
  - No puedo iniciar sesión
  - No aparecen horarios disponibles
  - Error al confirmar reserva

---

### 11. SOLUCIÓN DE PROBLEMAS
**Contenido:**
- **Problemas de Acceso:**
  - Olvidé mi contraseña → Recuperación
  - No puedo iniciar sesión → Verificar credenciales
- **Problemas con Reservas:**
  - No aparecen horarios → Verificar fecha (mínimo 1 día)
  - Error al confirmar → Verificar que estés logueado
  - No puedo cancelar → Solo reservas futuras
- **Contacto de Soporte:**
  - Email de soporte
  - Teléfono
  - Horario de atención

---

## 📊 INFORMACIÓN CLAVE A INCLUIR

### Horarios del Centro
- **Mañana:** 8:00 - 14:00
- **Cerrado:** 14:00 - 17:00
- **Tarde:** 17:00 - 23:30
- **Duración de sesión:** 1h 30min
- **Precio:** 30€ por sesión

### Reglas de Reservas
- Antelación mínima: 1 día
- No se aceptan reservas para el mismo día
- Se pueden cancelar reservas futuras
- Las reservas gratis se devuelven al cancelar

### Programa de Recompensas
- Cada 5 reservas = 1 reserva gratis
- Se otorga automáticamente
- Se puede usar en cualquier momento
- Se devuelve si cancelas una reserva gratis

---

## ✅ CHECKLIST MÍNIMO

- [ ] Introducción y primeros pasos
- [ ] Proceso completo de reserva (paso a paso)
- [ ] Gestión de reservas (ver y cancelar)
- [ ] Programa de recompensas explicado
- [ ] Perfil de usuario básico
- [ ] FAQ con preguntas más comunes
- [ ] Solución de problemas básicos
- [ ] Capturas de pantalla de procesos principales
- [ ] Información de contacto y soporte

---

## 📐 FORMATO SUGERIDO

- **Extensión:** 20-30 páginas (versión resumida)
- **Idioma:** Español claro y directo
- **Estilo:** Paso a paso con capturas numeradas
- **Estructura:** Cada sección con:
  1. Breve introducción
  2. Pasos numerados
  3. Capturas de pantalla
  4. Tips o advertencias (si aplica)

---

**Versión:** 1.0 - Resumida
**Fecha:** [Fecha actual]
**Público objetivo:** Usuarios finales y administradores


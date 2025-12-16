# REPORTE DE ERRORES Y VULNERABILIDADES - PNGKIT

**Fecha de escaneo:** 16 de Diciembre de 2025

---

## ✅ CORRECTIVOS REALIZADOS

### 1. Undefined Array Key - RESUELTO
- Agregado `isset()` en 16 archivos
- Inicialización segura de arrays de BD
- Fallback con operador ternario en 50+ ubicaciones

### 2. UTF-8 Encoding - RESUELTO
- Corregidas 17 comillas simples sin cerrar en `SET NAMES 'utf8'`
- 4 archivos correctos, 13 archivos con error

### 3. Conexion.php - RESUELTO
- Eliminadas 3 copias duplicadas en carpetas
- Centralizado en raíz: `/conexion.php`
- Actualizado todas las rutas de include (21 archivos)

---

## ❌ ERRORES CRÍTICOS - PENDIENTES

### 1. SQL INJECTION (CRÍTICO) - 30+ VULNERABILIDADES

**Descripción:** Todas las consultas usan interpolación de variables sin escapar. Esto permite a atacantes:
- Extraer datos de la BD
- Modificar/eliminar datos
- Elevar privilegios
- Ejecutar comandos

**Solución:** Implementar Prepared Statements con `mysqli_prepare()` o usar `mysqli_real_escape_string()`

**Archivos con vulnerabilidad:**
- ✗ `perfil/actualizar.php` - 4 consultas SQL
- ✗ `perfil/configuracion.php` - 2 consultas SQL
- ✗ `perfil/descripcion.php` - 4 consultas SQL
- ✗ `perfil/guardar_imagen_banner.php` - 4 consultas SQL
- ✗ `perfil/guardar_imagen_perfil.php` - 4 consultas SQL
- ✗ `cargar_imagenes/buscador.php` - 2 consultas SQL
- ✗ `cargar_imagenes/buscar_imagenes.php` - 1 consulta SQL
- ✗ `cargar_imagenes/crear_carpeta.php` - 1 consulta SQL
- ✗ `cargar_imagenes/galeria-carpeta.php` - 3 consultas SQL
- ✗ `cargar_imagenes/guardar_imagen.php` - 1 consulta SQL
- ✗ `cargar_imagenes/imagen.php` - 1 consulta SQL
- ✗ `inicio_secion/registrar.php` - 3 consultas SQL
- ✗ `index.php` - 1 consulta SQL (LIKE)

**Ejemplo de vulnerabilidad:**
```php
// VULNERABLE
$correo = "admin'--";  // Entrada maliciosa
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
// Resulta en: SELECT * FROM usuarios WHERE correo = 'admin'--'
```

---

### 2. XSS (Cross-Site Scripting) - CRÍTICO

**Descripción:** Salida de datos del usuario sin escapar en HTML

**Ubicaciones:**
- ✗ `cargar_imagenes/subir-imagen.php` línea 209: `echo $_GET['carpeta_subir'];`
- ✗ `cargar_imagenes/subir-imagen.php` línea 83: `echo '...'.$_SESSION['usuario']['nombre'].'</b>';`
- ✗ `perfil/configuracion.php` línea 133: `echo 'checked="'.$_SESSION['usuario']['modo'].'"';`

**Solución:** Usar `htmlspecialchars()` o `htmlentities()`

---

### 3. Headers Duplicados (HTTP HEADERS)

**Descripción:** Llamadas múltiples a `header()` causarán errores HTTP

**Archivos afectados:**
- ✗ `perfil/guardar_imagen_perfil.php` - headers en líneas 4, 8, 30, 37
- ✗ `perfil/guardar_imagen_banner.php` - headers en líneas 4, 30, 37
- ✗ `perfil/descripcion.php` - headers en líneas 23, 30

**Solución:** Verificar con `headers_sent()` o consolidar redirects

---

### 4. Falta de Validación de Entrada

**Descripción:** Variables no validadas antes de usar en lógica

**Ejemplos:**
```php
// Sin validar tipo ni rango
$nuevo_nombre = $_POST["nuevo_nombre"];
$estilo = $_POST["estilo"];
$descripcion = $_POST["descripcion"];
```

**Solución:** Validar tipo, longitud, contenido permitido

---

### 5. Falta de CSRF Token

**Descripción:** Formularios POST sin protección CSRF

**Archivos con formularios:**
- ✗ `perfil/actualizar.php`
- ✗ `perfil/descripcion.php`
- ✗ `perfil/redes_sociales.php`
- ✗ `cargar_imagenes/crear_carpeta.php`

---

### 6. Salida de Errores en Pantalla

```php
// ❌ Expone información sensible
die("error al insertar los requisitos");  // Muestra errores DB
or die("Error al preparar la consulta: " . $mysqli->error);
```

**Afectados:** `perfil/guardar_imagen_perfil.php`, `perfil/guardar_imagen_banner.php`, `perfil/descripcion.php`

---

### 7. Session Fixation

**Descripción:** Session ID no se regenera después de login

**Ubicación:** `inicio_secion/iniciar.php` - Session iniciada pero ID no regenerado

---

### 8. Falta de Rate Limiting

**Descripción:** Login sin límite de intentos - vulnerable a ataques de fuerza bruta

**Ubicación:** `inicio_secion/iniciar.php`, `inicio_secion/registrar.php`

---

### 9. Contraseñas en Plain Text

**Descripción:** Las contraseñas se almacenan sin hash en la BD

```php
$sentencia = "INSERT INTO usuarios(..., contraseña) values (..., '$contraseña')";
// Contraseña sin encriptar
```

**Solución:** Usar `password_hash()` y `password_verify()`

---

### 10. Falta de Validación de Archivos

**Descripción:** Upload de archivos sin validar tipo/tamaño

**Ubicación:** `cargar_imagenes/subir-imagen.php` - Firebase upload sin validación servidor

---

## 📊 RESUMEN

| Error | Cantidad | Severidad | Estado |
|-------|----------|-----------|--------|
| SQL Injection | 30+ | CRÍTICO | ⏳ PENDIENTE |
| XSS | 3+ | CRÍTICO | ⏳ PENDIENTE |
| Headers Duplicados | 7 | ALTO | ⏳ PENDIENTE |
| Undefined Array Key | 50+ | MEDIO | ✅ RESUELTO |
| UTF-8 Comillas | 17 | BAJO | ✅ RESUELTO |
| Conexion.php Duplicadas | 3 | BAJO | ✅ RESUELTO |

---

## 🚀 RECOMENDACIONES

1. **URGENTE:** Implementar Prepared Statements para todas las consultas
2. **URGENTE:** Escapar salida HTML con `htmlspecialchars()`
3. **IMPORTANTE:** Agregar validación de entrada en todos los formularios
4. **IMPORTANTE:** Hash de contraseñas con `password_hash()`
5. **IMPORTANTE:** CSRF tokens en formularios
6. **RECOMENDADO:** Rate limiting en login
7. **RECOMENDADO:** Logging de intentos fallidos
8. **RECOMENDADO:** Regenerar session ID después de login

---

**Documento generado automáticamente por análisis de código**

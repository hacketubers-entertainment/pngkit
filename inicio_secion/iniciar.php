<?php
session_start();
// 1. Incluye el archivo de conexión, que crea el objeto $mysqli
include "../conexion.php"; 

// 2. Establecer la codificación de caracteres de forma segura
// Usamos la función propia de mysqli en lugar de una consulta SQL, 
// lo que evita errores de sintaxis como el anterior.
if (!$mysqli->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    exit();
}

// 3. Obtener y sanear las credenciales del usuario desde la URL ($_GET)
$correo = $_GET['correo'] ?? ''; // Usamos ?? para evitar errores si no existe la variable
$contraseña = $_GET['contraseña'] ?? '';

// --- INICIO DE SESIÓN SEGURO CON SENTENCIAS PREPARADAS ---

// 4. Preparar la consulta SQL con placeholders (?)
// NOTA: Nunca selecciones la contraseña del usuario; sólo la necesitas para la verificación.
$stmt = $mysqli->prepare("SELECT id, nombre FROM usuarios WHERE correo = ? AND contraseña = ?");

if ($stmt === false) {
    die("Error al preparar la consulta: " . $mysqli->error);
}

// 5. Vincular los parámetros (los valores reales) a los placeholders
// "ss" significa que ambos parámetros son strings (cadenas de texto)
$stmt->bind_param("ss", $correo, $contraseña); 

// 6. Ejecutar la consulta
$stmt->execute();

// 7. Obtener el resultado
$result = $stmt->get_result();

// 8. Verificar si se encontraron resultados
if ($result->num_rows === 1) {
    // El usuario existe y las credenciales son válidas
    $usuario = $result->fetch_assoc(); // Obtener la fila del usuario

    // Guardar los datos del usuario en la sesión
    $_SESSION['usuario'] = array(
        'id' => $usuario['id'],
        'nombre' => $usuario['nombre'],
    );

    // Cerrar la sentencia y la conexión antes de redirigir
    $stmt->close();
    $mysqli->close();

    header('Location: ../index.php');
    exit;

} else {
    // No se encontraron resultados (credenciales inválidas)

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $mysqli->close();

    header('Location: iniciar_secion.php?error=credenciales');
    // Nota: Es mejor redirigir a la página de login y mostrar el error allí, 
    // en lugar de usar 'echo' aquí, que podría no ejecutarse bien con el 'header()'.
    exit;
}
?>

<?php
session_start();
include "conexion.php"; 

// Obtener las credenciales del usuario desde la URL
$correo = $_GET['correo'];
$contraseña = $_GET['contraseña'];

// Establecer la codificación de caracteres
$mysqli -> query("SET NAMES 'utf8");

// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // El usuario existe y las credenciales son válidas
    $usuario = $result->fetch_assoc(); // Obtener la fila del usuario

    // Guardar los datos del usuario en la sesión
    $_SESSION['usuario'] = array(
        'id' => $usuario['id'],
        'nombre' => $usuario['nombre'],
    );

    mysqli_close($conexion);
    header('Location: ../index.php');
    exit;
} else {
    // No se encontraron resultados
    mysqli_close($conexion);
    header('Location: iniciar_secion.php');
    echo "Credenciales inválidas.";
    exit;
}

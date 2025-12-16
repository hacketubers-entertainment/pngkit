<?php
session_start(); // Iniciar la sesión

include "conexion.php";
$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$contraseña = $_GET['contraseña'];

// Establecer la codificación de caracteres
$mysqli -> query("SET NAMES 'utf8");
// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Guardar el mensaje en la sesión
    $_SESSION['mensaje'] = "El correo ya está en uso.";

    // Redirigir al usuario a iniciar_secion.php
    header('Location: iniciar_secion.php');
    exit;
} else {
    // No se encontraron resultados
    $sentencia = "INSERT INTO usuarios(id, nombre, correo, contraseña) values (0, '$nombre', '$correo', '$contraseña')";
    $resultado = mysqli_query($mysqli, $sentencia) or die ("error al insertar los requisitos");
    // Obtener el ID del usuario insertado
    $id = mysqli_insert_id($mysqli);
    $sentencia1 = "INSERT INTO configuracion_perfil(id_usuario, nombre_usuario, descripcion) values ($id, '$nombre', 'Sin descripcion')";
    $resultado1 = mysqli_query($mysqli, $sentencia1) or die ("error al insertar los requisitos de configuracion perfil");
    // Guardar los datos del usuario en la sesión
    $_SESSION['usuario'] = array(
        'id' => $id,
        'nombre' => $nombre,
        'nombre_usuario' => $nombre,
        'correo' => $correo
    );

    mysqli_close($conexion);
    header('Location: ../index.php');
    exit;
}


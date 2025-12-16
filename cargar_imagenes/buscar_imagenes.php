<?php
session_start();
include "../conexion.php"; 

// Obtener las credenciales del usuario desde la URL
$usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
$nombrecarpeta = isset($_GET['nombrecarpeta']) ? $_GET['nombrecarpeta'] : '';
$descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : '';
$enlace = isset($_GET['enlace']) ? $_GET['enlace'] : '';

$mysqli -> query("SET NAMES 'utf8'");

// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM imagenes WHERE usuario = '$usuario' AND nombrecarpeta = '$nombrecarpeta' AND descripcion = '$descripcion' AND enlace = '$enlace'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

$usuario = $result->fetch_assoc(); 

// Guardar los datos del usuario en la sesión
$_SESSION['imagen'] = array(
    'usuario' => $usuario['usuario'],
    'nombrecarpeta' => $usuario['nombrecarpeta'],
    'descripcion' => $usuario['descripcion'],
    'enlace' => $enlace,
);

mysqli_close($mysqli);
exit;

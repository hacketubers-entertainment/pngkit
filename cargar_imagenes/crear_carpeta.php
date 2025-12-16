<?php
include "../conexion.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_carpeta = $_POST["nombre_carpeta"];
    $estilo = $_POST["estilo"]; 

$id_usuario = $_SESSION['usuario']['id'];
// Establecer la codificación de caracteres
$mysqli -> query("SET NAMES 'utf8'");
// Consulta SQL para verificar las credenciales
$sql = "INSERT INTO carpetas(nombre_carpeta, estilo, id_usuario) values ('$nombre_carpeta', '$estilo', '$id_usuario')";

// Ejecutar la consulta
$result = $mysqli->query($sql);
mysqli_close($mysqli);
header('Location: subir-imagen.php');
exit;
}

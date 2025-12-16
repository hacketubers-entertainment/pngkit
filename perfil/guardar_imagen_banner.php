<?php
session_start();
if (!isset($_SESSION['usuario']) || !isset($_GET['enlace'])) {
    header('Location: ../cargar_imagenes/subir-imagen.php');
    exit;
}
include "../conexion.php";

// Obtener los detalles de la imagen desde la URL
$id = $_SESSION['usuario']['id'];
$url = $_GET['enlace'];
echo $url;
echo $id;

// Establecer la codificación de caracteres
$mysqli -> query("SET NAMES 'utf8'");
// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM configuracion_perfil WHERE id_usuario = '$id'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows == 0) {
    $sentencia = "INSERT INTO configuracion_perfil(id_usuario) values ('$id')";
    $sentencia2 = "UPDATE configuracion_perfil SET foto_banner = '$url' WHERE id_usuario = '$id'";
    $resultado = mysqli_query($mysqli, $sentencia) or die ("error al insertar los requisitos");
    $resultado2 = mysqli_query($mysqli, $sentencia2) or die ("error al insertar los requisitos");
    mysqli_close($mysqli);
    header('Location: ../cargar_imagenes/subir-imagen.php');
    exit;
}else{
    // Consulta para actualizar el nombre
    $sentencia = "UPDATE configuracion_perfil SET foto_banner = '$url' WHERE id_usuario = '$id'";
    $resultado = mysqli_query($mysqli, $sentencia) or die ("error al insertar los requisitos");
    mysqli_close($mysqli);
    header('Location: ../cargar_imagenes/subir-imagen.php');
    exit;
}

// Consulta SQL para insertar los detalles de la imagen
//$sentencia = "UPDATE configuracion_perfil SET foto_perfil = '$url' WHERE id_usuario = '$id'";

// Ejecutar la consulta
//if ($mysqli->query($sentencia) === TRUE) {


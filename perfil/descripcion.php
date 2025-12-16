<?php
include "../conexion.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"]; // ID del usuario
    $nueva_descripcion = $_POST["descripcion"]; // Nuevo nombre
    
// Establecer la codificación de caracteres
$mysqli -> query("SET NAMES 'utf8'");
// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM configuracion_perfil WHERE id_usuario = '$id_usuario'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows == 0) {
    $sentencia = "INSERT INTO configuracion_perfil(id_usuario) values ('$id_usuario')";
    $sentencia2 = "UPDATE configuracion_perfil SET descripcion = '$nueva_descripcion' WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($mysqli, $sentencia) or die ("error al insertar los requisitos");
    $resultado2 = mysqli_query($mysqli, $sentencia2) or die ("error al insertar los requisitos");
    mysqli_close($mysqli);
    header('Location: ../cargar_imagenes/subir-imagen.php');
    exit;
}else{
    // Consulta para actualizar el nombre
    $sentencia = "UPDATE configuracion_perfil SET descripcion = '$nueva_descripcion' WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($mysqli, $sentencia) or die ("error al insertar los requisitos");
    mysqli_close($mysqli);
    header('Location: ../cargar_imagenes/subir-imagen.php');
    exit;
}
}

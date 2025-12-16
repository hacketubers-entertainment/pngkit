<?php
include "../conexion.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"]; // ID del usuario
    $facebook = $_POST["facebook"];
    $instagram = $_POST["instagram"]; 
    $x = $_POST["x"]; 
    $discord = $_POST["discord"]; 
    $reddit = $_POST["reddit"]; 
    $pinterest = $_POST["pinterest"]; 
    $linkedin = $_POST["linkedin"];
    $sitio_web = $_POST["sitio_web"]; 
    
// Establecer la codificación de caracteres
$mysqli -> query("SET NAMES 'utf8'");
// Consulta SQL para verificar las credenciales
$sql = "SELECT * FROM redes_sociales WHERE id_usuario = '$id_usuario'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows == 0) {
    $sentencia = "INSERT INTO redes_sociales(id_usuario) values ('$id_usuario')";
    $sentencia2 = "UPDATE redes_sociales SET id_usuario = '$id_usuario', facebook = '$facebook', instagram  = '$instagram', x = '$x', discord = '$discord', reddit = '$reddit', pinterest = '$pinterest', linkedin = '$linkedin', sitio_web = '$sitio_web' WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($mysqli, $sentencia) or die ("error al insertar los requisitos");
    $resultado2 = mysqli_query($mysqli, $sentencia2) or die ("error al insertar los requisitos");
    mysqli_close($mysqli);
    header('Location: ../cargar_imagenes/subir-imagen.php');
    exit;
}else{
    echo $id_usuario;
    echo $facebook;
    // Consulta para actualizar el nombre
    $sentencia = "UPDATE redes_sociales SET id_usuario = '$id_usuario', facebook = '$facebook', instagram  = '$instagram', x = '$x', discord = '$discord', reddit = '$reddit', pinterest = '$pinterest', linkedin = '$linkedin', sitio_web = '$sitio_web' WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($mysqli, $sentencia) or die ("error al insertar los requisitos");
    mysqli_close($mysqli);
    header('Location: ../cargar_imagenes/subir-imagen.php');
    exit;
}
}

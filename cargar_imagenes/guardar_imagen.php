<?php
include "../conexion.php";

// Obtener los detalles de la imagen desde la URL
$id = $_GET['id'] ?? '';
$usuario = $_GET['usuario'] ?? '';
$titulo = $_GET['nombrecarpeta'] ?? '';
$nombre_imagen = $_GET['nombre_imagen'] ?? '';
$descripcion = $_GET['descripcion'] ?? '';
$estilo = $_GET['estilo'] ?? '';
$url = $_GET['enlace'] ?? '';

// Consulta SQL para insertar los detalles de la imagen
$sql = "INSERT INTO imagenes (id, usuario, nombre_imagen, nombrecarpeta, descripcion, enlace) VALUES (0, '$usuario', '$nombre_imagen', '$titulo', '$descripcion', '$url')";

// Ejecutar la consulta
if ($mysqli->query($sql) === TRUE) {
    echo "Imagen guardada con éxito.";
    header('Location: ../index.php');
} else {
    echo "Error al guardar la imagen: " . $mysqli->error;
}

$mysqli->close();

<?php
session_start();
include "conexion.php";

// Obtener los detalles de la imagen desde la URL
$id = $_GET['id'];
$valor = $_GET['valor'];

// Consulta SQL para insertar los detalles de la imagen
$sentencia = "UPDATE configuracion_perfil SET modo = '$valor' WHERE id_usuario = '$id'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

// Ejecutar la consulta
if ($mysqli->query($sentencia) === TRUE) {
    echo "guardada con éxito.";
    $_SESSION['usuario'] = array(
        'id' => $_SESSION['usuario']['id'],
        'nombre' => $_SESSION['usuario']['nombre'],
        'nombre_usuario' => $_SESSION['usuario']['nombre_usuario'],
        'correo' => $_SESSION['usuario']['correo'],
        'foto' => $_SESSION['usuario']['foto'],
        'modo' => $valor,
        'descripcion' => $_SESSION['usuario']['descripcion'],
    );
    mysqli_close($conexion);
    header('Location: ../index.php');
    
    
} else {
    echo "Error al guardar: " . $mysqli->error;
}




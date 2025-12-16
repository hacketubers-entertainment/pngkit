<?php
session_start(); // Iniciar la sesión

if (isset($_SESSION['usuario'])) {
    $nombre = $_SESSION['usuario']['nombre'];
    $id = $_SESSION['usuario']['id']; // Obtener el ID del usuario de la sesión

    header('Content-Type: application/json');
    echo json_encode(array('id' => $id, 'nombre' => $nombre)); // Devolver el ID como una respuesta JSON
} else {
    // Si $_SESSION['id'] no está definido, devolver un mensaje de error
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'ID no definido'));
}


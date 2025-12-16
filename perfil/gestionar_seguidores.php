<?php
session_start();
include "../conexion.php";

// Validar que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Usuario no autenticado']);
    http_response_code(401);
    exit;
}

header('Content-Type: application/json');

$usuario_id = $_SESSION['usuario']['id'];
$accion = $_GET['accion'] ?? '';

// Tabla de seguidores en la base de datos MySQL
// Crear tabla si no existe
$mysqli->query("CREATE TABLE IF NOT EXISTS seguidores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    perfil_id INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (usuario_id, perfil_id)
)");

if ($accion === 'verificar') {
    // Verificar perfiles seguidos
    $sql = "SELECT perfil_id FROM seguidores WHERE usuario_id = $usuario_id";
    $result = $mysqli->query($sql);
    
    $seguidos = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $seguidos[] = (int)$row['perfil_id'];
        }
    }
    
    echo json_encode(['seguidos' => $seguidos]);
    exit;
}

if ($accion === 'seguir') {
    // Agregar seguidor
    $perfil_id = $_POST['perfil_id'] ?? null;
    
    if (!$perfil_id) {
        http_response_code(400);
        echo json_encode(['error' => 'ID del perfil no proporcionado']);
        exit;
    }
    
    $perfil_id = (int)$perfil_id;
    
    // Insertar o ignorar si ya existe
    $sql = "INSERT IGNORE INTO seguidores (usuario_id, perfil_id) VALUES ($usuario_id, $perfil_id)";
    
    if ($mysqli->query($sql)) {
        echo json_encode(['exito' => true, 'mensaje' => 'Perfil seguido correctamente']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error al seguir perfil: ' . $mysqli->error]);
    }
    exit;
}

if ($accion === 'dejarDeSeguir') {
    // Dejar de seguir
    $perfil_id = $_POST['perfil_id'] ?? null;
    
    if (!$perfil_id) {
        http_response_code(400);
        echo json_encode(['error' => 'ID del perfil no proporcionado']);
        exit;
    }
    
    $perfil_id = (int)$perfil_id;
    
    $sql = "DELETE FROM seguidores WHERE usuario_id = $usuario_id AND perfil_id = $perfil_id";
    
    if ($mysqli->query($sql)) {
        echo json_encode(['exito' => true, 'mensaje' => 'Perfil dejado de seguir correctamente']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Error al dejar de seguir perfil']);
    }
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Acción no válida']);

<?php
session_start();
include 'conexion.php';

$ids = explode(',', $_POST['ids']);

if (count($ids) > 0) {
    // Crear placeholders para la consulta
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    // Consulta SQL para obtener la información de los usuarios seguidos
    $sql = "SELECT * FROM configuracion_perfil WHERE id_usuario IN ($placeholders)";
    $stmt = $mysqli->prepare($sql);

    // Vincular parámetros dinámicamente
    $types = str_repeat('s', count($ids));
    $stmt->bind_param($types, ...$ids);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["foto_perfil"]){
                echo '<li class="seguidos-li"><div class="div-lista-segudos"><a href="perfiles.php?parametro1=' . $row["id_usuario"] . '"><img class="foto_perfil" src="'.$row["foto_perfil"].'"></img>' . $row["nombre_usuario"] . '</a></div></li>';
            }else{
                echo '<li class="seguidos-li"><div class="div-lista-segudos"><a href="perfiles.php?parametro1=' . $row["id_usuario"] . '"><img class="foto_perfil" src="https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg"></img>' . $row["nombre_usuario"] . '</a></div></li>';
            }
            
        }
    } else {
        echo '<li class="seguidos-li"><span>No sigues a nadie</span></li>';
    }

    $stmt->close();
} else {
    echo '<li class="seguidos-li"><span>No sigues a nadie</span></li>';
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['modo']) && $_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/galeri.css">';
        echo '<link rel="stylesheet" href="../css/buscador.css">';
    }else{
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/galerie.css">';
        echo '<link rel="stylesheet" href="../css/buscador.css">';
    }
    ?>
<header>
    <nav>
        <ul>
            <h1>FANKIT</h1>
            <li><a href="../index.php">Home</a></li>
                <li><a href="../informacion/informacion.php">Informacion</a></li>
                <li><a href="../perfil/suscripciones.php">suscripciones</a></li>
                <li><a href="../cargar_imagenes/subir-imagen.php">perfil</a></li>
            </ul>
        </nav>
</header>
<button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset="">
</button> <script>
function goBack() {
window.history.back();
}</script>
<div class="info"><b>Resultado de busquedas</b></div>
<?php
include "../conexion.php"; 
// Verifica si los parámetros están presentes en la URL
if (isset($_GET['parametro'])) {
    
    // Obtén los valores de los parámetros
    $palabra = $_GET['parametro'];
    $cont_result = 0;
        
        // Consulta SQL para verificar las credenciales
        $sql = "SELECT * FROM imagenes WHERE nombre_imagen LIKE '%$palabra%'";

        // Ejecutar la consulta
        $result = $mysqli->query($sql);
    
        if ($result->num_rows > 0) {
            echo '<div class="info"><p>Imagenes con el nombre '.$palabra.'</p></div><div class="contenedor">';
            while ($e = $result->fetch_assoc()) {
                $cont_result = $cont_result + 1;
                echo '<div class="contenedor-img">
                <a href="galeria-carpeta.php?parametro1=' . $e['usuario'] . '&parametro2=' .$e['nombrecarpeta'].'">
                <img class="imagen" src="' . $e['enlace'] . '">
                </a>
                </div>';
            }
            echo '</div>';
        }
        

    // Realiza acciones con los valores obtenidos
    
    // Establecer la codificación de caracteres
    $mysqli -> query("SET NAMES 'utf8'");

    

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM carpetas WHERE nombre_carpeta LIKE '%$palabra%'";

    // Ejecutar la consulta
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="info"><p>Imagenes en carpetas con el nombre '.$palabra.'</p></div><div class="contenedor">';
        while ($c = $result->fetch_assoc()) {
            $id_carpeta_encontrada = $c['id'];
            $sql1 = "SELECT * FROM imagenes WHERE nombrecarpeta = '$id_carpeta_encontrada'";
            // Ejecutar la consulta
            $result1 = $mysqli->query($sql1);
            while ($e = $result1->fetch_assoc()) {
                $cont_result = $cont_result + 1;
                echo '<div class="contenedor-img">
                <a href="galeria-carpeta.php?parametro1=' . $e['usuario'] . '&parametro2=' .$id_carpeta_encontrada.'">
                <img class="imagen" src="' . $e['enlace'] . '">
                </a>
                </div>';
            }
        }
        echo '</div>';
    }


        // Consulta para los estilos
        $sql = "SELECT * FROM carpetas WHERE estilo LIKE '%$palabra%'";

        // Ejecutar la consulta
        $result = $mysqli->query($sql);
    
        if ($result->num_rows > 0) {
            echo '<div class="info"><p>Imagenes en carpetas con el estilo artistico o tecnica '.$palabra.'</p></div><div class="contenedor">';
            while ($c = $result->fetch_assoc()) {
                $id_carpeta_encontrada = $c['id'];
                $sql1 = "SELECT * FROM imagenes WHERE nombrecarpeta = '$id_carpeta_encontrada'";
                // Ejecutar la consulta
                $result1 = $mysqli->query($sql1);
                while ($e = $result1->fetch_assoc()) {
                    $cont_result = $cont_result + 1;
                    echo '<div class="contenedor-img">
                    <a href="galeria-carpeta.php?parametro1=' . $e['usuario'] . '&parametro2=' .$id_carpeta_encontrada.'">
                    <img class="imagen" src="' . $e['enlace'] . '">
                    </a>
                    </div>';
                }
            }
            echo '</div>';
        }


    $sql = "SELECT * FROM configuracion_perfil WHERE nombre_usuario LIKE '%$palabra%'";

    // Ejecutar la consulta
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="info"><p>Usuarios con el nombre '.$palabra.'</p></div><div class="contenedor_perfiles">';
        while ($e = $result->fetch_assoc()) {
            $cont_result = $cont_result + 1;
            echo '<div class="contenedor-perfil">
            <a href="../perfil/perfiles.php?parametro1=' . $e['id_usuario'] . '">';
            if (isset($e['foto_perfil']) && $e['foto_perfil']){
                echo '<img class="imagen_perfil" src="' . $e['foto_perfil'] . '">';
            }else{
                echo '<img class="imagen_perfil" src="https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg">';
            }
            echo '<p>' . $e['nombre_usuario'] . '</p>
            </a>
            </div>';
        }
        echo '</div>';
    }
    if($cont_result == 0){
        echo '<div class="info"><b>No se encontraro resultados con la palabra '.$palabra.'</b></div>';
    }
    mysqli_close($mysqli);
} else {
    // Si los parámetros no están presentes, muestra un mensaje de error o realiza otra acción
    echo "Parámetros no encontrados en la URL.";
}
?>


</body>
</html>

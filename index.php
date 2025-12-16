<?php
session_start();

// Procesar solicitudes JSON si existen
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id'])) {
    // Si se solicita JSON, responder en JSON
    if (!empty($_GET) || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
        $id = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : '';
        header('Content-Type: application/json');
        echo json_encode(array('id' => $id));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fan-Kit</title>
</head>
<body>

    <?php
    // La sesión ya fue iniciada arriba
    if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['modo']) && $_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="css/modo_oscuro/estiloss.css">';
    }else{
        echo '<link rel="stylesheet" href="css/estilos.css">';
    }
    ?>
<div class="imagen-principal">
    <img src="imagenes/imagen.png" class="fondo">
    <h1 class="eslogan">Busca y Explora Distintos Estilos de Arte</h1>

    <input class="buscador" type="search" placeholder="Busca arte en fankit" id="mySearchField">
    <button id="boton_buscar"><img src="imagenes/lupa.svg" alt=""></button>
    <script>
        document.getElementById("boton_buscar").addEventListener('click', function() {
            const searchValue = document.getElementById("mySearchField").value;
            window.location.href = `cargar_imagenes/buscador.php?parametro=${encodeURIComponent(searchValue)}`;
        });
    function redirectToPhp(event) {
    if (event.key === "Enter") {
      const searchValue = document.getElementById("mySearchField").value;
      window.location.href = `cargar_imagenes/buscador.php?parametro=${encodeURIComponent(searchValue)}`;
    }
  }

  document.getElementById("mySearchField").addEventListener("keydown", redirectToPhp);
  </script>
</div>
<header>
        <nav>
            <ul>
            <h1>FANKIT</h1>
                <li><a href="index.php">Home</a></li>
                <li><a href="informacion/informacion.php">Informacion</a></li>
                <li><a href="perfil/suscripciones.php">Suscripciones</a></li>
                <li><a href="cargar_imagenes/subir-imagen.php">perfil</a></li>
            </ul>
        </nav>
    </header>
<div id="categorias">
    <?php
    include 'conexion.php';
        // Consulta SQL para verificar las credenciales
        $sql = "SELECT DISTINCT nombre_carpeta FROM carpetas ORDER BY id DESC";
    
        // Ejecutar la consulta
        $result = $mysqli->query($sql);
    
        if ($result->num_rows > 0) {
            $texto = "Carpetas";
            // El usuario tiene carpeta la abrira
            while ($e = $result->fetch_assoc()) {
                if (isset($e['usuario'])) {
                    echo $e['usuario'];
                }
                echo '<a href="cargar_imagenes/buscador.php?parametro=' . (isset($e['nombre_carpeta']) ? $e['nombre_carpeta'] : '') .'">
                    <p>' . (isset($e['nombre_carpeta']) ? $e['nombre_carpeta'] : '') . '</p>
                    </a>';
            }
        } else {
            // No se encontraron resultados
            $texto = "No se encontraron carpetas.";
        }
    
    ?>
</div>
    <div class="contenedor">
    <?php
include "conexion.php";
$mysqli->query("SET NAMES 'utf8'");
$sql = "SELECT * FROM imagenes ORDER BY id DESC"; // Ordenar por ID en orden descendente
$result = $mysqli->query($sql);

$imagesToShow = 60; 

$imageCounter = 0; 

while ($e = mysqli_fetch_array($result)) {
    if ($imageCounter >= $imagesToShow) {
        break;
    }

    echo '<div class="contenedor-img">
        <a href="cargar_imagenes/galeria-carpeta.php?parametro1=' . $e['usuario'] . '&parametro2=' . $e['nombrecarpeta'] .'">
        <img class="imagen" src="' . $e['enlace'] . '">
        </a>
    </div>';

    $imageCounter++; // Incrementa el contador de imágenes
}
?>
</div>

<script>
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'css/galerie.css';
        document.body.appendChild(link);
    </script>
    <footer>
    <div class="marca">
    <p class="pcontacto">
        2024 Hacketubers Entertainment
    </p>
    </div>
    <div class="correo">
        <p class="pcontacto">
            contact us <a href="">garlymanzanero70@gmail.com</a> 
        </p>
    </div>
    <div class="redes-sociales">
        <a id="github" class="iconos-contacto" href="https://github.com/hacketubers-entertainment"><img src="imagenes/github.svg" alt=""></a>
        <a id="linkeding" class="iconos-contacto" href="https://www.linkedin.com/in/hacketubers-entertainment-547718271/"><img src="imagenes/linkedin.svg" alt=""></a>
        <a id="instagram" class="iconos-contacto" href=https://www.instagram.com/hacketubers><img src="imagenes/instagram.svg" alt=""></a>
        <a id="x" class="iconos-contacto" href="https://x.com/hacketubersyt"><img src="imagenes/x.svg" alt=""></a>
    </div>
</footer>
<script src="js/buscare.js"></script>
</body>
</html>
<!-- href="../" 1 carpeta atras-->

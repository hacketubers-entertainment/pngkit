<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de</title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['modo']) && $_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/informacions.css">';
    }else{
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/informacion.css">';
    }
    ?>
<header>
    <nav>
        <ul>
            <h1>FANKIT</h1>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../informacion/informacion.php">Informacion</a></li>
            <li><a href="../perfil/suscripciones.php">suscripciones</a></li>
            <li><a href="../cargar_imagenes/subir-imagen.php">Perfil</a></li>
        </ul>
    </nav>
</header>
<button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset=""></button>
<script>
function goBack() {
window.history.back();
}</script>
<div class="informacion">
    <h2>Acerca De</h2>
    <span>Fankit un sitio creado para artistas donde podras tomar inspiracion o mostrar tu arte</span>
</div>
<div class="contenedores">
    <img src="imagenes/capturas/2.png" alt="" srcset="">
    <div class="contenedor-texto">
        <span>Interfaz Limpia y Minimalista</span><br><br>
        <span class="texto-mediano">Navega por una interfaz limpia y comoda, sin saturacion de colores ni efectos que relenticen la carga</span>
    </div>
</div>
<div class="contenedores">
    <div class="contenedor-texto">
        <span>Sistema de organizacion por carpetas</span><br><br>
        <span class="texto-mediano">Organiza tus imagenes en carpetas para sparar tus estilos de arte y facilitar la busqueda de contenido</span>
    </div>
    <img src="imagenes/capturas/1.png" alt="" srcset="">
</div>
<div class="contenedores">
    <img src="imagenes/capturas/5.png" alt="" srcset="">
    <div class="contenedor-texto">
        <span>Sigue a tus artistas favoritas</span><br><br>
        <span class="texto-mediano">Sigue a los perfiles que mas te gusten</span>
    </div>
</div>
<div class="contenedores">
    <div class="contenedor-texto">
        <span>Personaliza tu perfil</span><br><br>
        <span class="texto-mediano">Agrega una foto y un nombre de usuario personalizable a cada momento para que todos la vean</span>
    </div>
    <img src="imagenes/capturas/4.png" alt="" srcset="">
</div>
<div class="contenedores">
    <img src="imagenes/capturas/3.png" alt="" srcset="">
    <div class="contenedor-texto">
        <span>Modo oscuro</span><br><br>
        <span class="texto-mediano">Personaliza tu navegacion con el modo oscuro o modo claro</span>
    </div>
</div>
</body>
</html>

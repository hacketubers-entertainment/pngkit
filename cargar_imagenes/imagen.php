<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    session_start();
    if ($_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/imagen.css">';
    }else{
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/imagen.css">';
    }
    ?>
</head>
<body>
<header>
    <nav>
        <ul>
            <h1>FANKIT</h1>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../informacion/informacion.php">Informacion</a></li>
            <li><a href="../perfil/suscripciones.php">Suscripciones</a></li>
            <li><a href="../cargar_imagenes/subir-imagen.php">Perfil</a></li>
        </ul>
    </nav>
</header>
<button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset=""></button>
<script>
function goBack() {
window.history.back();
}</script>
<?php
include "conexion.php";
$id_imagen = $_GET['id'];
$mysqli -> query("SET NAMES 'utf8'");
$sql = "SELECT i.enlace, i.nombre_imagen, i.descripcion, u.id_usuario, u.nombre_usuario, c.nombre_carpeta, c.estilo, c.id
FROM imagenes i
JOIN configuracion_perfil u ON i.usuario = u.id_usuario
JOIN carpetas c ON i.nombrecarpeta = c.id
WHERE i.id = '$id_imagen'";
$result = $mysqli->query($sql);
$i = $result-> fetch_assoc();

echo'<div id="contenedor_informacion">
        <img id="imagen" src="'.$i['enlace'].'" alt="">
        <div id="contenedor_texto">
        <h2 id="nombre_imagen">'.$i['nombre_imagen'].'</h2>
        <div id="info_externa">
            <a href="../perfil/perfiles.php?parametro1='.$i['id_usuario'].'"><h3 id="nombre_usuario">Autor: '.$i['nombre_usuario'].'</h3></a>
            <a href="galeria-carpeta.php?parametro1='.$i['id_usuario'].'&parametro2='.$i['id'].'"><h3 id="nombre_carpeta">Carpeta: '.$i['nombre_carpeta'].'</h3></a>
        </div>
        <b id="estilo">Estilo Artistico: '.$i['estilo'].'</b><br>
        <div id="descripcion"><b>Descripcion: </b><span>'.$i['descripcion'].'</span></div>
        </div>
    </div>'
?>
<script>
document.querySelectorAll('#imagen').forEach(img => {
    img.onload = function() {
        if (this.naturalWidth > this.naturalHeight) {
            this.classList.add('imagen_horizontal');
        } else {
            this.classList.add('imagen_vertical');
        }
    };
});
</script>
</body>
</html>
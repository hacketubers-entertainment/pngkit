<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Suscripciones</title>
</head>
<body>
<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../inicio_secion/iniciar_secion.php');
        exit;
    }
    if (isset($_SESSION['usuario']['modo']) && $_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/estilos-subimge.css">';
    }else{
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/estilos-subimge.css">';
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
    <div id="lista-seguidos">
        <?php
        $nombre = $_SESSION['usuario']['id'];
        echo '<input type="hidden" id="usuario" value="'.$nombre.'"><input type="hidden" id="perfil_actual" value="'.$nombre.'">';
        ?>
        
    </div>
    <script src="js/script_seguidores.js?v=<?php echo time(); ?>"></script>
    <script>leerDatosUsuario()</script>
</body>
</html>

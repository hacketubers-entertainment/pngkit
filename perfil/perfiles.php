<!DOCTYPE html>
<html lang="es">
<head>
    
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-storage.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    
</head>
<?php
    session_start();
    if ($_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/estilos-subimge.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/redes_sociales.css">';
    }else{
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/estilos-subimge.css">';
        echo '<link rel="stylesheet" href="../css/redes_sociales.css">';
    }
    ?>
<body>
<header>
        <nav>
            <ul>
                <h1>FANKIT</h1>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../informacion/informacion.php">Informacion</a></li>
                <li><a href="../perfil/suscripciones.php">Suscribes</a></li>
                <li><a href="../cargar_imagenes/subir-imagen.php">Subir</a></li>
            </ul>
        </nav>
    </header>

    <div id="perfil">
    <?php
    session_start();
    $nombre = $_SESSION['usuario']['id'];
    $perfil = $_SESSION['usuario']['nombre'];
    include "conexion.php"; 
    // Verifica si los parámetros están presentes en la URL
    if (isset($_GET['parametro1'])) {
        
        // Obtén los valores de los parámetros
        $usuario = $_GET['parametro1'];
        $mysqli->query("SET NAMES 'utf8'");

        // Consulta SQL para verificar las credenciales
        $sql = "SELECT * FROM usuarios WHERE id = '$usuario'"; 
        // Ejecutar la consulta
        $result = $mysqli->query($sql);
        $t = $result->fetch_assoc();
        $usuario = $t['id'];
        $sql = "SELECT * FROM configuracion_perfil WHERE id_usuario = '$usuario'"; 
        // Ejecutar la consulta
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        if($row['foto_perfil'] != ""){
            echo '<img id="foto_perfil" src="'. $row['foto_perfil'] .'"> ';
        }else{
            echo '<img id="foto_perfil" src="https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg" alt="">';
        }
        if($row['foto_banner'] != ""){
            echo '<img id="foto_banner" src="'. $row['foto_banner'] .'"> ';
        } else {
            echo '<img id="foto_banner" src="https://premiotransparencia.org.mx/wp-content/uploads/2023/09/Diferencia-entre-el-color-lila-y-orado-1024x497.jpg"></img>';
        }
        echo'<button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset="">
    </button> <script>
function goBack() {
window.history.back();
}</script>';
        echo '<div id="cont_nombre_verficado"><b id="nombre_usuario">'. $row['nombre_usuario'] .'</b>';
        if($row['verificado']){
            echo '<img src="imagenes/verificado.svg" alt=""></div>';
        }else{
            echo '</div>';
        }
        if($row['descripcion'] != ""){
            echo '<p id="descripcion">'. $row['descripcion'] .'</p>';
        }
        $mysqli -> query("SET NAMES 'utf8");

        // Consulta SQL para verificar las credenciales
        $sql = "SELECT * FROM redes_sociales WHERE id_usuario = '$usuario'";
        $result = $mysqli->query($sql);
        $k = $result->fetch_assoc();
        if ($result->num_rows > 0){
            $facebook = $k['facebook'];
            $instagram = $k['instagram'];
            $x = $k['x'];
            $discord = $k['discord'];
            $reddit = $k['reddit'];
            $pinterest = $k['pinterest'];
            $linkedin = $k['linkedin'];
            $sitio_web = $k['sitio_web'];
            echo '<div class="redes_sociales">';
            if($facebook){
                echo '<a href="'. $facebook .'"><img id="facebook" class="iconos-contacto" src="imagenes/facebook.svg" alt="" srcset=""></a>';
            }
            if($instagram){
                echo '<a href="'. $instagram .'"><img id="instagram" class="iconos-contacto" src="imagenes/instagram.svg" alt="" srcset=""></a>';
            }
            if($x){
                echo '<a href="'. $x .'"><img id="x" class="iconos-contacto" src="imagenes/x.svg" alt="" srcset=""></a>';
            }
            if($discord){
                echo '<a href="'. $discord .'"><img id="discord" class="iconos-contacto" src="imagenes/discord.svg" alt="" srcset=""></a>';
            }
            if($reddit){
                echo '<a href="'. $reddit .'"><img id="reddit" class="iconos-contacto" src="imagenes/reddit.svg" alt="" srcset=""></a>';
            }
            if($pinterest){
                echo '<a href="'. $pinterest .'"><img id="pinterest" class="iconos-contacto" src="imagenes/pinterest.svg" alt="" srcset=""></a>';
            }
            if($linkedin){
                echo '<a href="'. $linkedin .'"><img id="linkedin" class="iconos-contacto" src="imagenes/linkedin.svg" alt="" srcset=""></a>';
            }
            if($sitio_web){
                echo '<a href="'. $sitio_web .'"><img id="sitio_web" class="iconos-contacto" src="imagenes/eart.svg" alt="" srcset=""></a>';
            }
            echo'</div>';
        }
    }
        if (isset($_GET['parametro1'])) {
            $usuario = $_GET['parametro1'];
            if($nombre != $usuario){
                echo '<button id="seguir" class="seguir" onclick="guardarPerfilSeguido()">seguir</button>';
            }
            else{
                header('Location: ../cargar_imagenes/subir-imagen.php');
            }
            echo '<input type="hidden" id="usuario" value="'.$nombre.'"><input type="hidden" id="perfil_actual" value="'.$usuario.'">';
        }
    ?>
    </div>
    

    <div class="carpetas">
    <?php
    include "conexion.php"; 
    // Verifica si los parámetros están presentes en la URL
    if (isset($_GET['parametro1'])) {
        
        // Obtén los valores de los parámetros
        $usuario = $_GET['parametro1'];
        $mysqli -> query("SET NAMES 'utf8");

        // Consulta SQL para verificar las credenciales
        $sql = "SELECT * FROM carpetas WHERE id_usuario = '$usuario'";
        
        // Ejecutar la consulta
        $result = $mysqli->query($sql);
    
        if ($result->num_rows > 0) {
            $texto = "Carpetas";
            // El usuario tiene carpeta la abrira
            while ($e = $result->fetch_assoc()) {
                echo '<a href="../cargar_imagenes/galeria-carpeta.php?parametro1=' . $usuario . '&parametro2=' . $e['id'] .'">
                    <div class="carpeta">
                    <img class="img_folder" src="imagenes/folder.svg">
                    <p>' . $e['nombre_carpeta'] . '<p>
                    </div>
                    </a>';
            }
        } else {
            // No se encontraron resultados
            $texto = "No se encontraron carpetas.";
        }
    
    } else {
        $texto = "Inicia secion";
    }
    
    ?>
    </div>
    <script src="js/script_seguidores.js"></script>
    <script>verificarSeguido();</script>
</body>
</html>
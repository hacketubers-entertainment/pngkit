<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="https://genfavicon.com/tmp/icon_ca7a0a5637dc1b274fda20a6799a5e1c.ico">
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-storage.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
</head>
<body>
<?php
include "../conexion.php";
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../index.php');
        exit;
    }
    $id = $_SESSION['usuario']['id'];
    if (isset($_SESSION['usuario']['modo']) && $_SESSION['usuario']['modo']=='true'){
        echo'<link rel="stylesheet" href="../css/modo_oscuro/redes_sociales.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/estilos-subimge.css">';
        $modo_oscuro = true;
    }else{
        echo '<link rel="stylesheet" href="../css/redes_sociales.css">';
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/estilos-subimge.css">';
        $modo_oscuro = false;
    }
    $mysqli -> query("SET NAMES 'utf8'");

    
    $sql = "SELECT * FROM configuracion_perfil WHERE id_usuario = '$id'";
    // Ejecutar la consulta
    $result = $mysqli->query($sql);
    $p = $result ? $result->fetch_assoc() : array();
    ?>
<header>
        <nav>
            <ul>
                <h1>FANKIT</h1>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../informacion/informacion.php">Informacion</a></li>
                <li><a href="../perfil/suscripciones.php">Suscribes</a></li>
                <li><a href="../cargar_imagenes/subir-imagen.php">Perfil</a></li>
            </ul>
        </nav>
</header>

<div id="perfil">
    <?php
        if ($p['foto_banner']!="") {
            echo '<img id="foto_banner" src="'.$p['foto_banner'].'" alt="">';
        }
        else{
            echo '<img id="foto_banner" src="https://premiotransparencia.org.mx/wp-content/uploads/2023/09/Diferencia-entre-el-color-lila-y-orado-1024x497.jpg"></img>';
        }
        echo'<button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset="">
        </button> <script>
    function goBack() {
    window.history.back();
    }</script>';
        if ($p['foto_perfil']!="") {
            echo '<img id="foto_perfil" src="'.$p['foto_perfil'].'" alt="">';
        }else{
            echo '<img id="foto_perfil" src="https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg" alt="">';
        }

    ?>

    <?php
    if (isset($p) && $p && isset($p['nombre_usuario']) && $p['nombre_usuario']) {
        echo '<div id="cont_nombre_verficado"><b id="nombre_usuario">'.$p['nombre_usuario'].'</b>';
        if(isset($p['verificado']) && $p['verificado']){
            echo '<img src="imagenes/verificado.svg" alt=""></div>';
        }else{
            echo '</div>';
        }
        echo '<b id="nombre">nombre</b>';
    }else{
        echo '<b id="nombre_usuario">'.htmlspecialchars($_SESSION['usuario']['nombre'], ENT_QUOTES, 'UTF-8').'</b>
        <b id="nombre">nombre</b>';
    }
    ?>
    
    <?php
    if (isset($_SESSION['usuario'])) {
        echo '<p id="descripcion">'.$p['descripcion'].'</p>';
        $nombre = $_SESSION['usuario']['nombre'];
        $id = $_SESSION['usuario']['id'];

        $mysqli -> query("SET NAMES 'utf8'");

        // Consulta SQL para verificar las credenciales
        $sql = "SELECT * FROM redes_sociales WHERE id_usuario = '$id'";
        $result = $mysqli->query($sql);
        $row = $result ? $result->fetch_assoc() : array();
        if ($result && $result->num_rows > 0){
            $facebook = $row['facebook'];
            $instagram = $row['instagram'];
            $x = $row['x'];
            $discord = $row['discord'];
            $reddit = $row['reddit'];
            $pinterest = $row['pinterest'];
            $linkedin = $row['linkedin'];
            $sitio_web = $row['sitio_web'];
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
        echo '<div class="botones"><a href="../perfil/configuracion.php?id_usuario='.$id.'"><button id="editar-perfil">Editar Perfil</button></a>';
        echo '<a href="#subir"><button id="bajar_subimg">Subir Imagen</button></a></div>';
        echo '<p id="info-folder"></p>';
    } else {
        echo'<a href="../inicio_secion/iniciar_secion.php"><p id="info-folder"></p></a>';
    }    
    ?>
    
</div>
<br><br>



<div class="carpetas">

<?php

if (isset($_SESSION['usuario'])) {
    echo '<a href="">
        <div id="crear_carpeta" class="carpeta">
        <img class="img_folder" src="imagenes/folder-add.svg">
        <p>Crear Carpeta<p>
        </div>
        </a>';
    $nombre = $_SESSION['usuario']['nombre'];
    $id = $_SESSION['usuario']['id']; // Obtener el ID del usuario de la sesión
    $mysqli -> query("SET NAMES 'utf8'");

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT id, nombre_carpeta FROM carpetas WHERE id_usuario = '$id'";
    
    // Ejecutar la consulta
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $texto = "Carpetas";
        echo '';
        while ($e = $result->fetch_assoc()) {
            echo '<a href="galeria-carpeta.php?parametro1=' .$id . '&parametro2=' . $e['id'] .'">
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
    <script>
        document.getElementById('info-folder').textContent = '<?php echo $texto; ?>';
    </script>

</div>
<a name="subir"></a>
<div class="cont">

    <div class="contenedor-form-img">
        <h2 id="estado-subida">Sube tu imagen</h2>
        <span>Selecciona la imagen que deseas subir</span>
        <input type="file" id="imageUpload" />
        <img id="imagen_seleccionada" src="" alt="" srcset=""><br>
        <label id="labelarchivo" for="imageUpload"></label>

        <?php
            if (isset($_GET['carpeta_subir'])) {
                echo htmlspecialchars($_GET['carpeta_subir'], ENT_QUOTES, 'UTF-8');
                echo '<select id="folderName" name="folder">
                <option value="'.htmlspecialchars($_GET['carpeta_subir'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($_GET['carpeta_subir'], ENT_QUOTES, 'UTF-8').'</option>';
            }else{
                echo '<select id="folderName" name="folder">
                <option value="">--Selecciona una carpeta--</option>';
            }
            $sql = "SELECT id, nombre_carpeta FROM carpetas WHERE id_usuario = '$id'";
    
            // Ejecutar la consulta
            $result = $mysqli->query($sql);
        
            if ($result->num_rows > 0) {
                $texto = "Carpetas";
                // El usuario tiene carpeta la abrira
                while ($e = $result->fetch_assoc()) {
                    echo '<option value="' . $e['id'] .'">' . $e['nombre_carpeta'] .'</option>';
                }
            }
        ?>
    </select>

        <input type="text" id="nombre_imagen" placeholder="Ingresa el nombre de la imagen">
        <input type="text" id="descripcion_imagen" placeholder="Ingresa una descripcion para tu imagen">
        <button disabled id="uploadButton">Rellena todos los campos</button>
    </div>
</div>

<div id="contenedorFormulario"></div>
<?php
echo '<input id="input_modo" type="hidden" value="'.$modo_oscuro.'">';
?>
    <script src="js/javascript.js"></script>
    <script src="js/inputfile.js"></script>
    <script src="js/crearcarpeta.js"></script>
</body>
</html>
        <!--<input type="text" id="folderName" placeholder="Ingresa el nombre de la carpeta" value="<?php
        //if (isset($_GET['carpeta_subir'])) {
            //echo $_GET['carpeta_subir'];
        //}
        ?>"/>-->

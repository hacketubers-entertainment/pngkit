<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-storage.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
</head>
<body>
<?php
include '../conexion.php';
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../index.php');
        exit;
    }
    $id = $_SESSION['usuario']['id'];
    if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['modo']) && $_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/configura.css">';
    }else{
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/configurar.css">';
    }
    $mysqli -> query("SET NAMES 'utf8'");

    
    $sql = "SELECT * FROM configuracion_perfil WHERE id_usuario = '$id'";
    // Ejecutar la consulta
    $result = $mysqli->query($sql);
    $p = $result ? $result->fetch_assoc() : array();
    $sql = "SELECT * FROM redes_sociales WHERE id_usuario = '$id'";
    // Ejecutar la consulta
    $result = $mysqli->query($sql);
    $e = $result ? $result->fetch_assoc() : array();
    ?>
<header>
    <nav>
        <ul>
            <h1>FANKIT</h1>
            <li><a href="../index.php">Home</a></li>
                <li><a href="../informacion/informacion.php">Informacion</a></li>
                <li><a href="suscripciones.php">Suscribes</a></li>
                <li><a href="../cargar_imagenes/subir-imagen.php">Subir</a></li>
            </ul>
        </nav>
</header>
<?php
echo'<button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset="">
    </button> <script>
    function goBack() {
    window.history.back();
    }</script>';
?>
<hr>
<div>
    <span id="progreso_carga_banner"> Subir Foto de banner</span>
    <div id="contenedor_foto_banner">
    <img src="<?php
        if (isset($p['foto_banner']) && $p['foto_banner']!="") {
            echo $p['foto_banner'];
        }else{
            echo 'https://premiotransparencia.org.mx/wp-content/uploads/2023/09/Diferencia-entre-el-color-lila-y-orado-1024x497.jpg';
        }
    ?>" alt="" srcset="" id="foto_banner">
    </div>
<input type="file" id="input_banner" /><br>
<button disabled="disabled" id="subir_banner">Actualizar banner</button>
<script>
$("#input_banner").change(function(){
    $("#subir_banner").prop("disabled", this.files.length == 0);
});
</script>
</div>
<hr>
<div>
    <span id="progreso_carga_perfil">Subir Foto de perfil</span>
    <div id="contenedor_foto">
    <img src="<?php
        if (isset($p['foto_perfil']) && $p['foto_perfil']!="") {
            echo $p['foto_perfil'];
        }else{
            echo 'https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg';
        }
    ?>" alt="" srcset="" id="foto_perfil">
    </div>
<input type="file" id="input_perfil" /><br>
<button disabled="disabled" id="subir_perfil">Actualizar Imagen Perfil</button>
<script>$("#input_perfil").change(function(){
    $("#subir_perfil").prop("disabled", this.files.length == 0);
});</script>
</div>
<hr>
<div>
<form method="POST" action="actualizar.php">
    Nuevo nombre<br>
    <input type="text" name="nuevo_nombre" placeholder="Ingresa el nombre de usuario" value="<?php echo isset($p['nombre_usuario']) ? $p['nombre_usuario'] : '';?>"><br>
    <input type="hidden" name="id_usuario" value="<?php echo isset($_GET['id_usuario']) ? $_GET['id_usuario'] : $id;?>" id="id-user">
    <input class="boton_actualizar" type="submit" value="Actualizar">
</form>
</div>
<hr>
<div>
<form method="POST" action="descripcion.php">
    Descripcion<br>
    <input type="text" name="descripcion" placeholder="Ingresa una Descripcion" value="<?php echo isset($p['descripcion']) ? $p['descripcion'] : '';?>"><br>
    <input type="hidden" name="id_usuario" value="<?php echo isset($_GET['id_usuario']) ? $_GET['id_usuario'] : $id;?>" id="id-user">
    <input class="boton_actualizar" type="submit" value="Actualizar">
</form>
</div>
<hr>
<div>
<form method="POST" action="redes_sociales.php">
    Redes Sociales<br>
    <input type="text" name="facebook" placeholder="https://facebook.com/user" value="<?php echo isset($e['facebook']) ? $e['facebook'] : '';?>"><br>
    <input type="text" name="instagram" placeholder="https://instagram.com/user" value="<?php echo isset($e['instagram']) ? $e['instagram'] : '';?>"><br>
    <input type="text" name="x" placeholder="https://x.com/user" value="<?php echo isset($e['x']) ? $e['x'] : '';?>"><br>
    <input type="text" name="discord" placeholder="https://discord.com/user" value="<?php echo isset($e['discord']) ? $e['discord'] : '';?>"><br>
    <input type="text" name="reddit" placeholder="https://reddit.com/user" value="<?php echo isset($e['reddit']) ? $e['reddit'] : '';?>"><br>
    <input type="text" name="pinterest" placeholder="https://pinterest.com/user" value="<?php echo isset($e['pinterest']) ? $e['pinterest'] : '';?>"><br>
    <input type="text" name="linkedin" placeholder="https://linkedin.com/user" value="<?php echo isset($e['linkedin']) ? $e['linkedin'] : '';?>"><br>
    <input type="text" name="sitio_web" placeholder="ingresa tu sitio web" value="<?php echo isset($e['sitio_web']) ? $e['sitio_web'] : '';?>"><br>
    <input type="hidden" name="id_usuario" value="<?php echo isset($_GET['id_usuario']) ? $_GET['id_usuario'] : $id;?>" id="id-user">
    <input class="boton_actualizar" type="submit" value="Actualizar">
</form>
</div>
<hr>
<div>
<input type="checkbox" name="" id="togle" <?php 
if(isset($_SESSION['usuario']) && isset($_SESSION['usuario']['modo']) && $_SESSION['usuario']['modo']=='true'){
    echo 'checked="'.htmlspecialchars($_SESSION['usuario']['modo'], ENT_QUOTES, 'UTF-8').'"';
}
?>>
<label for="togle">Modo oscuro</label>
</div>
<hr>
<div>
<a id="cerrar_secion" href="../inicio_secion/cerrar_secion.php">Cerrar_secion</a>
</div>
<script>
    console.log(document.getElementById("id-user").value)
</script>
<script src="js/subir_foto_perfil.js"></script>
<script src="js/subir_foto_banner.js"></script>
<script src="js/modo.js"></script>
</body>
</html>

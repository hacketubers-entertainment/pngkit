<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
</head>
<body>
<?php
    session_start();
    if ($_SESSION['usuario']['modo']=='true'){
        echo '<link rel="stylesheet" href="../css/modo_oscuro/styl.css">';
        echo '<link rel="stylesheet" href="../css/modo_oscuro/galeri.css">';
    }else{
        echo '<link rel="stylesheet" href="../css/styles.css">';
        echo '<link rel="stylesheet" href="../css/galerie.css">';
    }
    ?>
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

<?php
echo'<button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset="">
    </button> <script>
    function goBack() {
    window.history.back();
    }</script>';
include "conexion.php"; 
// Verifica si los parámetros están presentes en la URL
if (isset($_GET['parametro1']) && isset($_GET['parametro2'])) {
    
    // Obtén los valores de los parámetros
    $usuario = $_GET['parametro1'];
    $idcarpeta = $_GET['parametro2'];

    $mysqli->query("SET NAMES 'utf8'");
    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM configuracion_perfil WHERE id_usuario = '$usuario'"; 
    // Ejecutar la consulta
    $result = $mysqli->query($sql);
    $t = $result->fetch_assoc();

    // Consulta SQL para verificar las credenciales
    $sql1 = "SELECT * FROM carpetas WHERE id = '$idcarpeta'"; 
    // Ejecutar la consulta
    $result1 = $mysqli->query($sql1);
    $c = $result1->fetch_assoc();


    // Realiza acciones con los valores obtenidos
    echo '<div class="info">
    <a id="nombre_usuario" href="../perfil/perfiles.php?parametro1=' . $usuario .'">';

    if ($t['foto_perfil']){
        echo'<img id="foto_perfil" src="'.$t['foto_perfil'].'"></img>';
    }else{
        echo'<img id="foto_perfil" src="https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg"></img>';
    }
    $nombre_carpeta = $c['nombre_carpeta'];
    echo'<div>
    <b id="nombre_carpeta">'.$c['nombre_carpeta'].'</b>
    <p>'. $t['nombre_usuario'].'</p></a>
    <div>
    </div>
    <div class="contenedor">';

    $mysqli -> query("SET NAMES 'utf8");

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM imagenes WHERE nombrecarpeta = '$idcarpeta'";

    $result = $mysqli->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // El usuario tiene carpeta la abrira
        while ($e = $result->fetch_assoc()) {
            echo '<div class="contenedor-img">
                <a href="imagen.php?id=' . $e['id'] . '">
                <img class="imagen" src="' . $e['enlace'] . '">
                </a>
            </div>';
        }
    } else {

        echo "No se encontraron imágenes.";
    }

    mysqli_close($conexion);
} else {

    echo "Parámetros no encontrados en la URL.";
}
?>

</div>
    <?php
    if($usuario == $_SESSION['usuario']['id']){
        echo '<a href="subir-imagen.php?carpeta_subir='.$idcarpeta.'"><button id="subir_boton">Subir imagen a esta carpeta</button></a>';
    }
    ?>
</body>
</html>

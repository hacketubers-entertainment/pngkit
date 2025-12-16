<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/iniciar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>inicio de sesion</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <button onclick="goBack()" id="flecha_nav"><img src="imagenes/arrow.svg" alt="" srcset=""></button>
    <script>
        function goBack() {
        window.open('../index.php', '_self')
    }
    </script>
    <div class="container">
        <div class="form-content">
            <h1 id="title">Registro</h1>
            <form action="registrar.php" method="GET" id="formulario">
                <div class="input-group">
                    <div class="input-field" id="name-input">
                        <i class="fa-solid fa-user"></i>
                        <img src="imagenes/user.svg" alt="">
                        <input type="text" placeholder="nombre" id="nombre" name="nombre">
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <img src="imagenes/user.svg" alt="">
                        <input type="email" placeholder="correo" id="correo" name="correo">
                    </div>    
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <img src="imagenes/user.svg" alt="">
                        <input type="password" placeholder="contraseña" id="contraseña" name="contraseña">
                    </div>   
                    <p>olvidaste tu contraseña <a href="">click aqui</a></p>                                  
                </div>
                <div class="btn-field">
                    <button id="crearcuenta" type="submit">Registro</button>
                    <button id="iniciosecion"  type="button" class="disable">log-in</button>
                </div>
            </form>
        </div>
    </div>
    <?php
session_start(); // Iniciar la sesión

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje']; // Guardar el mensaje en una variable
    unset($_SESSION['mensaje']); // Borrar el mensaje de la sesión
} else {
    $mensaje = ''; // Si no hay mensaje, usar una cadena vacía
}
?>

<script>
var mensaje = "<?php echo $mensaje; ?>"; // Pasar el mensaje a JavaScript

window.onload = function() {
    if (mensaje !== '') {
        document.getElementById('title').textContent = mensaje; // Cambiar el texto de la etiqueta con el ID "title"
    }
};
</script>
    <script src="js/iniciar_sesion.js"></script>
</body>
</html>

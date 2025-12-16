<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '12345678';
    $db_name = 'pngkit';

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    if (mysqli_connect_error()){
        printf("conexion fallida", mysqli_connect_error());
        exit();
    }
?>
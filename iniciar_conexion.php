<?php
$host = "localhost";
$usuario = "root";
$pass = "iaw";
$base_datos = "servidor_web";
$conectar = mysqli_connect($host, $usuario, $pass, $base_datos);
if(!$conectar)
{
    die("Error de conexión." . mysqli_connect_error());
}
?>
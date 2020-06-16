<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
}
$nombreFichero = $_GET['foto'];
echo "<img src='./directorio_fichero/$s_usuario/$nombreFichero' alt='Error de visualizacion'/>" . "<br>";
echo "<a href='contenido.php'>Volver</a>";
?>
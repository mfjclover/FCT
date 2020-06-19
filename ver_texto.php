<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
}
else {
    header("Location: error.php");
}

include_once 'function_ver_texto.php';

$nombreFichero = $_GET['texto'];
$nombreFichero = "./directorio_fichero/$s_usuario/$nombreFichero";
echo ver_texto($nombreFichero) . "<br>";
echo "<a href='contenido.php'>Volver</a>"
?>

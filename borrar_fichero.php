<?php
session_start();
if(isset($_SESSION["s_usuario"]))
{
    $s_usuario = $_SESSION["s_usuario"];
}
else {
    header("Location: error.php");
}
$nombreFichero = $_GET["borrar_fichero"];
unlink("./directorio_fichero/$s_usuario/$nombreFichero");
header("Location: contenido.php");
?>
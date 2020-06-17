<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
}
$nombreFichero = $_POST['nombre_fichero'];
echo "Fichero: " . $nombreFichero . "<br>";
$contenido = $_POST['contenido'];
echo $contenido;
// copy($nombreFichero, "/tmp/" . $_POST['fichero']);
$editar = fopen($nombreFichero, "w");
fwrite($editar, $contenido);
fclose($editar);
header("Location: contenido.php");
?>
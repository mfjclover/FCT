<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
}
$nombreFichero = $_GET['texto'];
$nombreFichero = "./directorio_fichero/$s_usuario/$nombreFichero";
include_once 'function_ver_texto.php';
echo "<html>";
echo "<form action='guardar_texto.php' method='POST'>" ;
    echo "<textarea rows='15' cols='30' name='contenido'/>";
    echo ver_texto($nombreFichero);
    echo "</textarea>";
    echo "<input type='hidden' name='nombre_fichero' value='$nombreFichero'/>" . "<br>";
    echo "<input type='submit' value='Guardar'/>";
    echo "<a href='contenido.php'>Volver</a>";
echo "</form>";
echo "</body>";
echo "</html>";
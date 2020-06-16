<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
}

function ver_texto($nameFile){
    $leer = fopen($nameFile, "r");
    $contenido = "";
    while(!feof($leer)){
        $linea = fgets($leer);
        if(strlen($linea) > 0){
            $contenido .= $linea . "<br>";
        }
    }
    fclose($leer);
    return $contenido;
}

$nombreFichero = $_GET['texto'];
$nombreFichero = "./directorio_fichero/$s_usuario/$nombreFichero";
echo ver_texto($nombreFichero) . "<br>";
echo "<a href='contenido.php'>Volver</a>"
?>

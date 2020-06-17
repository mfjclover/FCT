<?php
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

function editar_texto($nameFile){
    $leer = fopen($nameFile, "r");
    $contenido = "";
    while(!feof($leer)){
        $linea = fgets($leer);
        if(strlen($linea) > 0){
            $contenido .= $linea;
        }
    }
    fclose($leer);
    return $contenido;
}

?>
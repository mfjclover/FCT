<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];    
    if(is_uploaded_file($_FILES["fichero_a_subir"]["tmp_name"]))
    {
        $nombre_original = $_FILES["fichero_a_subir"]["name"];
        copy($_FILES["fichero_a_subir"]["tmp_name"], "./directorio_fichero/$s_usuario/$nombre_original");
        echo "Se ha subido correctamente el fichero: $nombre_original" . "<br>";
        echo "<a href='contenido.php'>Volver</a>";
    }
    else {
        echo "Error: No se ha subido el fichero correspondiente";
    }
}

else{
    echo "Error: Acceso denegado";
    echo "<a href='index.php'>Volver</a>";
}
?>
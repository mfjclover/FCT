<?php
if(is_uploaded_file($_FILES["fichero_a_subir"]["tmp_name"]))
{
    $nombre_original = $_FILES["fichero_a_subir"]["name"];
    copy($_FILES["fichero_a_subir"]["tmp_name"], "./directorio_fichero/$nombre_original");
}
else{
    echo "Error";
}
?>
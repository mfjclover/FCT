<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
    echo "Hola $s_usuario" . "<br> <br>";
}
function ver($nameFile)
{
    if(substr($nameFile, -4) == ".txt")
    {
        return "<a href='ver_texto.php?texto=$nameFile'>Ver</a>";
    }
    elseif(substr($nameFile, -4) == ".png" or substr($nameFile, -5) == ".jpeg")
    {
        return "<a href='ver_foto.php?foto=$nameFile'>Ver</a>";
    }
}
$directorio_usuario = opendir("./directorio_fichero/" . $s_usuario);
echo "<table>";
    echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Ver</th>";
        echo "<th>Editar</th>";
        echo "<th>Borrar</th>";
    echo "</tr>";
    while(($nombreFichero = readdir($directorio_usuario)) != FALSE)
    {
        if($nombreFichero != "." && $nombreFichero != "..")
        {
            echo "<tr>";
            echo "<td>$nombreFichero</td>";
            echo "<th>" . ver($nombreFichero) . "</th>";
            echo "<th>Editar</th>";
            echo "<th>Borrar</th>";
            echo "</tr>";
        }
    }
echo "</table>";
?> 
<!DOCTYPE html>
<html>
<body>
	<p>Subir fichero</p>
    <form action="subir_fichero.php" method="post" enctype="multipart/form-data">
        Selecciona un fichero a subir:
        <input type="file" name="fichero_a_subir"> <br>
        <input type="submit" value="Subir fichero">
    </form>
</body>
</html>
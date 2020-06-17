<?php
session_start();
include_once 'iniciar_conexion.php';
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
    echo "Hola $s_usuario" . "<br> <br>";
}

function ver($nameFile){
    if(substr($nameFile, -4) == ".txt")
    {
        return "<a href='ver_texto.php?texto=$nameFile'>Ver</a>";
    }
    elseif(substr($nameFile, -4) == ".png" or substr($nameFile, -5) == ".jpeg")
    {
        return "<a href='ver_foto.php?foto=$nameFile'>Ver</a>";
    }
}
function editar($nameFile){
    if(substr($nameFile, -4) == ".txt")
    {
        return "<a href='editar_texto.php?texto=$nameFile'>Editar</a>";
    }
}
$directorio_usuario = opendir("./directorio_fichero/" . $s_usuario);
echo "<table>";
    echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Tamaño</th>";
        echo "<th>Ver</th>";
        echo "<th>Editar</th>";
        echo "<th>Borrar</th>";
    echo "</tr>";
    while(($nombreFichero = readdir($directorio_usuario)) != FALSE)
    {
        if($nombreFichero != "." && $nombreFichero != "..")
        {
            $tamañoFichero = filesize("./directorio_fichero/$s_usuario/$nombreFichero") / 1024;
            $tamañoFichero = round($tamañoFichero, 2);
            echo "<tr>";
            echo "<td>$nombreFichero</td>";
            echo "<td>$tamañoFichero kb</td>";
            echo "<th>" . ver($nombreFichero) . "</th>";
            echo "<th>" . editar($nombreFichero) . "</th>";
            echo "<th><a href='borrar_fichero.php?borrar_fichero=$nombreFichero'>Borrar</a></th>";
            echo "</tr>";
        }
        $total_tamañoFichero= $total_tamañoFichero + $tamañoFichero;
    }
echo "</table>";

$sql_cuota = "select cuota from usuarios where user = '$s_usuario'";
$result_sql_cuota = mysqli_query($conectar, $sql_cuota);

if (mysqli_num_rows($result_sql_cuota) > 0) {
    while($fila = mysqli_fetch_assoc($result_sql_cuota)) {
        $cuota = $fila['cuota'];
    }
}

echo "<br>" . "Total: $total_tamañoFichero de $cuota";

?> 
<!DOCTYPE html>
<html>
<body>
	<p>Subir fichero</p>
    <form action="subir_fichero.php" method="post" enctype="multipart/form-data">
        Selecciona un fichero a subir:
        <input type="file" name="fichero_a_subir"> <br>
		<?php 
		if ($total_tamañoFichero < $cuota) {
            echo "<input type='submit' value='Subir fichero'>";
		}
        else {
           echo "Ha alcanzado el límite de espacio";
        }
        ?>
    </form>
</body>
</html>
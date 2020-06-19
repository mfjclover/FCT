<?php
session_start();
include_once 'iniciar_conexion.php';
include_once 'function_listar_directorio.php';
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
    echo "Hola $s_usuario" . "<br> <br>";
}
else {
    header("Location: error.php");
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

echo "<table>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Tamaño</th>";
echo "<th>Ver</th>";
echo "<th>Editar</th>";
echo "<th>Borrar</th>";
echo "</tr>";

$raiz = "/var/www/FCT/directorio_fichero";
chdir($raiz);
$directorio_actual = getcwd();

if (isset($_GET['entrar_directorio']) & isset($_GET['directorio_actual'])) {
    $nombre_directorio = $_GET['entrar_directorio'];
    $directorio_actual = $_GET['directorio_actual'];
    $directorio_actual = $directorio_actual . "/" . $nombre_directorio;
    chdir($directorio_actual);
    $directorio_actual = getcwd();
}
if (isset($_GET['volver_directorio'])) {
    $directorio_actual = $_GET['volver_directorio'];
    if ($directorio_actual != $raiz){
        $directorio_actual = dirname($directorio_actual);
    }
    else {
        echo "Error: Ya no se puedo retroceder, has llegado a la raiz" . "<br>";
    }
}

echo "Directorio actual: $directorio_actual" . "<br>";

$directorio_usuario = opendir($directorio_actual);

while(($nombreFichero = readdir($directorio_usuario)) != FALSE)
{
    if($nombreFichero != "." && $nombreFichero != "..")
    {        
        echo "<tr>";
        if (is_dir($nombreFichero)){
            echo "<td> <a href='administrador.php?entrar_directorio=$nombreFichero&&directorio_actual=$directorio_actual'>$nombreFichero</a> </td>";
        }
        else {
            $tamañoFichero = filesize($directorio_actual . "/" . $nombreFichero) / 1024;
            $tamañoFichero = round($tamañoFichero, 2);
            echo "<td> $nombreFichero </td>";
            echo "<td> $tamañoFichero kb </td>";
            echo "<th>" . ver($nombreFichero) . "</th>";
            echo "<th>" . editar($nombreFichero) . "</th>";
            echo "<th><a href='borrar_fichero.php?borrar_fichero=$nombreFichero'>Borrar</a></th>";
            echo "</tr>";
            $total_tamañoFichero= $total_tamañoFichero + $tamañoFichero;
        }
    }    
}
echo "</table>";

echo "<br>" . "<a href='administrador.php?volver_directorio=$directorio_actual'>Volver</a>" . "<br>";

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
</body>
</html>
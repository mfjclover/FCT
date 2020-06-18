<?php
session_start();
include_once 'iniciar_conexion.php';
include_once 'function_listar_directorio.php';
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

echo "<table>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Tamaño</th>";
echo "<th>Ver</th>";
echo "<th>Editar</th>";
echo "<th>Borrar</th>";
echo "</tr>";

$raiz = "./directorio_fichero/";
chdir($raiz);
if (isset($_GET['directorio_actual'])) {    
    $directorio_actual = $_GET['directorio_actual'];
    $directorio_anterior = $_GET['directorio_actual'] . "/../";
//     if ($directorio_anterior == $raiz) {
//         $directorio_anterior = $raiz;
//     }
}
else {
    $directorio_actual = getcwd();
}

echo "Directorio actual: $directorio_actual" . "<br>";
echo "Directorio anterior: $directorio_anterior" . "<br>";
$directorio_usuario = opendir($directorio_actual);

while(($nombreFichero = readdir($directorio_usuario)) != FALSE)
{
    if($nombreFichero != "." && $nombreFichero != "..")
    {        
        echo "<tr>";
        if (is_dir($nombreFichero)){
            echo "<td> <a href='administrador.php?directorio_actual=$nombreFichero'>$nombreFichero</a> </td>";
        }
        else {
            $tamañoFichero = filesize($directorio_actual . "/" . $nombreFichero) / 1024;
            $tamañoFichero = round($tamañoFichero, 2);
            echo "<td> $nombreFichero </td>";
            
        }
        echo "<td> $tamañoFichero kb </td>";
        echo "<th>" . ver($nombreFichero) . "</th>";
        echo "<th>" . editar($nombreFichero) . "</th>";
        echo "<th><a href='borrar_fichero.php?borrar_fichero=$nombreFichero'>Borrar</a></th>";
        echo "</tr>";
        $total_tamañoFichero= $total_tamañoFichero + $tamañoFichero;
    }    
}
echo "</table>";

echo "<br>" . "<a href='administrador.php?directorio_actual=$directorio_anterior'>Volver</a>" . "<br>";

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
<!--     <form action="crear_carpeta.php" method="POST"> -->
<!--         Iniciar sesión: <br> -->
<!--         Usuario: <br> -->
<!--         <input type="text" name="usuario"> <br> -->
<!--         Contrasena: <br> -->
<!--         <input type="password" name="password"> <br> -->
<!--         <input type="submit" value="Entrar" name="verificar"> <br> -->
<!--         ¿No tienes una cuenta aún? -->
<!--         <a href="./registrar.php">Registrate</a> -->
<!--     </form> -->
</body>
</html>
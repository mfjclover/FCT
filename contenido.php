<?php
session_start();
if (isset($_SESSION['s_usuario'])){
    $s_usuario=$_SESSION["s_usuario"];
    echo "Hola $s_usuario" . "<br>";
}
?> 
<!DOCTYPE html>
<html>
<body>
	<p>Subir fichero</p> <br>
    <form action="subir_fichero.php" method="post" enctype="multipart/form-data">
        Selecciona un fichero a subir:
        <input type="file" name="fichero_a_subir"> <br>
        <input type="submit" value="Subir fichero">
    </form>
</body>
</html>
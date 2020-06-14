<?php
session_start();
if (isset($_POST['entrar'])) {
  $usuario=$_POST[usuario];
  $password=$_POST[password];
}
else {
  header("location: index.php");
}
echo "usuario = $usuario <br>";
$_SESSION["s_usuario"] = $usuario;
$s_usuario=$_SESSION["s_usuario"];
echo "Hola $s_usuario <br>";
?> 
<!DOCTYPE html>
<html>
<body>
    <form action="subir_fichero.php" method="post" enctype="multipart/form-data">
        Selecciona un fichero a subir:
        <input type="file" name="fichero_a_subir">
        <input type="submit" value="Subir fichero">
    </form>
</body>
</html>
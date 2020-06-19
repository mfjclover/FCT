<?php
session_start();
include_once 'iniciar_conexion.php';
if (isset($_POST['verificar'])){
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    $sqlVerificar = "select password, administrador from usuarios where user = '$usuario'";
    $resultVerificar = mysqli_query($conectar, $sqlVerificar); 
    if(!$resultVerificar)
    {
        echo mysqli_error($conectar);
    }
    if ($_POST['verificar'] == "Entrar") {
        if (mysqli_num_rows($resultVerificar) == 1){
            $fila = mysqli_fetch_assoc($resultVerificar);
            if(password_verify($_POST['password'], $fila['password'])) {
                $_SESSION["s_usuario"] = $usuario;
                if ($fila['administrador'] == True) {
                    header("location: administrador.php");
                }
                else {
                    header("location: contenido.php");
                }
            }
            else {
                echo "Error";
            }
        }
        else {
            echo "El usuario no se ha registrado";
            echo "<a href='index.php'>Volver</a>";
        }
    }
    elseif ($_POST['verificar'] == "Registrar"){
        if (mysqli_num_rows($resultVerificar) > 0) {
            echo "El usuario ya existe";
        }
        elseif (mysqli_num_rows($resultVerificar) == 0){
            $password_h = password_hash($password, PASSWORD_BCRYPT);
            $insertUsuario = "insert into usuarios (user, password) values ('$usuario','$password_h')";
            $resultInsertUsuario = mysqli_query($conectar, $insertUsuario);
            if (!$resultInsertUsuario){
                echo "Error: " . mysqli_error($conectar);
            }
            else {
                echo "Se ha creado correctamente el usuario: $usuario" . "<br>";
                mkdir("./directorio_fichero/" . $usuario);
            }
            echo "<a href='index.php'>Volver</a>";
        }
    }
}
else {
    header("location: error.php");
}

?>
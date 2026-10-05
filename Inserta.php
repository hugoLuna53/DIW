<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insercción de cliente</title>
</head>
<style>
div {
    position: relative;
    left: 30%;
    background-color: white;
    padding: 60px 60px 60px 60px;
    width: 30%;
    border-radius: 20px;
    border: black solid 5px;
    font-size: 25px;
    text-align: center;

}
div.rellena {
    position: relative;
    left: 30%;
    background-color: white;
    padding: 0px 60px 60px 60px;
    width: 30%;
    border-radius: 20px;
    border: black solid 5px;
    font-size: 25px;

}


body {
   background-color: bisque;
}
input {
    border: black 5px solid;
    border-radius: 5px;
    color: black;
    font-size: 25px;
    position: relative;
    right: 15%;
    padding: 0px 40px 0px 40px;
    background-color: bisque;
}
a {
    position: relative;
    left: 15%;
    top: -34px;
    padding: 0px 40px 0px 40px;
    background-color: bisque;
}

</style>
<body >

<?php 
$numIntentos = 5;

    $conexion = mysqli_connect("localhost","root","","base1")or die("Problemas con la conexion");
     $consulta = mysqli_query($conexion,"Insert into usuarios(nombre,apellido,telefono,email,contraseña,contraseña_cifrada,num_intentos)
                                        values('".$_POST['nombre']."','".$_POST['apellido1']."','".$_POST['telefono']."','".$_POST['correo']."','".$_POST['contraseña']."','".md5($_POST['contraseña'])."','".$numIntentos."')");

   

    echo "<div>";
    echo "Usuario insertado correctamente";
    echo "<br>";
    echo "</div>";
    mysqli_close($conexion);


?>    
<div class="rellena">

<h1>¿Quieres seguir rellenando tu pérfil?</h1>
<form action="login.php" method="post">
    <input type="submit" value="SI">
</form>

 <a href="formulario.html" style="border: black solid 5px;border-radius: 5px;color: black;">NO</a>

</div>
</body>
</html>
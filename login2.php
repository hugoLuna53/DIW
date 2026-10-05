<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        div {

        text-align: center;
        font-size: 30px;
        
        }
    </style>
</head>
<body>

<?php 
echo "<div>";
echo "<h1>Login</h1>";

session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
    
$correo = $_POST['email'];
$password = $_POST['password'];

$conexion = mysqli_connect("localhost","root","","base1")or die("Problemas con la conexion");

$consulta = mysqli_query($conexion,"Select id_Usuarios from usuarios where email = '$correo' and contraseña= '$password'");
$usuario = mysqli_fetch_assoc($consulta);


if(!empty($usuario)){
    echo "<h1>Bienvenido a tu pagina personal</h1>";
    echo "<a href='RellenaPerfil.html'>Rellenar el perfil</a>";
    $hora = date('Y-m-d');
    $consulta = mysqli_query($conexion,"Update usuarios set hora_login='$hora'  where email = '$correo' and contraseña= '$password'");


}
else {
    echo "<h1>ERROR:USUARIO NO ENCONTRADO</h1>";
    echo "<a href='formulario.html'>Volver a la pagina principal</a>";
    $consulta1 = mysqli_query($conexion,"Select id_Usuarios,num_intentos from usuarios where email = '$correo'");
    $usuario1= mysqli_fetch_assoc($consulta1);

    if(!empty($usuario1)){

    $num_Intentos = $usuario1['num_intentos'];
        if($num_Intentos <1){
            echo "<h1>CUENTA BLOQUEADA</h1>";

        }
        else {
         $num_Intentos--;
        echo "<h1>";
        echo "Te quedan: ";
        echo $num_Intentos;
        echo " intentos";
        echo "</h1>";
        $id = $usuario1['id_Usuarios'];
        $consulta2 = mysqli_query($conexion,"Update usuarios set num_intentos = '$num_Intentos'where id_Usuarios = '$id'");

        }


    }
    else{
        
       

    }
    






}














}
else {
    echo "Accede desde el formulario";
}






echo "</h1>";
?>
    
</body>
</html>
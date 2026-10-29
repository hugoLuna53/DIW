<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar el perfil</title>
    <style>
    html {
        background: #2a5298;
    }

    body {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    h1 {
        color: #1e3c72;
        margin-top: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    th {
        background: #2a5298;
        color: white;
        padding: 10px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover td {
        background: #f2f5fb;
    }

    img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 50%;
    }

    button {
        background: #2a5298;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #1e3c72;
    }

    button a {
        display: block;
        padding: 8px 12px;
        color: white;
        text-decoration: none;
    }

    body > a {
        color: #2a5298;
        font-weight: bold;
    }
</style>
</head>
<body>
<?php 

session_start();
    if($_SESSION['perfil']=== "Admin"&&isset($_SESSION['perfil'])){
    $email = $_SESSION['email'];
    $conexion = mysqli_connect("localhost","root","","base1")or die("Problemas con la conexion");
    $consulta = mysqli_query($conexion,"SELECT * FROM usuarios ");


    echo "<h1>Listado de usuarios</h1>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
          
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Perfil</th>
          </tr>";

    
    while($usuario = mysqli_fetch_assoc($consulta)){
    echo "<tr>";
    $nombre = $usuario['nombre'];
    $apellido = $usuario['apellido'];
    $emailUsuario = $usuario['email'];
    $perfil = $usuario['Perfil'];
    $foto = $usuario['foto'];
    $ruta = "imagenes/".$foto;
    if($perfil === "Admin"){

    }
 
    else {
        echo "<td><img src= $ruta width=100px></td>";
        echo "<td>".$nombre."</td>";
        echo "<td>".$apellido."</td>";
        echo "<td>".$emailUsuario."</td>";
        echo "<td>".$perfil."</td>";
        echo "<td><button><a href='CambiarPerfil.php?email=$emailUsuario'>Cambiar su perfil</a></button></td>";

    }

    echo "</tr>";


    }
    echo "</table>";
    echo "<a href='perfilAdmin.php'>Volver a tu pagina personal</a>";



}
else {
    echo "No tienes permiso";
}


?>
    
</body>
</html>
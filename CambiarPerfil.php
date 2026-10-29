<?php
session_start();
include "conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion del admin para cambiar perfil</title>
    <style>
   
    html {
        background: #2a5298;
    }

    body {
        width: 400px;
        margin: 80px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    h1 {
        font-size: 20px;
        color: #1e3c72;
        margin-top: 0;
    }

    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 15px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: white;
        background: #2a5298;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background: #1e3c72;
    }
</style>
</style>
</head>
<body>

    <?php 
      
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $NuevoPefil = $_POST['perfil'];
      $cosulta = mysqli_query($conexion,"UPDATE usuarios set Perfil = '$NuevoPefil' where email = '$email'");
      echo "<h1>Perfil actualizado correctamente</h1>";
      header("location: Ajustes.php");
      exit;

    }
    else {
        $email = $_GET['email'];
    }
    
    ?>

    <h1>Elige el perfil que le quieres poner a este usuario con el siguiente email:<?php echo $_GET['email'] ?> </h1>
    <form action="CambiarPerfil.php" method="post">
        <input type="email" name="email" hidden value=<?= htmlspecialchars($email)?>>
 
        <select name="perfil" required>
            <option value="">-- Selecciona --</option>
            <option value="Admin">Administrador</option>
            <option value="Cliente">Cliente</option>
            <option value="Empleado">Empleado</option>
            
        </select>
        <input type="submit" value="Cambiar perfil">
        
    </form>
    
</body>
</html>
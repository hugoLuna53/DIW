<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de cliente</title>
</head>
<body>
    
    <?php 
    session_start();
    $email = $_SESSION['email'];
    $conexion = mysqli_connect("localhost","root","","base1");
    $consulta = mysqli_query($conexion,"SELECT foto FROM usuarios where email = '$email'");
    $foto = mysqli_fetch_assoc($consulta); 
    $fotoPerfil = $foto['foto'];    
    
    ?>
    <img src="<?= htmlspecialchars("imagenes/".$fotoPerfil)?>" alt="NO HA CARGADO FOTO">
    
    
    
</body>
</html>
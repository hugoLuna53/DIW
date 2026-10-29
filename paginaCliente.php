<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de cliente</title>
     <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 100px 20px 20px 20px; /* deja hueco para la barra */
            min-height: 100vh;
            background: #f5f7fb;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
        }

        /* Barra superior de otro color */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        h1 {
            position: fixed;
            top: 0;
            left: 20px;
            right: 100px;
            margin: 0;
            height: 80px;
            line-height: 80px;
            text-align: right;
            font-size: 1.2rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            z-index: 2;
        }

        img {
            position: fixed;
            top: 12px;
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
            background: #dce5f4;
            color: transparent;
            font-size: 0;
            cursor: pointer;
            transition: box-shadow 0.2s, transform 0.2s;
            z-index: 2;
        }

        img:hover {
            transform: scale(1.08);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.35);
        }
    </style>
</head>
<body>
    
    <?php 
    session_start();
    $email = $_SESSION['email'];
    $conexion = mysqli_connect("localhost","root","","base1");
    $consulta = mysqli_query($conexion,"SELECT foto,nombre,apellido FROM usuarios where email = '$email'");
    $foto = mysqli_fetch_assoc($consulta); 
    $fotoPerfil = $foto['foto'];    
    
    ?>
    <h1><?= htmlspecialchars($foto['nombre']." ".$foto['apellido']) ?></h1>
    <img src="<?= htmlspecialchars("imagenes/".$fotoPerfil)?>" alt="NO HA CARGADO FOTO">
    
    
    
</body>
</html>
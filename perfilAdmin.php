<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de admin</title>
     <style>
         * {
        box-sizing: border-box;
    }

    html {
        min-height: 100%;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
    }

    /* Tarjeta base (también la usa el mensaje de "sin permiso") */
    body {
        max-width: 620px;
        margin: 60px auto;
        padding: 40px 36px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        font-family: "Segoe UI", Roboto, Arial, sans-serif;
        text-align: center;
        color: #555;
    }

    h1 {
        font-size: 1.4rem;
        line-height: 1.5;
        color: #1e3c72;
        margin: 10px 0;
    }

    a {
        color: #2a5298;
        font-weight: 600;
    }

    br {
        display: none;
    }

    /* "Hola señor Admin" */
    body:has(button) > h1:first-of-type {
        font-size: 1.8rem;
        margin: 0 0 28px 0;
        padding-bottom: 20px;
        border-bottom: 1px solid #e3e8f0;
    }

    /* ===== Perfil: foto a la izquierda, texto y botones a la derecha ===== */
    body > h1:has(button) {
        display: grid;
        grid-template-columns: 150px 1fr;
        column-gap: 32px;
        row-gap: 12px;
        align-items: center;
        margin: 0;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.6;
        color: #555;
        text-align: left;
        overflow-wrap: anywhere;
    }

    /* Foto de perfil */
    body > h1:has(button) img {
        grid-column: 1;
        grid-row: 1 / span 3;
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 0 0 3px #2a5298, 0 8px 20px rgba(0, 0, 0, 0.25);
        background: #e3e8f0;
    }

    button {
        display: block;
        width: 100%;
        margin: 0;
        padding: 0;
        border: none;
        border-radius: 8px;
        background: #2a5298;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }

    button:hover {
        background: #1e3c72;
        transform: translateY(-2px);
    }

    button a {
        display: block;
        padding: 12px 20px;
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
    }

    /* Móvil: la foto pasa arriba, centrada, y todo en columna */
    @media (max-width: 560px) {
        body {
            margin: 20px 16px;
            padding: 28px 20px;
        }

        body > h1:has(button) {
            grid-template-columns: 1fr;
            text-align: center;
        }

        body > h1:has(button) img {
            grid-column: 1;
            grid-row: auto;
            justify-self: center;
            width: 130px;
            height: 130px;
        }
    }
    </style>
</head>
<body>

    <?php 
    session_start();
    include "conexion.php";
    if(!isset($_SESSION['perfil'])){
        echo "<h1>Perfil no encontrado</h1>";
        if(empty($_SESSION['perfil']) || $_SESSION['perfil'] !="Admin"){
            
            echo "<h1>No tienes permiso para estar aqui</h1>";
            echo " <a href='formulario.html'>Volver al principio</a>";
        
        }
    }else {
        $email = $_SESSION['email'];
        $consulta = mysqli_query($conexion,"SELECT foto FROM usuarios where email ='$email' ");
        $usuario = mysqli_fetch_assoc($consulta);
        $foto = $usuario['foto']??"Predeterminado.png";
        echo "<h1>Hola señor Admin</h1>";
        echo "<h1>";
        echo "Bienvenido ". $_SESSION['nombre'] . " y su email: ". $_SESSION['email'];
        echo "<img src='imagenes/$foto'>";
        echo "<br>";
        echo "<button><a href='RellenaPerfil.php'>Rellenar su perfil</a></button>";
        echo "</br>";
        echo "<button><a href='Ajustes.php'>Ajustes</a></button>";
        echo "</h1>";
    }
    
    ?>
   
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rellenar perfiles</title>
     <style>
        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
        }

        body {
            max-width: 520px;
            margin: 40px auto;
            padding: 40px 32px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            color: #444;
            font-weight: 600;
            line-height: 1.4;
        }

        h1 {
            font-size: 1.5rem;
            text-align: center;
            color: #1e3c72;
            margin-bottom: 24px;
        }

        form {
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            display: block;
            width: 100%;
            margin: 6px 0 4px 0;
            padding: 10px 12px;
            border: 1px solid #ccd5e3;
            border-radius: 8px;
            background: #fff;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 400;
            color: #222;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.2);
        }

        /* Campos bloqueados (los que no se pueden modificar) */
        input:disabled {
            background: #eef2f9;
            color: #7a869a;
            cursor: not-allowed;
        }

        input[type="file"] {
            display: block;
            width: 100%;
            margin: 6px 0 4px 0;
            padding: 8px;
            border: 1px dashed #9db0d3;
            border-radius: 8px;
            background: #f7f9fd;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 400;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            margin-right: 12px;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            background: #2a5298;
            color: #fff;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background: #1e3c72;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            margin-top: 24px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            background: #2a5298;
            color: #fff;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        input[type="submit"]:hover {
            background: #1e3c72;
            transform: translateY(-2px);
        }

        br {
            display: none;
        }
    </style>
</head>

<body>

<?php 

    session_start();
    $conexion = mysqli_connect("localhost","root","","base1") or die("Problemas con la conexion");
    $email = $_SESSION['email'];
    echo "<h1>Bienvenido a tu pagina personal ".$_SESSION['nombre']."</h1>";
    $consulta = mysqli_query($conexion,"Select id_Usuarios,apellido,telefono,email,contraseña,Perfil from usuarios where email='$email'");
    $usuario = mysqli_fetch_assoc($consulta);
    $id = $usuario['id_Usuarios'];

    if($_SERVER['REQUEST_METHOD'] === "POST"){
    $apellido2 = $_POST['apellido2']??"";
    $pais = $_POST['pais']??"";
    $ciudad = $_POST['ciudad']??"";
    $nombreFoto = null;
    
     if (isset($_FILES['FotoPerfil']) && $_FILES['FotoPerfil']['error'] === UPLOAD_ERR_OK) {

        $extension = strtolower(pathinfo($_FILES['FotoPerfil']['name'], PATHINFO_EXTENSION));

       $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
       $valida = false;

    for ($i = 0; $i < count($permitidas); $i++) {
        if ($extension === $permitidas[$i]) {
        $valida = true;
        break; 
        }
    }

        if (!$valida) die('Solo imágenes.');

        if ($_FILES['FotoPerfil']['size'] > 2 * 1024 * 1024) die('Máximo 2 MB.');

        $nombreFoto = $id.time(). '.' . $extension;
        
        move_uploaded_file($_FILES['FotoPerfil']['tmp_name'], "imagenes/" . $nombreFoto);
    }
    else {
        $nombreFoto = "Predeterminado.png";   
    }
    
    
    
    $consultaUpdate = mysqli_query($conexion,"update usuarios set apellido2 = '$apellido2',pais='$pais',ciudad='$ciudad',foto = '$nombreFoto' where email='$email'");
    
    
    if($_SESSION['perfil'] == "Empleado"||$_SESSION['perfil'] == "Cliente"){
    header("Location: paginaCliente.php");
    exit;
    }
    if($_SESSION['perfil'] == "Admin"){
        header("Location: perfilAdmin.php");
        exit;
    }
    
    }
    
   

?>

    <form action="Rellenaperfil.php" method="post" enctype="multipart/form-data">
    Nombre: 
    <input type="text" name="nombre" value="<?php echo $_SESSION['nombre']; ?>" disabled> <br>
    Primer apellido: 
    <input type="text" name="apellido1" required value="<?php echo $usuario['apellido']; ?>" disabled><br>
    Segundo apellido: 
    <input type="text" name="apellido2" required pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" placeholder="Obligatorio"><br>
    Pais: 
    <input type="text" name="pais" required pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" placeholder="Obligatorio"><br>
    Telefono: 
    <input type="text" name="telefono" required value="<?php echo $usuario['telefono']; ?>"  disabled> <br>
    Email: 
    <input type="email" name="correo" required  value="<?php echo $usuario['email']; ?>"   disabled> <br>
    Ciudad: 
    <input type="text" name="ciudad" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" placeholder="Obligatorio"><br>

    Contraseña: 
    <input type="password" name="contraseña" required  value="<?php echo $usuario['contraseña']; ?>"   disabled><br>
    Perfil:
    <input type="text" name="perfil" value="<?php echo $usuario['Perfil']; ?>" disabled><br>
    Foto perfil:
    <input type="file" name="FotoPerfil"><br>
    <input type="submit" value="Modificar Datos">



</form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rellenar perfiles</title>
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
        
        move_uploaded_file($_FILES['FotoPerfil']['tmp_name'], __DIR__ . '/imagenes/' . $nombreFoto);
    }
    
    
    
    $consultaUpdate = mysqli_query($conexion,"update usuarios set apellido2 = '$apellido2',pais='$pais',ciudad='$ciudad',foto = '$nombreFoto' where email='$email'");
    header("Location: paginaCliente.php");
    exit;
    
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
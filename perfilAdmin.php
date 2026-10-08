<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de admin</title>
</head>
<body>

    <?php 
    session_start();
    if(!isset($_SESSION['perfil'])){
        echo "<h1>Perfil no encontrado</h1>";
        if(empty($_SESSION['perfil']) || $_SESSION['perfil'] !="Admin"){
            
            echo "<h1>No tienes permiso para estar aqui</h1>";
            echo " <a href='formulario.html'>Volver al principio</a>";
        
        }
    }else {
        echo "<h1>Hola señor Admin</h1>";
        echo "<h1>";
        echo "Bienvenido ". $_SESSION['nombre'] . " y su email: ". $_SESSION['email'];
        echo "</h1>";
    }
    
    ?>
   
</body>
</html>
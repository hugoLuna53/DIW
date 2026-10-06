<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de admin</title>
</head>
<body>
    <h1>Hola señor Admin</h1>
    <?php 
    session_start();
    echo "<h1>";
    echo "Bienvenido ". $_SESSION['nombre'] . " y su email: ". $_SESSION['email'];
    echo "</h1>";
    
    
    ?>
    
</body>
</html>
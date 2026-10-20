
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Debes logearte para rellenar tu perfil</h1>
    <form action="login2.php" method="post">
    Introduce el email: 
    <input type="email" name="email" placeholder="Obligatorio" required> <br>
    Introduce la contraseña: 
    <input type="password" name="password" require placeholder="Obligatorio"> <br>
      <input type="hidden" name="lat" id="lat">
      <input type="hidden" name="lon" id="lon">
    <p id="estadoUbicacion">Obteniendo ubicacion...</p>
    <input type="submit" value="Entrar" id="btnEntrar" disabled>
    </form>
    
<script>
navigator.geolocation.getCurrentPosition(
    function (pos) {
        document.getElementById('lat').value = pos.coords.latitude;
        document.getElementById('lon').value = pos.coords.longitude;
        document.getElementById('estadoUbicacion').textContent = 'Ubicacion obtenida';
        document.getElementById('btnEntrar').disabled = false;
    },
    function () {
        document.getElementById('estadoUbicacion').textContent = 'Debes permitir la ubicacion para iniciar sesion';
    },
    { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
);
</script>
    
</body>
</html>
 
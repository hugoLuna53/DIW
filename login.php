
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        font-size: 22px;
        color: #1e3c72;
        margin-top: 0;
    }

    form {
        text-align: left;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin: 5px 0 15px 0;
        box-sizing: border-box;
    }

    p {
        text-align: center;
        color: #555;
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

    input[type="submit"]:disabled {
        background: #aab4c8;
        cursor: not-allowed;
    }
</style>
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
 
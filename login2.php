<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        div {

        text-align: center;
        font-size: 30px;
        
        }
    </style>
</head>
<body>

<?php 


session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
    
$correo = $_POST['email'];
$password = $_POST['password'];


// ===== VALIDACION POR DISTANCIA (NUEVO) =====
define('LAT_REF', 36.866301289247865);
define('LON_REF', -6.178468465805054);
define('DISTANCIA_MAX', 100); // metros

function distanciaMetros($lat1, $lon1, $lat2, $lon2) {
    $radioTierra = 6371000;
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    return $radioTierra * 2 * atan2(sqrt($a), sqrt(1 - $a));
}

$lat = $_POST['lat'] ?? null;
$lon = $_POST['lon'] ?? null;

if (!is_numeric($lat) || !is_numeric($lon)) {
    echo "<h1>ERROR: no se pudo obtener tu ubicacion</h1>";
    echo "<a href='login.php'>Volver al login</a>";
    echo "</body></html>";
    exit;
}

$distancia = distanciaMetros(LAT_REF, LON_REF, (float)$lat, (float)$lon);

if ($distancia > DISTANCIA_MAX) {
    echo "<h1>ACCESO DENEGADO</h1>";
    echo "<h2>Estas a " . round($distancia) . " metros del punto permitido (maximo " . DISTANCIA_MAX . " m)</h2>";
    echo "<a href='login.php'>Volver al login</a>";
    echo "</body></html>";
    exit;
}

$conexion = mysqli_connect("localhost","root","","base1")or die("Problemas con la conexion");

$consulta = mysqli_query($conexion,"Select id_Usuarios,Perfil,nombre,email from usuarios where email = '$correo' and contraseña= '$password'");
$usuario = mysqli_fetch_assoc($consulta);

 $hora = date('Y-m-d H:i:s');

 $consultaBloqueo = mysqli_query($conexion,"Select id_Usuarios,hora_bloqueo,num_intentos from usuarios where email = '$correo'");
 $datosBloqueo = mysqli_fetch_assoc($consultaBloqueo);
 if(!empty($datosBloqueo)&&$datosBloqueo['num_intentos'] <=0){

    $desbloqueo = strtotime($datosBloqueo['hora_bloqueo']) + (15*60);
    $segundosRestantes = $desbloqueo - time();

    if($segundosRestantes>0){

    $minutosRestantes = floor($segundosRestantes/60);
    $segundoSolos = $segundosRestantes%60;

     echo "CUENTA BLOQUEADA";
     echo "Quedan " . $minutosRestantes . " minutos y ". $segundoSolos . " segundos";


    }

    else {
    $num_int = 3;
    $id = $datosBloqueo['id_Usuarios'];
    echo "Ya han pasado esos 15 min";
    echo "CUENTA DESBLOQUEADA";
    $actualizaIntentos = mysqli_query($conexion,"Update usuarios set num_intentos = '$num_int'where id_Usuarios= '$id'");

    }


 }

if(!empty($usuario)){
    echo "<h1>Login correcto</h1>";
  
    $_SESSION['perfil'] = $usuario['Perfil'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['email'] = $usuario['email'];

    $loginCorreNumIntentos =3;
    if($_SESSION['perfil'] == "Admin"){
         header("Location: perfilAdmin.php");
         $consulta = mysqli_query($conexion,"Update usuarios set hora_login='$hora',num_intentos= $loginCorreNumIntentos  where email = '$correo' and contraseña= '$password'");
         
         exit;
    }else{
            header("Location: RellenaPerfil.php");
           $consulta = mysqli_query($conexion,"Update usuarios set hora_login='$hora',num_intentos= $loginCorreNumIntentos  where email = '$correo' and contraseña= '$password'");
            exit;
    }                                   
    


}
else {
    echo "<h1>ERROR:USUARIO NO ENCONTRADO</h1>";
    echo "<a href='formulario.html'>Volver a la pagina principal</a>";
    $consulta1 = mysqli_query($conexion,"Select id_Usuarios,num_intentos from usuarios where email = '$correo'");
    $usuario1= mysqli_fetch_assoc($consulta1);

    if(!empty($usuario1)){
        $num_Intentos = $usuario1['num_intentos'];
    
    if($num_Intentos <=1){
            echo "<h1>CUENTA BLOQUEADA</h1>";
            echo "<h1>Tiempo de espera para volver a intentarlos: 15 minutos</h1>";
            $num_Intentos--;
             $id = $usuario1['id_Usuarios'];
        $consulta2 = mysqli_query($conexion,"Update usuarios set num_intentos = '$num_Intentos',hora_bloqueo = '$hora' where id_Usuarios = '$id'");

        }
        else {
         $num_Intentos--;
        echo "<h1>";
        echo "Te quedan: ";
        echo $num_Intentos;
        echo " intentos";
        echo "</h1>";
        $id = $usuario1['id_Usuarios'];
        $consulta2 = mysqli_query($conexion,"Update usuarios set num_intentos = '$num_Intentos'where id_Usuarios = '$id'");

        }


    }
    
    






}














}
else {
    echo "<h1>Accede desde el formulario</h1>";
}






echo "</h1>";
?>
    
</body>
</html>
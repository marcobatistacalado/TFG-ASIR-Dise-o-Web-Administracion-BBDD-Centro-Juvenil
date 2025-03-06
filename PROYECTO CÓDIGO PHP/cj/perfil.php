<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" type="text/css" href="form-style.css">
    <link rel="icon" type="image/jpg" href="./main/img/logolabalsa.png" />
</head>
<body>
<div class="blanco"></div>
    <img src="./main/img/iglesia2.jpg" id="img1">
    <img src="./main/img/logo sls.png" id="img2">
    <div class="content">
        <div class="form-container">
        <a href="./index.php"><img src="./main/img/logolabalsa.png  "></a>

<?php
session_start();

// Requerir las funciones del fichero funciones.php para utilizarlas.
require './funciones.php';

//Verificar que se ha iniciado sesión y si no redirigirle.
verificarSesion();
$usuario=$_SESSION['usuario'];

$conn = conectarBD();

$sql = "SELECT usuarios.usuario, DNI_Adulto, nombre, apellidos, fecha_nac, telefono, email, seguro, hijos, seccion FROM adultos, usuarios WHERE adultos.usuario = usuarios.usuario AND usuarios.usuario = '$usuario'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Obtener los datos del usuario
    $row = mysqli_fetch_assoc($result);
    $usuario = $row['usuario'];
    $dni = $row['DNI_Adulto'];
    $nombre = $row['nombre'];
    $apellidos = $row['apellidos'];
    $fecha_nac = $row['fecha_nac'];
    $telefono = $row['telefono'];
    $email = $row['email'];
    $seguro = $row['seguro'];
    $hijos = $row['hijos'];
    $seccion = $row['seccion'];

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);

    // Mostrar los datos en el perfil de usuario
    echo "<h2>Perfil de Usuario</h2>";
    echo "<div class='profile'>";
    echo "<p><strong>Usuario:</strong> $usuario</p>";
    echo "<p><strong>Password:</strong><a href='newpassword.php'>Change password</a></p>";
    echo "<p><strong>DNI:</strong> $dni</p>";
    echo "<p><strong>Nombre:</strong> $nombre</p>";
    echo "<p><strong>Apellidos:</strong> $apellidos</p>";
    echo "<p><strong>Fecha de Nacimiento:</strong> $fecha_nac</p>";
    echo "<p><strong>Teléfono:</strong> $telefono</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Seguro:</strong> $seguro</p>";
    echo "<p><strong>Sección:</strong> $seccion</p>";

    if (hijos_usuario($usuario) == 1){
        echo "<p><strong>Hijos:</strong> $hijos -- <a href='perfilmenores.php'>Mostrar sus perfiles</a></p> </p>";
    }
    
    echo "</div>";
} else {
    echo "No se encontraron datos para el usuario especificado.";
}
?>
</div>
</div>
</body>
</html>

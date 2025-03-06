<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Hijos</title>
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
$DNI_Adulto = obtenerDNIAdulto($_SESSION['usuario']);

$conn = conectarBD();

$sql = "SELECT DNI_menor, nombre, apellidos, fecha_nac, telef_menor, email, seguro, colegio, seccion FROM menores WHERE adulto = '$DNI_Adulto'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Mostrar los datos en el perfil de usuario
    echo "<h2>Perfil de Hijos</h2>";

    $contador = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $DNI_menor = $row['DNI_menor'];
        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $fecha_nac = $row['fecha_nac'];
        $telef_menor = $row['telef_menor'];
        $email = $row['email'];
        $seguro = $row['seguro'];
        $colegio = $row['colegio'];
        $seccion = $row['seccion'];

        echo "<div class='profile'>";
        echo "<h4 style='text-align:center; font-weight:bold; text-decoration: underline;'>Hijo nº $contador </h4>";
        echo "<p><strong>DNI Nombre:</strong> $DNI_menor</p>";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Apellidos:</strong> $apellidos</p>";
        echo "<p><strong>Fecha de Nacimiento:</strong> $fecha_nac</p>";
        echo "<p><strong>Teléfono Menor:</strong> $telef_menor</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Seguro:</strong> $seguro</p>";
        echo "<p><strong>Colegio:</strong> $colegio</p>";
        echo "<p><strong>Sección:</strong> $seccion</p>";
        echo "</div>";

        $contador++;
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    echo "No se encontraron datos para el usuario especificado.";
}
?>
</div>
</div>
</body>
</html>

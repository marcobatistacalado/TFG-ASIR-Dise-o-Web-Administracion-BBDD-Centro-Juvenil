<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis reservas</title>
    <link rel="stylesheet" type="text/css" href="form-style.css">
    <script>
        function quitarError(id) {
            document.getElementById(id).style.display = "none";
        }
    </script>
    <link rel="icon" type="image/jpg" href="./main/img/logolabalsa.png" />
</head>
<body>
<div class="blanco"></div>
    <img src="./main/img/iglesia2.jpg" id="img1">
    <img src="./main/img/logo sls.png" id="img2">
    <div class="content">
        <div class="form-container">
        <a href="./index.php"><img src="./main/img/logolabalsa.png  "></a>
    <h2>Mis Reservas</h2>

<?php
session_start();

// Requerir las funciones del fichero funciones.php para utilizarlas.
require './funciones.php';

//Verificar que se ha iniciado sesión y si no redirigirle.
verificarSesion();
$usuario=$_SESSION['usuario'];

//Mostrar formulario.
$mostrarform = true;

    //Obtener el DNI del adulto
    $DNI_Adulto=obtenerDNIAdulto($usuario);
    //Usuario tiene en el registro marcado si tiene hijos o no
    $tipo=hijos_usuario($usuario);   
    //Si tiene hijos, mostramos la tabla. 
    if ($tipo == 1){
        mostrarReservas_menor($DNI_Adulto);
    }elseif ($tipo == 0){
        mostrarReservas($DNI_Adulto);
    }

// Verificar si se ha enviado el formulario
if (isset($_POST['enviar'])) {
    // Obtener los datos del formulario
    if (!isset($_POST['numero']) ) {
        die("No vienes de la página adecuada");
    }
    $numero = $_POST['numero'];

    $reservaExiste = verificarReserva($numero, $DNI_Adulto);

        if ($reservaExiste == 1) {
            eliminarReserva($numero);
            echo "<br><p style='font-weight: bold;'>Ha sido cancelada la reserva</p>";
        } else {
            $error_numero = "La reserva que estas introduciendo no existe <br>";
        }
    

                
            
}
if($mostrarform == true){
?>
    <form method="post" action="misreservas.php" enctype="multipart/form-data">
    <br>
    <label>Número de reserva que quieres anular:  <input type="number" name="numero" min="1" value="<?php echo isset($_POST['numero']) ? $_POST['numero'] : ''; ?>"onfocus="quitarError('error_numero')"> </p>
                            <?php if(isset($error_numero)) { ?>
                                <span id="error_numero" style="color:red;"><?php echo $error_numero; ?></span>
                            <?php } ?><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
<?php
}
?>
</div>
</div>
</body>
</html>
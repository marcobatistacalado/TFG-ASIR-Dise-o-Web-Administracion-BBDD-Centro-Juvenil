<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de entradas</title>
    <link rel="stylesheet" type="text/css" href="../form-style.css">
    <script>
        function quitarError(id) {
            document.getElementById(id).style.display = "none";
        }
    </script>
</head>
<body>
<div class="content">
<div class="form-container">
<a href="../index.php"><img src="../main/img/logosls2.png"></a>
    <h2>Registro Cena Confirmaciones 2023</h2>

<?php
session_start();

// Requerir las funciones del fichero funciones.php para utilizarlas.
require '../funciones.php';

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
        //Recordemos que aqui controla que si puso que si tenia hijos pero no hay ninguno registrado
        obtenerHijos($DNI_Adulto);
    }

// Verificar si se ha enviado el formulario
if (isset($_POST['enviar'])) {
    // Obtener los datos del formulario
    if (!isset($_POST['musical']) && !isset($_POST['transferencia']) && !isset($_POST['cod_form']) ) {
        die("No vienes de la página adecuada");
    }
    $cod_form = $_POST['cod_form'];
    //No dejar registrar si estan las plazas ocupadas.
    compararPlazas($cod_form);

    $observaciones = $_POST['observaciones'];
    $menu = $_POST['menu'];
    $consideraciones = $_POST['consideraciones'];
    //Montar el campo de la BBDD:
    $observaciones = $observaciones ." || ". $menu ." || ".$consideraciones;
    $maxreservas = 1;
    $error_reserva = "";
    //Solo si tiene hijos recoges ese dato.
    if ($tipo == 1){
        $DNI_menor=$_POST['DNI_menor'];

        //Solo se puede apuntar una única vez a casa hijo
        $reservas = contarFormularios_menor($DNI_menor,$cod_form);
        if ($reservas >= $maxreservas){
            $error_reserva="Ya has registrado a este hijo";
        }
    }elseif ($tipo == 0){
        $reservas = contarFormularios($DNI_Adulto,$cod_form);
        if ($reservas >= $maxreservas){
            $error_reserva="Ya estás registrado";
        }
    }

                
            if ($tipo == 0){
                if ($error_reserva == ""){
                    $mostrarform = false;

                    //DATOS TRASFERENCIA
                    // Llamar a la función y almacenar el resultado en una variable
                    $trans = procesarTransferencia_parzan();
                    // Acceder a los valores del array asociativo
                    $nombreImagen = $trans['nombreImagen'];
                    $haEntregadoImagen = $trans['haEntregadoImagen'];


                    //Realizar la reserva
                        try {
                            $conn = conectarBD();
                            $sql = "INSERT INTO reservas (cod_form, DNI_Adulto, pagado, observaciones, t_imagen )
                                            VALUES ('$cod_form','$DNI_Adulto','$haEntregadoImagen','$observaciones', '$nombreImagen')";
                            
                            if (mysqli_query($conn, $sql)) {
                                $compra = "<br><p style='font-weight:bold;'>Registro realizado para la Cena.</p>";
                                incrementarPlazasOcupadas($cod_form);
                            }else{
                                $compra = "Error al realizar el registro";
                            }
                            mysqli_close($conn);
                        }catch (Exception $e) {
                            echo "Se ha producido un error al hacer una consuta del usuario en la base de datos";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    echo $compra;
                }

            }elseif ($tipo == 1){
                if (!isset($_POST['DNI_menor'])) {
                    die("No vienes de la página adecuada");
                }
                //Comprobar el DNI del menor.
                $error_DNI_menor = verificarEsHijo($DNI_menor, $DNI_Adulto);

                if ($error_DNI_menor == "" && $error_reserva == "") {
                    $mostrarform = false;

                    //DATOS TRASFERENCIA
                    // Llamar a la función y almacenar el resultado en una variable
                    $trans = procesarTransferencia__c_conf_23();
                    // Acceder a los valores del array asociativo
                    $nombreImagen = $trans['nombreImagen'];
                    $haEntregadoImagen = $trans['haEntregadoImagen'];

                    $ficha = procesarArchivoPDF_parzan();
                    $nombreImagen = $nombreImagen ." || ".  $ficha['nombreAleatorio'];

                    $foto = procesar_foto_participante_parzan();
                    $nombreImagen = $nombreImagen ." || ".  $foto['nombreImagen'];

                    //Realizar la reserva 
                        try {
                            $conn = conectarBD();
                            $sql = "INSERT INTO reservas (cod_form,DNI_Adulto, DNI_menor, pagado, observaciones, t_imagen )
                                        VALUES ('$cod_form','$DNI_Adulto','$DNI_menor','$haEntregadoImagen','$observaciones', '$nombreImagen')";
                        
                            if (mysqli_query($conn, $sql)) {
                                $compra = "<br><p style='font-weight:bold;'>Registro realizado para la Cena.</p>";
                                incrementarPlazasOcupadas($cod_form);
                            }else{
                                $compra = "Error al realizar la compra";
                            }
                        } catch (Exception $e) {
                            echo "Se ha producido un error al hacer una consuta del usuario en la base de datos";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    echo $compra;
                } 
            }
            
}
if($mostrarform == true){
?>
    <form method="post" action="cenaconfirmaciones.php" enctype="multipart/form-data">
        <br><br>
        <?php
            $tipo = hijos_usuario($usuario);
            if ($tipo == 1) {
                echo 'DNI del menor: <input type="text" maxlength="9" name="DNI_menor" value="' . (isset($_POST['DNI_menor']) ? $_POST['DNI_menor'] : '') . '" onfocus="quitarError(\'error_DNI_menor\'); quitarError(\'error_reserva\')"><br><br>';
                if (isset($error_DNI_menor)) {
                    echo '<span id="error_DNI_menor" style="color:red;">' . $error_DNI_menor . '</span>';
                }
            }

            if (isset($error_reserva)) {
                echo '<span id="error_reserva" style="color:red;">' . $error_reserva . '</span>';
            }
        ?>


<br>    
        <label for="transferencia">Imagen de transferencia:</label>
        <input type="file" name="transferencia" id="transferencia" accept="image/jpeg, image/png" required>
        <br><br>
        <label for="menu">Menú:</label>
        <select name="menu" id="menu" required>
            <option value="">Selecciona una opción</option>
            <option value="Medio costillar">Medio costillar</option>
            <option value="Hamburguesa Cheesy">Hamburguesa Cheesy</option>
            <option value="Hamburguesa Crispy Chicken">Hamburguesa Crispy Chicken</option>
            <option value="Pollo BBQ">Pollo BBQ</option>
        </select>

        <br><br>

        <label for="consideraciones">Consideraciones alimentarias:</label>
            <select name="consideraciones" id="consideraciones" required>
            <option value="">Selecciona una opción</option>
            <option value="Vegano">Vegano</option>
            <option value="Vegetariano">Vegetariano</option>
            <option value="Omnívoro">Omnívoro</option>
            <option value="Otro">Otro</option>
        </select>

        <br><br>
        <label for="observaciones">Observaciones:</label><br>
        <textarea name="observaciones" rows="4" cols="50"></textarea><br><br>
        <input type="hidden" name="cod_form" value="C_CONF_23">
        <input type="submit" name="enviar" value="Enviar">
    </form>
<?php
}
?>
</div>
</div>
</body>
</html>
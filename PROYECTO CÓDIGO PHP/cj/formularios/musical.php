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
    <h2>Compra de entradas para el musical</h2>

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
    //Verificar que se ha seleccionado alguna opción del musical
    if (!isset($_POST['musical']) && !isset($_POST['transferencia'])) {
        die("No vienes de la página adecuada");
    }
    // Obtener los datos del formulario
    $cod_form = $_POST['musical'];
    //No dejar registrar si estan las plazas ocupadas.
    compararPlazas($cod_form);

    $observaciones = $_POST['observaciones'];
    $num_entradas = $_POST['num_entradas'];
    //Solo si tiene hijos recoges ese dato.
    if ($tipo == 1){
        $DNI_menor=$_POST['DNI_menor'];
    }
    $error_num_entradas="";

        //Aqui son un máximo de 6 entradas por familia por lo que se calcula las reservas con el DNI_Adulto
        $reservas = contarFormularios($DNI_Adulto,$cod_form);
        $maxreservas = 6 - $reservas;
        if ($num_entradas > $maxreservas){
            $error_num_entradas="Tú numero de entradas disponibles para esta representación es: $maxreservas.";
        }

    

        // Realizar el proceso de compra de entradas y almacenar en la tabla de reservas
        // Realizar la consulta SQL para obtener el DNI del usuario en base a su sesión y tabla correspondiente
                
            if ($tipo == 0){
                if ($error_num_entradas == ""){
                    $mostrarform = false;

                    //DATOS TRASFERENCIA
                    // Llamar a la función y almacenar el resultado en una variable
                    $trans = procesarTransferencia_M();

                    // Acceder a los valores del array asociativo
                    $nombreImagen = $trans['nombreImagen'];
                    $haEntregadoImagen = $trans['haEntregadoImagen'];

                    //Realizar la reserva el numero de entradas que se ha solicitado.
                    for ($i = 1; $i <= $num_entradas; $i++){
                        try {
                            $conn = conectarBD();
                            $sql = "INSERT INTO reservas (cod_form, DNI_Adulto, pagado, observaciones, t_imagen )
                                            VALUES ('$cod_form','$DNI_Adulto','$haEntregadoImagen','$observaciones', '$nombreImagen')";
                            
                            if (mysqli_query($conn, $sql)) {
                                $compra = "<br>Compra realizada en tu cuenta";
                                incrementarPlazasOcupadas($cod_form);
                            }else{
                                $compra = "Error al realizar la compra";
                            }
                            mysqli_close($conn);
                        }catch (Exception $e) {
                            echo "Se ha producido un error al hacer una consuta del usuario en la base de datos";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                    echo $compra;
                }

            }elseif ($tipo == 1){
                if (!isset($_POST['DNI_menor'])) {
                    die("No vienes de la página adecuada");
                }
                //Comprobar el DNI del menor.
                $error_DNI_menor = verificarEsHijo($DNI_menor, $DNI_Adulto);

                if ($error_DNI_menor == "" && $error_num_entradas == "") {
                    $mostrarform = false;

                    //DATOS TRASFERENCIA
                    // Llamar a la función y almacenar el resultado en una variable
                    $trans = procesarTransferencia_M();

                    // Acceder a los valores del array asociativo
                    $nombreImagen = $trans['nombreImagen'];
                    $haEntregadoImagen = $trans['haEntregadoImagen'];
                    //Realizar la reserva el numero de entradas que se ha solicitado.
                    for ($i = 1; $i <= $num_entradas; $i++){
                        try {
                            $conn = conectarBD();
                            $sql = "INSERT INTO reservas (cod_form,DNI_Adulto, DNI_menor, pagado, observaciones, t_imagen )
                                        VALUES ('$cod_form','$DNI_Adulto','$DNI_menor','$haEntregadoImagen','$observaciones', '$nombreImagen')";
                        
                            if (mysqli_query($conn, $sql)) {
                                $compra = "Compra realizada en tu cuenta";
                                incrementarPlazasOcupadas($cod_form);
                            }else{
                                $compra = "Error al realizar la compra";
                            }
                        } catch (Exception $e) {
                            echo "Se ha producido un error al hacer una consuta del usuario en la base de datos";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                    echo $compra;
                } 
            }
            
}
if($mostrarform == true){
?>
    <form method="post" action="musical.php" enctype="multipart/form-data">
        <br><br>
        <?php
            $tipo=hijos_usuario($usuario); 
            if ($tipo == 1){
                ?>
                DNI del menor: <input type="text" maxlength="9" name="DNI_menor" <?php echo isset($_POST['DNI_menor']) ? $_POST['DNI_menor'] : ''; ?> onfocus="quitarError('error_DNI_menor')"><br><br>
                    <?php if(isset($error_DNI_menor)) { ?>
                    <span id="error_DNI_menor" style="color:red;"><?php echo $error_DNI_menor; ?></span><br>
                    <?php } ?>
                <?php
            }

        ?>
        <label for="musical">Selecciona una representación:</label>
        
        
            <select name="musical" id="musical" required>
                <?php
                $formulario = "Musical";
                $resultados = obtenerCodFormYFechaPorNombre($formulario);
                
                foreach ($resultados as $resultado) {
                    $codForm = $resultado['cod_form'];
                    $dia = $resultado['dia'];
                    $hora = $resultado['hora'];
                
                    echo "<option value='$codForm'>Dia: $dia, Hora: $hora</option>";
                }
                
                
                ?>
            </select>
        <br><br>
        <label for="num_entradas">Número de entradas:</label>
        <input type="number" id="num_entradas" name="num_entradas" min="1" max="6" onfocus="quitarError('error_num_entradas')" required>
        <?php if(isset($error_num_entradas)) { ?>
                <span id="error_num_entradas" style="color:red;"><?php echo $error_num_entradas; ?></span><br>
        <?php } ?>
        <br><br>
        <label for="transferencia">Imagen de transferencia:</label>
        <input type="file" name="transferencia" id="transferencia" accept="image/jpeg, image/png" required>
        <br><br>
        <label for="observaciones">Observaciones:</label><br>
        <textarea name="observaciones" rows="4" cols="50"></textarea><br><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
<?php
}
?>
</div>
</div>
</body>
</html>
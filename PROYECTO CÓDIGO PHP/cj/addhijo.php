<!DOCTYPE html>
<html>
<head>
  <title>Registro de menor</title>
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
            <?php
            session_start();
            $usuario = $_SESSION['usuario'];
            // Requerir las funciones del fichero funciones.php para utilizarlas.
            require 'funciones.php';

            //Verificar que se ha iniciado sesión y si no redirigirle.
            verificarSesion();

            //mostrar el formulario
            $mostrarform = true;

            // Comprobar si se ha enviado el formulario
            if (isset($_POST['enviar'])) {
                $contador2=0;
                

                if (!isset($_POST['dni']) || !isset($_POST['nombre']) || !isset($_POST['apellidos']) || !isset($_POST['fecha_nac'])||
                !isset($_POST['telef_menor']) || !isset($_POST['email']) || !isset($_POST['seguro']) || !isset($_POST['colegio']) ||
                !isset($_POST['seccion'])){
                die("No vienes de la página adecuada");
                }
                // Recuperar los datos del formulario
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellidos'];
                $fnac = $_POST['fecha_nac'];
                $telef = $_POST['telef_menor'];
                $mail = $_POST['email'];
                $seguro = $_POST['seguro'];
                $colegio = $_POST['colegio'];
                $seccion = $_POST['seccion'];

                // Validación DNI
                $validarDni = validarDni($dni);
                $error_dni = $validarDni['error_dni'];
                $contador2 += $validarDni['contador1'];

                // Validación Nombre.
                $validarNombre = validarNombre($nombre);
                $error_nombre = $validarNombre['error_nom'];
                $contador2 += $validarNombre['contador1'];

                // Validación Apellido.
                $validarApellido = validarApellido($apellido);
                $error_apellido = $validarApellido['error_ape'];
                $contador2 += $validarApellido['contador1'];

                // Validación mayoría de edad.
                $validarEdadMenor = validarEdadMenor($fnac);
                $error_fnac = $validarEdadMenor['error_fnac'];
                $contador2 += $validarEdadMenor['contador1'];

                // Validación telefono.
                $resultado = validarTelefono($telef);
                $error_telef = $resultado['error_telef'];
                $contador2 += $resultado['contador1'];

                // Validación email.
                $validarEmail = validarEmail($mail);
                $error_email = $validarEmail['error_email'];
                $contador2 += $validarEmail['contador1'];

                if ($contador2 == 0){  
                    $DNI_Adulto = obtenerDNIAdulto($usuario);

                    if ($DNI_Adulto !== null) {
                        $conn = conectarBD();
                        try{
                        $sql = "INSERT INTO menores (DNI_menor, nombre, apellidos, fecha_nac, telef_menor, email, seguro,colegio, adulto, seccion )
                                            VALUES ('$dni','$nombre','$apellido','$fnac','$telef','$mail','$seguro','$colegio','$DNI_Adulto','$seccion')";
                            
                            if (mysqli_query($conn, $sql)) {
                                echo "<p style='font-weight: bold;'>Menor creado en tu cuenta</p>";
                            }else{
                                echo "Error al crear al menor";
                            }
                        }catch (Exception $e) {
                            echo "Se ha producido un error al hacer una consuta del usuario en la base de datos";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }       
                }
            }
                ?>



                <?php 
                if (hijos_usuario($usuario) != 1) {
                    die ("<p>No tienes hijos. Habla con el administrador si tienes algún problema. <a href='./index.php'>Página principal</a></p>");
                }
                if ( cuantos_hijos($usuario) == hijos_registro_adulto($usuario)){
                    die ("<p>Ya están todos tus hijos registrados, si tienes algún problema habla con el administrador. <a href='./index.php'>Página principal</a></p>");
                }
                
                ?>
                    <h2>Formulario de registro de menor</h2>
                    <form method="post" action="">
                        <p>DNI:
                        <input type="text" name="dni" onfocus="quitarError('error_dni')" ></p>
                        <?php if(isset($error_dni)) { ?>
                                        <span id="error_dni" style="color:red;"><?php echo $error_dni; ?></span>
                        <?php } ?>

                        <p>Nombre:
                        <input type="text" name="nombre" onfocus="quitarError('error_nombre')" ></p>
                        <?php if(isset($error_nombre)) { ?>
                                        <span id="error_nombre" style="color:red;"><?php echo $error_nombre; ?></span>
                        <?php } ?>

                        <p>Apellidos:
                        <input type="text" name="apellidos" onfocus="quitarError('error_apellido')" ></p>
                        <?php if(isset($error_apellido)) { ?>
                                        <span id="error_apellido" style="color:red;"><?php echo $error_apellido; ?></span>
                        <?php } ?>

                        <p>Fecha de nacimiento:
                        <input type="date" name="fecha_nac" onfocus="quitarError('error_fnac')" ></p>
                        <?php if(isset($error_fnac)) { ?>
                                        <span id="error_fnac" style="color:red;"><?php echo $error_fnac; ?></span>
                        <?php } ?>

                        <p>Teléfono:
                        <input type="text" name="telef_menor" onfocus="quitarError('error_telef')" maxlength="9"></p>
                        <?php if(isset($error_telef)) { ?>
                                        <span id="error_telef" style="color:red;"><?php echo $error_telef; ?></span>
                        <?php } ?>

                        <p>Email:
                        <input type="email" name="email" onfocus="quitarError('error_email')" ></p>
                        <?php if(isset($error_email)) { ?>
                                        <span id="error_email" style="color:red;"><?php echo $error_email; ?></span>
                        <?php } ?>

                        <p>Seguro:
                        <input type="radio" name="seguro" value="privado" required> Privado
                        <input type="radio" name="seguro" value="publico" required> Público
                        <input type="radio" name="seguro" value="público/privado" required> Privado y Público</p>

                        <p>Colegio:
                        <input type="radio" name="colegio" value="Salesianos Estrecho" required> Salesianos Estrecho
                        <input type="radio" name="colegio" value="Otro" required> Otro</p>

                        <p>Sección:
                        <input type="radio" name="seccion" value="Chiquicentro" required> Chiquicentro
                        <input type="radio" name="seccion" value="Preadolescentes" required> Preadolescentes
                        <input type="radio" name="seccion" value="Adolescentes" required> Adolescentes
                        <input type="radio" name="seccion" value="Jovenes" required> Jóvenes</p>

                        <input type="submit" name="enviar" value="Enviar">
                    </form>
    
</div>
</div>
</body>
</html>

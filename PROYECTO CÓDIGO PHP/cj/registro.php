<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="form-style.css">
    <link rel="icon" type="image/jpg" href="./main/img/logolabalsa.png" />
</head>
    
    <!--Función para ocultar los errores al clickar un campo-->
    <script>
        function quitarError(id) {
            document.getElementById(id).style.display = "none";
        }
    </script>
    
</head>
<body>
    <?php
    //Requerir las funciones del fichero funciones.php para utilizarlas.
    require 'funciones.php';

    $mensaje = "";

    //mostrar el formulario de usuario
    $mostrarform=true;
    $mostrarform1=true;
    $mostrarform2=true;

    //Este primer formulario se ejecuta con su correspondiente botón llamado siguiente.
    if(isset($_POST["siguiente"])) {

        //Comprobar que los datos llegan de la forma correcta.
        if (!isset($_POST['user']) || !isset($_POST['pass']) || !isset($_POST['pass2']) || !isset($_POST['tipo']) ){
        die("No vienes de la página adecuada");
        }
        
        //Limpiar datos.
        $user = test_input($_POST['user']);
        $pass = test_input($_POST['pass']);
        $pass2 = test_input($_POST['pass2']);
        $tipo = test_input($_POST['tipo']);

        $contador=0;

        $error_usuario = new_user($user);
        $error_contrasena= new_password($pass);
        $error_contrasena2= compare_passwords($pass, $pass2);
        
        //Dejar de mostrar este formulario de usuario.
        if (empty($error_usuario) && empty($error_contrasena) && empty($error_contrasena2)) {
            $mostrarform = false;
        }
         
        
    }elseif(isset($_POST["siguiente1"])) {
        //Dejar de mostrar el formulario de usuario.
        $mostrarform = false;
        //print_r($_REQUEST);
        //Contador de errores para comprobar si es todo correcto o no.
        $contador1=0;

        if (!isset($_POST['dni']) || !isset($_POST['nom']) || !isset($_POST['ape']) || !isset($_POST['fnac'])||
        !isset($_POST['telef']) || !isset($_POST['mail']) || !isset($_POST['seguro']) || !isset($_POST['cons']) ||
        !isset($_POST['nhijo']) ||!isset($_POST['user']) || !isset($_POST['pass']) || !isset($_POST['tipo'])
        || !isset($_POST['seccion'])){
        die("No vienes de la página adecuada");
        }
    
        $dni=test_input($_REQUEST['dni']);
        $nom=test_input($_REQUEST['nom']);
        $ape=test_input($_REQUEST['ape']);
        $fnac=test_input($_REQUEST['fnac']);
        $telef=test_input($_REQUEST['telef']);
        $mail=test_input($_REQUEST['mail']);
        $seguro=test_input($_REQUEST['seguro']);
        $cons=test_input($_REQUEST['cons']);
        $nhijo=test_input($_REQUEST['nhijo']);
        $user=test_input($_REQUEST['user']);
        $pass=test_input($_REQUEST['pass']);
        $tipo=test_input($_REQUEST['tipo']);
        $seccion=test_input($_REQUEST['seccion']);
       
        //Validación DNI.
        $validarDni = validarDni($dni);
        $error_dni = $validarDni['error_dni'];
        $contador1 += $validarDni['contador1'];

        //Validación Nombre.
        $validarNombre = validarNombre($nom);
        $error_nom = $validarNombre['error_nom'];
        $contador1 += $validarNombre['contador1'];   

        //Validación Apellido.
        $validarApellido = validarApellido($ape);
        $error_ape = $validarApellido['error_ape'];
        $contador1 += $validarApellido['contador1'];
        
        //Validación mayoría de edad.
        $validarFechaNacimiento = validarFechaNacimiento($fnac);
        $error_fnac = $validarFechaNacimiento['error_fnac'];
        $contador1 += $validarFechaNacimiento['contador1'];

        //Validación telefono.
        $resultado = validarTelefono($telef);
        $error_telef = $resultado['error_telef'];
        $contador1 += $resultado['contador1'];

        //Validación email.
        $validarEmail = validarEmail($mail);
        $error_email = $validarEmail['error_email'];
        $contador1 += $validarEmail['contador1'];

        //Validar el número de hijos.
        if(empty($nhijo)) {
            $error_nhijo= "El número de hijos es obligatorio";
            $contador1=$contador1+1;
        }elseif($nhijo <=0 || $nhijo >5) {
            $error_nhijo= "El número de hijos tiene que estar entre 1 y 5";
            $contador1=$contador1+1;
        }

        //Guardar valor consentimiento.
        if (isset($_POST['cons'])) {
            $valor_cons = 1;
        }else {
            $valor_cons = 0;
        }

        //Guardar valor tratamiento de imagenes.
        if (isset($_POST['trat'])) {
            $valor_trat = 1;
        }else {
            $valor_trat = 0;
        }
        
        //Si no hay ningún error continuamos.
        if ($contador1 == 0){

            //Dejar de mostrar el formulario y formulario1
            $mostrarform = false;
            $mostrarform1 = false;

            //Realizar conexión BD.
            $conn = conectarBD();

            //Y realizamos el registro final de un usuario adulto responsable de menores.
            try {
                //Cifrado de contraseña muy importante.
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO usuarios (usuario, password, tipo) VALUES ('$user','$pass_hash','$tipo')";
                    // Comprobamos el número de filas que devuelve la select
                    if (mysqli_query($conn, $sql)) {
                        echo "<div class='blanco'></div>
                            <img src='./main/img/iglesia2.jpg' id='img1'>
                            <img src='./main/img/logo sls.png' id='img2'>
                            <div class='content'><div class='form-container'>
                            <a href='./index.php'><img src='./main/img/logolabalsa.png'></a>";
                        echo "Usuario creado";
                        $sql = "INSERT INTO adultos (DNI_adulto,nombre,apellidos,fecha_nac,telefono,email,cons_cj,trat_img,seguro,hijos,usuario,seccion)
                        VALUES ('$dni','$nom','$ape','$fnac','$telef','$mail','$valor_cons','$valor_trat','$seguro',$nhijo,'$user','$seccion')";
                        // Comprobamos el número de filas que devuelve la select
                        if (mysqli_query($conn, $sql)) {
                            echo " y Adulto creado. Te recomendamos registrar a tus hijos en en el apartado de administración de tu usuario. ";
                        }
                        echo "</div></div>";
                    }
                //Cerrar la conexión de la BBDD
                mysqli_close($conn);
            } catch (Exception $e) {
                echo "Se ha producido un error al crear usuario";
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    
    }elseif(isset($_POST["siguiente2"])) {
        //Dejar de mostrar el formulario de usuario.
        $mostrarform = false;
        //print_r($_REQUEST);
        //Contador de errores para comprobar si es todo correcto o no.
        $contador2=0;
        if (!isset($_POST['dni']) || !isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['fnac'])||
        !isset($_POST['telef']) || !isset($_POST['mail']) || !isset($_POST['seguro']) || !isset($_POST['cons']) ||
        !isset($_POST['user']) || !isset($_POST['pass']) || !isset($_POST['tipo']) || !isset($_POST['seccion'])){
        die("No vienes de la página adecuada");
        }
        
        $dni=test_input($_REQUEST['dni']);
        $nombre=test_input($_REQUEST['nombre']);
        $apellido=test_input($_REQUEST['apellido']);
        $fnac=test_input($_REQUEST['fnac']);
        $telef=test_input($_REQUEST['telef']);
        $mail=test_input($_REQUEST['mail']);
        $seguro=test_input($_REQUEST['seguro']);
        $cons=test_input($_REQUEST['cons']);
        $user=test_input($_REQUEST['user']);
        $pass=test_input($_REQUEST['pass']);
        $tipo=test_input($_REQUEST['tipo']);
        $seccion=test_input($_REQUEST['seccion']);
           
        // Validación DNI.
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
        $validarFechaNacimiento = validarFechaNacimiento($fnac);
        $error_fnac = $validarFechaNacimiento['error_fnac'];
        $contador2 += $validarFechaNacimiento['contador1'];

        // Validación teléfono.
        $resultado = validarTelefono($telef);
        $error_telef = $resultado['error_telef'];
        $contador2 += $resultado['contador1'];

        // Validación email.
        $validarEmail = validarEmail($mail);
        $error_email = $validarEmail['error_email'];
        $contador2 += $validarEmail['contador1'];


        //Guardar valor consentimiento.
        if (isset($_POST['cons'])) {
            $valor_cons = 1;
        }else {
            $valor_cons = 0;
        }

        //Guardar valor tratamiento de imagenes.
        if (isset($_POST['trat'])) {
            $valor_trat = 1;
        }else {
            $valor_trat = 0;
        }
        
        //Si no hay ningún error continuamos.

        if ($contador2 == 0){
            //Dejar de mostrar formulario y formulario2.
            $mostrarform = false;
            $mostrarform2 = false;
            //Y realizamos el registro final de un usuario adulto NO responsable de menores.
            //Realizar conexión BD.
            $conn = conectarBD();
            try {
                //Cifrado de contraseña muy importante.
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO usuarios (usuario, password, tipo)
                        VALUES ('$user','$pass_hash','$tipo')";
                    // Comprobamos el número de filas que devuelve la select
                        if (mysqli_query($conn, $sql)) {
                            echo "<div class='blanco'></div>
                            <img src='./main/img/iglesia2.jpg' id='img1'>
                            <img src='./main/img/logo sls.png' id='img2'>
                            <div class='content'><div class='form-container'>
                            <a href='./index.php'><img src='./main/img/logolabalsa.png'></a>";
                            echo "Usuario creado";
                            $sql = "INSERT INTO adultos (DNI_adulto,nombre,apellidos,fecha_nac,telefono,email,cons_cj,trat_img,seguro,hijos,usuario,seccion)
                            VALUES ('$dni','$nombre','$apellido','$fnac','$telef','$mail','$valor_cons','$valor_trat','$seguro',0,'$user','$seccion')";
                                // Comprobamos el número de filas que devuelve la select
                                if (mysqli_query($conn, $sql)) {
                                    echo " y Adulto creado";   
                                }
                            echo "</div></div>";
                        }
                //Cerrar la conexión de la BBDD
                mysqli_close($conn);
            }catch (Exception $e) {
                echo "Se ha producido un error al crear usuario";
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    

    ?>


        <!--mostrar los mensajes de error si hubiera-->
        <?php
            if(!empty($mensaje)) {
                echo $mensaje;
            }

            //Mostrar y dejar de mostrar el primer formulario
            if ($mostrarform == true){
        ?>  
        <div class="blanco"></div>
        <img src="./main/img/iglesia2.jpg" id="img1">
        <img src="./main/img/logo sls.png" id="img2">
        <div class="content">
            <div class="form-container">
            <a href="./index.php"><img src="./main/img/logolabalsa.png  "></a>
        <h2>Registro de Usuario</h2>
            <form action="registro.php" method="POST" >
                <p>Usuario: <input type="text" name="user" onfocus="quitarError('error_usuario')" value="<?php echo isset($_POST['user']) ? $_POST['user'] : ''; ?>"> </p>
                <!--mostrar cada error-->
                <?php if(isset($error_usuario)) { ?>
                    <span id="error_usuario" style="color:red;"><?php echo $error_usuario; ?></span>
                <?php } ?>
                <p> Contraseña: <input type="password" name="pass" onfocus="quitarError('error_contrasena')"value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>"></p>
                <?php if(isset($error_contrasena)) { ?>
                    <span id="error_contrasena" style="color:red;"><?php echo $error_contrasena; ?></span>
                <?php } ?>
                <p> Repite Contraseña: <input type="password" name="pass2" onfocus="quitarError('error_contrasena2')"value="<?php echo isset($_POST['pass2']) ? $_POST['pass2'] : ''; ?>"></p>
                <?php if(isset($error_contrasena2)) { ?>
                    <span id="error_contrasena2" style="color:red;"><?php echo $error_contrasena2; ?></span>
                <?php } ?>
                
                <br>¿Tienes hijos?
                <!--para no validar a posterior marcamos campo obligatorio y además un checked para asegurarnos de que esa casilla se marca si o si-->
                <p><input type="radio" name="tipo" value="1" required> si
                <input type="radio" name="tipo" value="0" required > no</p>
                <?php if(isset($error_tipo)) { ?>
                    <span id="error_tipo" style="color:red;"><?php echo $error_tipo; ?></span>
                <?php } ?>

                <br><input type="submit" name="siguiente" value="Siguiente" >
            </form>
        </div>
        </div>
        
        <?php
        } 
        ?>  
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                if (empty($error_usuario) && empty($error_contrasena) && empty($error_contrasena2)) {
                    if ($tipo == 1){
                        //print_r($_REQUEST);
                        
                        
                        //mostrar o dejar de mostrar formulario 1
                        if ($mostrarform1 == true){
                        ?>
                            <div class="blanco"></div>
                            <img src="./main/img/iglesia2.jpg" id="img1">
                            <img src="./main/img/logo sls.png" id="img2">
                            <div class="content">
                                <div class="form-container">
                                <a href="./index.php"><img src="./main/img/logolabalsa.png  "></a>
                        <h2>Registro de Usuario</h2>
                            <form action="registro.php" method="POST">
                            <p>DNIadulto: <input type="text" name="dni" maxlength="9" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>" onfocus="quitarError('error_dni')"> </p>
                            <?php if(isset($error_dni)) { ?>
                                <span id="error_dni" style="color:red;"><?php echo $error_dni; ?></span>

                            <?php } ?>
                            <p>Nombre: <input type="text" name="nom" maxlength="60" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ''; ?>" onfocus="quitarError('error_nom')"> </p>
                            <?php if(isset($error_nom)) { ?>
                                <span id="error_nom" style="color:red;"><?php echo $error_nom; ?></span>
                        
                            <?php } ?>
                            <p>Apellidos: <input type="text" name="ape" maxlength="60" value="<?php echo isset($_POST['ape']) ? $_POST['ape'] : ''; ?>" onfocus="quitarError('error_ape')"> </p>
                            <?php if(isset($error_ape)) { ?>
                                <span id="error_ape" style="color:red;"><?php echo $error_ape; ?></span>
                            <?php } ?>
                            <p>Fecha nacimiento: <input type="date" name="fnac" value="<?php echo isset($_POST['fnac']) ? $_POST['fnac'] : ''; ?>" onfocus="quitarError('error_fnac')"> </p>
                            <?php if(isset($error_fnac)) { ?>
                                <span id="error_fnac" style="color:red;"><?php echo $error_fnac; ?></span>
                            <?php } ?>
                            <p>Telefono: <input type="text" name="telef" maxlength="9" value="<?php echo isset($_POST['telef']) ? $_POST['telef'] : ''; ?>" onfocus="quitarError('error_telef')"> </p>
                            <?php if(isset($error_telef)) { ?>
                                <span id="error_telef" style="color:red;"><?php echo $error_telef; ?></span>
                            <?php } ?>
                            <p>Email: <input type="email" name="mail" maxlength="60" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" onfocus="quitarError('error_email')"> </p>
                            <?php if(isset($error_email)) { ?>
                                <span id="error_email" style="color:red;"><?php echo $error_email; ?></span>
                            <?php } ?>
                            <p>Consentimiento de participacion en el centro juvenil<input type="checkbox" name="cons"  required>
                            <p>Consentimiento de uso y tratamiento de imágenes <input type="checkbox" name="trat" >
                            <p>Seguro: <input type="radio" name="seguro" value="privado" required> Privado
                            <input type="radio" name="seguro" value="público" required> Publico
                            <input type="radio" name="seguro" value="público/privado" required>Privado y Público</p>
                            <p>¿Cuantos hijos tienes?: <input type="number" name="nhijo" min="1" max="5" value="<?php echo isset($_POST['nhijo']) ? $_POST['nhijo'] : ''; ?>"onfocus="quitarError('error_nhijo')"> </p>
                            <?php if(isset($error_nhijo)) { ?>
                                <span id="error_nhijo" style="color:red;"><?php echo $error_nhijo; ?></span>
                            <?php } ?>
                            <input type="hidden" name="user" value=<?php echo $user?> >
                            <input type="hidden" name="pass" value=<?php echo $pass?> >
                            <input type="hidden" name="tipo" value=<?php echo $tipo?> >
                            <input type="hidden" name="seccion" value=<?php echo "padre"?> >
                            <br><input type="submit" name="siguiente1" value="Siguiente" >
                            </form>
                        </div>
                        </div>
                        <?php
                        }
                            
                    }else{
                        if ($tipo == 0){
                            //mostrar o dejar de mostrar formulario 2
                            if ($mostrarform2 == true){
                        ?>
                                <div class="blanco"></div>
                                <img src="./main/img/iglesia2.jpg" id="img1">
                                <img src="./main/img/logo sls.png" id="img2">
                                <div class="content">
                                    <div class="form-container">
                                    <a href="./index.php"><img src="./main/img/logolabalsa.png  "></a>
                                <form action="registro.php" method="POST">
                                <p>DNIadulto: <input type="text" name="dni" maxlength="9" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>" onfocus="quitarError('error_dni')"> </p>
                                <?php if(isset($error_dni)) { ?>
                                    <span id="error_dni" style="color:red;"><?php echo $error_dni; ?></span>
                                <?php } ?>
                                <p>Nombre: <input type="text" name="nombre" maxlength="60" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" onfocus="quitarError('error_nom')"> </p>
                                <?php if(isset($error_nombre)) { ?>
                                    <span id="error_nom" style="color:red;"><?php echo $error_nombre; ?></span>
                                <?php } ?>
                                <p>Apellidos: <input type="text" name="apellido" maxlength="60" value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : ''; ?>" onfocus="quitarError('error_apellido')"> </p>
                                <?php if(isset($error_apellido)) { ?>
                                    <span id="error_apellido" style="color:red;"><?php echo $error_apellido; ?></span>
                                <?php } ?>
                                <p>Fecha nacimiento: <input type="date" name="fnac" value="<?php echo isset($_POST['fnac']) ? $_POST['fnac'] : ''; ?>" onfocus="quitarError('error_fnac')"> </p>
                                <?php if(isset($error_fnac)) { ?>
                                    <span id="error_fnac" style="color:red;"><?php echo $error_fnac; ?></span>
                                <?php } ?>
                                <p>Telefono: <input type="text" name="telef" maxlength="9" value="<?php echo isset($_POST['telef']) ? $_POST['telef'] : ''; ?>" onfocus="quitarError('error_telef')"> </p>
                                <?php if(isset($error_telef)) { ?>
                                    <span id="error_telef" style="color:red;"><?php echo $error_telef; ?></span>
                                <?php } ?>
                                <p>Email: <input type="email" name="mail" maxlength="60" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" onfocus="quitarError('error_email')"> </p>
                                <?php if(isset($error_email)) { ?>
                                    <span id="error_email" style="color:red;"><?php echo $error_email; ?></span>
                                <?php } ?>

                                <p>Consentimiento de participacion en el centro juvenil<input type="checkbox" name="cons"  required>
                                <p>Consentimiento de uso y tratamiento de imágenes <input type="checkbox" name="trat" >
                                <p>Seguro: <input type="radio" name="seguro" value="privado" required> Privado
                                <input type="radio" name="seguro" value="público" required> Publico
                                <input type="radio" name="seguro" value="público/privado" required>Privado y Público</p>
                            
                                <p>Seccion: 
                                <input type="radio" name="seccion" value="Catecumenado" required> Catecumenado
                                <input type="radio" name="seccion" value="Comunidades" required>Comunidades
                                <input type="radio" name="seccion" value="Otro" required> Otro</p>
                                

                                <input type="hidden" name="user" value=<?php echo $user?> >
                                <input type="hidden" name="pass" value=<?php echo $pass?> >
                                <input type="hidden" name="tipo" value=<?php echo $tipo?> >
                                <br><input type="submit" name="siguiente2" value="Siguiente" >
                                </form>
                        </div>
                        </div>
                                <?php
                            }
                        }
                    }        
                }
            }
        
            ?>
</body>
</html>
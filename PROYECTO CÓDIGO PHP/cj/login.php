<?php
 $servername = "localhost";
 $username = "nuevo";
 $password = "a1234567";
 $dbname = "cj";


// Configurar el tiempo de vida de sesión
ini_set('session.gc_maxlifetime', 1800); // 1800 segundos = 30 minutos
// Configurar la caducidad de la sesión
session_set_cookie_params(1800); // 1800 segundos = 30 minutos

session_start();

/* PONER ESTO CUANDO TENGAMOS LA PAGINA DE LOS BOTONES, LOG OUT, ADDHIJO...,
Y SI AUN NO HA INICIADO SESION TAMBIEN HAY QUE MOSTRAR UN BOTON DE REGISTRO
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: index.php');
    exit();
}*/

// Requerir las funciones del fichero funciones.php para utilizarlas.
require 'funciones.php';

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // Si el usuario ya ha iniciado sesión, redirigirlo a la página de inicio o a cualquier otra página que desees
    header('Location: ./index.php');
    exit();
}

// Si el usuario aún no ha iniciado sesión y se han enviado los datos del formulario
if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    // Recuperar las credenciales ingresadas por el usuario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Realizar conexión a la base de datos.
    $conn = conectarBD();

    // Verificar si el usuario y la contraseña son correctos
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Si el usuario existe en la base de datos, verificar la contraseña utilizando password_verify()
        $fila = mysqli_fetch_assoc($result);
        $contrasena_encriptada = $fila['password'];

        if (password_verify($contrasena, $contrasena_encriptada)) {
            // Si la contraseña es correcta, crea una sesión
            $_SESSION['usuario'] = $usuario;

            // Establecer una cookie de sesión para almacenar el nombre de usuario durante 1 día (86400 segundos)
            setcookie('nombre_usuario', $usuario, time() + 86400, '/');

            // Redirigir a la página de inicio
            header("location: ./index.php");
            exit();
        } else {
            // Si la contraseña es incorrecta, muestra un mensaje de error
            $mensaje_error = "Usuario y/o contraseña incorrectos.";
        }
    } else {
        // Si el usuario no existe en la base de datos, muestra un mensaje de error
        $mensaje_error = "Usuario y/o contraseña incorrectos.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <h2>Iniciar sesión</h2>
            <form method="post" action="login.php">
                <p>
                    <label for="usuario" class="c_fijo">Usuario:</label>
                    <input type="text" name="usuario" id="usuario">
                </p>
                <p>
                    <label for="contrasena" class="c_fijo">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena" onfocus="quitarError('error')">
                </p>
                <?php if (isset($mensaje_error)) { ?>
                    <p class="error"><?php echo "$mensaje_error"; ?></p>
                <?php } ?>
                <p>
                    <input type="submit" value="Iniciar sesión" class="c_enlace">
                    <a href="registro.php" class="c_enlace register-link" >Registrarse</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>
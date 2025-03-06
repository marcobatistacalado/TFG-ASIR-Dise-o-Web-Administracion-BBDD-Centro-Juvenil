<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de contraseña</title>
    <link rel="stylesheet" type="text/css" href="form-style.css">
    <style>
        .error {
            color: red;
        }
    </style>
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
        <h2>Cambio de contraseña</h2>

        <?php
        session_start();

        // Requerir las funciones del fichero funciones.php para utilizarlas.
        require './funciones.php';

        //Verificar que se ha iniciado sesión y si no redirigirle.
        verificarSesion();
        $usuario = $_SESSION['usuario'];

        // Inicializar las variables de error
        $currentPasswordErr = $newPasswordErr = $confirmPasswordErr = $confirmPasswordErr2 = '';
        $errorMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if (empty($confirmPasswordErr)) {
                // Conectar a la base de datos
                $conn = conectarBD();

                // Obtener la contraseña actual del usuario desde la base de datos
                $sql = "SELECT password FROM usuarios WHERE usuario = '$usuario'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $hashedPassword = $row['password'];

                    // Verificar si la contraseña actual es correcta
                    if (password_verify($currentPassword, $hashedPassword)) {
                        // Validar que las contraseñas coincidan
                        $confirmPasswordErr = compare_passwords($newPassword, $confirmPassword);
                        $confirmPasswordErr2 = new_password($newPassword);
                        if ($confirmPasswordErr == "" && $confirmPasswordErr2 == "") {

                            // Generar el hash de la nueva contraseña
                            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                            // Actualizar la contraseña en la base de datos
                            $updateSql = "UPDATE usuarios SET password = '$newHashedPassword' WHERE usuario = '$usuario'";
                            $updateResult = mysqli_query($conn, $updateSql);

                            if ($updateResult) {
                                $errorMsg = 'La contraseña ha sido actualizada correctamente.';
                            } else {
                                $errorMsg = 'Error al actualizar la contraseña.';
                            }
                        }
                    } else {
                        $currentPasswordErr = 'La contraseña actual es incorrecta.';
                    }
                } else {
                    $errorMsg = 'No se encontró el usuario en la base de datos.';
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($conn);
            }
        }
        ?>

        <form method="POST" action="">
            <label for="current_password">Contraseña actual:</label>
            <input type="password" name="current_password" onfocus="quitarError('current_password_error')" required>
            <?php if (!empty($currentPasswordErr)) : ?>
                <span class="error"><?php echo "<br><br>$currentPasswordErr"; ?></span>
            <?php endif; ?>
            <br><br>

            <label for="new_password">Nueva contraseña:</label>
            <input type="password" name="new_password" onfocus="quitarError('new_password_error')" onfocus="quitarError('confirm_password_error')" onfocus="quitarError('confirm_password_error2')" required>
            <?php if (!empty($newPasswordErr)) : ?>
                <span class="error"><?php echo "<br><br>$newPasswordErr"; ?></span>
            <?php endif; ?>
            <br><br>

            <label for="confirm_password">Confirmar contraseña:</label>
            <input type="password" name="confirm_password" onfocus="quitarError('confirm_password_error')" onfocus="quitarError('confirm_password_error2')" required>
            <?php if (!empty($confirmPasswordErr)) : ?>
                <span class="error"><?php echo "<br><br>$confirmPasswordErr"; ?></span>
            <?php endif; ?>
            <?php if (!empty($confirmPasswordErr2)) : ?>
                <span class="error"><?php echo "<br><br>$confirmPasswordErr2"; ?></span>
            <?php endif; ?>
            <br><br>
            <?php if (!empty($errorMsg)) : ?>
                <p><?php echo $errorMsg; ?></p>
            <?php endif; ?>

            <input type="submit" value="Cambiar contraseña">
        </form>
    </div>
    </div>
</body>

</html>
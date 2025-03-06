<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" type="text/css" href="./form-style.css">
    <link rel="icon" type="image/jpg" href="./main/img/logolabalsa.png" />
    <style>
        .buttons-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            background-color: #db1b13;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        $usuario = $_SESSION['usuario'];
        // Requerir las funciones del fichero funciones.php para utilizarlas.
        require 'funciones.php';

        //Verificar que se ha iniciado sesión y si no redirigirle.
        verificarSesion();
    ?>
    <div class="blanco"></div>
    <img src="./main/img/iglesia2.jpg" id="img1">
    <img src="./main/img/logo sls.png" id="img2">
    <div class="content">
        <div class="form-container">
        <a href="./index.php"><img src="./main/img/logolabalsa.png  "></a>
            <div class="buttons-container">
                <button class="button" onclick="window.location.href='./logout.php'">Cerrar sesión</button>
                <button class="button" onclick="window.location.href='./perfil.php'">Perfil</button>
                <button class="button" onclick="window.location.href='./newpassword.php'">Cambiar contraseña</button>
                <button class="button" onclick="window.location.href='misreservas.php'">Mis Reservas</button>

                <?php
                if (hijos_usuario($usuario) == 1){
                    ?>
                    <button class="button" onclick="window.location.href='addhijo.php'">Añadir un hijo</button>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
session_start(); // Iniciar sesión
if(isset($_SESSION['usuario'])){ // Verificar si la variable de sesión 'usuario' está definida
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión actual
}
header("Location: login.php"); // Redirigir al usuario a la página de inicio de sesión
exit(); // Detener la ejecución del script
?>

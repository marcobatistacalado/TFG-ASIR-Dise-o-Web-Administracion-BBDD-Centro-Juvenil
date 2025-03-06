<?php
// Declarar una variable global
global $habladmin;
// Asignar un valor a la variable global
$habladmin = "Se ha producido un error. Habla con el administrador.";

//Conexión a la BBDD
function conectarBD() {
    $servername = "localhost";
    $username = "administrador";
    $password = "TFG.2023.CJ_asir";
    $dbname = "cj";

// Crear la conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check conexión
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

//Función guardar errores en un fichero log.
function guardarErrorEnLog($error) {
    $fecha = date('Y-m-d H:i:s');
    $mensaje = "[$fecha] $error" . PHP_EOL;

    $archivo = 'log.txt';

    // Intentar abrir el archivo en modo 'append'
    if ($handle = fopen($archivo, 'a')) {
        fwrite($handle, $mensaje); // Escribir en el archivo
        fclose($handle); // Cerrar el archivo
    }
}

//Función para limpiar datos
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

//Función para validar un nuevo usuario
    function new_user($user) {
        //Importante realizar la conexión llamando a su función correspondiente.
        $conn = conectarBD();
        //Función IMPORTANTE ante el sql injection
        $user = mysqli_real_escape_string($conn, $user);
        $error_usuario = ''; // Inicializar el mensaje de error

        if (empty($user)) {
            $error_usuario = "El nombre de usuario es obligatorio";
        } elseif (strlen($user) < 5) {
            $error_usuario = "El nombre de usuario tiene que tener al menos 5 caracteres";
        } else {
            // Realizar la consulta en la base de datos
            try {
                $sql = "SELECT * FROM usuarios WHERE usuario='$user'";
                // ... Código de ejecución de la consulta ...
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) >= 1) {
                    $error_usuario = "Ya existe este usuario";
                }

                mysqli_close($conn);
            } catch (Exception $e) {
                $error = $e->getMessage();
                guardarErrorEnLog($error);
                global $habladmin;
                die ("$habladmin");
            }
        }

        return $error_usuario; // Devolver el mensaje de error (o cadena vacía si no hay errores)
    }

//Función validar contraseña nueva
    function new_password($pass) {
        $error_contrasena = ''; // Inicializar el mensaje de error

        if (empty($pass)) {
            $error_contrasena = "La contraseña es obligatoria";
        } elseif (mb_strlen($pass) < 10) {
            $error_contrasena = "La contraseña debe tener al menos 10 caracteres";
        } elseif (!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9ñÑ])/', $pass)) {
            $error_contrasena = "La contraseña debe incluir al menos una letra, un número y un carácter especial";
        }

        return $error_contrasena; // Devolver el mensaje de error (o cadena vacía si no hay errores)
    }

//Función comparar contraseñas
    function compare_passwords($pass1, $pass2) {
        if ($pass1 !== $pass2) {
            $error_contrasena = "Las contraseñas no son iguales";
            return $error_contrasena;
        }

        return ''; // Retorna una cadena vacía si las contraseñas son iguales
    }

//Función para validar DNI
    function validarDni($dni) {
        $error_dni = ''; // Inicializar el mensaje de error
        $contador1 = 0; // Inicializar el contador

        if (empty($dni)) {
            $error_dni = "El DNI es obligatorio";
            $contador1++;
        } elseif (strlen($dni) != 9) {
            $error_dni = "El DNI debe tener 9 caracteres";
            $contador1++;
        } elseif (!preg_match('/^[0-9]{8}[A-Za-z]$/', $dni)) {
            $error_dni = "El formato del DNI no es correcto";
            $contador1++;
        } else {
            $numeros = substr($dni, 0, 8);
            $letra = strtoupper(substr($dni, -1));
            $letra_calculada = substr('TRWAGMYFPDXBNJZSQVHLCKE', $numeros % 23, 1);
            
            if ($letra != $letra_calculada) {
                $error_dni = "La letra no coincide";
                $contador1++;
            } else {
                //Importante realizar la conexión llamando a su función correspondiente.
                $conn = conectarBD();
                //Función IMPORTANTE ante el sql injection
                $dni = mysqli_real_escape_string($conn, $dni);
                try {
                    $sql = "SELECT * FROM adultos WHERE DNI_adulto='$dni'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) >= 1) {
                        $error_dni = "Ya existe este DNI en la tabla adulto";
                        $contador1++;
                    } else {
                        $sql = "SELECT * FROM menores WHERE DNI_menor='$dni'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) >= 1) {
                            $error_dni = "Este DNI ya existe en la tabla de Menores";
                            $contador1++;
                        }
                    }

                    mysqli_close($conn);
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    guardarErrorEnLog($error);
                    global $habladmin;
                    die ("$habladmin");
                }
            }
        }

        return array('error_dni' => $error_dni, 'contador1' => $contador1);
    }

//Función validar nombre
    function validarNombre($nom) {
        $error_nom = ''; // Inicializar el mensaje de error
        $contador1 = 0; // Inicializar el contador

        if (empty($nom)) {
            $error_nom = "El nombre es obligatorio";
            $contador1++;
        } elseif (!preg_match('/^[A-Z][a-z]+(\s[A-Z][a-z]+)?$/', $nom)) {
            // Ejemplo: 'Jose Manuel'
            $error_nom = "El nombre no tiene el formato correcto";
            $contador1++;
        }

        return array('error_nom' => $error_nom, 'contador1' => $contador1);
    }

//Función validar apellido
    function validarApellido($ape) {
        $error_ape = ''; // Inicializar el mensaje de error
        $contador1 = 0; // Inicializar el contador

        if (empty($ape)) {
            $error_ape = "El apellido es obligatorio";
            $contador1++;
        } elseif (!preg_match('/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)?$/', $ape)) {
            // Ejemplo: 'Agyakwa Delgado'
            $error_ape = "El apellido no tiene el formato correcto";
            $contador1++;
        }
        

        return array('error_ape' => $error_ape, 'contador1' => $contador1);
    }

//Función validar mayoría de 18 años.
    function validarFechaNacimiento($fnac) {
        $error_fnac = ''; // Inicializar el mensaje de error
        $contador1 = 0; // Inicializar el contador

        if (empty($fnac)) {
            $error_fnac = "La fecha de nacimiento es obligatoria";
            $contador1++;
        } else {
            $fecha_actual = date('Y-m-d'); // Obtenemos la fecha actual en formato Y-m-d

            // Calculamos la edad del usuario restando la fecha actual con la fecha de nacimiento
            $edad = date_diff(date_create($fnac), date_create($fecha_actual))->y;

            if ($edad <= 18) {
                $error_fnac = "Debes ser mayor de 18 años";
                $contador1++;
            }
        }

        return array('error_fnac' => $error_fnac, 'contador1' => $contador1);
    }

//Función validar edad de los menores
    function validarEdadMenor($fnac) {
        $error_fnac = ''; // Inicializar el mensaje de error
        $contador1 = 0; // Inicializar el contador

        if (empty($fnac)) {
            $error_fnac = "La fecha de nacimiento es obligatoria";
            $contador1++;
        } else {
            $fecha_actual = date('Y-m-d'); // Obtenemos la fecha actual en formato Y-m-d

            // Calculamos la edad del usuario restando la fecha actual con la fecha de nacimiento
            $edad = date_diff(date_create($fnac), date_create($fecha_actual))->y;

            if ($edad < 8 || $edad > 18) {
                $error_fnac = "La edad debe estar entre 8 y 18 años";
                $contador1++;
            }
        }

        return array('error_fnac' => $error_fnac, 'contador1' => $contador1);
    }


//Función validar telefono móvil.

function validarTelefono($telef) {
    $error_telef = ''; // Inicializar el mensaje de error
    $contador1 = 0; // Inicializar el contador

    if (empty($telef)) {
        $error_telef = "El teléfono es obligatorio";
        $contador1++;
    } elseif (!preg_match('/^(6|7)\d{8}$/', $telef)) {
        $error_telef = "El formato del teléfono es incorrecto";
        $contador1++;
    }

    return array('error_telef' => $error_telef, 'contador1' => $contador1);
}

//Función validar el email.
    function validarEmail($mail) {
        $error_email = ''; // Inicializar el mensaje de error
        $contador1 = 0; // Inicializar el contador

        if (empty($mail)) {
            $error_email = "El email es obligatorio";
            $contador1++;
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $error_email = "El formato del email es incorrecto";
            $contador1++;
        }

        return array('error_email' => $error_email, 'contador1' => $contador1);
    }

//Función para obtener el DNI del adulto que tiene iniciada la sesión.
function obtenerDNIAdulto($usuario) {
    // Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();

    try {
        $sql = "SELECT DNI_Adulto FROM adultos, usuarios WHERE adultos.usuario = usuarios.usuario AND usuarios.usuario = '$usuario'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $fila = mysqli_fetch_assoc($result);
            $DNI_Adulto = $fila["DNI_Adulto"];
        } else {
            $DNI_Adulto = null;
            echo "No se ha podido obtener el DNI de Adulto inicia sesión primero: <a href='login.php'>Log-in</a>";
        }

        mysqli_close($conn);

        return $DNI_Adulto;
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");

        return null;
    }
}

function verificarSesion() {
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario'])) {
        // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
        header('Location: /login.php');
        exit();
    }
}

//Función para saber si el usuario tiene hijos o no. (CAMPO tipo:).

function hijos_usuario($usuario) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $usuario = mysqli_real_escape_string($conn, $usuario);

    try {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se obtuvo un resultado
        if (mysqli_num_rows($result) > 0) {
            // Obtener el valor de "tipo"
            $row = mysqli_fetch_assoc($result);
            $tipo = $row['tipo'];
        } else {
            // Si no se encontró ningún registro, asignar un valor predeterminado
            $tipo = null;
        }

        mysqli_close($conn);

        return $tipo;
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");

        return null;
    }
}

//Función para saber cuantos hijos tiene el usuario/adulto

function cuantos_hijos($usuario) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $usuario = mysqli_real_escape_string($conn, $usuario);
    $DNI_Adulto = obtenerDNIAdulto($usuario);

    try {
        $sql = "SELECT * FROM menores WHERE adulto = '$DNI_Adulto'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se obtuvo un resultado
        if (mysqli_num_rows($result) > 0) {
            //Obtener numero de hijos
            $num_hijos = mysqli_num_rows($result);
        } else {
            // Si no se encontró ningún registro, asignar un valor predeterminado
            $num_hijos = null;
        }

        mysqli_close($conn);

        return $num_hijos;
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
        return null;
    }
}

//Función saber el numero de hijos de registro del usuario.
function hijos_registro_adulto($usuario) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $usuario = mysqli_real_escape_string($conn, $usuario);
    $DNI_Adulto = obtenerDNIAdulto($usuario);

    try {
        $sql = "SELECT hijos FROM adultos WHERE DNI_adulto = '$DNI_Adulto'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se obtuvo un resultado
        if (mysqli_num_rows($result) > 0) {
            // Obtener el valor de "tipo"
            $row = mysqli_fetch_assoc($result);
            $hijos = $row['hijos'];
        } else {
            // Si no se encontró ningún registro, asignar un valor predeterminado
            $hijos = null;
        }

        mysqli_close($conn);

        return $hijos;
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
        return null;
    }
}

//Función para obtener el codigo del formulario por el nombre.

function obtenerCodFormYFechaPorNombre($nombre) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $nombre = mysqli_real_escape_string($conn, $nombre);

    try {
        $sql = "SELECT cod_form, fecha_hora FROM formularios WHERE nombre = '$nombre'";
        $result = mysqli_query($conn, $sql);

        // Crear un array para almacenar los resultados
        $resultados = array();

        // Recorrer los resultados y almacenar los cod_form y fecha_hora en el array
        while ($row = mysqli_fetch_assoc($result)) {
            $fechaHora = new DateTime($row['fecha_hora']);
            $dia = $fechaHora->format('d');
            $hora = $fechaHora->format('H:i');

            $resultado = array(
                'cod_form' => $row['cod_form'],
                'dia' => $dia,
                'hora' => $hora
            );
            $resultados[] = $resultado;
        }

        mysqli_close($conn);

        return $resultados;
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");

        return null;
    }
}

//Función obtener tabla de hijos
function obtenerHijos($DNI_Adulto) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $DNI_Adulto = mysqli_real_escape_string($conn, $DNI_Adulto);
    try {
        $sql = "SELECT DNI_menor, nombre FROM menores WHERE adulto = '$DNI_Adulto'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table style='width:100%; margin:auto;'>";
            echo "<tr>";
            echo "<th style='background-color: red; color: white; padding:10px;'>ㅤㅤDNI Menorㅤㅤ</th>";
            echo "<th style='background-color: red; color: white; padding:10px;'>ㅤㅤNombreㅤㅤ</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td style='padding:10px; text-align:center;'>" . $row["DNI_menor"] . "</td>";
                echo "<td style='padding:10px; text-align:center;'>" . $row["nombre"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se han encontrado los hijos";
            header('Location: ../addhijo.php');
            exit();
        }

        mysqli_close($conn); // Cerrar conexión a la base de datos
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
    }
}

//Función comprueba que el DNI del menor es hijo del DNI adulto:
function verificarEsHijo($DNI_menor, $DNI_Adulto) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $DNI_menor = mysqli_real_escape_string($conn, $DNI_menor);
    $DNI_Adulto = mysqli_real_escape_string($conn, $DNI_Adulto);
    $error_DNI_menor = "";

    try {
        $sql = "SELECT * FROM menores, adultos WHERE menores.adulto = adultos.DNI_adulto AND DNI_menor = '$DNI_menor' AND adulto = '$DNI_Adulto'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            $error_DNI_menor = "El DNI del menor no corresponde con tus menores asignados.<br>";
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
    }

    return $error_DNI_menor;
}

//Función obtener el numero de reservas de un formulario por DNI_Adulto.
function contarFormularios($DNI_Adulto, $cod_form) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $cod_form = mysqli_real_escape_string($conn, $cod_form);
    $DNI_Adulto = mysqli_real_escape_string($conn, $DNI_Adulto);

    try {
        $sql = "SELECT * FROM reservas WHERE DNI_adulto = '$DNI_Adulto' AND cod_form = '$cod_form'";
        $result = mysqli_query($conn, $sql);
        $numFilas = mysqli_num_rows($result);

        mysqli_close($conn);

        return $numFilas;
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
        return 0;
    }
}

//Funcion para incrementar el numero de plazas ocupadas de un formulario.

function incrementarPlazasOcupadas($cod_form) {
    // Realizar la conexión a la base de datos
    $conn = conectarBD();

    // Escapar el valor del código de formulario para evitar inyección de SQL
    $cod_form = mysqli_real_escape_string($conn, $cod_form);
    try {
        // Consulta SQL para incrementar en 1 el campo "plazas_ocupadas"
        $sql = "UPDATE formularios SET plazas_ocupadas = plazas_ocupadas + 1 WHERE cod_form = '$cod_form'";

        // Ejecutar la consulta
        mysqli_query($conn, $sql);

        // Cerrar la conexión
        mysqli_close($conn);
    }catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
        return 0;
    }
}

//Función obtener el numero de reservas de un formulario por DNI_menor.
function contarFormularios_menor($DNI_menor, $cod_form) {
    //Importante realizar la conexión llamando a su función correspondiente.
    $conn = conectarBD();
    //Función IMPORTANTE ante el sql injection
    $cod_form = mysqli_real_escape_string($conn, $cod_form);
    $DNI_menor = mysqli_real_escape_string($conn, $DNI_menor);

    try {
        $sql = "SELECT * FROM reservas WHERE DNI_menor = '$DNI_menor' AND cod_form = '$cod_form'";
        $result = mysqli_query($conn, $sql);
        $numFilas = mysqli_num_rows($result);

        mysqli_close($conn);

        return $numFilas;
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");

        return 0;
    }
}



// Procesar transferencia del Musical.
function procesarTransferencia_M() {
    $nombreImagen = '';
    $haEntregadoImagen = 0;

    if (isset($_FILES['transferencia']) && $_FILES['transferencia']['error'] === UPLOAD_ERR_OK) {
        // Se ha subido una imagen de transferencia
        // Generar un nombre de archivo único
        $nombreArchivo = "t_musical" . '_' . uniqid();
        $rutaArchivo = './t_musical/' . $nombreArchivo;

        // Mover la imagen de transferencia a la ubicación deseada
        move_uploaded_file($_FILES['transferencia']['tmp_name'], $rutaArchivo);

        // Establecer el nombre del archivo en la base de datos
        $nombreImagen = $nombreArchivo;
        $haEntregadoImagen = 1;
    }

    return array('nombreImagen' => $nombreImagen, 'haEntregadoImagen' => $haEntregadoImagen);
}

//Procesar pdf ficha medica campamento
function procesarArchivoPDF_parzan(){
    // Validar si se ha adjuntado el archivo PDF
    if (isset($_FILES['medica']) && $_FILES['medica']['error'] === 0) {
        // Generar un nombre de archivo aleatorio
        $extension = pathinfo($_FILES['medica']['name'], PATHINFO_EXTENSION);
        $nombreAleatorio = "med" . '_' . uniqid() . '.' . $extension;

        // Guardar el archivo en una carpeta específica
        $carpetaDestino = './par_23/pdf_medica/';
        $rutaPDF = $carpetaDestino . $nombreAleatorio;
        move_uploaded_file($_FILES['medica']['tmp_name'], $rutaPDF);

    } else {
        // No se ha adjuntado el archivo PDF
        $nombreAleatorio = '';
    }

    return [
        'nombreAleatorio' => $nombreAleatorio,
    ];
}

//Procesar la foto del participante de parzan
function procesar_foto_participante_parzan() {
    $nombreImagen = '';

    if (isset($_FILES['participante']) && $_FILES['participante']['error'] === UPLOAD_ERR_OK) {
        // Se ha subido una imagen de transferencia
        // Generar un nombre de archivo único
        $nombreArchivo = "foto" . '_' . uniqid();
        $rutaArchivo = './par_23/f_part/' . $nombreArchivo;

        // Mover la imagen de transferencia a la ubicación deseada
        move_uploaded_file($_FILES['participante']['tmp_name'], $rutaArchivo);

        // Establecer el nombre del archivo en la base de datos
        $nombreImagen = $nombreArchivo;
    }

    return array('nombreImagen' => $nombreImagen);
}

//Procesar foto transferencia parzan.
function procesarTransferencia_parzan() {
    $nombreImagen = '';
    $haEntregadoImagen = 0;

    if (isset($_FILES['transferencia']) && $_FILES['transferencia']['error'] === UPLOAD_ERR_OK) {
        // Se ha subido una imagen de transferencia
        // Generar un nombre de archivo único
        $nombreArchivo = "trans" . '_' . uniqid();
        $rutaArchivo = './par_23/t_par_23/' . $nombreArchivo;

        // Mover la imagen de transferencia a la ubicación deseada
        move_uploaded_file($_FILES['transferencia']['tmp_name'], $rutaArchivo);

        // Establecer el nombre del archivo en la base de datos
        $nombreImagen = $nombreArchivo;
        $haEntregadoImagen = 1;
    }

    return array('nombreImagen' => $nombreImagen, 'haEntregadoImagen' => $haEntregadoImagen);
}

// Procesar transferencia de la Cena de Confirmaciones.
function procesarTransferencia__c_conf_23() {
    $nombreImagen = '';
    $haEntregadoImagen = 0;

    if (isset($_FILES['transferencia']) && $_FILES['transferencia']['error'] === UPLOAD_ERR_OK) {
        // Se ha subido una imagen de transferencia
        // Generar un nombre de archivo único
        $nombreArchivo = "trans" . '_' . uniqid();
        $rutaArchivo = './t_c_conf_23/' . $nombreArchivo;

        // Mover la imagen de transferencia a la ubicación deseada
        move_uploaded_file($_FILES['transferencia']['tmp_name'], $rutaArchivo);

        // Establecer el nombre del archivo en la base de datos
        $nombreImagen = $nombreArchivo;
        $haEntregadoImagen = 1;
    }

    return array('nombreImagen' => $nombreImagen, 'haEntregadoImagen' => $haEntregadoImagen);
}

//Función para no dejar registrarse en un formulario que ya no tiene plazas disponibles
function compararPlazas($cod_form) {
    try {
        // Realizar la consulta a la base de datos
        $conn = conectarBD();
        $cod_form = mysqli_real_escape_string($conn, $cod_form);
        $sql = "SELECT plazas, plazas_ocupadas FROM formularios WHERE cod_form = '$cod_form'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se encontraron resultados
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $plazas = $row['plazas'];
            $plazas_ocupadas = $row['plazas_ocupadas'];

            // Comparar los valores de plazas y plazas_ocupadas
            if ($plazas == $plazas_ocupadas) {
                throw new Exception("No hay plazas disponibles.");
            }
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
    }
}


function mostrarReservas_menor($DNI_Adulto) {
    try {
        // Realizar la primera consulta para obtener numero, cod_form y DNI_menor
        $conn = conectarBD();
        $DNI_Adulto = mysqli_real_escape_string($conn, $DNI_Adulto);
        $sql = "SELECT numero, cod_form, DNI_menor FROM reservas WHERE DNI_adulto = '$DNI_Adulto'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se encontraron resultados
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th style='padding:10px; background-color: red; color: white; text-align:center;'>Número de Reserva</th>";
            echo "<th style='padding:10px; background-color: red; color: white; text-align:center;'>DNI Menor</th>";
            echo "<th style='padding:10px; background-color: red; color: white; text-align:center;'>Nombre de la Actividad</th>";
            echo "</tr>";

            // Recorrer los resultados y mostrarlos en la tabla
            while ($row = mysqli_fetch_assoc($result)) {
                $numero = $row['numero'];
                $cod_form = $row['cod_form'];
                $DNI_menor = $row['DNI_menor'];

                // Realizar la segunda consulta para obtener el nombre del formulario
                $sql2 = "SELECT nombre FROM formularios WHERE cod_form = '$cod_form'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $nombre = $row2['nombre'];

                // Mostrar los datos en la tabla
                echo "<tr>";
                echo "<td style='padding:10px; text-align:center;'>$numero</td>";
                echo "<td style='padding:10px; text-align:center;'>$DNI_menor</td>";
                echo "<td style='padding:10px; text-align:center;'>$nombre</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            die("No tienes reservas disponibles.");
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
    }
}



function mostrarReservas($DNI_Adulto) {
    try {
        // Realizar la primera consulta para obtener numero, cod_form y DNI_menor
        $conn = conectarBD();
        $DNI_Adulto = mysqli_real_escape_string($conn, $DNI_Adulto);
        $sql = "SELECT numero, cod_form FROM reservas WHERE DNI_adulto = '$DNI_Adulto'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se encontraron resultados
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th style='padding:10px; background-color: red; color: white; text-align:center;'>Número de Reserva</th>";
            echo "<th style='padding:10px; background-color: red; color: white; text-align:center;'>Nombre de la Actividad</th>";
            echo "</tr>";

            // Recorrer los resultados y mostrarlos en la tabla
            while ($row = mysqli_fetch_assoc($result)) {
                $numero = $row['numero'];
                $cod_form = $row['cod_form'];

                // Realizar la segunda consulta para obtener el nombre del formulario
                $sql2 = "SELECT nombre FROM formularios WHERE cod_form = '$cod_form'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $nombre = $row2['nombre'];

                // Mostrar los datos en la tabla
                echo "<tr>";
                echo "<td style='padding:10px; text-align:center;'>$numero</td>";
                echo "<td style='padding:10px; text-align:center;'>$nombre</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            throw new Exception("No tienes reservas disponibles.");
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
    }
}



//Borrado de reservas
function eliminarReserva($numero) {
    try {
        // Realizar la conexión a la base de datos
        $conn = conectarBD();
        $numero = mysqli_real_escape_string($conn, $numero);
        // Obtener el cod_form correspondiente al número de reserva
        $sql = "SELECT cod_form FROM reservas WHERE numero = $numero";
        $result = mysqli_query($conn, $sql);

        // Verificar si se encontró el cod_form
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $cod_form = $row['cod_form'];

            // Eliminar la reserva con DELETE
            $sql_delete = "DELETE FROM reservas WHERE numero = $numero";
            if (mysqli_query($conn, $sql_delete)) {
                // Actualizar plazas_ocupadas en formularios con UPDATE
                $sql_update = "UPDATE formularios SET plazas_ocupadas = plazas_ocupadas - 1 WHERE cod_form = '$cod_form'";
                if (mysqli_query($conn, $sql_update)) {
                    echo "";
                } else {
                    throw new Exception("Error al actualizar la tabla formularios: " . mysqli_error($conn));
                }
            } else {
                throw new Exception("Error al eliminar la reserva: " . mysqli_error($conn));
            }
        } else {
            throw new Exception("No se encontró el número de reserva especificado.");
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
    }
}


//Comprobar que la reserva que quiere borrar el usuario es suya.
function verificarReserva($numero, $DNI_Adulto) {
    try {
        // Realizar la conexión a la base de datos
        $conn = conectarBD();
        $numero = mysqli_real_escape_string($conn, $numero);
        $DNI_Adulto = mysqli_real_escape_string($conn, $DNI_Adulto);
        // Realizar la consulta
        $sql = "SELECT * FROM reservas WHERE numero = $numero AND DNI_adulto = '$DNI_Adulto'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se encontraron filas
        if ($result && mysqli_num_rows($result) > 0) {
            // Se encontraron filas
            mysqli_close($conn);
            return 1;
        } else {
            // No se encontraron filas
            mysqli_close($conn);
            return 0;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        guardarErrorEnLog($error);
        global $habladmin;
        die ("$habladmin");
        return null;
    }
}


  
  














?>
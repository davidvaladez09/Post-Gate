<?php
require './controladores/base_datos.php';

// Conectar a la base de datos (se asume que '$conn' es la conexión)
 $conn_usuario = $conn;

// Obtener los datos del formulario
$email = isset($_POST['email']) ? $_POST['email'] : '';
$bytes = random_bytes(5);
$token = bin2hex($bytes);
date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');

// Sentencia para no insertar el mismo usuario y correo
$sql_usuario = "SELECT * FROM perfil WHERE correo = ?";
$stmt = $conn->prepare($sql_usuario);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

// Validación de campos vacíos
if (empty($email)) {
    // Mostrar el mensaje de datos incompletos
    echo '<script>';
    echo 'alert("DEBES INGRESAR UN CORREO");';
    // Redirigir al usuario a la página de inicio de sesión
    echo 'window.location = "recuperar_password.php";';
    echo '</script>';
} else {
    // Validación de correo de alumnos
    if (preg_match("/@alumnos.udg.mx/", $email) || preg_match("/@gmail.com/", $email) ) {
        if ($result->num_rows > 0) {
            include "./mail_recuperacion_password.php";

            if ($enviado) {
                $sql = "INSERT INTO passwords (email, token, codigo, fecha) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssss', $email, $token, $codigo, $fecha);

                if ($stmt->execute()) {
                    // Mostrar el mensaje de registro realizado en una notificación flotante
                    echo '<script>';
                    echo 'alert("SE HA ENVIADO UN CODIGO DE CONFIRMACION A TU CORREO ELECTRONICO. \nPOR FAVOR VALIDA TU CUENTA.");';
                    // Redirigir al usuario a la página de inicio de sesión
                    echo 'window.location = "login.php";';
                    echo '</script>';
                } else {
                    // Mostrar el mensaje de error al realizar la consulta
                    echo '<script>';
                    echo 'alert("ERROR AL REALIZAR LA CONSULTA");';
                    // Redirigir al usuario a la página de registro
                    echo 'window.location = "registro.php";';
                    echo '</script>';
                }
            } else {
                // Mostrar el mensaje si no se pudo enviar el correo de confirmación
                echo '<script>';
                echo 'alert("NO SE PUDO ENVIAR EL CORREO DE CONFIRMACIÓN");';
                // Redirigir al usuario a la página de registro
                echo 'window.location = "registro.php";';
                echo '</script>';
            }

        } else {
            // Mostrar el mensaje de error si el correo ingresado no se encuentra registrado
            echo '<script>';
            echo 'alert("EL CORREO INGRESADO NO SE ENCUENTRA REGISTRADO.");';
            // Redirigir al usuario a la página de inicio de sesión
            echo 'window.location = "login.php";';
            echo '</script>';
        }
    } else {
        // Mostrar el mensaje si el correo no es válido
        echo '<script>';
        echo 'alert("EL CORREO ES INVALIDO \nDEBES CONTAR CON CORREO DOMINIO: juan@alumnos.udg.mx");';
        // Redirigir al usuario a la página de recuperación de contraseña
        echo 'window.location = "recuperar_password.php";';
        echo '</script>';
    }
}
?>

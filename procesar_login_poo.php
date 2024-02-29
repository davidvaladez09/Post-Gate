<?php
session_start();

if(isset($_SESSION['username'])){
    header('location: Main.php');
    exit();
}

// Conexión a la base de datos
require './controladores/base_datos.php';

// Verificación de la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recuperación de las credenciales del usuario
$credencial = $_POST['username']; // Nombre de usuario o correo electrónico
$contrasena = $_POST['password'];

// Encriptación de la contraseña con password_hash()
$contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

// Consulta a la base de datos para verificar las credenciales y el estado de token_confirmado
$query = "SELECT * FROM perfil WHERE username='$credencial' OR correo='$credencial'";
$resultado = $conn->query($query);

// Verificación del resultado de la consulta
if ($resultado->num_rows == 1) {
    // Si el usuario existe en la base de datos y el token está validado, verificamos la contraseña
    $usuario = $resultado->fetch_assoc();
    if (password_verify($contrasena, $usuario['password'])) {
        //Verfificar si la cuenta esta validada con el token
        if ($usuario['token_confirmado'] == 'si') {
             // Si las credenciales son correctas, recuperamos los permisos del usuario
            $permisos = $usuario['rol'];

            // Guardamos el usuario en la sesión
            $_SESSION['username'] = $usuario['username'];

            setcookie('username', $username, time() + 3600); // Tiempo de vida de la cookie: 1 hora

            // Mostramos la ventana correspondiente según los permisos del usuario
            if ($permisos == 1) {
                header('location: Main_admin.php');
            } elseif ($permisos == 2) {
                header('location: Main.php');
            } else {
                // Mostrar el mensaje de error en una notificación flotante
                echo '<script>';
                echo 'alert("NO TIENES PERMISO PARA ACCEDER");';
                // Redirigir al usuario a la página de inicio de sesión
                echo 'window.location = "login.php";';
                echo '</script>';
            }
        } else {
            // Mostrar el mensaje de error en una notificación flotante
            echo '<script>';
            echo 'alert("TU CUENTA NO HA SIDO VALIDADA");';
            // Redirigir al usuario a la página de inicio de sesión
            echo 'window.location = "login.php";';
            echo '</script>';
        }
    } else {
        // Mostrar el mensaje de error en una notificación flotante
        echo '<script>';
        echo 'alert("CONTRASEÑA INCORRECTA");';
        // Redirigir al usuario a la página de inicio de sesión
        echo 'window.location = "login.php";';
        echo '</script>';
    }
} else {
    // Mostrar el mensaje de error en una notificación flotante
    echo '<script>';
    echo 'alert("USUARIO O CORREO INCORRECTOS");';
    // Redirigir al usuario a la página de inicio de sesión
    echo 'window.location = "login.php";';
    echo '</script>';
}

// Cerramos la conexión a la base de datos
$conn->close();
?>

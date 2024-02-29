<?php
require './controladores/base_datos.php';

$conn_usuario = $conn;

if ($conn_usuario->connect_error) {
  // Mostrar el mensaje de error de conexión
  echo '<script>';
  echo 'alert("ERROR DE CONEXIÓN");';
  // Redirigir al usuario a la página de inicio de sesión
  echo 'window.location = "registro.php";';
  echo '</script>';
}

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmar_password'];


// Encriptar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// Validación de campos vacíos
if (empty($email) && empty($confirm_password)) {
    // Mostrar el mensaje de datos incompletos
    echo '<script>';
    echo 'alert("INGRESA UN PASSWORD NUEVO");';
    echo '</script>';
} else {
    // Validar si los passwords son iguales
    if ($password === $confirm_password) {
        // Insertar usuario a la base de datos 
        $sql = "UPDATE perfil SET password = '$hashed_password' WHERE correo = '$email';" ;
        // Insertar datos en la tabla perfil
        if ($conn_usuario->query($sql)) {
            // Mostrar el mensaje de registro realizado en una notificación flotante
            echo '<script>';
            echo 'alert("PASSWORD ACTUALIZADO CORRECTAMENTE.");';
            // Redirigir al usuario a la página de inicio de sesión
            echo 'window.location = "login.php";';
            echo '</script>';
        } else {
            // Mostrar el mensaje de error de registro en una notificación flotante
            echo '<script>';
            echo 'alert("NO SE PUDO REALIZAR EL REGISTRO");';
            echo '</script>';
        }
                            
        $conn_usuario->close();

            
    } else {
        // Mostrar el mensaje de passwords diferentes en una notificación flotante
        echo '<script>';
        echo 'alert("LAS CONTRASEÑAS NO COINCIDEN");'; 
        echo '</script>';
    }
}


?>
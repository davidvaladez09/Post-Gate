<?php
// Iniciamos la sesión
session_start();

// Destruimos la sesión
session_destroy();

// Redireccionamos al usuario a la página de inicio de sesión o a la página principal de tu sitio web
echo '<script>';
// Redirigir al usuario a la página de inicio de sesión
echo 'window.location = "../login.php";';
echo '</script>';
exit();
?>
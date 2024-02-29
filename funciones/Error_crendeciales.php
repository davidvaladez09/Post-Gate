<?php
// Verificar si hay una variable de sesión con un mensaje de error
session_start();
if (isset($_SESSION['mensaje_error'])) {
  // Mostrar el mensaje de error
  echo '<p>' . $_SESSION['mensaje_error'] . '</p>';
  // Eliminar la variable de sesión
  unset($_SESSION['mensaje_error']);
}
?>
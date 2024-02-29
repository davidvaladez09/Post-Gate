<?php
session_start(); // Iniciar la sesión

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  // La sesión está iniciada y el valor de la cookie de sesión no está vacío
  $username = $_SESSION['username']; // Leer el valor de la cookie de sesión
} else {
  // La sesión no está iniciada o el valor de la cookie de sesión está vacío
  header("Location: ../login.php");
  exit();
}
?>
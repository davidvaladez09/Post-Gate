<?php
session_start(); // Iniciar la sesión

// Verificar si la sesión está iniciada y el valor de la cookie de sesión es correcto
if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
  $username = $_SESSION['username']; // Leer el valor de la cookie de sesión

  /*
  $tiempoActual = time();

  
  if (isset($_SESSION['ultimoAcceso'])) {
    
    $tiempoTranscurrido = $tiempoActual - $_SESSION['ultimoAcceso'];

    
    if ($tiempoTranscurrido > 120) {
     
      session_unset(); 
      session_destroy();

     
      header('../Location: login.php');
      exit();
    }
  }*/

  // Actualizar el valor de 'último acceso' en la sesión
  //$_SESSION['ultimoAcceso'] = $tiempoActual;
} else {
  // La sesión no está iniciada o el valor de la cookie de sesión no es correcto
  header('Location: ../login.php'); // Redirigir al usuario a la página de inicio de sesión
  exit();
}
?>

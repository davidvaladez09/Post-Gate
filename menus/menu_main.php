<?php
  require "./controladores/base_datos.php";
  session_start(); // Iniciar la sesión
  // Verificar si la sesión está iniciada y el valor de la cookie de sesión es correcto
  if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
  $username = $_SESSION['username']; // Leer el valor de la cookie de sesión

  // Obtener el tiempo actual en segundos
  $tiempoActual = time();

  // Verificar si existe el valor de 'último acceso' en la sesión
  if (isset($_SESSION['ultimoAcceso'])) {
    // Calcular la diferencia de tiempo entre el último acceso y el tiempo actual
    $tiempoTranscurrido = $tiempoActual - $_SESSION['ultimoAcceso'];

    // Verificar si el tiempo transcurrido es mayor a 5 minutos (300 segundos)
    if ($tiempoTranscurrido > 300) {
      // Cerrar la sesión
      session_unset(); // Eliminar todas las variables de sesión
      session_destroy(); // Destruir la sesión

      // Redirigir al usuario a la página de inicio de sesión
      header('Location: ../login.php');
      exit();
    }
  }

  // Actualizar el valor de 'último acceso' en la sesión
  $_SESSION['ultimoAcceso'] = $tiempoActual;
} else {
  // La sesión no está iniciada o el valor de la cookie de sesión no es correcto
  header('Location: ../login.php'); // Redirigir al usuario a la página de inicio de sesión
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="./style/style.main2.css" rel="stylesheet" type="text/css">
    
    <title>HOME</title>

    <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>
<body>
  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background-color: black;">
        <a class="navbar-brand" href="./Main.php">
        <img src="./imagenes/logo_postgate_pestana_invertido.png" width="70" height="40" class="d-inline-block align-top" alt="">
        </a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="./views_carreras/coordinadores.php">INFO COORDINADORES</a>
            </li>
            
            <?php
            if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
              $sql_carreras = "SELECT codigo, nombre FROM carrera WHERE codigo != 'COMPARTIDA' ORDER BY nombre ASC LIMIT 4";
              $resultado = $conn->query($sql_carreras);

              if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                  $codigo_carrera = $fila['codigo']; // Obtener el ID de la publicación
                  $nombre_carrera = $fila['nombre'];

                  echo "<li class='nav-item actie'>";
                  echo "<a class='nav-link' href='./views_carreras/Carreras.php?codigo=$codigo_carrera'>$nombre_carrera</a>";
                  echo "</li>";
                }
              }
            }
            ?>
            <div class="dropdown show">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MAS CARRERAS</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <?php
                if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
                  $sql_carreras_dropdown = "SELECT codigo, nombre FROM carrera ORDER BY nombre ASC LIMIT 18446744073709551615 OFFSET 5";
                  $resultado = $conn->query($sql_carreras_dropdown);

                  if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                      $codigo_carrera = $fila['codigo']; // Obtener el ID de la publicación
                      $nombre_carrera = $fila['nombre'];

                      echo "<a class='dropdown-item' href='./views_carreras/Carreras.php?codigo=$codigo_carrera'>$nombre_carrera</a>";
                    }
                  }
                }
                ?>
              </div>
            </div>
          </ul>
          <form class="d-flex">
            <a class="nav-link" href="./funciones/logout.php">Log Out</a>
            <a class="nav-link" href="./funciones/Perfil2.php">Perfil</a>
          </form>
        </div>
      </nav>
    </div>
  </header>

  <hr>

</body>
</html>
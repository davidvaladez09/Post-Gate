<?php
  require '../controladores/controlador_cookie.php';
  require '../controladores/base_datos.php';

  if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
    $sql = "SELECT carrera.rutaMallaCurricular AS ruta, carrera.nombre AS nombre_carrera, carrera.codigo AS codigo_carrera, coordinador.nombre AS nombre_coordinador, coordinador.correo, coordinador.telefono FROM carrera INNER JOIN coordinador ON carrera.idCoordinador = coordinador.id WHERE carrera.codigo != 'COMPARTIDA' ORDER BY carrera.nombre ASC;";


    $result = $conn->query($sql);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../style/style.main2.css" rel="stylesheet" type="text/css">
    
    <title>Coordinadores</title>
    
    <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>
<body>

  <?php 
    require '../menus/menu_materias.php';
    require '../controladores/conrolador_chatbot.php'; 
  ?>

  <br>
  <br>
  <div class="container">
    <br>
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $carrera = $row['nombre_carrera'];
          $codigo_carrera = $row['codigo_carrera'];
          $nombre_coordinador = $row['nombre_coordinador'];
          $correo = $row['correo'];
          $telefono = $row['telefono'];
          $ruta = $row['ruta'];

          echo "<div class='card'>";
          echo "<div class='card-header' style='color: black; font-weight: bold;'>";
          echo "$carrera ($codigo_carrera)";
          echo "</div>";
          echo "<div class='card-body'>";
          echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
          echo "<p class='card-text'>$nombre_coordinador</p>";
          echo "<label style='color: black; font-weight: bold;'>Correo</label>";
          echo "<p class='card-text'>Correo: $correo</p>";
          echo "<label style='color: black; font-weight: bold;'>Telefono</label>";
          echo "<p class='card-text'>$telefono</p>";
          echo "</div>";
          echo "<div class='card-footer text-muted'>";
          echo "<a href='$ruta' class='btn btn-primary'>Descargar Malla Curricular</a>";
          echo "</div>";
          echo "</div>";
          echo "<br>";
          //require '../views_admin';
        }
      } else {
        echo "No se encontraron resultados.";
      }
    ?>

  </div>
  <script>
    let inactivityTime = 600; // Tiempo de inactividad en segundos (ejemplo: 5 minutos)
    let timeout;

    function resetTimer() {
      clearTimeout(timeout);
      timeout = setTimeout(redirectLogout, inactivityTime * 1000);
    }

    function redirectLogout() {
      window.location.href = '../login.php';
    }

    // Reinicia el temporizador cuando hay interacción del usuario
    document.addEventListener('mousemove', resetTimer);
    document.addEventListener('keypress', resetTimer);

    // Inicia el temporizador cuando la página se carga
    window.onload = resetTimer;
  </script>

</body>
</html>

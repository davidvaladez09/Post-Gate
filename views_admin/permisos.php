<?php
  require '../controladores/controlador_cookie.php';
  require '../controladores/base_datos.php';

  if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
    $sql = "SELECT * FROM perfil WHERE username != 'admin';";

    $result = $conn->query($sql);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERMISOS DE USUARIO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../style/style.main2.css" rel="stylesheet" type="text/css">
    
    <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>
<body>
  <?php
      require '../menus/menu_funciones_admin.php';
  ?>

  <div class="container">
    <br>
    <br>
    <p class="h1">CAMBIAR PERMISOS DE USUARIO</p>
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $username = $row['username'];
          $nombre = $row['nombre'];
          $correo = $row['correo'];
          $carrera = $row['carrera'];
          $descripcion = $row['descripcion'];
          $rol = $row['rol'];

          echo "<div class='card'>";
          echo "<div class='card-header' style='color: black; font-weight: bold;'>";
          echo "$username";
          echo "</div>";
          echo "<div class='card-body'>";
          echo "<label style='color: black; font-weight: bold;'>Username</label>";
          echo "<p class='card-text'>$username</p>";
          echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
          echo "<p class='card-text'>$nombre</p>";
          echo "<label style='color: black; font-weight: bold;'>Correo</label>";
          echo "<p class='card-text'>Correo: $correo</p>";
          echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
          echo "<p class='card-text'>$carrera</p>";
          echo "<label style='color: black; font-weight: bold;'>Descripcion</label>";
          echo "<p class='card-text'>$descripcion</p>";
          echo "<label style='color: black; font-weight: bold;'>Tipo de permisos</label>";
          echo "<p class='card-text'>"; 
          echo "$rol - ";
          if($rol == 1){
            echo "ADMINISTRADOR";
          } else {
            echo "USUARIO";
          }
          echo "</p>";
          echo "</div>";
          echo "<div class='card-footer text-muted'>";
          echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal$$username'>CAMBIAR PERMISOS</button>";

          //-- Modal -->
          echo "<div class='modal fade' id='exampleModal$$username' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
          echo "<div class='modal-dialog' role='document'>";
          echo "<div class='modal-content'>";
          echo "<div class='modal-header'>";
          echo "<h5 class='modal-title' id='exampleModalLabel'>CAMBIAR PERMISOS</h5>";
          echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
          echo "<span aria-hidden='true'>&times;</span>";
          echo "</button>";
          echo "</div>";
          echo "<div class='modal-body'>";
          //--------BODY--------------
          echo "<form action='procesar_cambiar_permiso.php?username=$username' method='POST' enctype='multipart/form-data'>";
          echo "<label style='color: black; font-weight: bold;'>Username</label>";
          echo "<p class='card-text'>$username</p>";
          echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
          echo "<p class='card-text'>$nombre</p>";
          echo "<label style='color: black; font-weight: bold;'>Correo</label>";
          echo "<p class='card-text'>Correo: $correo</p>";
          echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
          echo "<p class='card-text'>$carrera</p>";
          echo "<label style='color: black; font-weight: bold;'>Descripcion</label>";
          echo "<p class='card-text'>$descripcion</p>";
          echo "<label style='color: black; font-weight: bold;'>Tipos de Permiso</label>";
          echo "<p class='card-text'>$rol</p>";
          echo "<div class='form-group'>";
          echo "<select class='custom-select' name='permiso-editable' required>";
          echo "<option value='$rol'>TIPO DE PERMISO</option>";
          echo "<option value='1'>ADMINISTRADOR</option>";
          echo "<option value='2'>USUARIO</option>";
          echo "</select>";
          echo "<div class='invalid-feedback'>Example invalid custom select feedback</div>";
          echo "</div>";
          echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>CAMBIAR PERMISOS</button>";
          echo "</form>";
          //----------
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "<br>";
        }
      } else {
        echo "No se encontraron resultados.";
      }
    ?>
  </div>
  <script>
      let inactivityTime = 300; // Tiempo de inactividad en segundos (ejemplo: 5 minutos)
      let timeout;

      function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(redirectLogout, inactivityTime * 1000);
      }

      function redirectLogout() {
        window.location.href = '../login.php';
        fetch('../funciones/logout.php', {
          method: 'POST', // Puedes ajustar según tu implementación
          credentials: 'include', // Para enviar las cookies de sesión
        })
      }

      // Reinicia el temporizador cuando hay interacción del usuario
      document.addEventListener('mousemove', resetTimer);
      document.addEventListener('keypress', resetTimer);

      // Inicia el temporizador cuando la página se carga
      window.onload = resetTimer;
    </script>

</body>
</html>
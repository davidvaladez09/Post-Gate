<?php
require './controladores/controlador_cookie.php';
require './controladores/base_datos.php';

// Consulta SQL para obtener los datos de publicaciones
$consulta_publicaciones = "SELECT carrea, COUNT(*) as contador_publicaciones FROM post GROUP BY carrea";
$resultado_publicaciones = mysqli_query($conn, $consulta_publicaciones);
$resultado_contador_publicaciones = $conn->query($consulta_publicaciones);

// Consulta SQL para obtener los datos de usuarios
$consulta_usuarios = "SELECT carrera, COUNT(*) as contador_usuarios FROM perfil WHERE username != 'admin' GROUP BY carrera";
$resultado_usuarios = mysqli_query($conn, $consulta_usuarios);
$resultado_contador_usuarios = $conn->query($consulta_usuarios);

// Consulta SQL para obtener los datos de materias
$consulta_materias = "SELECT carrera, COUNT(*) as contador_materias FROM materia GROUP BY carrera";
$resultado_materias = mysqli_query($conn, $consulta_materias);
$resultado_contador_materias = $conn->query($consulta_materias);

// Preparar los datos para la gráfica de publicaciones
$categorias_publicaciones = array();
$valores_publicaciones = array();
while ($fila_publicaciones = mysqli_fetch_assoc($resultado_publicaciones)) {
    $categorias_publicaciones[] = $fila_publicaciones['carrea'];
    $valores_publicaciones[] = $fila_publicaciones['contador_publicaciones'];
}

// Preparar los datos para la gráfica de usuarios
$categorias_usuarios = array();
$valores_usuarios = array();
while ($fila_usuarios = mysqli_fetch_assoc($resultado_usuarios)) {
    $categorias_usuarios[] = $fila_usuarios['carrera'];
    $valores_usuarios[] = $fila_usuarios['contador_usuarios'];
}

// Preparar los datos para la gráfica de materias
$categorias_materias = array();
$valores_materias = array();
while ($fila_materias = mysqli_fetch_assoc($resultado_materias)) {
    $categorias_materias[] = $fila_materias['carrera'];
    $valores_materias[] = $fila_materias['contador_materias'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="../style/style.informatica.css" rel="stylesheet" type="text/css">
    
    <title>HOME ADMIN</title>

    <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">

    <style>
      /* Estilos de los botones */
      .boton-info {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px;
      }
    </style>
</head>
<body>
  <?php
    require './menus/menu_admin.php';
  ?>

  <div class="container">
    <br>
    <br>
    <br>
    <p class="h1" style="color: azure; font-size: 2rem"><?php echo "Bienvenido: " . $username = $_SESSION['username']; ?></p>

    <br>
    <p class="h1" style="color: azure; font-size: 2rem">Número de publicaciones:</p>
    <br>

    <div style="width: 800px;">
      <canvas id="grafica_publicaciones"></canvas>
    </div>

    <br>

    <div class="row">
      <?php
        if ($resultado_contador_publicaciones->num_rows > 0) {
          while ($row = $resultado_contador_publicaciones->fetch_assoc()) {
            $carrera = $row["carrea"];
            $num_publicaciones = $row["contador_publicaciones"];

            echo "<button type='button' class='btn boton-info' style='font-size: 20px; margin-left: 15px; background-color: #9132F1;' title='$carrera'>";
            echo "$carrera <span class='badge badge-light' style='margin-left: 10px'>$num_publicaciones</span>";
            echo "</button>";
            echo "<br>";
          }
        } else {
          echo "No se encontraron resultados.";
        }
      ?>
    </div>

    <br>
    <br>
    <p class="h1" style="color: azure; font-size: 2rem">Número de usuarios:</p>
    <br>

    <div style="width: 800px;">
      <canvas id="grafica_usuarios"></canvas>
    </div>
    <br>

    <div class="row">
      <?php
        if ($resultado_contador_usuarios->num_rows > 0) {
          while ($row = $resultado_contador_usuarios->fetch_assoc()) {
            $carrera = $row["carrera"];
            $num_publicaciones = $row["contador_usuarios"];

            echo "<button type='button' class='btn boton-info' style='font-size: 20px; margin-left: 15px; background-color: #2FF4A0; color: black' title='$carrera'>";
            echo "$carrera <span class='badge badge-light' style='margin-left: 10px; background: black; color: white;'>$num_publicaciones</span>";
            echo "</button>";
            echo "<br>";
          }
        } else {
          echo "No se encontraron resultados.";
        }
      ?>
    </div>

    <br>
    <br>
    <p class="h1" style="color: azure; font-size: 2rem">Número de materias:</p>
    <br>

    <div style="width: 800px;">
      <canvas id="grafica_materias"></canvas>
    </div>
    <br>

    <div class="row">
      <?php
        if ($resultado_contador_materias->num_rows > 0) {
          while ($row = $resultado_contador_materias->fetch_assoc()) {
            $carrera_materia = $row["carrera"];
            $num_materias = $row["contador_materias"];

            echo "<br>";
            echo "<button class='btn boton-info' type='button' data-bs-toggle='collapse' data-bs-target='#collapseExample' aria-expanded='false' aria-controls='collapseExample' style='font-size: 20px; margin-left: 15px; background-color: #F0362D; color: white' title='$carrera_materia'>";
            echo "$carrera_materia <span class='badge badge-light' style='margin-left: 10px; background: black; color: white;'>$num_materias</span>";
            echo "</button>";
            echo "<br>";
          }
        } else {
          echo "No se encontraron resultados.";
        }
      ?>
    </div>
    
    <br>
    <br>
    <br>

    <script>
      //Funcion para cerrar sesion despues de 5 minutos

      let inactivityTime = 300; // Tiempo de inactividad en segundos (ejemplo: 5 minutos)
      let timeout;

      function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(redirectLogout, inactivityTime * 1000);
      }

      function redirectLogout() {
        window.location.href = './login.php';
        fetch('./funciones/logout.php', {
          method: 'POST', // Puedes ajustar según tu implementación
          credentials: 'include', // Para enviar las cookies de sesión
        })
      }

      // Reinicia el temporizador cuando hay interacción del usuario
      document.addEventListener('mousemove', resetTimer);
      document.addEventListener('keypress', resetTimer);

      // Inicia el temporizador cuando la página se carga
      window.onload = resetTimer;

      /*-------------------------------------------------------------------------------*/

      // Obtener los datos desde PHP
      var categorias_publicaciones = <?php echo json_encode($categorias_publicaciones); ?>;
      var valores_publicaciones = <?php echo json_encode($valores_publicaciones); ?>;

      // Crear la gráfica de publicaciones con Chart.js
      var ctx_publicaciones = document.getElementById('grafica_publicaciones').getContext('2d');
      var grafica_publicaciones = new Chart(ctx_publicaciones, {
          type: 'bar',
          data: {
              labels: categorias_publicaciones,
              datasets: [{
                  label: 'Número de publicaciones',
                  data: valores_publicaciones,
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

      // Obtener los datos desde PHP
      var categorias_usuarios = <?php echo json_encode($categorias_usuarios); ?>;
      var valores_usuarios = <?php echo json_encode($valores_usuarios); ?>;

      // Crear la gráfica de usuarios con Chart.js
      var ctx_usuarios = document.getElementById('grafica_usuarios').getContext('2d');
      var grafica_usuarios = new Chart(ctx_usuarios, {
          type: 'bar',
          data: {
              labels: categorias_usuarios,
              datasets: [{
                  label: 'Número de usuarios',
                  data: valores_usuarios,
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

       // Obtener los datos desde PHP
      var categorias_materias = <?php echo json_encode($categorias_materias); ?>;
      var valores_materias = <?php echo json_encode($valores_materias); ?>;

      // Crear la gráfica de usuarios con Chart.js
      var ctx_materias = document.getElementById('grafica_materias').getContext('2d');
      var grafica_materias = new Chart(ctx_materias, {
          type: 'bar',
          data: {
              labels: categorias_materias,
              datasets: [{
                  label: 'Número de usuarios',
                  data: valores_materias,
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  </script>
</div>
</body>
</html>

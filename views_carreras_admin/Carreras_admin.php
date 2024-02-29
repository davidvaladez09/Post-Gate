<?php
  require '../controladores/controlador_cookie_carrera.php';
  require '../controladores/base_datos.php';

  $carrera = $_GET['codigo'];
  $nombre_carrera = ""; // Variable para almacenar el nombre de la carrera

  if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
    $sql_carreras = "SELECT codigo, nombre FROM carrera WHERE codigo='$carrera'";
    $resultado = $conn->query($sql_carreras);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $codigo_carrera = $fila['codigo']; // Obtener el ID de la publicación
        $nombre_carrera = $fila['nombre'];
    } else {
        $nombre_carrera = "Carrera no encontrada";
    }
  }

  $carrera_compartida = 'COMPARTIDA';
  $semestre_compartido = '0';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $nombre_carrera?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../style/style.informatica.css" rel="stylesheet" type="text/css"> 
    
    <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">


    <script>
      // JavaScript
      var myInput = document.getElementById('myInput');
      var myLink = document.getElementById('myLink');
  
      myLink.href = "../views_materias/sem_programacion.php?parametro=" + encodeURIComponent(myInput.value);
    </script>
 

</head>
<body>
  <?php
    require '../menus/menu_carreras_admin.php';
  ?>

  <br>
  <br>

  <div class="container">
    <?php
    if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
        $sql_nombre_carrera = "SELECT nombre FROM carrera WHERE codigo='$carrera'";
        $resultado = $conn->query($sql_nombre_carrera);
    
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $nombre = $fila['nombre'];
        } else {
            $nombre_carrera = "Carrera no encontrada";
        }
      }
    ?>
    <p class="h1"><?php echo $nombre?></p>
    <div class="row">
     <!-- -------------------------------------MATERIAS COMPARTIDAS----------------------------------------- -->
     <?php
        if($carrera == 'INNI' || $carrera == 'INCO'){
            if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
                $sql_materias_compartidas = "SELECT nrc, nombre FROM materia WHERE carrera = '$carrera_compartida' AND semestre = '$semestre_compartido'";
                $resultado = $conn->query($sql_materias_compartidas);
        
                if ($resultado->num_rows > 0) {
                  while ($fila = $resultado->fetch_assoc()) {
                    $nrc_materia_compartida = $fila['nrc']; // Obtener el ID de la publicación
                    $nombre_materia_compartida = $fila['nombre'];
        
        
                    echo "<div class='col-sm-3'>";
                    echo "<div class='card text-white mb-3' style='background-color: #33F0FF; color: black; height: 16rem;'>";
                    echo "<div class='card-header' style='font-weight: bold; color: black;'>MATERIAS COMPARTIDAS</div>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title' style='color: black;'>$nombre_materia_compartida</h5>";
                    echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_materia_compartida) . "' class='btn btn-dark'>Ver foro</a>";
        
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                  }
                }
        
               }
        }
     ?> 

    <?php
      if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
          $sql_prueba = "SELECT nrc, nombre, semestre FROM materia WHERE carrera = '$carrera' ORDER BY semestre ASC";
          $resultado = $conn->query($sql_prueba);

          if ($resultado->num_rows > 0) {
              while ($fila = $resultado->fetch_assoc()) {
                  $nrc_prueba = $fila['nrc'];
                  $nombre_prueba = $fila['nombre'];
                  $semestre_prueba = intval($fila['semestre']);

                  switch ($semestre_prueba) {
                      case '1':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #FF8D33; color: black; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: black;'>PRIMER SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: black;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '2':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #33FF39; color: black; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: black;'>SEGUNDO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: black;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '3':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #33A2FF; color: black; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: black;'>TERCER SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: black;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '4':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #FF3374; color: white; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: white;'>CUARTO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: white;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '5':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #F9FF33; color: black; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: black;'>QUINTO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: black;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '6':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #9933FF; color: white; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: white;'>SEXTO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: white;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '7':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #33FF83; color: black; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: black;'>SEPTIMO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: black;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '8':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #FF3333; color: white; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: white;'>OCTAVO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: white;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '9':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #FF3383; color: white; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: white;'>NOVENO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: white;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      case '10':
                          echo "<div class='col-sm-3'>";
                          echo "<div class='card text-white mb-3' style='background-color: #112773; color: white; height: 16rem;'>";
                          echo "<div class='card-header' style='font-weight: bold; color: white;'>DECIMO SEMESTRE</div>";
                          echo "<div class='card-body'>";
                          echo "<h5 class='card-title' style='color: white;'>$nombre_prueba</h5>";
                          echo "<a id='myLink' href='../views_carreras_admin/publicacion_admin.php?nrc=" . urlencode($nrc_prueba) . "' class='btn btn-dark'>Ver foro</a>";
                          echo "</div>";
                          echo "</div>";
                          echo "</div>";
                          break;
                      // Agrega más casos para otros semestres si es necesario
                    }
                }
            }
        }
      ?>
      

    </div>
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
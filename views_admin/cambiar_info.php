<?php
  require '../controladores/controlador_cookie.php';
  require '../controladores/base_datos.php';

  if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
    $sql = "SELECT * FROM coordinador;";
    $result = $conn->query($sql);
  }

 

  $sql_carrera_materia = "SELECT * FROM carrera ORDER BY nombre ASC;";
  $result_carrera_materia = $conn->query($sql_carrera_materia);
  $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COORDINADORES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../style/style.main2.css" rel="stylesheet" type="text/css">
    
    <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>

<body>
  <?php
    require '../menus/menu_funciones_admin.php';
  ?>

  <br>
  <br>
  <br>

  <div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">EDITAR COORDINADORES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="carrera-tab" data-toggle="tab" href="#carrera" role="tab" aria-controls="carrera" aria-selected="true">EDITAR CARRERA</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="materia-tab" data-toggle="tab" href="#materia" role="tab" aria-controls="materia" aria-selected="true">EDITAR MATERIA</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">

      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">AÑADIR COORDINADOR</button>
        <br>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <br>
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AÑADIR COORDINADOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="./procesar_añadir_coordinador.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group" action="procesar_registrar_carrera.php" method="POST" enctype="multipart/form-data">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" name="nombre" aria-describedby="emailHelp" placeholder="Ingresa nombre" style="height: 100%">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Correo</label>
                    <input type="email" class="form-control" name="correo" aria-describedby="emailHelp" placeholder="Ingresa correo">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefono</label>
                    <input type="text" class="form-control" name="telefono" aria-describedby="emailHelp" placeholder="Ingresa telefono">
                  </div>
                  <small id="emailHelp" class="form-text text-muted">Debes completar todos los campos.</small>
                  <button type="submit" class="btn btn-success" name="actualizar">AÑADIR</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $id_coordinador = $row['id'];
              $carrera = $row['nombre'];
              $nombre_coordinador = $row['nombre'];
              $correo = $row['correo'];
              $telefono = $row['telefono']; 

              echo "<div class='card'>";
              echo "<div class='card-header' style='color: black; font-weight: bold;'>";
              echo "$nombre_coordinador";
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
              echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal$$id_coordinador'>EDITAR COORDINADOR</button>";
              echo "<br>";
              echo "<form action='procesar_elimnar_coordinador.php?id_coordinador=$id_coordinador' method='POST' enctype='multipart/form-data'>";
              echo "<button type='submit' class='btn btn-danger' name='eliminar' sytle='margin-top: 10px;'>ELIMINAR COORDINADOR</button>";
              echo "</form>";

              //-- Modal -->
              echo "<div class='modal fade' id='exampleModal$$id_coordinador' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
              echo "<div class='modal-dialog' role='document'>";
              echo "<div class='modal-content'>";
              echo "<div class='modal-header'>";
              echo "<h5 class='modal-title' id='exampleModalLabel'>EDITAR COORDINADOR</h5>";
              echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
              echo "<span aria-hidden='true'>&times;</span>";
              echo "</button>";
              echo "</div>";
              echo "<div class='modal-body'>";
              //--------BODY--------------
              echo "<form action='procesar_editar_coordinador.php?id_coordinador=$id_coordinador' method='POST' enctype='multipart/form-data'>";
              echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
              echo "<br>";
              echo "<input type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre_coordinador'>";
              echo "<br>";
              echo "<br>";
              echo "<label style='color: black; font-weight: bold;'>Correo</label>";
              echo "<br>";
              echo "<input type='email' name='correo-editable' style='width: 100%; border-radius: 5px' value='$correo'>";
              echo "<br>";
              echo "<br>";
              echo "<label style='color: black; font-weight: bold;'>Telefono</label>";
              echo "<br>";
              echo "<input type='text' name='telefono-editable' style='width: 100%; border-radius: 5px' value='$telefono'>";          
              echo "<br>";
              echo "<br>";
              echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
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

      <div class="tab-pane fade" id="carrera" role="tabpanel" aria-labelledby="carrera-tab">
        <br>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: black; font-weight: bold;">
                  AÑADIR CARRERA
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <form action="procesar_registrar_carrera.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa Codigo" name="codigo-nueva-carrera">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Ingresa Nombre" name="nombre-nueva-carrera">
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <?php
                        echo "<select class='custom-select' id='inputGroupSelect02' name='coordinador-nueva-carrera'>";
                        echo "<option selected>Selecciona Coordinador</option>";
                        // Verificar si se encontraron resultados
                        if ($result->num_rows > 0) {
                          // Iterar sobre los resultados y generar las opciones del select
                          while ($row = $result->fetch_assoc()) {
                            $id_coordinador_drop = $row['id'];
                            $nombre_coordinador_drop = $row['nombre'];
                            echo "<option value='$id_coordinador_drop'>$nombre_coordinador_drop</option>";
                          }
                        } else {
                          echo "<option value=''>No hay opciones disponibles</option>";
                        }

                        echo "</select>";
                      ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="custom-file">
                        <label class="custom-file-label" for="malla">Malla Curricular</label>
                        <input type="file" class="custom-file-input" id="malla" name="malla-nueva-carrera">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">AÑADIR</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <?php
          if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
            $sql_carrera = "SELECT c.*, co.id AS id_coordinador, co.nombre AS nombre_coordinador FROM carrera c LEFT JOIN coordinador co ON c.IdCoordinador = co.id ORDER BY c.nombre ASC;";

            $result_carrera = $conn->query($sql_carrera);
          }
          if ($result_carrera && $result_carrera->num_rows > 0) {
            while ($row = $result_carrera->fetch_assoc()) {
              $codigo_carrera = $row['codigo'];
              $nombre_carrera = $row['nombre'];
              $nombre_coordinador = $row['nombre_coordinador'];
              $id_coordinador_drop = $row['id_coordinador'];
              $ruta = $row['rutaMallaCurricular'];

              echo "<br>";
              echo "<div class='card'>";
              echo "<div class='card-header' style='color: black; font-weight: bold;'>";
              echo "$nombre_carrera($codigo_carrera)";
              echo "</div>";
              echo "<div class='card-body'>";
              echo "<label style='color: black; font-weight: bold;'>Codigo</label>";
              echo "<p class='card-text'>$codigo_carrera</p>";
              echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
              echo "<p class='card-text'>$nombre_carrera</p>";
              echo "<label style='color: black; font-weight: bold;'>Coordinador</label>";
              echo "<p class='card-text'>$nombre_coordinador</p>";
              echo "<label style='color: black; font-weight: bold;'>Malla Curricular</label>";
              echo "<br>";
              echo "<a class='card-text' href='$ruta'>Descargar archivo</a>";
              echo "</div>";
              echo "<div class='card-footer text-muted'>";
              echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal$codigo_carrera'>EDITAR CARRERA</button>";
              echo "<form action='procesar_eliminar_carrera.php?codigo=$codigo_carrera' method='POST' enctype='multipart/form-data'>";
              echo "<button type='submit' class='btn btn-danger' name='eliminar' style='margin-top: 10px;'>ELIMINAR CARRERA</button>";
              echo "</form>";

              //-- Modal -->
              echo "<div class='modal fade' id='exampleModal$codigo_carrera' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
              echo "<div class='modal-dialog' role='document'>";
              echo "<div class='modal-content'>";
              echo "<div class='modal-header'>";
              echo "<h5 class='modal-title' id='exampleModalLabel'>EDITAR CARRERA</h5>";
              echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
              echo "<span aria-hidden='true'>&times;</span>";
              echo "</button>";
              echo "</div>";
              echo "<div class='modal-body'>";
              //--------BODY--------------
              echo "<form action='procesar_editar_carrera.php?codigo_carrera=$codigo_carrera' method='POST' enctype='multipart/form-data'>";
              echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
              echo "<br>";
              echo "<input type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre_carrera'>";
              echo "<br>";
              echo "<br>";
              echo "<label style='color: black; font-weight: bold;'>Coordinador</label>";
              echo "<br>";
              echo "<div class='col-md'>";
              echo "<div class='form-group'>";
              $sql_coor = "SELECT id, nombre FROM coordinador;";
              $result_coor = $conn->query($sql_coor);
              echo "<select class='custom-select' id='coordinador' name='coordinador-editable'>";
              echo "<option value='$id_coordinador_drop' selected>$nombre_coordinador</option>";
              
              // Verificar si se encontraron resultados
              if ($result_coor->num_rows > 0) {
                // Iterar sobre los resultados y generar las opciones del select
                while ($row = $result_coor->fetch_assoc()) {
                  $id_coordinador_drop = $row['id'];
                  $nombre_coordinador_drop = $row['nombre'];
                  echo "<option value='$id_coordinador_drop'>$nombre_coordinador_drop</option>";
                }
              } else {
                echo "<option value=''>No hay opciones disponibles</option>";
              }
              echo "<option value=''>SIN COORDINADOR</option>";

              echo "</select>";
              echo "</div>";
              echo "</div>";
              echo "<br>";
              echo "<label style='color: black; font-weight: bold;'>Malla Curricular</label>";
              echo "<br>";
              echo "<div class='custom-file'>";
              echo "<input type='file' class='custom-file-input' id='validatedCustomFile' name='ruta-malla-editable'>";
              echo "<label class='custom-file-label' for='validatedCustomFile'>Selecciona archivo</label>";
              echo "</div>";
              echo "<br>";
              echo "<button type='submit' class='btn btn-success' style='margin-top: 10px;'>EDITAR</button>";
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

      <div class="tab-pane fade" id="materia" role="tabpanel" aria-labelledby="materia-tab">
        <br>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="color: black; font-weight: bold;">
                  AÑADIR MATERIA
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
              <form action="procesar_registrar_materia.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Codigo de materia</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa Codigo" name="codigo-materia">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Ingresa Nombre" name="nombre-materia">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Semestre</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Ingresa Semestre" name="semestre-materia">
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <?php
                        echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-materia'>";
                        echo "<option selected>Selecciona Carrera</option>";
                        // Verificar si se encontraron resultados
                        if ($result_carrera_materia_dropdown->num_rows > 0) {
                          // Iterar sobre los resultados y generar las opciones del select
                          while ($row = $result_carrera_materia_dropdown->fetch_assoc()) {
                            $codigo_carrera_materias = $row['codigo'];
                            $nombre_carrera_materias = $row['nombre'];
                            echo "<option value='$codigo_carrera_materias'>$nombre_carrera_materias</option>";
                          }
                        } else {
                          echo "<option value=''>No hay opciones disponibles</option>";
                        }

                        echo "</select>";
                      ?>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">AÑADIR</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <?php
            if ($result_carrera_materia->num_rows > 0) {
              while ($fila = $result_carrera_materia->fetch_assoc()) {
                $codigo_carrera_materia = $fila['codigo'];
                $nombre_carrera_materia = $fila['nombre']; 


                echo "<div class='col-sm-3'>";
                echo "<div class='card text-white mb-3' style='background-color: #33F0FF; color: black; height: 16rem;'>";
                echo "<div class='card-header' style='font-weight: bold; color: black;'>$codigo_carrera_materia</div>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title' style='color: black;'>$nombre_carrera_materia</h5>";
                echo "<a id='myLink' href='materias.php?codigo=" . urlencode($codigo_carrera_materia) . "' class='btn btn-dark'>Ver Materias</a>";

                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
            }
          ?>
        </div>
        
      </div>

    </div>
    <br>
  
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

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+L9tg5uZlXGz0G6X6fVIkL3X9Uupo9PTNb+s1E7I5ta9vc/" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

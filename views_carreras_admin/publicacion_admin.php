<?php
  require '../controladores/base_datos.php';
  require '../controladores/controlador_cookie_carrera.php';

  //OBTIENE EL NRC
  $nrc = $_GET['nrc'];
  // La sesión está iniciada y el valor de la cookie de sesión es correcto
  $username = $_SESSION['username']; // Leer el valor de la cookie de sesión

  if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
    $sql = "SELECT p.username, p.nombre, p.correo, p.password, p.carrera, p.descripcion, p.id_foto, p.rol, fp.ruta FROM perfil p INNER JOIN fotos_perfil fp ON p.id_foto = fp.id WHERE p.username = '$username';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $user = $row["username"];
      $id_foto = $row["id_foto"];
      $fotoPerfil = $row["ruta"];
      $rol = $row["rol"];
    } else {
      echo "No se encontraron resultados.";
    }

    $sql_nombre_materia = "SELECT nombre FROM materia WHERE nrc = '$nrc'";
    $resultado = $conn->query($sql_nombre_materia);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
      $row = $resultado->fetch_assoc();
      $nombreMateria = $row['nombre'];
    } else {
      $nombreMateria = "Materia no encontrada";
    }
 

  } else {
    // La sesión no está iniciada o el valor de la cookie de sesión no es correcto
    header('Location: login.php'); // Redirigir al usuario a la página de inicio de sesión
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $nombreMateria; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="../style/style.programacion2.css" rel="stylesheet" type="text/css">

  <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>

<body>
  <?php
    require '../menus/menu_carreras_admin.php';
  ?>

  <br>
  <br>
  <br>

  <div class="container">
  <p class="h1"><?php echo $nombreMateria ?></p>
    <div class="card">
      <div class="card-header">
        <img src="./<?php echo $fotoPerfil; ?>" id="foto" class="rounded me-2" alt="...">
        <strong class="me-auto"><?php echo $user; ?></strong>
      </div>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <form action="./procesar_publicacion_admin.php?nrc=<?php echo $_GET['nrc']; ?>" method="POST" enctype="multipart/form-data">
            <input type='hidden' name='nrc' value='<?php echo $_GET['nrc']; ?>'> <!-- Campo oculto con el ID de la publicación -->
            <input type="text" name="titulo" id="titulo" placeholder="Ingresa un título de publicación">
            <textarea name="contenido" id="contenido" placeholder="Escribe tu publicación"></textarea>
            <input type="file" name="archivo">
            <button type="submit">Publicar</button>
          </form>
          <footer class="blockquote-footer">
            <cite title="Source Title">
              <?php 
              date_default_timezone_set('America/Mexico_City'); 
              $fecha = date('Y-m-d');
              echo $fecha; ?>
            </cite>
          </footer>
        </blockquote>
      </div>
    </div>

    <?php
      if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
        // La sesión está iniciada y el valor de la cookie de sesión es correcto
        $username = $_SESSION['username']; // Leer el valor de la cookie de sesión
        $nrc = $_GET['nrc']; //Solo se usa para la consulta SQL

        $sql_publicacion = "SELECT * FROM post WHERE nrc_materia = '$nrc' ORDER BY fecha DESC";
        $resultado = $conn->query($sql_publicacion);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
          // Recorrer los resultados y mostrar las publicaciones
          while ($fila = $resultado->fetch_assoc()) {
            $id_publicacion = $fila['id']; // Obtener el ID de la publicación
            $username_publicacion = $fila['username'];
            $titulo = $fila['titulo'];
            $contenido = $fila['texto'];
            $archivo = $fila['ruta_archivo'];
            $fecha = $fila['fecha'];

            // Obtener la foto de perfil del usuario
            $sql_perfil = "SELECT fp.ruta FROM perfil p INNER JOIN fotos_perfil fp ON p.id_foto = fp.id WHERE p.username = '$username_publicacion';";
            $result_perfil = $conn->query($sql_perfil);

            if ($result_perfil->num_rows > 0) {
              $row_perfil = $result_perfil->fetch_assoc();
              $fotoPerfilPublicacion = $row_perfil["ruta"];
            } else {
              // Establecer una imagen de perfil predeterminada si no se encuentra la foto
              $fotoPerfilPublicacion = "./fotos_perfil/avatar_admin.jpg";
            }

            //Mostrar publicaciones
            echo "<br>";
            echo "<div class='card card-publicacion'>";
            echo "<div class='card-header'>";
            echo "<img src='./$fotoPerfilPublicacion' id='foto' class='rounded me-2' alt=''...'>";
            echo "<a href='./perfil.php?user=" . $username_publicacion . "' style='margin-left: 10px; color: black; font-weight: bold;'>" . $username_publicacion . "</a>";
            echo "</div>";
            echo "<div class='card-body'>";
            echo "<blockquote class='blockquote mb-0'>";
            
            echo "<h3 class='card-title'><strong class='me-auto';'>$titulo</strong></h3>";

            echo "<p class='card-text'>$contenido</p>";

            //Muestra archivo o foto
            if (!empty($archivo)) {
              if (exif_imagetype($archivo) !== false) {
                //require '../views_materias/';
                echo "<br>";
                echo "<img src='$archivo' alt='Imagen' id='foto-publicacion'>";
              } else {
                echo "<br>";
                echo "<a href='$archivo'>Descargar archivo</a>";
                echo "<br>";
              }
            }

            require_once "../views_materias/funciones.php";
           
            //Escribir comentario
            echo "<form action='./procesar_comentario_admin.php?$id_publicacion' method='POST' enctype='multipart/form-data'>";
            echo "<input type='hidden' name='id-publicacion' value='$id_publicacion'>"; // Campo oculto con el ID de la publicación
            echo "<br>";
            //echo "<textarea name='contenido-comentario' id='contenido-comentario' style='height: 4rem' placeholder='Escribe un comentario'></textarea>";
            echo "<div class='input-group mb-3'>";
            echo "<textarea type='text' class='form-control' name='contenido-comentario' id='contenido-comentario' placeholder='Escribe un comentario' aria-label='Recipient's username' aria-describedby='basic-addon2' style='height: 4rem; font-size: 16px;'></textarea>";
            echo "<div class='input-group-append'>";
            echo "<button class='btn btn-outline-secondary' type='submit' style='color: white; background-color: #D84222; font-size: 16px;'>Comentar</button>";
            echo "</div>";
            echo "</div>";
            echo "<input type='file' name='archivo-comentario'>";
            echo "<br>";
            echo "</form>";

            
            //MODAL ACTUALIZAR O ELIMINAR PUBLICACION
            if($rol == '1'){
              echo "<br>";
              echo "<form action='./procesar_eliminar_publicacion.php?id_publicacion=$id_publicacion' method='POST' enctype='multipart/form-data'>";
              echo "<button type='submit' class='btn btn-info' style='width: 100%; font-size: 16px;'>ELIMINAR PUBLICACION</button>";
              echo "</form>";
            }

            //Dropdown de comentarios
            echo "<br>";
            echo "<button type='button' class='btn btn-light' data-toggle='modal' data-target='#modal$id_publicacion' style='width: 100%; font-size: 16px;'>";
            echo "Ver Comentarios";
            echo "</button>";

            echo "<div class='modal fade bd-example-modal-lg' id='modal$id_publicacion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>";
            echo "<div class='modal-dialog modal-lg' role='document'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='exampleModalLongTitle'>COMENTARIOS $titulo</h5>";
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
            echo "<div class='modal-body'>";

            // Mostrar los comentarios
            $sql_comentarios = "SELECT c.username, c.fecha, c.texto, c.ruta_archivo, c.id FROM comentario c WHERE c.idPublicacion = '$id_publicacion' ORDER BY c.fecha DESC";
            $result_comentarios = $conn->query($sql_comentarios);

            // Mostrar comentarios
            if ($result_comentarios->num_rows > 0) {
              while ($fila_comentario = $result_comentarios->fetch_assoc()) {
                $id_comentario = $fila_comentario['id'];
                $username_comentario = $fila_comentario['username'];
                $fecha_comentario = $fila_comentario['fecha'];
                $texto_comentario = $fila_comentario['texto'];
                $ruta_archivo_comentario = $fila_comentario['ruta_archivo'];

                // Obtener la foto de perfil del usuario
                $sql_foto_comentario = "SELECT fp.ruta FROM perfil p INNER JOIN fotos_perfil fp ON p.id_foto = fp.id WHERE p.username = '$username_comentario';";
                $result_perfil = $conn->query($sql_foto_comentario);

                if ($result_perfil->num_rows > 0) {
                  $row_perfil = $result_perfil->fetch_assoc();
                  $fotoPerfilPublicacion = $row_perfil["ruta"];
                } else {
                  // Establecer una imagen de perfil predeterminada si no se encuentra la foto
                  $fotoPerfilPublicacion = "./fotos_perfil/avatar_admin.jpg";
                }

                echo "<br>";
                echo "<div class='card comentario'>";
                echo "<div class='card-header'>";
                echo "<img src='./$fotoPerfilPublicacion' id='foto' class='rounded me-2' alt=''>";
                echo "<a href='./perfil.php?user=" . $username_comentario . "' style='margin-left: 10px; color: black; font-weight: bold;'>" . $username_comentario . "</a>";
                echo "</div>";
                echo "<div class='card-body'>";
                echo "<blockquote class='blockquote mb-0'>";
                echo "<p class='card-text'>$texto_comentario</p>";

                if (!empty($ruta_archivo_comentario)) {
                  if (exif_imagetype($ruta_archivo_comentario) !== false) {
                    echo "<img src='$ruta_archivo_comentario' alt='Imagen' id='foto-comentario' style='border-radius: 15px; width: 10rem; height: 7.5rem;'>";
                  } else {
                    echo "<br>";
                    echo "<a href='$ruta_archivo_comentario'>Descargar archivo</a>";
                  }
                }

                //MODAL DE VALIDACION DE COMENTARIO
                if($rol == '1'){
                  echo "<br>";
                  echo "<form action='./procesar_eliminar_comentario.php?id_comentario=$id_comentario' method='POST' enctype='multipart/form-data'>";
                  echo "<button type='submit' class='btn btn-info' style='width: 100%; font-size: 16px;'>ELIMINAR COMENTARIO</button>";
                  echo "</form>";
              }

              //FIN MODAL VALIDAR COMENTARIO

                echo "<footer class='blockquote-footer' style='margin-top: 1rem;'><cite title='Source Title'>$fecha_comentario</cite></footer>";
                echo "</blockquote>";
                echo "</div>";
                echo "</div>";
              }
            } else {
              echo "<br>";
              echo "<br>";
              echo "<p>Aún no hay comentarios.</p>";
            }

            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<br>";
            //FIN DROPDOWN COMENTARIOS------------------------------------------------

            //Fecha
            echo "<footer class='blockquote-footer' style='margin-top: 1rem;'><cite title='Source Title'>$fecha</cite></footer>";
            echo "</blockquote>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "<div class='alert alert-info' role='alert' style='margin-top: 2rem;'>Aún no hay publicaciones en esta materia.</div>";
        }
      }
    ?>
  </div>
</body>

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

    function toggleComments(id) {
      var commentsSection = document.getElementById(`comments-${id}`);
      var commentsButton = document.getElementById(`button-${id}`);
      if (commentsSection.style.display === "none") {
        commentsSection.style.display = "block";
        commentsButton.textContent = "Ocultar comentarios";
      } else {
        commentsSection.style.display = "none";
        commentsButton.textContent = "Mostrar comentarios";
      }
    }
  </script>

</html>
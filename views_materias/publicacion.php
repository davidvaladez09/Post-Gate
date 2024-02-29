<?php
  require '../controladores/base_datos.php';
  require '../controladores/controlador_cookie_carrera.php';

  //OBTIENE EL NRC
  $nrc = $_GET['nrc'];
  //OBTIENE CARRERA
  $carrera = $_GET['carrera'];
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
      $carrera_usuario = $row['carrera'];
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
    require '../menus/menu_materias.php';
    require '../controladores/conrolador_chatbot.php';
  ?>

  <br>
  <br>
  <br>

  <div class="container">
  <p class="h1"><?php echo $nombreMateria ?></p>
    <?php
    date_default_timezone_set('America/Mexico_City'); 
    $fecha = date('Y-m-d');
      if($carrera_usuario === $carrera || $carrera === 'NV'){
          echo "<div class='card'>";
          echo "<div class='card-header'>";
          echo "<img src='./$fotoPerfil' id='foto' class='rounded me-2' alt='...''>";
          echo "<strong class='me-auto' style='margin-left:5px'>$user</strong>";
          echo "</div>";
          echo "<div class='card-body'>";
          echo "<blockquote class='blockquote mb-0'>";
          echo "<form action='./procesar_publicacion.php?nrc=" . $_GET['nrc'] . "' method='POST' enctype='multipart/form-data'>";
          echo "<input type='hidden' name='nrc' value='" . $_GET['nrc'] . "'>"; // Campo oculto con el ID de la publicación
          echo "<input type='text' name='titulo' id='titulo' placeholder='Ingresa un título de publicación'>";
          echo "<textarea name='contenido' id='contenido' placeholder='Escribe tu publicación'></textarea>";
          echo "<input type='file' name='archivo'>";
          echo "<button type='submit'>Publicar</button>";
          echo "</form>";
          echo "<footer class='blockquote-footer'>";
          echo "<cite title='Source Title'>"; 
          echo $fecha;
          echo "</cite>";
          echo "</footer>";
          echo "</blockquote>";
          echo "</div>";
          echo "</div>";
      } else {
        echo "<div class='alert alert-info' role='alert' style='margin-top: 3rem;'>Solo puedes compartir en los foros acordes a tu carrera.</div>";
        echo "<br>";
        echo "<br>";
      }
    ?>

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
            echo "<form action='./perfil.php' method='post'>";
            echo "<input type='hidden' name='user' value='" . $username_publicacion . "'>";
            echo "<img src='./$fotoPerfilPublicacion' id='foto' class='rounded me-2' alt=''...'>";
            echo "<button type='submit' style='background: none; border: none; padding: 0; margin-left: 10px; color: black; font-weight: bold; cursor: pointer; text-decoration: underline;'>" . $username_publicacion . "</button>";
            echo "</form>";
            echo "</div>";
            echo "<div class='card-body'>";
            echo "<blockquote class='blockquote mb-0'>";
            
            echo "<h3 class='card-title'><strong class='me-auto';'>$titulo</strong></h3>";

            echo "<p class='card-text'>$contenido</p>";

            //Muestra archivo o foto
            if (!empty($archivo)) {
              if (exif_imagetype($archivo) !== false) {
                echo "<br>";
                echo "<img src='$archivo' alt='Imagen' id='foto-publicacion'>";
              } elseif($archivo === "") {
                echo "NO HAY ARCHIVO";
              } else {
                echo "<br>";
                echo "<a href='$archivo'>Descargar archivo</a>";
                echo "<br>";
              }
            }

            require_once "./funciones.php";
           
            //Escribir comentario
            echo "<form action='./procesar_comentario.php?$id_publicacion&nrc=$nrc&carrera=$carrera' method='POST' enctype='multipart/form-data'>";
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
            if($username_publicacion == $username){
              echo "<br>";
              echo "<button type='button' class='btn btn-info' data-toggle='modal' data-target='#$id_publicacion' style='width: 100%; font-size: 16px;'>";
              echo "Modificar o Eliminar Publicacion";
              echo "</button>";

              echo "<div class='modal fade' id='$id_publicacion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>";
              echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
              echo "<div class='modal-content'>";
              echo "<div class='modal-header'>";
              echo "<h5 class='modal-title' id='exampleModalLongTitle'>EDITAR O ELIMINAR PUBLICACION</h5>";
              echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
              echo "<span aria-hidden='true'>&times;</span>";
              echo "</button>";
              echo "</div>";
              echo "<div class='modal-body'>";
                  
              // FORMULARIO DE ACTUALIZACION
              editarPublicacion($username_publicacion, $username, $id_publicacion, $titulo, $contenido); 
              //------------------

              echo "</div>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
              echo "<br>";

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
                echo "<form action='./perfil.php' method='post'>";
                echo "<input type='hidden' name='user' value='" . $username_comentario . "'>";
                echo "<img src='./$fotoPerfilPublicacion' id='foto' class='rounded me-2' alt=''>";
                echo "<button type='submit' style='background: none; border: none; padding: 0; margin-left: 10px; color: black; font-weight: bold; cursor: pointer; text-decoration: underline;'>" . $username_comentario . "</button>";
                echo "</form>";
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
                if($username_comentario == $username){
                  echo "<br>";
                  echo "<br>";
                  echo "<div id='accordion'>";
                  echo "<div class='card'>";
                  echo "<div class='card-header' id='heading$id_comentario'>";
                  echo "<h5 class='mb-0'>";
                  echo "<button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapse$id_comentario' aria-expanded='false' aria-controls='collapse$id_publicacion' style='font-size: 16px; color: black'>Editar o Eliminar Comentario</button>";
                  echo "</h5>";
                  echo "</div>";
                  echo "<div id='collapse$id_comentario' class='collapse' aria-labelledby='heading$id_comentario' data-parent='#accordion'>";
                  echo "<div class='card-body'>";

                  //FORMULARIO DE ACTUALIZACION DE COMENTARIO
                  echo "<form action='./procesar_editar_comentario.php?id_comentario=$id_comentario&nrc=$nrc&carrera=$carrera' method='POST' enctype='multipart/form-data'>";
                  echo "<input type='hidden' name='id-comentario' value='$id_comentario'>";
                  echo "<textarea name='contenido-editable-comentario' id='contenido-editable' style='height: 4rem'>$texto_comentario</textarea>";
                  echo "<input type='file' name='archivo-editable-comentario'>";
                  echo "<br>";
                  echo "<br>";
                  echo "<button type='submit' id='boton-editar' name='actualizar'>Editar</button>";
                  echo "<button type='submit' id='boton-eliminar' name='borrar' style='margin-left: 5px;'>Eliminar</button>";
                  echo "<br>";
                  echo "</form>";
                  //FIN FORMULARIO ACTUALIZACION COMENTARIO

                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
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
          echo "<div class='alert alert-info' role='alert' style='margin-top: 3rem; margin-left: 10px;'>Aún no hay publicaciones en esta materia.</div>";
        }
      }
    ?>
  </div>
</body>

<script>
  let inactivityTime = 60; // Tiempo de inactividad en segundos (ejemplo: 5 minutos)
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
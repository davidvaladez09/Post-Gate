<?php
  require '../controladores/base_datos.php';
  require '../controladores/controlador_cookie_carrera.php';

  //OBTIENE EL NRC
  $codigo = $_GET['codigo'];
  $carrera_compartida = 'COMPARTIDA';
  $semestre_compartido = '0';

  // La sesión está iniciada y el valor de la cookie de sesión es correcto
  $username = $_SESSION['username']; // Leer el valor de la cookie de sesión

  if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
    $sql = "SELECT * FROM materia WHERE carrera = '$codigo' ORDER BY semestre ASC;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $nrc = $fila["nrc"];
        $nombre = $fila["nombre"];
        $semestre = $fila["semestre"];
        $carrera = $fila["carrera"];
    } else {
        $nombre_carrera = "Carrera no encontrada";
    }

  } else {
    // La sesión no está iniciada o el valor de la cookie de sesión no es correcto
    header('Location: login.php'); // Redirigir al usuario a la página de inicio de sesión
    exit();
  }

  $sql_carrera_materia = "SELECT * FROM carrera;";
  $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $carrera; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="../style/style.informatica.css" rel="stylesheet" type="text/css"> 

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
    <p class="h1"><?php echo $carrera; ?></p>

    <div class="row">
        <?php
            if($carrera == 'INNI' || $carrera == 'INCO'){
                if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
                    $sql_materias_compartidas = "SELECT * FROM materia WHERE carrera = '$carrera_compartida' AND semestre = '$semestre_compartido'";
                    $resultado = $conn->query($sql_materias_compartidas);
            
                    if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $nrc_materia_compartida = $fila['nrc']; // Obtener el ID de la publicación
                        $nombre_materia_compartida = $fila['nombre'];
                        $semestre_materia_compartida = $fila['semestre'];
                        $carrera_materia_compartida = $fila['carrera'];
            
            
                        echo "<div class='col-sm-3'>";
                        echo "<div class='card text-white mb-3' style='background-color: #33F0FF; color: black; height: 30rem;'>";
                        echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre_materia_compartida</div>";
                        echo "<div class='card-body'>";
                        echo "<p class='card-text' style='color: black;'>Nombre: $nombre_materia_compartida</p>";
                        echo "<p class='card-text' style='color: black;'>Codigo: $nrc_materia_compartida</p>";
                        echo "<p class='card-text' style='color: black;'>Carrera: $carrera_materia_compartida</p>";
                        echo "<p class='card-text' style='color: black;'>Semestre: $semestre_materia_compartida</p>";
                        echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc_materia_compartida' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc_materia_compartida' tabindex='-1' role='dialog' aria-labelledby='$nrc_materia_compartida' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc_materia_compartida' style='color: black;'>$nrc_materia_compartida</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc_materia_compartida' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc_materia_compartida' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre_materia_compartida'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera_materia_compartida' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre_materia_compartida'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        echo "<br>";
                        echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc_materia_compartida' class='btn btn-danger'>Eliminar Materia</a>";
            
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    }
            
                }
            }
        ?> 
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nrc = $row["nrc"];
                    $nombre = $row["nombre"];
                    $semestre = $row["semestre"];
                    $carrera = $row["carrera"];

                    switch($semestre){
                        case '1':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #F9221B; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;

                        case '2':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #6594DC; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";

                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";

                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '3':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #35E3AE; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '4':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #F582E0; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '5':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #B7DFFA; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '6':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #B7FACE; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '7':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #FFB260; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '8':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #DBFF60; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '9':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #FF60A1; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                        case '10':
                            echo "<div class='col-sm-3'>";
                            echo "<div class='card text-white mb-3' style='background-color: #B290F5; color: black; height: 30rem;'>";
                            echo "<div class='card-header' style='font-weight: bold; color: black;'>$nombre</div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='color: black;'>Nombre: $nombre</p>";
                            echo "<p class='card-text' style='color: black;'>Codigo: $nrc</p>";
                            echo "<p class='card-text' style='color: black;'>Carrera: $carrera</p>";
                            echo "<p class='card-text' style='color: black;'>Semestre: $semestre</p>";
                            echo "<br>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#$nrc' style='width: 100%'>Editar Materia</button>";

                            echo "<div class='modal fade' id='$nrc' tabindex='-1' role='dialog' aria-labelledby='$nrc' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='$nrc' style='color: black;'>$nrc</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='procesar_editar_materia.php?nrc=$nrc' method='POST' enctype='multipart/form-data'>";
                            echo "<label style='color: black; font-weight: bold;'>Codigo de Materia</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='email' style='width: 100%; border-radius: 5px' value='$nrc' readOnly>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Nombre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='text' name='nombre-editable' style='width: 100%; border-radius: 5px' value='$nombre'>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Carrera</label>";
                            echo "<br>";
                            $sql_carrera_materia = "SELECT * FROM carrera;";
                            $result_carrera_materia_dropdown = $conn->query($sql_carrera_materia);
                            echo "<select class='custom-select' id='inputGroupSelect02' name='carrera-editable'>";
                            echo "<option value='$carrera' selected>Selecciona Carrera</option>";
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
                            echo "<br>";
                            echo "<br>";
                            echo "<label style='color: black; font-weight: bold;'>Semestre</label>";
                            echo "<br>";
                            echo "<input class='form-control' type='number' name='semestre-editable' style='width: 100%; border-radius: 5px' value='$semestre'>";
                            echo "<br>";
                            echo "<br>";
                            echo "<button type='submit' class='btn btn-success' sytle='margin-top: 10px;'>EDITAR</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "<br>";
                            echo "<a href='./procesar_eliminar_materia.php?nrc=$nrc' class='btn btn-danger'>Eliminar Materia</a>";
                    
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            break;
                    }
                }  
            } else {
                echo "No se encontraron resultados.";
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
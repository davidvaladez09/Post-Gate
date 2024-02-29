<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $codigo_carrera = $_GET['codigo_carrera'];
    $nombre_editable = $_POST['nombre-editable'];
    $coordinador_editable = $_POST['coordinador-editable'];
    
    $archivo = $_FILES['ruta-malla-editable'];
    $nombreArchivo = $archivo['name'];
    $rutaTemporal = $archivo['tmp_name'];
    $rutaDestino = '../archivos/' . $nombreArchivo;


    if (!empty($nombre_editable) && !empty($coordinador_editable) && !empty($rutaDestino)) {
        if ($_FILES['ruta-malla-editable']['size'] > 0) {
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                $sql = "UPDATE carrera SET nombre = '$nombre_editable', IdCoordinador = '$coordinador_editable', rutaMallaCurricular = '$rutaDestino' WHERE codigo = '$codigo_carrera';";
                
                if ($conn->query($sql)) {
                    // Mostrar el mensaje de registro realizado en una notificación flotante
                    echo '<script>';
                    echo 'alert("INFORMACION ACTUALIZADA");';
                    echo 'window.location.href = "cambiar_info.php";';
                    echo '</script>';
                    exit();
                } else {
                    echo '<script>';
                    echo 'alert("ERROR AL ACTUALIZAR INFORMACION");';
                    echo 'window.location.href = "cambiar_info.php";';
                    echo '</script>';
                    exit();
                }
            } else {
                // Mostrar el mensaje de error si no se pudo mover el archivo
                echo '<script>';
                echo 'alert("ERROR AL MOVER EL ARCHIVO");';
                echo 'window.location.href = "cambiar_info.php";';
                echo '</script>';
                exit();
            }
        }
    }
?>
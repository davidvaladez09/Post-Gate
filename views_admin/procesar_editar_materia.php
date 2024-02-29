<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $nrc = $_GET['nrc'];
    $nombre_editable = $_POST['nombre-editable'];
    $carrera_editable = $_POST['carrera-editable'];
    $semestre_editable = $_POST['semestre-editable'];

    if(!empty($nombre_editable) && !empty($carrera_editable) && !empty($semestre_editable)){
        $sql = "UPDATE materia SET nombre = '$nombre_editable', semestre = '$semestre_editable', carrera = '$carrera_editable' WHERE nrc = '$nrc';";
        
        if ($conn->query($sql)) {
            // Mostrar el mensaje de registro realizado en una notificación flotante
            echo '<script>';
            echo 'alert("MATERIA ACTUALIZADA");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL ACTUALIZAR MATERIA");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        }
    
    }

?>
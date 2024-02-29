<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $codigo = $_POST['codigo-materia'];
    $nombre = $_POST['nombre-materia'];
    $semestre = $_POST['semestre-materia'];
    $carrera = $_POST['carrera-materia'];


    if(!empty($codigo) || !empty($nombre) || !empty($semestre) || !empty($carrera)){
        
        $sql = "INSERT INTO materia (nrc, nombre, semestre, carrera) VALUES ('$codigo', '$nombre', '$semestre', '$carrera');";
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("MATERIA AÑADIDA CORRECTAMENTE");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("MATERIA AL AÑADIR CARRERA");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        }
    } else {
        // Mostrar el mensaje de registro realizado en una notificación flotante
        echo '<script>';
        echo 'alert("DEBES DE COMPLETAR TODOS LOS CAMPOS.");';
        echo 'window.location.href = "cambiar_info.php";';
        echo '</script>';
        exit();
    }

?>
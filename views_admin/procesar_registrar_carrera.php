<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $codigo = $_POST['codigo-nueva-carrera'];
    $nombre = $_POST['nombre-nueva-carrera'];
    $coordinador = $_POST['coordinador-nueva-carrera'];

    $archivo = $_FILES['malla-nueva-carrera'];
    $nombreArchivo = $archivo['name'];
    $rutaTemporal = $archivo['tmp_name'];
    $rutaDestino = '../archivos/' . $nombreArchivo;

    if(!empty($codigo) || !empty($nombre) || !empty($coordinador)){
        
        $sql = "INSERT INTO carrera (codigo, nombre, IdCoordinador, rutaMallaCurricular) VALUES ('$codigo', '$nombre', '$coordinador', '$rutaDestino');";
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("CARRERA AÑADIDA CORRECTAMENTE");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL AÑADIR CARRERA");';
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
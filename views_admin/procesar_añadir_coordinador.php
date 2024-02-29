<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    if(!empty($nombre) && !empty($correo) && !empty($telefono)){
        
        $sql = "INSERT INTO coordinador(nombre, correo, telefono) VALUES ('$nombre', '$correo', '$telefono');";
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("COORDINADOR AÑADIDO CORRECTAMENTE");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL AÑADIR COORDINADOR");';
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
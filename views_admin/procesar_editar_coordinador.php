<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $id_coordinador = $_GET['id_coordinador'];
    $nombre_editable = $_POST['nombre-editable'];
    $correo_editable = $_POST['correo-editable'];
    $telefono_editable = $_POST['telefono-editable'];

    if(!empty($nombre_editable) && !empty($correo_editable) && !empty($telefono_editable)){
        $sql = "UPDATE coordinador SET nombre = '$nombre_editable', correo = '$correo_editable', telefono = '$telefono_editable' WHERE id = '$id_coordinador';";
        
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
    
    }

?>
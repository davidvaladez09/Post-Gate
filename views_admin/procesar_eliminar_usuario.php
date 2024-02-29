<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $username = $_GET['username'];

    // Realizar la consulta SQL para eliminar el coordinador
    $sql = "DELETE FROM perfil WHERE username = '$username'";

    if ($conn->query($sql)) {
        echo '<script>';
        echo 'alert("USUARIO ELIMINADO CORRECTAMENTE");';
        echo 'window.location.href = "eliminar_usuario.php";';
        echo '</script>';
        exit();
    } else {
        echo '<script>';
        echo 'alert("ERROR AL ELIMINAR USUARIO \n COORDINADOR LIGADO A CARRERA");';
        echo 'window.location.href = "eliminar_usuario.php";';
        echo '</script>';
        exit();
    }
?>

<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $id_coordinador = $_GET['id_coordinador'];

    // Realizar la consulta SQL para eliminar el coordinador
    $sql = "DELETE FROM coordinador WHERE id = '$id_coordinador'";

    try {
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("COORDINADOR ELIMINADO CORRECTAMENTE");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL ELIMINAR COORDINADOR \n COORDINADOR LIGADO A CARRERA");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'alert("ERROR AL ELIMINAR COORDINADOR \n COORDINADOR LIGADO A CARRERA");';
        echo 'window.location.href = "cambiar_info.php";';
        echo '</script>';
        exit();
    }
?>

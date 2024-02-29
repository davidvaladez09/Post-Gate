<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $codigo = $_GET['codigo'];

    // Realizar la consulta SQL para eliminar el coordinador
    $sql = "DELETE FROM carrera WHERE codigo = '$codigo'";

    try {
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("CARRERA ELIMINADA CORRECTAMENTE");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL ELIMINAR CARRERA \n COORDINADOR LIGADO A CARRERA");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'alert("ERROR AL ELIMINAR CARRERA \n COORDINADOR LIGADO A CARRERA");';
        echo 'window.location.href = "cambiar_info.php";';
        echo '</script>';
        exit();
    }
?>

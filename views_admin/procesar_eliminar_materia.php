<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $nrc = $_GET['nrc'];

    // Realizar la consulta SQL para eliminar la materia
    $sql = "DELETE FROM materia WHERE nrc = '$nrc'";

    try {
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("MATERIA ELIMINADA CORRECTAMENTE");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL ELIMINAR MATERIA: ' . $conn->error . '");';
            echo 'window.location.href = "cambiar_info.php";';
            echo '</script>';
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'alert("NO SE PUEDE ELIMINAR LA MATERIA. HAY PUBLICACIONES EN EL APARTADO.");';
        echo 'window.location.href = "cambiar_info.php";';
        echo '</script>';
        exit();
    }
?>

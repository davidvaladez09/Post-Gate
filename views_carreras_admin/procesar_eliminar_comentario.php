<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $id_comentario = $_GET['id_comentario'];

    // Realizar la consulta SQL para eliminar la materia
    $sql = "DELETE FROM comentario WHERE id = '$id_comentario'";

    try {
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("COMENTARIO ELIMINADO CORRECTAMENTE");';
            echo 'window.location.href = "../Main_admin.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL ELIMINAR COMENTARIO: ' . $conn->error . '");';
            echo 'window.location.href = "../Main_admin.php";';
            echo '</script>';
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'alert("NO SE PUEDE ELIMINAR EL COMENTARIO. HAY COMENTARIOS EN EL APARTADO.");';
        echo 'window.location.href = "../Main_admin.php";';
        echo '</script>';
        exit();
    }
?>

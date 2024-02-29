<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $id_publicacion = $_GET['id_publicacion'];

    // Realizar la consulta SQL para eliminar la materia
    $sql = "DELETE FROM post WHERE id = '$id_publicacion'";

    try {
        if ($conn->query($sql)) {
            echo '<script>';
            echo 'alert("PUBLICACION ELIMINADA CORRECTAMENTE");';
            echo 'window.location.href = "../Main_admin.php";';
            echo '</script>';
            exit();
        } else {
            echo '<script>';
            echo 'alert("ERROR AL ELIMINAR PUBLICACION: ' . $conn->error . '");';
            echo 'window.location.href = "../Main_admin.php";';
            echo '</script>';
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        echo '<script>';
        echo 'alert("NO SE PUEDE ELIMINAR LA PUBLICACION. HAY COMENTARIOS EN EL APARTADO.");';
        echo 'window.location.href = "../Main_admin.php";';
        echo '</script>';
        exit();
    }
?>

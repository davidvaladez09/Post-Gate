<?php
require '../controladores/base_datos.php';
require '../controladores/controlador_cookie_carrera.php';

$carrera = $_GET['carrera'];
$nrc = $_GET['nrc']; // Obtener el valor de nrc de la URL

$numeroAleatorio = rand(1, 1000);

date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');

// La sesión está iniciada y el valor de la cookie de sesión es correcto
$username = $_SESSION['username']; // Leer el valor de la cookie de sesión

$archivo = $_FILES['archivo-editable-comentario'];
$nombreArchivo = $username . $numeroAleatorio . $archivo['name'];
$rutaTemporal = $archivo['tmp_name'];
$rutaDestino = '../archivos_post/' . $nombreArchivo;

if (isset($_POST['actualizar'])) {
    if (isset($_POST['id-comentario'])) {
        $id_comentario = $_POST['id-comentario'];
    
        // Obtener los datos actualizados de la publicación
        $texto_actualizacion = $_POST['contenido-editable-comentario'];
    
        // Verificar si se proporcionó un archivo para actualizar
        if ($_FILES['archivo-editable-comentario']['error'] === UPLOAD_ERR_NO_FILE) {

            $sql_actualizacion_comentario = "UPDATE comentario SET texto = '$texto_actualizacion', fecha = '$fecha' WHERE id = '$id_comentario';";
    
            if ($conn->query($sql_actualizacion_comentario)) {
                // Mostrar el mensaje de actualización realizado en una notificación flotante
                echo '<script>';
                echo 'alert("COMENTARIO ACTUALIZADO");';
                echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                echo '</script>';
                exit();
            } else {
                // Mostrar el mensaje de error si no se pudo realizar la actualización
                echo '<script>';
                echo 'alert("ERROR AL ACTUALIZAR COMENTARIO");';
                echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                echo '</script>';
                exit();
            }
        } else {
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                $sql_actualizacion_comentario = "UPDATE comentario SET texto = '$texto_actualizacion', ruta_archivo = '$rutaDestino', fecha = '$fecha' WHERE id = '$id_comentario';";
    
                if ($conn->query($sql_actualizacion_comentario)) {
                    // Mostrar el mensaje de actualización realizado en una notificación flotante
                    echo '<script>';
                    echo 'alert("COMENTARIO ACTUALIZADO");';
                    echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                    echo '</script>';
                    exit();
                } else {
                    // Mostrar el mensaje de error si no se pudo realizar la actualización
                    echo '<script>';
                    echo 'alert("ERROR AL ACTUALIZAR COMENTARIO");';
                    echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                    echo '</script>';
                    exit();
                }
            } else {
                // Mostrar el mensaje de error si no se pudo mover el archivo
                echo '<script>';
                echo 'alert("ERROR AL MOVER EL ARCHIVO");';
                echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                echo '</script>';
                exit();
            }
        }
    } else {
        // Mostrar mensaje de error si no se recibió el ID de la publicación
        echo '<script>';
        echo 'alert("No se proporcionó el ID del comentario.");';
        echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
        echo '</script>';
        exit();
    }
} elseif (isset($_POST['borrar'])) {
    if (isset($_POST['id-comentario'])) {
        $id_comentario = $_POST['id-comentario'];
    
        $sql_eliminar_comentario = "DELETE FROM comentario WHERE id = '$id_comentario'";;
    
        if ($conn->query($sql_eliminar_comentario)) {
            // Mostrar el mensaje de actualización realizado en una notificación flotante
            echo '<script>';
            echo 'alert("COMENTARIO ELIMINADO");';
            echo 'history.back();';
            echo '</script>';
            exit();
        } else {
            // Mostrar el mensaje de error si no se pudo realizar la actualización
            echo '<script>';
            echo 'alert("ERROR AL ELIMINAR COMENTARIO");';
            echo 'history.back();';
            echo '</script>';
            exit();
        }
    
    
    } else {
        // Mostrar mensaje de error si no se recibió el ID de la publicación
        echo '<script>';
        echo 'alert("No se proporcionó el ID de la publicación.");';
        echo 'history.back();';
        echo '</script>';
        exit();
    }
}


?>

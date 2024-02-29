<?php
require '../controladores/base_datos.php';
require '../controladores/controlador_cookie_carrera.php';

$numeroAleatorio = rand(1, 1000);

date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');

// La sesión está iniciada y el valor de la cookie de sesión es correcto
$username = $_SESSION['username']; // Leer el valor de la cookie de sesión

$archivo = $_FILES['archivo-editable'];
$nombreArchivo = $username . $numeroAleatorio . $archivo['name'];
$rutaTemporal = $archivo['tmp_name'];
$rutaDestino = '../archivos_post/' . $nombreArchivo;

// Obtener los datos actualizados de la publicación
$titulo_actualizacion = $_POST['titulo-editable'];
$texto_actualizacion = $_POST['contenido-editable'];

if (isset($_POST['actualizar'])) {
    if (isset($_POST['id-publicacion'])) {
        $id_publicacion = $_POST['id-publicacion'];
    
        // Verificar si se proporcionó un archivo para actualizar
        if ($_FILES['archivo-editable']['error'] === UPLOAD_ERR_NO_FILE) {

            $sql_actualizacion = "UPDATE post SET titulo = '$titulo_actualizacion', texto = '$texto_actualizacion', fecha = '$fecha' WHERE id = '$id_publicacion';";
    
            if ($conn->query($sql_actualizacion)) {
                // Mostrar el mensaje de actualización realizado en una notificación flotante
                echo '<script>';
                echo 'alert("PUBLICACION ACTUALIZADA");';
                echo 'history.back();';
                echo '</script>';
                exit();
            } else {
                // Mostrar el mensaje de error si no se pudo realizar la actualización
                echo '<script>';
                echo 'alert("ERROR AL ACTUALIZAR PUBLICACIÓN");';
                echo 'history.back();';
                echo '</script>';
                exit();
            }
        } else {
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                $sql_actualizacion = "UPDATE post SET titulo = '$titulo_actualizacion', texto = '$texto_actualizacion', ruta_archivo = '$rutaDestino', fecha = '$fecha' WHERE id = '$id_publicacion';";
    
                if ($conn->query($sql_actualizacion)) {
                    echo '<script>';
                    echo 'alert("PUBLICACION ACTUALIZADA");';
                    echo 'history.back();';
                    echo '</script>';
                    exit();
                } else {
                    // Mostrar el mensaje de error si no se pudo realizar la actualización
                    echo '<script>';
                    echo 'alert("ERROR AL ACTUALIZAR PUBLICACIÓN");';
                    echo 'history.back();';
                    echo '</script>';
                    exit();
                }
            } else {
                // Mostrar el mensaje de error si no se pudo mover el archivo
                echo '<script>';
                echo 'alert("ERROR AL MOVER EL ARCHIVO");';
                echo 'history.back();';
                echo '</script>';
                exit();
            }
        }
    } else {
        // Mostrar mensaje de error si no se recibió el ID de la publicación
        echo '<script>';
        echo 'alert("No se proporcionó el ID de la publicación.");';
        echo 'history.back();';
        echo '</script>';
        exit();
    }
} elseif (isset($_POST['borrar'])) {
    if (isset($_POST['id-publicacion'])) {
        $id_publicacion = $_POST['id-publicacion'];
    
        $sql_actualizacion = "DELETE FROM post WHERE id = '$id_publicacion'";;
    
        if ($conn->query($sql_actualizacion)) {
            // Mostrar el mensaje de actualización realizado en una notificación flotante
            echo '<script>';
            echo 'alert("PUBLICACION ELIMINADA");';
            echo 'history.back();';
            echo '</script>';
            exit();
        } else {
            // Mostrar el mensaje de error si no se pudo realizar la actualización
            echo '<script>';
            echo 'alert("ERROR AL ELIMINAR PUBLICACIÓN");';
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

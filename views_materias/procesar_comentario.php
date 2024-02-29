<?php
require '../controladores/base_datos.php';
require '../controladores/controlador_cookie_carrera.php';

$carrera = $_GET['carrera'];
$nrc = $_GET['nrc']; // Obtener el valor de nrc de la URL

$numeroAleatorio = rand(1, 1000);

date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');
$texto_comentario = $_POST['contenido-comentario'];
$archivo = $_FILES['archivo-comentario'];
$nombreArchivo = $username . $numeroAleatorio . $archivo['name'];
$rutaTemporal = $archivo['tmp_name'];
$rutaDestino = '../archivos_post/' . $nombreArchivo;

// La sesión está iniciada y el valor de la cookie de sesión es correcto
$username = $_SESSION['username']; // Leer el valor de la cookie de sesión

if(!empty($texto_comentario)){
    if (isset($_POST['id-publicacion'])) {
        $id_publicacion = $_POST['id-publicacion'];
    
        // Verificar si se proporcionó un archivo para actualizar
        if ($_FILES['archivo-comentario']['error'] === UPLOAD_ERR_NO_FILE) {
            $rutaArchivoNull = '';
            $sql_actualizacion = "INSERT INTO comentario (idPublicacion, username, fecha, texto, ruta_archivo) VALUES ('$id_publicacion', '$username', '$fecha', '$texto_comentario', '$rutaArchivoNull')";
    
            if ($conn->query($sql_actualizacion)) {
                // Mostrar el mensaje de actualización realizado en una notificación flotante
                echo '<script>';
                echo 'alert("COMENTARIO REALIZADO");';
                echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                echo '</script>';
                exit();
            } else {
                // Mostrar el mensaje de error si no se pudo realizar la actualización
                echo '<script>';
                echo 'alert("ERROR AL REALIZAR COMENTARIO");';
                echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                echo '</script>';
                exit();
            }
        } else {    
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                $sql_actualizacion = "INSERT INTO comentario (idPublicacion, username, fecha, texto, ruta_archivo) VALUES ('$id_publicacion', '$username', '$fecha', '$texto_comentario', '$rutaDestino')";
    
                if ($conn->query($sql_actualizacion)) {
                    // Mostrar el mensaje de actualización realizado en una notificación flotante
                    echo '<script>';
                    echo 'alert("COMENTARIO REALIZADO");';
                    echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                    echo '</script>';
                    exit();
                } else {
                    // Mostrar el mensaje de error si no se pudo realizar la actualización
                    echo '<script>';
                    echo 'alert("ERROR AL REALIZAR COMENTARIO");';
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
        echo 'alert("No se proporcionó el ID de la publicación.");';
        echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
        echo '</script>';
        exit();
    }
} else {
    // Mostrar mensaje de error si no se recibió el ID de la publicación
    echo '<script>';
    echo 'alert("No puedes realizar un comentario vacio.");';
    echo 'window.location.href = "publicacion.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
    echo '</script>';
}


?>

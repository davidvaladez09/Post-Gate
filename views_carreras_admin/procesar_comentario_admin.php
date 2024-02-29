<?php
require '../controladores/base_datos.php';
require '../controladores/controlador_cookie_carrera.php';

$numeroAleatorio = rand(1, 1000);

date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');
$texto_comentario = $_POST['contenido-comentario'];

// La sesión está iniciada y el valor de la cookie de sesión es correcto
$username = $_SESSION['username']; // Leer el valor de la cookie de sesión
if(!empty($texto_comentario)){
    if (isset($_POST['id-publicacion'])) {
        $id_publicacion = $_POST['id-publicacion'];
    
        // Verificar si se proporcionó un archivo para actualizar
        if ($_FILES['archivo-comentario']['size'] > 0) {
            $archivo = $_FILES['archivo-comentario'];
            $nombreArchivo = $username . $numeroAleatorio . $archivo['name'];
            $rutaTemporal = $archivo['tmp_name'];
            $rutaDestino = '../archivos/' . $nombreArchivo;
    
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                $sql_actualizacion = "INSERT INTO comentario (idPublicacion, username, fecha, texto, ruta_archivo) VALUES ('$id_publicacion', '$username', '$fecha', '$texto_comentario', '$rutaDestino')";
    
                if ($conn->query($sql_actualizacion)) {
                    // Mostrar el mensaje de actualización realizado en una notificación flotante
                    echo '<script>';
                    echo 'alert("COMENTARIO REALIZADO");';
                    echo 'history.back();';
                    echo 'window.location.reload();'; // Recargar la página anterior
                    echo '</script>';
                    exit();
                } else {
                    // Mostrar el mensaje de error si no se pudo realizar la actualización
                    echo '<script>';
                    echo 'alert("ERROR AL REALIZAR COMENTARIO");';
                    echo 'history.back();';
                    echo 'window.location.reload();'; // Recargar la página anterior
                    echo '</script>';
                    exit();
                }
            } else {
                // Mostrar el mensaje de error si no se pudo mover el archivo
                echo '<script>';
                echo 'alert("ERROR AL MOVER EL ARCHIVO");';
                echo 'history.back();';
                echo 'window.location.reload();'; // Recargar la página anterior
                echo '</script>';
                exit();
            }
        } else {    
            $sql_actualizacion = "INSERT INTO comentario (idPublicacion, username, fecha, texto) VALUES ('$id_publicacion', '$username', '$fecha', '$texto_comentario')";
    
            if ($conn->query($sql_actualizacion)) {
                // Mostrar el mensaje de actualización realizado en una notificación flotante
                echo '<script>';
                echo 'alert("COMENTARIO REALIZADO");';
                echo 'history.back();';
                echo 'window.location.reload();'; // Recargar la página anterior
                echo '</script>';
                exit();
            } else {
                // Mostrar el mensaje de error si no se pudo realizar la actualización
                echo '<script>';
                echo 'alert("ERROR AL REALIZAR COMENTARIO");';
                echo 'history.back();';
                echo 'window.location.reload();'; // Recargar la página anterior
                echo '</script>';
                exit();
            }
        }
    } else {
        // Mostrar mensaje de error si no se recibió el ID de la publicación
        echo '<script>';
        echo 'alert("No se proporcionó el ID de la publicación.");';
        echo 'history.back();';
        echo 'window.location.reload();'; // Recargar la página anterior
        echo '</script>';
        exit();
    }
} else {
    // Mostrar mensaje de error si no se recibió el ID de la publicación
    echo '<script>';
    echo 'alert("No puedes realizar un comentario vacio.");';
    echo 'history.back();';
    echo 'window.location.reload();'; // Recargar la página anterior
    echo '</script>';
}


?>

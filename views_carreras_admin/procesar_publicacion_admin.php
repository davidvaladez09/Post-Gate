<?php
require '../controladores/base_datos.php';
require '../controladores/controlador_cookie_carrera.php';


// La sesión está iniciada y el valor de la cookie de sesión es correcto
$username = $_SESSION['username'];
//Generar numero aleatorio
$numeroAleatorio = rand(1, 1000);
// Variables de registro
$titulo = $_POST['titulo'];
$texto = $_POST['contenido'];
$nrc = $_GET['nrc']; // Obtener el valor de nrc de la URL
$carrera = $_GET['carrera'];

$archivo = $_FILES['archivo'];
$nombreArchivo =  $username . $numeroAleatorio . $archivo['name'];
$rutaTemporal = $archivo['tmp_name'];
$rutaDestino = '../archivos_post_admin/' . $nombreArchivo;


date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d H:i:s');


//Obtener carrera de usuario logueado
$sql = "SELECT carrera FROM perfil  WHERE username = '$username';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $carrera = $row["carrera"];
} else {
    echo "No se encontraron resultados.";
}


if (!empty($titulo)) {
    if (!empty($texto)) {
            if ($_FILES['archivo']['error'] === UPLOAD_ERR_NO_FILE) {
                $rutaArchivoNull = '';
                $sql_registro = "INSERT INTO post (titulo, username, carrea, nrc_materia, texto, ruta_archivo, fecha) VALUES ('$titulo', '$username', '$carrera', '$nrc', '$texto', '$rutaArchivoNull', '$fecha');";

                if ($conn->query($sql_registro)) {
                    // Mostrar el mensaje de registro realizado en una notificación flotante
                    echo '<script>';
                    echo 'alert("PUBLICACION REALIZADA");';
                    echo 'window.location.href = "publicacion_admin.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                    echo '</script>';
                exit();
                } else {
                    echo '<script>';
                    echo 'alert("ERROR AL REALIZAR PUBLICACION");';
                    echo 'window.location.href = "publicacion_admin.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                    echo '</script>';
                    exit();
                }
            } else {
                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    $sql_registro = "INSERT INTO post (titulo, username, carrea, nrc_materia, texto, ruta_archivo, fecha) VALUES ('$titulo', '$username', '$carrera', '$nrc', '$texto', '$rutaDestino', '$fecha');";
    
                    if ($conn->query($sql_registro)) {
                        // Mostrar el mensaje de registro realizado en una notificación flotante
                        echo '<script>';
                        echo 'alert("PUBLICACION REALIZADA");';
                        echo 'window.location.href = "publicacion_admin.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                        echo '</script>';
                    exit();
                    } else {
                        echo '<script>';
                        echo 'alert("ERROR AL REALIZAR PUBLICACION");';
                        echo 'window.location.href = "publicacion_admin.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                        echo '</script>';
                        exit();
                    }
                } else {
                    // Mostrar el mensaje de error si no se pudo mover el archivo
                    echo '<script>';
                    echo 'alert("ERROR AL MOVER EL ARCHIVO");';
                    echo 'window.location.href = "publicacion_admin.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
                    echo '</script>';
                    exit();
                }
            }
        
    } else {
        // Mostrar el mensaje de registro realizado en una notificación flotante
        echo '<script>';
        echo 'alert("ESCRIBE UN TITULO Y CONTENIDO");';
        echo 'window.location.href = "publicacion_admin.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
        echo '</script>';
        exit();
    }
} else {
    // Mostrar el mensaje de registro realizado en una notificación flotante
    echo '<script>';
    echo 'alert("TITULO VACIO");';
    echo 'window.location.href = "publicacion_admin.php?nrc=' . $nrc . '&carrera=' . $carrera . '";';
    echo '</script>';
    exit();
}
?>

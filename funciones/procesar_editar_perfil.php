<?php

// Conectarse a la base de datos
require '../controladores/base_datos.php';
require '../controladores/controlador_cookie_carrera.php';

$conn_usuario = $conn;

$username = $_SESSION['username'];

// Obtener los datos del formulario
$nombre = $_POST['nuevo_nombre'];
$carrera = $_POST['carrera'];
$descripcion = $_POST['nuevo_descripcion'];
$password = $_POST['nuevo_password'];
$confirm_password = $_POST['confirmar_nuevo_password'];


// Encriptar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["avatar"])) {
    // Obtener la ruta del avatar seleccionado
    $avatar = $_POST["avatar"];

    // Guardar la ruta de la imagen en la base de datos
    $conn = $conn_usuario;

    /*------------------------------------------------------------------------*/

    $ruta_sql = mysqli_real_escape_string($conn, $avatar);

        if(!empty($password) && !empty($confirm_password)){
            // Validar si los passwords son iguales
            if ($password === $confirm_password) {
                // Actualizar datos en la tabla perfil
                $sql = "UPDATE perfil SET nombre = '$nombre', password = '$hashed_password', carrera = '$carrera', descripcion = '$descripcion' WHERE username = '$username'";

                if ($conn->query($sql)) {
                    // Obtener el id de la última foto actualizada
                    $id_foto = mysqli_insert_id($conn);

                    // Actualizar ruta en la tabla de fotos
                    $sql_fotos = "UPDATE fotos_perfil SET ruta = '$ruta_sql' WHERE id = (SELECT id_foto FROM perfil WHERE username = '$username')";

                    if ($conn->query($sql_fotos)) {
                        // Mostrar el mensaje de actualización realizada en una notificación flotante
                        echo '<script>';
                        echo 'alert("PERFIL ACTUALIZADO.");';
                        // Redirigir al usuario a la página de inicio de sesión
                        echo 'window.location = "Perfil2.php";';
                        echo '</script>';
                    } else {
                        // Mostrar el mensaje de error de actualización en una notificación flotante
                        echo '<script>';
                        echo 'alert("NO SE PUDO ACTUALIZAR EL PERFIL.");';
                        // Redirigir al usuario a la página de inicio de sesión
                        echo 'window.location = "Perfil2.php";';
                        echo '</script>';
                    }
                } else {
                    // Mostrar el mensaje de error de actualización en una notificación flotante
                    echo '<script>';
                    echo 'alert("NO SE PUDO ACTUALIZAR EL PERFIL.");';
                    // Redirigir al usuario a la página de inicio de sesión
                    echo 'window.location = "Perfil2.php";';
                    echo '</script>';
                }

                $conn->close();
            } else {
                // Mostrar el mensaje de passwords diferentes en una notificación flotante
                echo '<script>';
                echo 'alert("LAS CONTRASEÑAS NO COINCIDEN");';
                // Redirigir al usuario a la página de inicio de sesión
                echo 'window.location = "Perfil2.php";';
                echo '</script>';
            }
        } else {
            // Actualizar datos en la tabla perfil
            $sql = "UPDATE perfil SET nombre = '$nombre', carrera = '$carrera', descripcion = '$descripcion' WHERE username = '$username'";

            if ($conn->query($sql)) {
                // Obtener el id de la última foto actualizada
                $id_foto = mysqli_insert_id($conn);

                // Actualizar ruta en la tabla de fotos
                $sql_fotos = "UPDATE fotos_perfil SET ruta = '$ruta_sql' WHERE id = (SELECT id_foto FROM perfil WHERE username = '$username')";

                if ($conn->query($sql_fotos)) {
                    // Mostrar el mensaje de actualización realizada en una notificación flotante
                    echo '<script>';
                    echo 'alert("PERFIL ACTUALIZADO.");';
                    // Redirigir al usuario a la página de inicio de sesión
                    echo 'window.location = "Perfil2.php";';
                    echo '</script>';
                } else {
                    // Mostrar el mensaje de error de actualización en una notificación flotante
                    echo '<script>';
                    echo 'alert("NO SE PUDO ACTUALIZAR EL PERFIL.");';
                    // Redirigir al usuario a la página de inicio de sesión
                    echo 'window.location = "Perfil2.php";';
                    echo '</script>';
                }
            } else {
                // Mostrar el mensaje de error de actualización en una notificación flotante
                echo '<script>';
                echo 'alert("NO SE PUDO ACTUALIZAR EL PERFIL.");';
                // Redirigir al usuario a la página de inicio de sesión
                echo 'window.location = "Perfil2.php";';
                echo '</script>';
            }

            $conn->close();
        }
} else {
    // Mostrar el mensaje de actualización de perfil inválida
    echo '<script>';
    echo 'alert("ACTUALIZACION DE PERFIL INVALIDA.");';
    // Redirigir al usuario a la página de inicio de sesión
    echo 'window.location = "Perfil2.php";';
    echo '</script>';
}

?>

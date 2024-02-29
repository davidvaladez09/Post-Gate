<?php
require './controladores/base_datos.php';

// Verificación de la conexión
if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
}

$email = $_POST['email'];
$codigo = $_POST['codigo'];

$query = "SELECT * FROM perfil WHERE correo = '$email' AND token = '$codigo'";
$resultado = mysqli_query($conn, $query);

// Verificación del resultado de la consulta
if (mysqli_num_rows($resultado) == 1) {
    // Si el usuario existe en la base de datos, verificamos la contraseña
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_query($conn, "UPDATE perfil SET token_confirmado = 'si' WHERE correo = '$email' ");

    // Mostrar el mensaje de éxito en una notificación flotante
    echo '<script>';
    echo 'alert("CUENTA VERIFICADA EXITOSAMENTE");';
    // Redirigir al usuario a la página de inicio de sesión
    echo 'window.location = "login.php";';
    echo '</script>';
} else {
    // Mostrar el mensaje de error en una notificación flotante
    echo '<script>';
    echo 'alert("EL CODIGO INGRESADO ES INVALIDO.");';
    // Redirigir al usuario a la página de inicio de sesión
    echo 'window.location = "validar_correo.php";';
    echo '</script>';
}
?>

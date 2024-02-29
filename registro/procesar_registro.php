<?php

// Conectarse a la base de datos
require '../controladores/base_datos.php';

$conn_usuario = $conn;

if ($conn_usuario->connect_error) {
  // Mostrar el mensaje de error de conexión
  echo '<script>';
  echo 'alert("ERROR DE CONEXIÓN");';
  // Redirigir al usuario a la página de inicio de sesión
  echo 'window.location = "registro.php";';
  echo '</script>';
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$carrera = $_POST['carrera'];
$descripcion = $_POST['descripcion'];
$username = $_POST['nombre_usuario'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Variable que define el rol en la base de datos
$rol = 2;

// Encriptar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["avatar"])) {
    // Obtener la ruta del avatar seleccionado
    $avatar = $_POST["avatar"];

    // Guardar la ruta de la imagen en la base de datos
    $conexion = $conn;

    /*------------------------------------------------------------------------*/

    $ruta_sql = mysqli_real_escape_string($conn_usuario, $avatar);

    // Sentencia para no insertar el mismo usuario y correo
    $sql_usuario = "SELECT * FROM perfil WHERE username = '$username' OR correo = '$email'";

    // Bandera para validación de usuario
    $result = $conn_usuario->query($sql_usuario);

    // Validación de campos vacíos
    if (empty($nombre) || empty($email) || empty($carrera) || empty($descripcion) || empty($username) || empty($password) || empty($confirm_password)) {
        // Mostrar el mensaje de datos incompletos
        echo '<script>';
        echo 'alert("DEBES DE LLENAR TODOS LOS CAMPOS DEL FORMULARIO");';
        // Redirigir al usuario a la página de inicio de sesión
        echo 'window.location = "registro.php";';
        echo '</script>';
    } else {
        // Validación correo alumnos
        if (preg_match("/@alumnos.udg.mx/", $email)) {
            // Validar si los passwords son iguales
            if ($password === $confirm_password) {
                if ($result->num_rows > 0) {
                    // Mostrar el mensaje de error en una notificación flotante
                    echo '<script>';
                    echo 'alert("EL USUARIO O CORREO INGRESADOS YA SE ENCUENTRAN REGISTRADOS. \nINTENTA CAMBIAR EL USUARIO O CORREO");';
                    // Redirigir al usuario a la página de inicio de sesión
                    echo 'window.location = "registro.php";';
                    echo '</script>';
                    //echo "Error: " . $sql . "<br>" . $conn->error;
                } else {

                    // Validar si el correo es real
                    $domain = substr(strrchr($email, "@"), 1);
                    if (checkdnsrr($domain)) {

                        // Sentencia insertar ruta en la tabla de fotos
                        $sql_fotos = "INSERT INTO fotos_perfil (ruta) VALUES ('$ruta_sql')";

                        // Realiza registro a la base de datos
                        if ($conn_usuario->query($sql_fotos)) {
                            
                            //ENVIAR CORREO DE VALIDACION
                            include "./mail.php";

                            if($enviado){
                                $id_foto = $conn_usuario->insert_id;

                                // Insertar usuario a la base de datos 
                                $sql = "INSERT INTO perfil (username, nombre, correo, password, carrera, descripcion, id_foto, rol, token) VALUES ('$username', '$nombre', '$email', '$hashed_password', '$carrera', '$descripcion', '$id_foto', '$rol', '$codigo')";
    
                                // Insertar datos en la tabla perfil
                                if ($conn_usuario->query($sql)) {
                                    // Mostrar el mensaje de registro realizado en una notificación flotante
                                    echo '<script>';
                                    echo 'alert("SE HA ENVIADO UN CODIGO DE CONFIRMACION A TU CORREO ELECTRONICO. \nPOR FAVOR VALIDA TU CUENTA.");';
                                    // Redirigir al usuario a la página de inicio de sesión
                                    echo 'window.location = "../login.php";';
                                    echo '</script>';
                                } else {
                                    // Mostrar el mensaje de error de registro en una notificación flotante
                                    echo '<script>';
                                    echo 'alert("NO SE PUDO REALIZAR EL REGISTRO");';
                                    // Redirigir al usuario a la página de inicio de sesión
                                    echo 'window.location = "registro.php";';
                                    echo '</script>';
                                }

                            } else {
                                // Mostrar el mensaje de registro no realizado en una notificación flotante
                                echo '<script>';
                                echo 'alert("NO SE PUDO ENVIAR EL CORREO DE CONFIRMACIÓN");';
                                // Redirigir al usuario a la página de inicio de sesión
                                echo 'window.location = "registro.php";';
                                echo '</script>';
                            }
                            
                        }

                        //mysqli_query($conn_usuario, $sql);
                        $conn_usuario->close();

                    } else {
                        // Mostrar el mensaje de registro no realizado en una notificación flotante
                        echo '<script>';
                        echo 'alert("EL CORREO INGRESADO NO ES REAL");';
                        // Redirigir al usuario a la página de inicio de sesión
                        echo 'window.location = "registro.php";';
                        echo '</script>';
                    }
                }
            } else {
                // Mostrar el mensaje de passwords diferentes en una notificación flotante
                echo '<script>';
                //echo 'alert("' . $_SESSION['mensaje_error'] . '");';
                echo 'alert("LAS CONTRASEÑAS NO COINCIDEN");';
                // Redirigir al usuario a la página de inicio de sesión
                echo 'window.location = "registro.php";';
                echo '</script>';
            }

        } else {
            // Mostrar el mensaje correo no es de alumnos
            echo '<script>';
            echo 'alert("EL CORREO ES INVALIDO \nPARA FORMAR PARTE DEL FORO DEBES SER ALUMNO UDG \nDEBES CONTAR CON CORREO DOMINIO: juan@alumnos.udg.mx");';
            // Redirigir al usuario a la página de inicio de sesión
            echo 'window.location = "registro.php";';
            echo '</script>';
        }
    }
} else {
    // Mostrar el mensaje correo no es de alumnos
    echo '<script>';
    echo 'alert("REGISTRO NO REALIZADO");';
    // Redirigir al usuario a la página de inicio de sesión
    echo 'window.location = "registro.php";';
    echo '</script>';
}

?>

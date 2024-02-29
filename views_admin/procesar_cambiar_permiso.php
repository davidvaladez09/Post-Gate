<?php
    require '../controladores/controlador_cookie_carrera.php';
    require '../controladores/base_datos.php';

    $username = $_GET['username'];
    $permiso = $_POST['permiso-editable'];


    if (!empty($permiso)) {
                $sql = "UPDATE perfil SET rol = '$permiso' WHERE username = '$username';";
                
                if ($conn->query($sql)) {
                    // Mostrar el mensaje de registro realizado en una notificación flotante
                    echo '<script>';
                    echo 'alert("PERMISOS ACTUALIZADOS");';
                    echo 'window.location.href = "permisos.php";';
                    echo '</script>';
                    exit();
                } else {
                    echo '<script>';
                    echo 'alert("PERMISOS NO ACTUALIZADOS");';
                    echo 'window.location.href = "permisos.php";';
                    echo '</script>';
                    exit();
                }

    }
?>

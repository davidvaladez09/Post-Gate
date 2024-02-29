<?php
  require '../controladores/base_datos.php';

    // La sesión está iniciada y el valor de la cookie de sesión es correcto
    $username = $_POST['user']; // Leer el valor de la cookie de sesión

    $sql = "SELECT p.username, p.nombre, p.correo, p.password, p.carrera, p.descripcion, p.id_foto, p.rol, fp.ruta FROM perfil p INNER JOIN fotos_perfil fp ON p.id_foto = fp.id WHERE p.username = '$username';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user = $row["username"];
        $nombre = $row["nombre"];
        $email = $row["correo"];
        $password = $row["password"];
        $carrera = $row["carrera"];
        $descripcion = $row["descripcion"];
        $id_foto = $row["id_foto"];
        $rol = $row["rol"];
        $fotoPerfil = $row["ruta"];
    } else {
      echo "No se encontraron resultados.";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PERFIL</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="../style/style.perfil_usuarios.css" rel="stylesheet" type="text/css">

  <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>

<body>
    <?php
        require '../menus/menu_materias_perfil.php';
        require '../controladores/conrolador_chatbot.php';
    ?>

    <br>
    <br>
    <br>

    <div class="container">
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="card" style="width: 16rem; border-radius: 10px;">
                    <img class="card-img-top" src="./<?php echo $fotoPerfil; ?>" alt="Card image cap" style="border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold;"><?php echo $user ?></h5>
                        <p class="card-text"><?php echo $descripcion; ?></p>
                        <span style="color: black;"><?php if (isset($rol)): ?> <?php if ($rol == 1) { echo 'ADMINISTRADOR'; } else { echo 'ESTUDIANTE'; } ?><?php endif; ?></span>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4" style="color: aliceblue; font-weight: bold;">Username</label>
                <div class="card">
                    <div class="card-body" style="width: 100%;">
                        <?php echo $user; ?>
                    </div>
                </div>
                <br>

                <label for="inputPassword4" style="color: aliceblue; font-weight: bold;">Nombre</label>
                <div class="card">
                    <div class="card-body" style="width: 100%;">
                        <?php echo $nombre; ?>
                    </div>
                </div>
                <br>
                
                <label for="inputEmail4" style="color: aliceblue; font-weight: bold;">Correo</label>
                <div class="card">
                    <div class="card-body" style="width: 100%;">
                        <?php echo $email; ?>
                    </div>
                </div>
                <br>

                <label for="inputPassword4" style="color: aliceblue; font-weight: bold;">Carrea</label>
                <div class="card">
                    <div class="card-body" style="width: 100%;">
                        <?php echo $carrera; ?>
                    </div>
                </div>
                <br>

                <label for="inputPassword4" style="color: aliceblue; font-weight: bold;">Descripcion</label>
                <div class="card">
                    <div class="card-body" style="width: 100%;">
                        <?php echo $descripcion; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let inactivityTime = 600; // Tiempo de inactividad en segundos (ejemplo: 10 minutos)
        let timeout;

        function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(redirectLogout, inactivityTime * 1000);
        }

        function redirectLogout() {
        window.location.href = '../login.php';
        }

        // Reinicia el temporizador cuando hay interacción del usuario
        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('keypress', resetTimer);

        // Inicia el temporizador cuando la página se carga
        window.onload = resetTimer;
    </script>
</body>

</html>

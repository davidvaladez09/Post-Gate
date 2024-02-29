<?php
  require '../controladores/base_datos.php';
  require '../controladores/controlador_cookie_carrera.php';

  if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
    // La sesión está iniciada y el valor de la cookie de sesión es correcto
    $username = $_SESSION['username']; // Leer el valor de la cookie de sesión

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

  } else {
    // La sesión no está iniciada o el valor de la cookie de sesión no es correcto
    header('Location: login.php'); // Redirigir al usuario a la página de inicio de sesión
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="../style/style.perfil_usuarios.css" rel="stylesheet" type="text/css">

  <title>PERFIL</title>

  <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">

  <script type="text/javascript">
        function mostrarPassword(){
            var cambio = document.getElementById("txtPassword");
		    if(cambio.type === "password"){
			    cambio.type = "text";
			    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		    } else{
                cambio.type = "password";
			    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		    }
	    } 
	
	    $(document).ready(function () {
	        //CheckBox mostrar contraseña
	        $('#ShowPassword').click(function () {
		        $('#password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	        });
        });

        function mostrarAvatarSeleccionado() {
            var avatarSelect = document.getElementById("avatar");
            var avatarImage = document.getElementById("avatar-image");
            var selectedAvatar = avatarSelect.options[avatarSelect.selectedIndex].value;
            avatarImage.src = selectedAvatar;
        }
  </script>


</head>

<body>
  <?php
    require '../menus/menu_materias.php';
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

            <label for="inputEmail4" style="color: aliceblue; font-weight: bold;">Password</label>
            <div class="card">
                <div class="card-body" style="width: 100%;">
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?php echo $password; ?>" readOnly>
                </div>
            </div>
        </div>
    </div>

    <label for="inputPassword4" style="color: aliceblue; font-weight: bold;">Username</label>
    <div class="card">
        <div class="card-body" style="width: 100%;">
            <?php echo $user; ?>
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

    <br>


    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-size: 16px; color: purple; font-weight: bold;">EDITAR PERFIL</button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <form action="procesar_editar_perfil.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="font-weight: bold;">Nuevo Nombre</label> 
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa Nombre" name="nuevo_nombre" value="<?php echo $nombre ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" style="font-weight: bold;">Nuevo Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingresa Password" name="nuevo_password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" style="font-weight: bold;">Confirmar Nuevo Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirma Password" name="confirmar_nuevo_password"">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" style="font-weight: bold;">Nueva Descripcion</label>
                        <textarea class="form-control" id="exampleInputPassword1" placeholder="Ingresa nueva Descripcion" name="nuevo_descripcion"><?php echo $descripcion ?></textarea>
                    </div>
                    
                    <br>

                    <label for="floatingSelectGrid" style="font-weight: bold;">Avatar</label>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="custom-select drop-avatar" id="avatar" name="avatar" onchange="mostrarAvatarSeleccionado()">
                                <option selected><?php echo $fotoPerfil ?></option>
                                <option value="../fotos_perfil/avatar_biologo.jpg">Avatar 1: biologosaurio</option>
                                <option value="../fotos_perfil/avatar_borracho.jpg">Avatar 2: borrachosaurio</option>
                                <option value="../fotos_perfil/avatar_cariñosa.jpg">Avatar 3: cariñosaurio</option>
                                <option value="../fotos_perfil/avatar_contador.jpg">Avatar 4: contadorsaurio</option>
                                <option value="../fotos_perfil/avatar_estudiante.jpg">Avatar 5: estudiantesaurio</option>
                                <option value="../fotos_perfil/avatar_quimico.jpg">Avatar 6: quimicosaurio</option>
                                <option value="../fotos_perfil/avatar_artistasaurio.jpg">Avatar 7: artistasaurio</option>
                                <option value="../fotos_perfil/avatar_babersaurio.jpg">Avatar 8: babersaurio</option>
                                <option value="../fotos_perfil/avatar_empresaurio.jpg">Avatar 9: empresaurio</option>
                                <option value="../fotos_perfil/avatar_polisaurio.jpg">Avatar 10: polisaurio</option>
                                <option value="../fotos_perfil/avatar_profesaurio.jpg">Avatar 11: profesaurio</option>
                                <option value="../fotos_perfil/avatar_topo.jpg">Avatar 12: toposaurio</option>
                                <option value="../fotos_perfil/avatar_doctorsaurio.jpg">Avatar 13: doctorsaurio</option>
                                <option value="../fotos_perfil/avatar_sistemas.jpg">Avatar 14: sistemasaurio</option>
                                <option value="../fotos_perfil/avatar_mecanicosaurio.jpg">Avatar 15: mecanicosaurio</option>
                                <option value="../fotos_perfil/avatar_albañisaurio.jpg">Avatar 16: albañisaurio</option>
                                <option value="../fotos_perfil/avatar_alcoholicosaurio.jpg">Avatar 17: alcoholicosaurio</option>
                                <option value="../fotos_perfil/avatar_vaquerosaurio.jpg">Avatar 18: vaquerosaurio</option>
                                <option value="../fotos_perfil/avatar_baterisaurio.jpg">Avatar 19: baterisaurio</option>
                                <option value="../fotos_perfil/avatar_cientificosaurio.jpg">Avatar 20: cientificosaurio</option>
                                <option value="../fotos_perfil/avatar_astronausaurio.jpg">Avatar 21: astronausaurio</option>
                                <option value="../fotos_perfil/avatar_hockeysaurio.jpg">Avatar 22: hockeysaurio</option>
                                <option value="../fotos_perfil/avatar_rugbysaurio.jpg">Avatar 23: rugbysaurio</option>
                                <option value="../fotos_perfil/avatar_besibolitsasaurio.jpg">Avatar 24: beisbpolistasaurio</option>
                                <option value="../fotos_perfil/avatar_pilotosaurio.jpg">Avatar 25: pilotosaurio</option>
                                <option value="../fotos_perfil/avatar_panaderosaurio.jpg">Avatar 26: panaderosaurio</option>
                                <option value="../fotos_perfil/avatar_cantasaurio.jpg">Avatar 27: cantasaurio</option>
                                <option value="../fotos_perfil/avatar_vejetarisaurio.jpg">Avatar 28: vejetarisaurio</option>
                                <option value="../fotos_perfil/avatar_callcentersaurio.jpg">Avatar 29: callcentersaurio</option>
                                <option value="../fotos_perfil/avatar_electricisaurio.jpg">Avatar 30: electricisaurio</option>
                            </select>
                        </div>
                        <br>
                        <img id="avatar-image" src="<?php echo $fotoPerfil ?>" alt="Avatar seleccionado" style="width: 7rem; border-radius: 15px">
                    </div>

                    <?php
                        require '../controladores/base_datos.php';

                        // Consulta SQL para obtener los datos de la tabla
                        $sql = "SELECT codigo FROM carrera WHERE codigo NOT IN('NV', 'COMPARTIDA')";
                        $resultado = $conn->query($sql);
                    ?>

                    <br>

                    <label for="floatingSelectGrid" style="font-weight: bold;">Carreras</label>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="custom-select drop-carrera" id="carrera" name="carrera">
                                <option selected><?php echo $carrera ?></option>
                                <?php
                                    // Verificar si se encontraron resultados
                                    if ($resultado->num_rows > 0) {
                                        // Iterar sobre los resultados y generar las opciones del select
                                        while ($row = $resultado->fetch_assoc()) {
                                            $carrera = $row['codigo'];
                                            echo "<option value='$carrera'>$carrera</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay opciones disponibles</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                </form>
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

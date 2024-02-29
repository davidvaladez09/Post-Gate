<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <link href="../style/style.registro.css" rel="stylesheet" type="text/css">
  
    <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">
  
    <title>REGISTRO DE USUARIO NUEVO</title>

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
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="../imagenes/logo_postgate1.png" id="icon" alt="User Icon" style="width: 20rem; margin-bottom: 2rem"/>
            </div>

            <form action="procesar_registro.php" method="post" enctype="multipart/form-data">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" id="floatingInputGrid" class="form-control" placeholder="Ingresa nombre" name="nombre">
                            <label for="floatingInputGrid">Ingresa tu nombre</label>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" id="floatingInputGrid" class="form-control" placeholder="Ingresa correo" name="email">
                            <label for="floatingInputGrid">Ingresa tu correo</label>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombre_usuario" placeholder="Ingresa un username" name="nombre_usuario">
                            <label for="nombre_usuario">Ingresa un username</label>
                        </div>

                        <br>

                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="Ingresa password" name="password">
                                    <label for="floatingInputGrid">Ingresa password</label>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="confirmar-password" placeholder="Cofirma password" name="confirm_password">
                                    <label for="floatingInputGrid">Confirma password</label>
                                </div>    
                            </div>
                        </div>

                        <br>

                        <div class="row g-2">
                            <div class="col-md">
                                <textarea class="form-control" placeholder="Ingresa una descripcion" id="floatingTextareaDisabled" name="descripcion"></textarea>
                            </div>

                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select drop-avatar" id="avatar" name="avatar" onchange="mostrarAvatarSeleccionado()">
                                        <option selected>Selecciona tu avatar</option>
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
                                    <label for="floatingSelectGrid">Avatar</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                        require '../controladores/base_datos.php';

                        // Consulta SQL para obtener los datos de la tabla
                         $sql = "SELECT codigo FROM carrera WHERE codigo NOT IN('NV', 'COMPARTIDA')";
                        $resultado = $conn->query($sql);
                    ?>

                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select drop-carrera" id="carrera" name="carrera">
                                <option selected>Selecciona tu carrera</option>
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
                            <label for="floatingSelectGrid">Carreras</label>
                        </div>
                        <img id="avatar-image" src="../fotos_perfil/avatar_dafault.jpg" alt="Avatar seleccionado">
                    </div>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Registrarme</button>
                </div>

                <a href="../login.php" style="color: black; font-family: sans-serif; font-size: .8rem; font-weight: bold; margin-left: 2rem; margin-top: 1rem">INICIAR SESION</a> | <a href="../index.php" style="color: black; font-family: sans-serif; font-size: .8rem; font-weight: bold; margin-top: 1rem">REGRESAR AL INICIO</a>

            </form>
        </div>
    </div>
</body>
</html>
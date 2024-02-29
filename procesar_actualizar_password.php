<?php
require './controladores/base_datos.php';

$email =$_POST['email'];
$token =$_POST['token'];
$codigo =$_POST['codigo'];

$conn_usuario = $conn;

$sql = "SELECT * FROM passwords WHERE email ='$email' AND token = '$token' AND codigo = '$codigo'";
$result = $conn_usuario->query($sql);

$correcto = false;

if ($result->num_rows > 0) {
    $fila = mysqli_fetch_row($result);
    $fecha =$fila[4];
    $fecha_actual = date("Y-m-d h:m:s");
    $seconds = strtotime($fecha_actual) - strtotime($fecha);
    $minutos=$seconds / 60;

    $correcto = true;
} else {
    $correcto = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!--<link href="style/style.registro2.css" rel="stylesheet" type="text/css">-->
    <link href="style/style.recuperar_password.css" rel="stylesheet" type="text/css">
  
    <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">
  
    <title>RESTABLECER PASSWORD</title>

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
                <img src="imagenes/logo_postgate1.png" id="icon" alt="User Icon" style="width: 20rem; margin-bottom: 2rem"/>
            </div>

            <?php if($correcto){ ?>
            <form action="cambiarpassword.php" method="post" enctype="multipart/form-data">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="password" class="fadeIn second" placeholder="Nuevo Password"  id="floatingInputGrid" name="password">
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating">
                            <input type="password" class="fadeIn third" placeholder="Confirmar Password"  id="floatingInputGrid" name="confirmar_password">
                            <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email?>">
                        </div>
                    </div>
                </div>

                <br>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Actualizar password</button>
                </div>

                <a href="./login.php" style="color: black; font-family: sans-serif; font-size: .8rem; font-weight: bold; margin-left: 2rem; margin-top: 1rem">INICIAR SESION</a> | <a href="./index.php" style="color: black; font-family: sans-serif; font-size: .8rem; font-weight: bold; margin-top: 1rem">REGRESAR AL INICIO</a>

            </form>
            <?php }else{ 
                // Mostrar el mensaje de registro realizado en una notificación flotante
                echo '<script>';
                echo 'alert("CODIGO INCORRECTO O VENCIDO.");';
                // Redirigir al usuario a la página de inicio de sesión
                echo 'window.location = "login.php";';
                echo '</script>';
            } ?>
        </div>
    </div>
</body>
</html>
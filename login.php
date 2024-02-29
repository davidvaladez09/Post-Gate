<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  <link href="style/style.login.css" rel="stylesheet" type="text/css">
  
  <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">
  
  <title>POST GATE</title>

  <script type="text/javascript">
    function mostrarPassword(){
		  var cambio = document.getElementById("txtPassword");
		  if(cambio.type == "password"){
			  cambio.type = "text";
			  $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		  }else{
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
  </script>

</head>

<body>
<a href="./index.php" style="color: black; font-family: sans-serif; font-size: .8rem; font-weight: bold; margin-left: 2rem; margin-top: 1rem">REGRESAR AL INICIO</a>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <img src="./imagenes/logo_postgate2.png" id="icon" alt="User Icon" />
            </div>

            <form method="post" action="procesar_login_poo.php">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="USERNAME OR EMAIL">
                <input id="password" type="password" Class="fadeIn third" name="password" placeholder="PASSWORD">
                <div class="input-group-append"> 
                  <input id="ShowPassword" type="checkbox" style="margin-left: 2.3rem; cursor: pointer; cursor: hand;"/><h5 style="margin-left: .5rem; margin-top: .7rem; font-size: .9rem; cursor: pointer; cursor: hand;">  MOSTRAR PASSWORD</h5>
                </div>
            
                <a href="./registro/registro.php">¿No tienes cuenta?</a> | <a href="./recuperar_password.php">¿Olvidaste la contraseña?</a>
                &nbsp;
                <input type="submit" value="Iniciar sesión">
                
            </form>  
        </div>
    </di>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <link href="style/style.recuperar_password.css" rel="stylesheet" type="text/css">
  
  <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">


  <title>RECUPERAR PASSWORD</title>
</head>

<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <div class="fadeIn first">
        <img src="./imagenes/logo_postgate2.png" id="icon" alt="User Icon" />
      </div>

      <label class="fadeIn first">RECUPERAR PASSWORD</label>

      <form action="procesar_recuperar_password.php" method="post">
        <input type="email" class="fadeIn second" placeholder="Ingresa tu correo" aria-label="email" aria-describedby="addon-wrapping" id="email" name="email">
        <input type="submit" value="Recuperar Contraseña">
        <a href="./login.php" style="color: black; font-family: sans-serif; font-size: .8rem; font-weight: bold;">INICIAR SESION</a>
      </form>
    </div>
  </div>
</body>
</html>
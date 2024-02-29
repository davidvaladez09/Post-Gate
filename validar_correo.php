<?php 
if(isset($_GET['email'] )){
    $email = $_GET['email'] ;
   
}else{
    header('Location: ./login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link href="style/style.recuperar_password.css" rel="stylesheet" type="text/css">
  
    <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">
  
    <title>VERIFICACION DE CUENTA</title>


  </head>
<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <div class="fadeIn first">
        <img src="./imagenes/logo_postgate2.png" id="icon" alt="User Icon" />
      </div>

      <label class="fadeIn first">VERIFICA TU CUENTA</label>

      <form action="./procesar_validar_correo.php" method="POST">
        <label class="fadeIn third">Ingresa el código enviado por correo</label>
        <input type="number" class="form-control" id="exampleInputEmail1" name="codigo" aria-describedby="emailHelp">
        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email;?>">
        <input type="submit" value="Verificar Cuenta">
      </form>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
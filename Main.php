<?php
  require './controladores/controlador_cookie.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>HOME</title>
    
    <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>
<body style="background-color: #00030E;">

  <?php 
    require './menus/menu_main.php'; 
    require './controladores/conrolador_chatbot.php';
  ?>

  <br>
  <br>
  <br>
  <h1 style="color: azure; font-size: 2rem; margin-left: 2rem">Bienvenido: <?php echo $_SESSION['username']; ?></h1>
  <br>
  <div class="container">
    <div class="card text-bg-dark" style="border-radius: 10px;">
      <img src="./archivos/postgate_info.png" class="card-img" alt="..." style="border-radius: 10px;">
    </div>
    <br>
    <br>
    <p class="h5">TUTORIAL</p>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner" style="border-radius: 10px;">
        <div class="carousel-item active">
          <img class="d-block w-100" src="./archivos/aprende_inicio.gif" alt="First slide" style="height: 40rem;">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./archivos/paso1.gif" alt="Second slide" style="height: 40rem;">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./archivos/paso2.gif" alt="Third slide" style="height: 40rem;">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./archivos/paso3.gif" alt="Cuarto slide" style="height: 40rem;">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <br>
    <div>
      <p class="h5">AQUÍ PUEDES VER LOS EDIFICIOS</p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3231.313808364439!2d-103.32520497387725!3d20.657079405005362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1690326725817!5m2!1ses-419!2smx" width="100%" height="450" style="border:0; border-radius: 15px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <br>
    <br>

  </div>
  
  <script>
        let inactivityTime = 600; // Tiempo de inactividad en segundos (ejemplo: 10 minutos)
        let timeout;

        function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(redirectLogout, inactivityTime * 1000);
        }

        function redirectLogout() {
        window.location.href = './login.php';
        }

        // Reinicia el temporizador cuando hay interacción del usuario
        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('keypress', resetTimer);

        // Inicia el temporizador cuando la página se carga
        window.onload = resetTimer;
    </script>
  
</body>
</html>

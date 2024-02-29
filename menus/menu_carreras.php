<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel="icon" href="./imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>
<body>
  <header class="main-header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="../Main.php">
        <img src="../imagenes/logo_postgate_pestana_invertido.png" width="70" height="40" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../views_carreras/coordinadores.php">INFO COORDINADORES</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../views_carreras/Informatica.php">INFORMATICA</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../views_carreras/Computacion.php">COMPUTACION</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../views_carreras/Quimica.php">QUIMICA</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../views_carreras/Fisica.php">FISICA</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../views_carreras/Ing_Civil.php">ING. CIVIL</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../views_carreras/Biomedica.php">BIOMEDICA</a>
            </li>
            <div class="dropdown show">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MAS CARRERAS</a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              | <a class="dropdown-item" href="../views_carreras/Matematicas.php">MATEMATICAS</a>
                <a class="dropdown-item" href="../views_carreras/Ciencia_Materiales.php">CIENCIA DE MATERIALES</a>
                <a class="dropdown-item" href="../views_carreras/Alimentos_Biotecnologia.php">ALIMENTOS Y BIOTECNOLOGIA</a>
                <a class="dropdown-item" href="../views_carreras/Robotica.php">ROBOTICA</a>
                <a class="dropdown-item" href="../views_carreras/Industrial.php">INDUSTRIAL</a>
                <a class="dropdown-item" href="../views_carreras/Fotonica.php">FOTONICA</a>
                <a class="dropdown-item" href="../views_carreras/Comunicaciones_electronica.php">COMUNICACIONES Y ELECTRONICA</a>
                <a class="dropdown-item" href="../views_carreras/Topografia.php">TOPOGRAFIA GEOMATICA</a>
                <a class="dropdown-item" href="../views_carreras/Quimico_farmacobiologo.php">QUIMICO FARMACOBIOLOGO</a>
                <a class="dropdown-item" href="../views_carreras/Logistica_Transporte.php"">LOGISTICA Y TRANSPORTE</a>
                <a class="dropdown-item" href="../views_carreras/Mecanica_electrica.php"">MECANICA ELECTRICA</a>
              </div>
            </div>
          </ul>
          <form class="d-flex">
            <a class="nav-link" href="../funciones/logout.php">Log Out</a>
            <a class="nav-link" href="../funciones/Perfil2.php">Perfil</a>
          </form>
        </div>
      </nav>
    </div>
  </header>

  <hr>

</body>
</html>
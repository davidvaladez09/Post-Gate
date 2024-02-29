<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "post_gate";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] == TRUE) {
  // La sesión está iniciada y el valor de la cookie de sesión es correcto
  $username = $_SESSION['username']; // Leer el valor de la cookie de sesión

  $sql = "SELECT username, nombre, correo, password, carrera, descripcion, id_foto, rol FROM perfil WHERE username = '$username'";
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
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../style/style.permisos.css" rel="stylesheet" type="text/css">
    
    <link rel="icon" href="../imagenes/logo_postgate_pestana.png" type="image/x-icon">
</head>
<body>
    <?php
        require '../menus/menu_funciones_admin.php';
    ?>

    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">USERNAME</span>
        <input type="text" class="form-control" placeholder="<?php if(isset($user)): ?> <?php echo $user; ?><?php endif; ?>" aria-label="Username" aria-describedby="addon-wrapping">
    </div>

    <br>
    <br>

    <form class="form-floating">
        <input type="text" class="form-control" id="floatingInputValue" placeholder="USERNAME" value="<?php if(isset($user)): ?> <?php echo $user; ?><?php endif; ?>">
        <label for="floatingInputValue">Input with value</label>
    </form>


    <?php if(isset($nombre) && isset($email) && isset($password) && isset($carrera) && isset($descripcion) && isset($id_foto) && isset($rol)): ?>
        <h1>Información del Usuario</h1>
        <p>Username: <?php echo $user; ?></p>
        <p>Nombre: <?php echo $nombre; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Password: <?php echo $password; ?></p>
        <p>Carrera: <?php echo $carrera; ?></p>
        <p>Descripcion: <?php echo $descripcion; ?></p>
        <p>ID Foto: <?php echo $id_foto; ?></p>
        <p>Rol: <?php echo $rol; ?></p>
    <?php endif; ?>

    <a href="../funciones/logout.php">Cerrar sesión</a>
</body>
</html>

<?php
$conn->close();
?>

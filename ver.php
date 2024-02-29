<?php
// Configuración de la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "post_gate";

//Variable de busqueda
$id = $_POST['id'];

// Conexión a la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Obtiene la ruta de la imagen de la base de datos
$sql = "SELECT ruta FROM fotos_perfil WHERE id = '$id'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
  $imagen = $resultado->fetch_assoc();

  // Muestra la imagen en la interfaz de usuario
  echo "<img src='" . $imagen['ruta'] . "'>";
} else {
  // No se encontraron resultados, puedes mostrar un mensaje o realizar alguna otra acción
  echo "No se encontró ninguna imagen para el usuario con ID: " . $id;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

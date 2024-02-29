<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "postgate";

// Crear una instancia de la clase mysqli para establecer la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar el juego de caracteres a UTF-8
$conn->set_charset("utf8");

// Retornar la conexión para su uso en otros archivos
return $conn;
?>

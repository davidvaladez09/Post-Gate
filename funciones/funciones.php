<?php

function editarPerfil($username_pub, $user, $id_pub, $titulo_pub, $contenido_pub){
  //DATOS DE ACTUALIZACIÓN
  if ($username_pub == $user) { // Verificar si el usuario logueado es el autor de la publicación
    echo "<form action='./procesar_editar_publicacion.php?$id_pub' method='POST' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='id-publicacion' value='$id_pub'>"; // Campo oculto con el ID de la publicación
    echo "<input type='text' name='titulo-editable' id='titulo-editable' value='$titulo_pub'>";
    echo "<textarea name='contenido-editable' id='contenido-editable' style='height: 4rem'>$contenido_pub</textarea>";
    echo "<input type='file' name='archivo-editable'>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit' id='boton-editar' name='actualizar'>Editar</button>"; // Eliminé el onclick del botón
    echo "<button type='submit' id='boton-eliminar' name='borrar' style='margin-left: 5px;'>Eliminar</button>";
    echo "<br>";
    echo "</form>";
  } else {
    echo "<p class='card-text'>$contenido_pub</p>"; 
  }
}

?>
<?php

$para = $_POST['email'];
$título = 'Gracias por registrarte PostGate';

//aleatoria
$codigo = rand(1000,9999);

// mensaje
$mensaje = '
    <html>
        <head>
            <meta charset="UTF8" />
        </head>
        <body>
            <p>Para poder verificar tu cuenta ingresa al siguiente link e ingresa tu código:</p>
            <p> <a 
                href="https://postgate.space/validar_correo.php?email='.$email.'">
                Verificar cuenta </a> 
            </p>
            <p>Tu código es: </p>
            <h2>'.$codigo.'</h2>
            <p>DISFRUTA DE LA COMUNIDAD DEL CUCEI.</p>
  
        </body>
    </html>
';


$cabeceras = "From: postgatecommunity@outlook.com\r\n";
$cabeceras .= "Content-type: text/html\r\n";

// Enviarlo
$enviado=false;
if(mail($para, $título, $mensaje, $cabeceras)){
   $enviado=true;
}


?>
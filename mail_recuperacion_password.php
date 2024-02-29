<?php
// Varios destinatarios
$para  =$email . ', '; // atención a la coma


// título
$título = 'Recuperación de password para PostGate';
$codigo= rand(1000,9999);


// mensaje
$mensaje = '
<html>
<head>
  <title>Restablecer</title>
</head>
<body>
    <h1>Post Gate Community.</h1>
    <div style="text-align:center; background-color:#ccc">
        <p>Restablecer contraseña</p>
        <h3>'.$codigo.'</h3>
        <p>Para poder reestablecer tu password ingresa al siguiente link e ingresa tu código:</p>
        <p> <a 
            href="https://postgate.space/actualizar_password.php?email='.$email.'&token='.$token.'"> 
            Restablecer password </a> </p>
        <p> <small>Si no solicitaste este correo puedes ignorarlo</small> </p>
    </div>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = "From: postgatecommunity@outlook.com\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$enviado =false;
if(mail($para, $título, $mensaje, $cabeceras)){
    $enviado=true;
}

?>
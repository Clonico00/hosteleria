
<?php
// Varios destinatarios
$para  = 'javilitom.g.2002@gmail.com' . ', '; // atención a la coma

// título
$titulo = 'Recordatorio de cumpleaños para Agosto';

// mensaje
$mensaje = '
<html>
<head>
  <title>Recordatorio de cumpleaños para Agosto</title>
</head>
<body>
  <p>¡Estos son los cumpleaños para Agosto!</p>
  <p>Tu codigo de verificacionn es 202020</p>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r";

// Cabeceras adicionales
$cabeceras .= 'To: Mary <>, Kelly <>' . "\r";

// Enviarlo
mail($para, $titulo, $mensaje, $cabeceras);


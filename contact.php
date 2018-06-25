<?php

/*
 * Script for sending E-Mail messages.
 * 
 * Note: Please edit $sendTo variable value to your email address.
 * 
 */

// please change this to your E-Mail address
$sendTo = "david_c91@oulook.com";
 
//$action = $_POST['tipo_de_consulta'];
//$action = $_POST['tipo_de_consulta'];
if (isset($_POST['tipo_de_consulta'])) {
    $tipoDeConsulta = $_POST['tipo_de_consulta'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['correo'];   
    $mensaje = $_POST['mensaje'];
    $asunto = "Asunto: consulta por " . $tipoDeConsulta;

    if ($nombre == "" || $email == "" || $mensaje == "") {
        echo "Oh no, ha ocurrido un error, prueba enviar tu emsaje de nuevo";
        exit();
    }
    
    $message = 'pregunta: ' . $tipoDeConsulta . "\r\n"
                        . "Nombre: " . $nombre . "\r\n"
                        . "Apellido: " . $apellido . "\r\n"
                        . "Email: " . $email . "\r\n"
                        . $asunto . "\r\n"
                        . "Mensaje: " . $mensaje . "\r\n";
} else {
    
    $email = $_POST['form_data'][0]['Email'];
    $nombre = $email;

    if ($email == "") {
        echo "Oh no, ha ocurrido un error, prueba enviar tu email de nuevo!";
        exit();
    }
    $asunto = 'subscripción';
    $mensaje = 'Nueva subscripción para : ' . $email;
} 

$headers = 'From: ' . $nombre . '<' . $email . ">\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

if (mail($sendTo, $asunto, $mensaje, $headers)) {
    echo "Mensaje enviado.";
exit;
} else {
    echo "Hubo unproblema con el E-Mail.";
}
?>

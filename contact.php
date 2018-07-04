<?php
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
/*
 * Script for sending E-Mail messages.
 * 
 * Note: Please edit $sendTo variable value to your email address.
 * 
 */

$mail = new PHPMailer(true);  



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

    $message = 'pregunta: ' . $tipoDeConsulta . "<br>"
                        . "Nombre: " . $nombre . "<br>"
                        . "Apellido: " . $apellido . "<br>"
                        . "Email: " . $email . "<br>"
                        . $asunto . "<br>"
                        . "Mensaje: " . $mensaje . "<br>";
} else {
    
    $email = $_POST['form_data'][0]['Email'];
    $nombre = $email;

    if ($email == "") {
        echo "Oh no, ha ocurrido un error, prueba enviar tu email de nuevo!";
        exit();
    }
    $asunto = 'subscripción';
    $message = 'Nueva subscripción para : ' . $email;
} 

// codigo para envio del mail con PHPmailer<
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'aqui va el host del corre ej smtp-mail.outlook.com ';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'aqui va el correo';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;  
    $mail->CharSet = 'UTF-8';                                  // TCP port to connect to
    //Recipients
    $mail->setFrom('correo desde donde se envia', 'sitio web');
    $mail->addAddress('al coreo que llega', 'Correo web');     // Add a recipient


    //Content
    $mail->isHTML();                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $message;
    $mail->AltBody = 'Este es un mensaje desde la pagina';
    $mail->setLanguage('es');

    $mail->send();
    echo 'Mensaje enviado.';
} catch (Exception $e) {
    echo 'Hubo unproblema con el E-Mail.', $mail->ErrorInfo;
}

?>

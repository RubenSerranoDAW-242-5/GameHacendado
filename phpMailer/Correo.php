<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function EnviarCorreo($email,$nombre)
{
    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'gamehacendado1693@gmail.com';                     //SMTP username
        $mail->Password = 'ihdc tvfg rnzp vcjw';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom("gamehacendado1693@gmail.com", 'GameHacendado');
        $mail->addAddress($email, 'Ruben');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Creacion Usuario Completada';
        $mail->Body = "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Bienvenido a Nuestra Plataforma</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #00bfff;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 123, 255, 0.2);
            text-align: center;
        }

        .header {
            color: #007bff;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
            box-shadow: 0px 4px 12px rgba(0, 123, 255, 0.4);
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>¡Bienvenido a Nuestra Plataforma!</div>
        <div class='content'>
            <p>Hola $nombre,</p>
            <p>Nos complace darte la bienvenida. Tu cuenta ha sido creada exitosamente.</p>
            <p>Para acceder a tu cuenta, haz clic en el siguiente botón y usa las credenciales que registraste.</p>
            <a href='http://localhost/GameHacendado/public/login.php?verificado=true' class='button'>Acceder a mi cuenta</a>
        </div>
        <div class='footer'>
            <p>Si tienes alguna pregunta, no dudes en contactarnos en info@gamehacendado.com.</p>
            <p>Gracias por unirte a nosotros.</p>
        </div>
    </div>
</body>
</html>
";


        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
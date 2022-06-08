<?php
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$mensaje = trim($_POST['mensaje']);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$sender = 'noreply.blueberryvideo@gmail.com';
$senderName = 'Pagina Blueberry video';
$recipient = 'noreply.blueberryvideo@gmail.com';

$usernameSmtp = 'noreply.blueberryvideo@gmail.com';
$passwordSmtp = 'hdgybzekimhkzhus';
$configurationSet = 'ConfigSet';
$host = 'smtp.gmail.com';
$port = 587;
$subject = 'Mensaje de textilo en la web';
$bodyText =  "Correo de la web";
$bodyHtml = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<li style="margin-bottom: 10px;">Nombre: ' . $nombre . '</li>
<li style="margin-bottom: 10px;">Correo electrónico: ' . $email . '</li>
<li style="margin-bottom: 10px;">Teléfono:  ' . $telefono . '</li>
<li style="margin-top: 40px;">Mensaje: ' . $mensaje . '</li>
</body>
</html>

';

$mail = new PHPMailer(true);


// Ingresa tu clave secreta.....
define("RECAPTCHA_V3_SECRET_KEY", '6LcbFlUgAAAAALajj57uqSPKg-7BdSqlyTQMZ242');
$token = $_POST['token'];
$action = $_POST['action'];

// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);

// verificar la respuesta
if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
    // Si entra aqui, es un humano, puedes procesar el formulario
    try {
        $mail->isSMTP();
        $mail->setFrom($sender, $senderName);
        $mail->Username   = $usernameSmtp;
        $mail->From   = $usernameSmtp;
        $mail->Password   = $passwordSmtp;
        $mail->Host       = $host;
        $mail->Port       = $port;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = 'tls';
        $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
        $mail->addAddress($recipient);
        $mail->isHTML(true);
        $mail->Subject    = $subject;
        $mail->Body       = $bodyHtml;
        $mail->AltBody    = $bodyText;
        $mail->Send();
        sleep(4);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } catch (phpmailerException $e) {
        echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
    } catch (Exception $e) {
        echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
    }
} else {
    // Si entra aqui, es un robot....
    echo "Lo siento, parece que eres un Robot";
}

?>



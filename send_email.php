
<?php
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$mensaje = trim($_POST['mensaje']);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$sender = 'noreply.blueberry@gmail.com';
$senderName = 'Pagina Blueberry video';
$recipient = 'noreply.blueberry@gmail.com';
$recipient1 = 'pruebascorreosbb@gmail.com';
$recipient2 = 'noreply.blueberry@gmail.com';
$recipient3 = 'fidelberry1@gmail.com';
$recipient4 = 'ventas01bb@gmail.com';

$usernameSmtp = 'noreply.blueberry@gmail.com';
$passwordSmtp = 'gaqgvbkoqicovutj';
$configurationSet = 'ConfigSet';
$host = 'smtp.gmail.com';
$port = 587;
$subject = 'Mensaje de Blueberry Video en la web';
$bodyText =  "Correo de la web";
$bodyHtml = '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <meta name="x-apple-disable-message-reformatting"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@600&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
  <title></title>
</head>
<body style="margin:0;padding:0;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff; font-family: sans-serif;">
    <tr>
      <td align="center" style="padding:0;">
        <table role="presentation" style="width:602px;border-collapse:collapse;border:0px solid #cccccc;border-spacing:0;text-align:left; font-family: sans-serif;">
          <tr>
            <td align="left" style="padding:10px 0 30px 0; font-family: sans-serif;">
              <img src="https://i.postimg.cc/vHX6QB70/Bueberrypostivo.jpg" alt="DIRÉ MÓVIL" width="200" style="height:auto;display:block;" />
              <hr>
            </td>
          </tr>
          <tr>
            <td style="padding:0px 30px 42px 20px; font-family: sans-serif;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0; font-family: sans-serif;">
                <tr>
                  <td style="padding:0 0 36px 0;color:#153643; font-family: sans-serif;">
                    <img src="https://i.postimg.cc/k4Jn15MD/Nuevo-Contacto.png" alt="NUEVO CONTACTO" style="max-width: 500px; margin-left: 50px; margin-bottom: 60px; margin-top: 20px;"/>
                    <center>
                      <h4 style="margin:0 0 12px 0;font-size: 20px; text-align: center; font-family: sans-serif;">Se ha capturado un nuevo lead en <b style="font-weight: 600; color: black;">BLUEBERRY VIDEO</b></h4>
                      <ul style="color: #aba9a8; list-style: none; text-align: center;">
                        <li style="margin-bottom: 10px;">Correo electrónico: '.$email.'</li>
                        <li style="margin-bottom: 10px;">Nombre: '.$nombre.'</li>
                        <li style="margin-bottom: 10px;">Telefono: '.$telefono.'</li>
                        <li style="margin-bottom: 10px;">Mensaje: '.$mensaje.'</li>
                      </ul>
                    </center>
                    </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:30px;background:#000000; font-family: sans-serif;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px; font-family:  sans-serif;">
                <tr>
                  <td style="padding:0;width:50%; font-family: sans-serif;" align="right">
                    <img src="https://i.postimg.cc/4dpfLLNY/materialized-blueberry.gif" alt="MATERIALIZED BY Blueberry"/>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
    

';

$mail = new PHPMailer(true);


// Ingresa tu clave secreta.....
define("RECAPTCHA_V3_SECRET_KEY", '6Lcpk1UgAAAAAOC4bYJEUMz4dhH5tG9av00M4bPB');
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
        $mail->addAddress($recipient1);
        $mail->addAddress($recipient2);
        $mail->addAddress($recipient3);
        $mail->addAddress($recipient4);
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
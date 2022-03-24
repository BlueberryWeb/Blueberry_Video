<?php 
require 'PHPMailerAutoload.php';  
//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->CharSet = "UTF-8";
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp-relay.sendinblue.com';
//$mail->Host = gethostbyname('smtp.mailgun.org');
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';

$mail->SMTPOptions = array(
   'ssl' => array(
       'verify_peer' => false,
       'verify_peer_name' => false,
       'allow_self_signed' => true
   )
);

$mail->Username = 'developer@redcore.com.mx';   // SMTP username
$mail->Password = 'ngAd2GrPcawRJ3Lx';  

//Set who the message is to be sent to
$mail->setFrom('hello@blueberry.mx', 'Blueberry Video Media ');
//Set who the message is to be sent from  
$mail->addAddress('fidelberry1@gmail.com', 'Fidel Galvan');
$mail->addAddress('hello@blueberry.mx', 'Hello BB'); 
$mail->addAddress('ventas@blueberry.mx', 'Ventas BB');  

$mail->Subject = 'Mensaje desde el sitio web de Video Media';
$mail->Body    = 'Mensaje Web Contacto: \n';
 
    if(isset($_POST['email'])) {
          // validation expected data exists
          if(
     
            !isset($_POST['nombre']) ||  
            !isset($_POST['email']) || 
            !isset($_POST['telefono']) ||  
            !isset($_POST['mensaje'])) {
     
            die('Datos invalidos.');       
     
          }

            $name_con = $_POST['nombre'];   
            $email_from= $_POST['email'];    
            $phone= $_POST['telefono'];         
            $message = $_POST['mensaje'];
      
            //Set an alternative reply-to address
            $mail->addReplyTo($_POST['email'], $_POST['email'],  $_POST['mensaje']);

      
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            $nom_exp = '/^[A-Za-z0-9._ áéíóúÁÉÍÓÚ]/'; 
            if(!preg_match($email_exp,$email_from)){
                $error_message .= 'La dirección de email no es valida.<br />';
            }
            if(!preg_match($nom_exp,$name_con)){
                $error_message .= 'El nombre contiene caracteres no validos.<br />';
            } 

            function clean_string($string) {
              $bad = array("content-type","bcc:","to:","cc:","href");
              return str_replace($bad,"",$string);
            }
      
            $email_message = "---Información del contacto.---\n\n";            
            $email_message .= "Nombre: ".clean_string($name_con)."\n";
            $email_message .= "Teléfono: ".clean_string($phone)."\n"; 
            $email_message .= "Email: ".clean_string($email_from)."\n\n";   
            $email_message .= "<strong>".clean_string($message)."\n\n </strong>";
            $mail->Body = "".$email_message;
      
      if($mail->send()){        
        header('Location: index.html?success=true'); 
        exit;
      }else{
        echo 'Message could not be sent.<br>';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
        header('Location: index.html?success=false');
        
      }
        
    }

?>
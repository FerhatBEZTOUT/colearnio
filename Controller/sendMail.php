<?php //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__.'/../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

function envoyerMail($email,$nom,$prenom,$key) {
    $mail = new PHPMailer(true);
    $error = false;
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-colearnio.alwaysdata.net';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'colearnio@alwaysdata.net';                     //SMTP username
        $mail->Password   = 'ma3dnous';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('colearnio@alwaysdata.net', 'Colearnio');
        $mail->addAddress($email, $nom.' '.$prenom);     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Validation de votre compte Colearnio';
        $mail->Body    = '<h1>Bienvenue dans Colearnio</h1>
        Valider votre compte en <a href="https://colearnio.alwaysdata.net/validation.php?key='.$key.'">cliquant ici</a>
        <p>Si vous n\'etes pas à l\'origine de cette inscription, merci d\'ignorer ce message et de ne pas cliquer sur le lien de validation</p>';
        $mail->AltBody = 'Valider votre compte en cliquant sur ce lien : http://colearnio.alwaysdata.net/validation?key='.$key;
    
        $mail->send();
       
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $error = false;
    }
}


?>
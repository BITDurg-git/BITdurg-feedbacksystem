<?php
//Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require 'PHPMailer\OAuth.php';
require 'PHPMailer\SMTP.php';
require 'PHPMailer\PHPMailer.php';
require 'PHPMailer\Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
//require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions

/**
 * 
 */
class Mail
{
    function send_mail($id, $uname, $pwd)
    {

    $mail = new PHPMailer(true);

    $email_id = $id;

    $html_body ="  <p>Recover Login Details below :-</p>
                    Username: <b>$uname</b> <br>
                    Password: <b>$pwd</b> <br><br>
                    Use above detials to Sign In to BITSAP portal
                ";

    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'bitdurgcse@gmail.com';                     // SMTP username
        $mail->Password   = '123@bit@321';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('from@gmail.com', 'BITSAP');
        //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addAddress($email_id);               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Account Credentials for BIT Self Assessment Portal';
        $mail->Body    = $html_body;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        ob_start(); // supress following echo output

        $t = $mail->send();

        ob_end_clean(); // Supressing Ends

        return $t;

    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return 0;
    }

    }
    
}



///echo send_mail('itstuitions@gmail.com', '111111111111', 'l234he');
//$pwd = substr(md5(mt_rand(1,10000)),0,6);
?>
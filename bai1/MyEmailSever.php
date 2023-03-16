<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
require './EmailServerInterface.php';
//Load Composer's autoloader

    class MyEmailServer implements EmailServerInterface {
        public function sendEmail($email, $name, $title, $message) { //$email, $name, $message.. $to, $subject, $message
            // Implementation to send email using MyEmailServer
            //Import PHPMailer classes into the global namespace
            //These must be at the top of your script, not inside a function

            
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER   ;// SMTP::DEBUG_SERVER                     //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';   //.e.tlu.edu.vn                  //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'tojimomirudo54@gmail.com';                     //SMTP username
                $mail->Password   = 'tirnyymkbmdcpxkh';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('tojimomirudo54@gmail.com', 'Mailer');
                $mail-> addAddress($email, $name);   //Add a recipient

            
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $title;
                $mail->Body    = $message;//This is the HTML message body <b>in bold!
             //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
    
?>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if(isset($_POST['submit'])){
    $mail = new PHPMailer(true); 

    //variables
    $name = $_POST['name'];
    $mailFrom = $_POST['mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mailTo = "mbobojonov@hotmail.com";
    $headers = "From: ".$mailFrom;
    $txt = "You have received an email form ".$name.".\n\n".$message;


    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output                                         // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'uzb.bobojonov@gmail.com';                     // SMTP username
        $mail->Password   = 'Maqneah4@';                               // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($mailFrom, $name);
        $mail->addAddress('uzb.bobojonov@gmail.com');     // Add a recipient
    

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
        header("Location: index.php?mailsend");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
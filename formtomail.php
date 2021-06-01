<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/autoload.php';
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset($_POST['send'])) {
    print_r($_POST);
    $email = $_POST['email'];
    $name = $_POST['name'];
    $mobno = $_POST['mobno'];
    $dob = $_POST['dob'];
    $msg = $_POST['msg'];

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'crawlerearth@gmail.com'; //SMTP username
        $mail->Password = '9876543210srijan'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('crawlerearth@gmail.com', 'Code Diggers');
        // $mail->addAddress('joe@example.net', 'Joe User'); //Add a recipient
        $mail->addAddress($email); //Name is optional
        // $mail->addReplyTo('crawlerearth@gmail.com', 'Code Diggers');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = "Thank you for reaching out to Code Diggers";
        $mail->Body = "<b>Hello $name,</b> <br> We have received your message $msg and we will try our best to reach
        out to you very soon.<br> <b>Till then stay happy and healthy.</b><br>
        Data: <br> DOB : $dob <br>Mobile no : $mobno
        <br> We wish you best of luck for your future.
         <br><br><br>Thank you,<br>Srijan Agrawal<br>Founder<br> Code Diggers";
        // $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

        $mail->send();
        echo '<script>window.location.href="index.htm?message_sent";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
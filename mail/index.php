<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require '../global/api/conn.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if (isset($_REQUEST['email'])) {
    $email = $_REQUEST['email'];
    $fromMail = $_REQUEST['fromMail'];
    $fromName = $_REQUEST['fromName'];
    $sql = 'SELECT * FROM user WHERE email="' . $email . '"';
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('" . isset($_REQUEST["contact"]) . "')</script>";
    if (mysqli_num_rows($result) <= 0 && !isset($_REQUEST["contact"])) {
        echo false;
    } else {
        $subject = $_REQUEST['subject'];
        $body = $_REQUEST['body'];
        $altbody = $_REQUEST['altbody'];
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'jigyasusharma2803@gmail.com'; //SMTP username
            $mail->Password = 'oaqdqszdsrqtcoyn'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients 
            $mail->setFrom($fromMail, $fromName);
            $mail->addAddress($email); //Add a recipient
            //Name is optional
            $mail->addReplyTo($fromMail, $fromName);
            // $mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body; //'This is the HTML message body <b>in bold!</b>'
            $mail->AltBody = $altbody;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
} else {
    echo "idher kya kar raha";
}
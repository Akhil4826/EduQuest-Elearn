<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function send_mail($recipient, $subject, $message) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;  
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "rudolfyoyo1983@gmail.com";
    $mail->Password = "prxltcgcejexjjey";

    $mail->IsHTML(true);
    $mail->AddAddress($recipient, "Esteemed Customer");
    $mail->SetFrom("rudolfyoyo1983@gmail.com", "My website");
    $mail->Subject = $subject;
    $mail->Body = $message;

    return $mail->Send();
}

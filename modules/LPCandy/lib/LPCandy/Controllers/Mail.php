<?php

namespace LPCandy\Controllers;

class Mail extends Base {   
    
    
    static function send($address) {

        require_once "PHPMailer/class.phpmailer.php";
        
        $mail = new \PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "lpcandy.beejee@gmail.com";
        $mail->Password = "BeeJee!123*";
        $mail->SetFrom("lpcandy.beejee@gmail.com");
        $mail->Subject = "Lpcandy";
        $mail->Body = "<b>У Вас появились новые заявки.<br/><br/><a href='lpcandy.ru/track-list'>Посмотреть</a></b>";
        $mail->AddAddress($address);
        
        if(!$mail->Send()){
            return "Mailer Error: " . $mail->ErrorInfo;
        } else{
            return "Message has been sent";
        }
    }
    
    
}

<?php
session_start();
require_once './vendor/autoload.php';
use PHPMailer\PHPMailer\Exception;
require 'class_holder.php';

if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
    header("Location: dashboard.php");
} else {
    try{
        $userRegister = new UserRegister();
        $userRegister->register();
        $mail = new Mailer(); 
        if(!$mail->sendEmail()){
    echo "Mail nie został wysłany. </br>";
    echo "Error zwrócony: ".$mail->ErrorInfo;
} 
    header("Location: dashboard.php");
    } catch (Exception $e) {
    header("Location: register.php");
    }
}

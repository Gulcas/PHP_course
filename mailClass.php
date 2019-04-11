<?php

require_once './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include './mail_config.php';
class Mailer {
    private $phpMailer;

    public function sender($receiver) {
        $this->smtpSetting = include './mail_config.php';
        $this->phpMailer = new PHPMailer;
        $this->phpMailer->isSMTP();
        $this->phpMailer->SMTPAuth = TRUE;
        $this->phpMailer->SMTPSecure = $mailArraya['SMTPSecure'];
        $this->phpMailer->Host = $mailArraya['Host'];
        $this->phpMailer->Port = $mailArraya['Port'];
        $this->phpMailer->Username = $mailArraya['Username'];
        $this->phpMailer->Password = $mailArraya['Password'];
        $this->phpMailer->setFrom($mailArraya['setFrom']);
        $this->phpMailer->Subject = $mailArraya['Subject'];
        $this->phpMailer->Body = $mailArraya['Body'];
        $this->phpMailer->addAddress($_POST['email']);
        $this->phpMailer->send();
        } 
 
}
$_POST['email'] = 'testprogramos@gmail.com';
$mail = new Mailer();
$mail->sender($_POST['email']);
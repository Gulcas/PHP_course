<?php
//header("Location: index.php");
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
include './mail_config.php';

abstract class FileUserData {
    private $filePath = null;
    protected $data = [];
    protected $fillable = false;
    
    //Funkcja sprawdzająca czy plik z danymi istnieje/nie->utwórz/tak->wczytaj
    public function __construct($filePath) {
        if(!file_exists($filePath)){
            $directory = dirname($filePath);
            if(!file_exists($directory)){
                mkdir($directory, 0755, TRUE);
            } touch($filePath);
        } 
        $this->filePath = $filePath;
        $this->data = unserialize(file_get_contents($this->filePath));
    }
    //function__construct END
    
    public static function fileExist($filePath){
        return file_exists($filePath);
    }
    
    //Funkcja wyłapująca dane o
    public function __set($varName, $value) {
        if($this->fillable === FALSE || (is_array($this->fillable) && in_array($varName, $this->fillable))){
            $this->data[$varName] = $value;
        } else {
            throw new Exception("Field {$varName} can't be accepted!");
        }
    }
    
    //zastosowany short if do szybkiego sprawdzenia
    public function __get($varName) {
        return isset($this->data[$varName]) ? $this->data[$varName] : NULL;
    }
    
    //
    public function save(){
        return file_put_contents($this->filePath, serialize($this->data));
    }    
} //FileUserData class END


class User extends FileUserData{
    protected $fillable = [
        "Name",
        "Surname",
        "Email",
        "Password"];
    
    public function __construct($userName){
        parent::__construct("UserData/.{$userName}.dat");
    }
    
    public static function userExist($userName){
        return parent::fileExist("UserData/.{$userName}.dat");
    }
    
    public function __set($varName, $value) {
        switch ($varName){
            case 'Email':
                if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                    throw new Exception("You must enter valid email");
                } break;
        } parent::__set($varName, $value);
    }
}//User class END

class Common {
    protected function getFromPost($varName){
        return isset($_POST[$varName]) ? $_POST[$varName] : NULL;
    }
}//Common class END

class UserRegister extends Common{
    public function register(){
        if(!isset($_POST)){
            throw new Exception("Fill all the registration fields");
        }
        if(is_null($this->getFromPost('Password')) || ($this->getFromPost('Password') !== $this->getFromPost('PasswordRepeat'))){
            throw new Exception("Password mismatch");
        }
        $emailMd5 = md5($this->getFromPost('Email'));
        
        $user = new User($emailMd5);
        $user->Name = $this->getFromPost('Name');
        $user->Surname = $this->getFromPost('Surname');
        $user->Email = $this->getFromPost('Email');
        $user->Password = sha1($this->getFromPost('Password'));
        $user->save();
        $_SESSION['auth'] = 1;
    }
}//UserRegister class END

class UserLogin extends Common{
    public function login(){
        $emailMd5 = md5($this->getFromPost('Email'));
        if(!User::userExist($emailMd5)){
            throw new Exception("User don't exist");
        }
        $emailMd5 = md5($this->getFromPost('Email'));
        $user = new User($emailMd5);
        if($user->Password == sha1($this->getFromPost('Password'))){
            $_SESSION['auth'] = 1;
            header("Location: dashboard.php");
        } else {
            throw new Exception("Wrong password");
        }
    }
}//UserLogin class END

//Licznik odwiedzin, not used yet!
class Counter extends Common{
    public function saveCounter($fileName){
        $name = implode("", $fileName);
        file_put_contents($name.".txt", "1 ", FILE_APPEND);
        
        $count = explode(",", file_get_contents($name.".txt"));
        count($count, 1) -1;
    }
}

//This class will use Common class to gram user email addres, and PHPMailer class to send email.
//All data are stored in different php file in an array
class Mailer extends Common {
    private $phpMailer;

    public function sendEmail() {
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
        $this->phpMailer->Body = $mailArraya['Body1'].$this->getFromPost('Name').$mailArraya['Body2'];
        $this->phpMailer->addAddress($this->getFromPost('Email'));
        $this->phpMailer->send();
        } 
}
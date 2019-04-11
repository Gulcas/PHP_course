<?php //
//session_start();
//
//require 'class_holder.php';
//
//if(isset($_SESSION['auth'])){
//    switch ($_SESSION['auth']){
//        case '2':
//            header("Location: dashborad.php");
//            break;
//        case '1':
//            try {
//    $userLogin = new UserLogin();
//    $userLogin->login();
//    } catch (Exception $e){
//        echo "You can't login: {$e->getMessage()}";
//    } 
//            break;
//        case '0':
//            try {
//        $userRegister = new UserRegister();
//        $userRegister->register();
//    } catch (Exception $e){
//        echo "An error occurs: {$e->getMessage()}";
//    }
//            break;
//    }
//} else {
//    header("Location: index.php");
//}
//
////TODO-> zmodyfikować plik controler.php 
////tak by był w stanie obsłużyć zarówno rejestrację jak i logowanie
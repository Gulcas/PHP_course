<?php
session_start();

require 'class_holder.php';

if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
    header("Location: dashboard.php");
} else {
    try {
        $userLogin = new UserLogin();
        $userLogin->login();
    } catch (Exception $e) {
        header("Location: login.php");
    }
}
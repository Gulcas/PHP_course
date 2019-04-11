<?php
require 'class_holder.php';
session_start();

echo "Welcome to dashboard.</br>";

if(isset($_SESSION['auth']) && $_SESSION['auth'] == 0){
    header("location: index.php");
}
echo "</br>Sesja: ".$_SESSION['auth']."</br>";
$_SESSION['auth'] = 0; //wyzerowanie sesji by ponownie przeprowadzić testy
var_dump($_SESSION['auth']);




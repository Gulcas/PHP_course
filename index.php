<!DOCTYPE html>
<!--
First page of the projest. User have to select is he wan't to log in or register
-->
<?php
 session_start();
 if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
     header("Location: dashboard.php");
 }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="Index" content="Index">
        <title>Index</title>
    </head><style>
        div {
        text-align: center
        }
    </style>
    <body><div>
        <form action="login.php" method="GET">
            <button name="Login" type="submit">Login</button>
        </form>
        <form action="register.php" method="GET">
            <button name="Register" type="submit">Register</button>
        </form>
        <form action="guestbook.php" method="GET">
            <button name="GuestBook" type="submit">Guest Book</button>
        </form>
    </div></body>
</html>

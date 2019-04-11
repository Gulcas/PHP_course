<!DOCTYPE HTML>

<html lang ="pl">
    <?php
    session_start();
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1){
            header("Location: dashboard.php");
          }
        ?>
    <head>
        <meta charset="UTF-8"/>
        <meta name="Form" content="Form"/>
        <title>Register Form</title>
        <style>
            div1 {
                text-align: center;
            }
        </style>
    </head><body>
    <div1><form action="login_controler.php" method="POST">
            <h1>Enter your email and password to log in</h1>
            <input name="Email" type="email" placeholder="email"><br>
            <input name="Password" type="password" placeholder="password" maxlength="14"><br>
            <input name="Submit" type="submit"></div1>
        </form>
    </body>
</html>


<!DOCTYPE HTML>
<!--Basic form that will take the user input and pass it to listing_25.php file -->
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
        <title>Register</title>
        <style>
            div1 {
                text-align: center;
            }
        </style>
    </head><body>
    <div1><form action="register_controler.php" method="POST">
            <h1>Fill the form to come to the dark side</h1>
            <input name="Name" type="text" placeholder="name"><input name="surname" type="text" placeholder="surname"><br>
            <input name="Email" type="email" placeholder="email"><br>
            <input name="Password" type="password" placeholder="password" maxlength="14"><input name="PasswordRepeat" type="password" placeholder="repeat password" maxlength="14"><br>
            <input name="Submit" type="submit"></div1>
        </form>
    </body>
</html>
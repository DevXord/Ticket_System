<!DOCTYPE html>

<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <title>Ticket System</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="icon" href="images\Favicon\side_icon.ico">
        <meta name="description" content="Ticket System" />
        <meta name="author" content="Patryk Kaszuba" />
    </head>

    <body>
        <img src="images/side_logo.png" id="logo_dev">
        <div id="contener">
            <p>LOGIN</p>
            <?php
                echo "elo XD";
            ?>
            <div id="login_box">
                <form action="#" method="get">
                    <input type="text" name="login_data" placeholder="LOGIN" minlength="5" maxlength="14" required="required">
                    <input type="password"  name="password_data" placeholder="PASSWORD" minlength="6" maxlength="17" required="required">
                    <a href="profil_side.html"><input type="submit" alt="Log in button"  title="Login" value="Login" name="login_button"></a>
                    <a href="register_side.html"> <input type="button" alt="Register button" title="Register" value="Register" name="register_button"></a>
                </form>
            </div>
        </div>
    </body>
</html>
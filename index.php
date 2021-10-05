<?php
    session_start();
?>
<!DOCTYPE html>

<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <title>Ticket System</title>
        <!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
        <link href="style.css?<?=filemtime("style.css")?>" rel="stylesheet" type="text/css" />

        <link rel="icon" href="images\Favicon\side_icon.ico">
        <meta name="description" content="Ticket System" />
        <meta name="author" content="Patryk Kaszuba" />
    </head>

    <body>
        <img src="images/side_logo.png" id="logo_dev">
        <?php

        require_once "connect_mysql.php";



        $db = @mysqli_connect($host , $username, $userpassword, $namedb);
        if(!$db)
            echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
            
        else
        {
            if(isset($_POST['email_data']) && isset($_POST['password_data']))
            {
                $uemail = $_POST['email_data'];
                $upassword = $_POST['password_data'];
                $sql = "SELECT * FROM users_db WHERE Email = '$uemail' AND Password = '$upassword'";

                if($result = $db->query($sql))
                {
                    $users_number = $result->num_rows;
                    if($users_number == 1)
                    {

                        $data = $result->fetch_assoc();

                        $_SESSION['id'] =  $data['ID'];
                        $_SESSION['uname'] =  $data['Name'];
                        $_SESSION['usname'] =  $data['Surname'];
                        $_SESSION['uemail'] =  $data['Email'];

                        $_SESSION['upass'] =  $data['Password'];
                        $_SESSION['jdate'] =  $data['Join_Date'];
                        $_SESSION['img'] =  $data['Images_url'];
                        $_SESSION['login'] =  true;
                        
                        $sqlt = "SELECT * FROM admins_db WHERE Email = '$uemail' AND Password = '$upassword'";

                        if($resulttwo = $db->query($sqlt))
                        {
                            $users_number = $resulttwo->num_rows;
                            if($users_number == 1)
                            {
                                $adata = $resulttwo->fetch_assoc();
                                $_SESSION['Rangs'] =  $adata['Rang_strong'];
                                $result->close();
                                $resulttwo->close();
                                header("location: profil_side.php");
                               
                            }
                            else
                            {
                                $_SESSION['Rangs'] = 0;
                                $result->close();
                                header("location: profil_side.php");
                            }
                        }
                    }
                    else
                        echo '<br><div id="error_contener"> Warning: The user does not exist!</div><br>';
            
                }
                
            }

            $db->close();
        }


        ?>

        <div id="contener">
        

            <p>LOGIN</p>
           
            <div id="login_box">
                <form action='index.php' method="post">
                    <input type="email" name="email_data" placeholder="E-mail" minlength="6" maxlength="24" required="required">
                    <input type="password"  name="password_data" placeholder="Password" minlength="6" maxlength="24" required="required">
                    <input type="submit" alt="Log in button"  title="Login" value="Login" name="login_button">
                </form>
                <a href="register_side.php"> <input type="button" alt="Register button" title="Register" value="Register" name="register_button"></a>

            </div>
        </div>
    </body>
</html>
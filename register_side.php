 
<!DOCTYPE html>

<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <title>Register side</title>
        <!-- <link rel="stylesheet" type="text/css" href="register_style.css" /> -->
        <link href="register_style.css?<?=filemtime("register_style.css")?>" rel="stylesheet" type="text/css" />
        <link rel="icon" href="images\Favicon\side_icon.ico">
        <meta name="description" content="Ticket System" />
        <meta name="author" content="Patryk Kaszuba" />
    </head>

    <body>
       
        <?php

        require_once "connect_mysql.php";



        $db = @mysqli_connect($host , $username, $userpassword, $namedb);
        if(!$db)
            echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
            
        else
        {
            if(isset($_POST['user_email']) && isset($_POST['user_password']))
            {
               


                $uemail = $_POST['user_email'];
                $pass = $_POST['user_password'];
                $rpass  = $_POST['user_rpassword'];

                if($pass === $rpass)
                {
                    
                    $sql = "SELECT * FROM users_db WHERE Email = '$uemail'";

                    if($result = $db->query($sql))  
                    {

                        $users_number = $result->num_rows;
                        if($users_number == 0)
                        {

                            $datesecond = time(); 
        
                            
                            $nowDate = date('Y-m-d', $datesecond);

                            $usern = $_POST["user_name"];
                            $usersn = $_POST["user_surname"];
                            $userem = $_POST["user_email"];
                            $userpass = $_POST["user_password"];

                            $sql =  "INSERT INTO `users_db`(`Name`, `Surname`, `Email`, `Password`, `Join_Date`, `Images_url`) VALUES ('$usern','$usersn','$userem','$userpass','$nowDate','NULL')";

                            
                            if($resulttwo = $db->query($sql))
                            {
                                
                                echo '<br><div id="info_contener"> Info: The account has been created !</div><br>';
                                header("location: index.php");
                            }
                            else
                            {
                                echo '<br><div id="error_contener"> Warning: Problem with sending!</div><br>';
                                $resulttwo->close();
                                header("location: register_side.php");

                            }
                        }
                        else
                        {
                            $result->close();
                            echo '<br><div id="error_contener"> Warning: This account already exists!</div><br>';
                        }

                    
                    }
                    else 
                        echo '<br><div id="error_contener"> Warning: Database error!</div><br>';
    

                    
           
                 }
                 else
                    echo '<br><div id="error_contener"> Warning: Passwords must be identical!</div><br>';
            }       
            $db->close();    
        }

           
        

        ?>




        <div id="contener">
            

            


            <p>Registration form</p>
            <div id="register_box">
                <form action="register_side.php" method="post">
                    
                    <p>Name:  <input type="text"class="input_data_class" name="user_name" placeholder="Enter your name" minlength="3" maxlength="24" required="required"></p >
                    <p>Surname:  <input type="text"class="input_data_class" name="user_surname" placeholder="Enter your surname"  minlength="3" maxlength="24" required="required"></p >
                    <p>E-mail: <input type="email" name="user_email" class="input_data_class" placeholder="Enter your e-mail" minlength="6" maxlength="30" required="required"></p>
                    <p>Password: <input  class="input_data_class" type="password"  name="user_password" placeholder="Enter your password" minlength="6" maxlength="24" required="required"></p >
                    <p>Repeat password: <input  class="input_data_class" type="password"  name="user_rpassword" placeholder="Please repeat password" minlength="6" maxlength="24" required="required"></p >
                    
                    <input type="submit" id="send_register_form" value="Send" title="Register" alt="Send the form for registration button" name="send_register_button">
           
            
                </form>
            </div>       
        </div>
    </body>
</html>
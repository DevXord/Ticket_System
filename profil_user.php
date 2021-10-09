<?php
    session_start();
    if(empty($_SESSION['login']))
    {
        
        header("location: logout.php");
        echo '<br><div id="error_contener"> Warning: You must be logged in!</div><br>';
    }

?>
<!DOCTYPE html>

<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        
        <!-- <link rel="stylesheet" type="text/css" href="profil_style.css" /> -->
        <link href="user_style.css?<?=filemtime("user_style.css")?>" rel="stylesheet" type="text/css" />
        <link rel="icon" href="images\Favicon\side_icon.ico">
        
           
       
        <meta name="description" content="Ticket System" />
        <meta name="author" content="Patryk Kaszuba" />
    </head>

    <body>
        <div id="contener">
            <div id="header">
                        
                <div id="link_contener">
                    <?php
                        if(empty($_SESSION['img']))
                            echo '<a id="user_go_profil" href="profil_side.php"><img class="image_header_icon" title="Profil side" alt="Go back to profil icon" src="User_profils\default_profil\default.png"></a>';
                        else
                        {
                            $pathi = "User_profils\\". $_SESSION['id'] ."\\".$_SESSION['img'];


                            echo "<a id='user_go_profil' href='profil_side.php'><img class='image_header_icon' title='Profil side' alt='Go back to profil icon' src='$pathi'></a>";
                        }
                    
                    ?>
                    <a id="user_go_ticket" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to Ticket side icon" src="images/icon_link/tickets.png" ></a> 
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out"  alt="Log out icon" src="images/icon_link/logout.png"></a>
                </div>

            </div>

            <div id="main">
                 
                        
                <?php
                    echo '<div id = "user_left_contener">';
                        $suemail = $_GET["author_email"];
                        $Uid;$Uname;$Usurname;$Ujdate;$Uimgurl;$Urangs;$Uonline;
                        require_once "connect_mysql.php";
                        $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                        if(!$db)
                            echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                        else
                        {
                            
                            $sql = "SELECT * FROM users_db WHERE Email = '$suemail'";

                            if($result = $db->query($sql))
                            {
                                $tcket_number = $result->num_rows;
                                if($tcket_number == 1)
                                {
                                    $data = $result->fetch_assoc();
                                    $Uid = $data['ID'];
                                    $Uname = $data['Name'];
                                    $Usurname = $data['Surname'];
                                    $Ujdate = $data['Join_Date'];
                                    $Uimgurl = $data['Images_url'];
                                    $Uonline = $data['Online'];

                                }

                                $result->close();
                            }
                            echo '<head> <title>Profil '.$Uname . ' ' .$Usurname.'</title></head>';
                            $sql = "SELECT * FROM admins_db WHERE Email = '$suemail'";

                            if($result = $db->query($sql))
                            {
                                $tcket_number = $result->num_rows;
                                if($tcket_number == 1)
                                {
                                    $data = $result->fetch_assoc();

                                    $Urangs = $data['Rang_strong'];
                                }
                                else
                                    $Urangs = 0;
                                $result->close();
                            }

                            if(@$Uimgurl == NULL)
                                echo '<img id= "user_photo_profil_id"  title="Your phot" alt="User photo" src="User_profils\default_profil\default.png">';
                            else
                            {
                                $pathi = "User_profils\\". $Uid."\\".$Uimgurl;
                                echo "<img id= 'user_photo_profil_id'  title='Your photo' alt='User photo' src='$pathi'>";
                            }

                           


                            switch($Urangs)
                            {
                            
                                case 0: 
                                    echo  " <label id='rang_style_user'>User</label>";
                                    break;
                                case 1: 
                                    echo  " <label id='rang_style_moderator'>Moderator</label>";
                                    break;
                                case 2: 
                                    echo  " <label id='rang_style_admin'>Administrator</label>";
                                    break;
                                case 3: 
                                    echo  " <label id='rang_style_headadmin'>Head Administrator</label>";
                                    break;
                                
                                
                            }
                                                echo "<label>Status:</label>";

        
                            if($Uonline != 0)
                                echo  " <label id='user_online'>ON-LINE</label>";
                            else
                                echo  " <label id='user_offline'>OFF-LINE</label>";     




                            echo '<label>Join date:</label>';                                    
                            echo '<label id="user_join_date">'. $Ujdate .'</label>';




                            $db->close();
                        }

                    echo '</div>';

                    echo  '<div id="user_settings_contener">';
               
                        echo '<label class="label_class_user">Name:</label>';
                        echo '<label class="label_class_settings_user">'.$Uname.'</label>';
                        echo '<label class="label_class_user">Surname:</label>';
                        echo '<label class="label_class_settings_user">'.$Usurname.'</label>';
                        echo '<label class="label_class_user">Email:</label>';
                        echo '<label class="label_class_settings_user">'.$suemail.'</label>';


                       
                    echo '</div>';
                        
                ?>
                    
                    

 

            </div>

            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>

            
        </div>
    </body>
</html>
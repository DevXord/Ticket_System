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
                    

                    
                        if($_SESSION['Rangs'] >= 2)
                        {
                            echo' <a id="admin_look_all" href="user_list_side.php"><img class="image_header_icon" title="User list side" alt="Go to user list side icon" src="images/icon_link/profils.png" ></a>';
                      
                            echo' <a id="admin_look_all" href="archive_side.php"><img class="image_header_icon" title="Archive list side" alt="Go to archive list side icon" src="images/icon_link/archive.png" ></a>';
                   
                        }
                   
                    ?>
                    <a id="user_go_ticket" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to Ticket side icon" src="images/icon_link/tickets.png" ></a> 
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out"  alt="Log out icon" src="images/icon_link/logout.png"></a>
                </div>

            </div>

            <div id="main">
                 
                        
                <?php
                    echo '<div id = "user_left_contener">';

                        if(!empty($_GET["author_id"]))
                            $Uid = $_GET["author_id"];
                        
                        
                        $suemail;$Uname;$Usurname;$Ujdate;$Uimgurl;$Urangs;$Uonline;
                        require_once "connect_mysql.php";
                        $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                        if(!$db)
                            echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                        else
                        {


                          
                            
                            $sql = "SELECT * FROM users_db WHERE ID = '$Uid'";
                            
                            if($result = $db->query($sql))
                            {
                                $tcket_number = $result->num_rows;
                                if($tcket_number == 1)
                                {
                                    $data = $result->fetch_assoc();
                                    $suemail = $data['Email'];
                                    $Uname = $data['Name'];
                                    $Usurname = $data['Surname'];
                                    $Ujdate = $data['Join_Date'];
                                    $Uimgurl = $data['Images_url'];
                                    $Uonline = $data['Online'];

                                }
                                else
                                {
        
                                    header('location: profil_side.php');
                                }

                                $result->close();
                            }

                            if(isset($_POST['radio_rangs']))
                            {
                                $rsql = "SELECT * FROM admins_db WHERE Email = '$suemail'";

                                if($_POST['radio_rangs'] == 0)
                                {
                                    

                                    if($rangresult = $db->query($rsql))
                                    {
                                        $rangs_number = $rangresult->num_rows;
                                        if($rangs_number == 1)
                                        {
                                        
                                            $drsql = "DELETE FROM `admins_db` WHERE Email = '$suemail'";

                                            $db->query($drsql);
                                        }
                                        $rangresult->close();
                                    }
                                }
                                if($_POST['radio_rangs'] == 1)
                                {
                                    

                                    if($rangresult = $db->query($rsql))
                                    {
                                        $rangs_number = $rangresult->num_rows;
                                        if($rangs_number == 1)
                                        {
                                        
                                            $drsql = "UPDATE `admins_db` SET `Rang_strong`='1' WHERE Email = '$suemail'";
                                             
                                            $db->query($drsql);
                                        }
                                        else
                                        {
                                            $drsql = "INSERT INTO `admins_db`(`Email`, `Rang_strong`) VALUES ('$suemail','1')";
                                             
                                            $db->query($drsql);
                                        }
                                        $rangresult->close();
                                    }
                                }
                                if($_POST['radio_rangs'] == 2)
                                {
                                    

                                    if($rangresult = $db->query($rsql))
                                    {
                                        $rangs_number = $rangresult->num_rows;
                                        if($rangs_number == 1)
                                        {
                                        
                                            $drsql = "UPDATE `admins_db` SET `Rang_strong`='2' WHERE Email = '$suemail'";
                                             
                                            $db->query($drsql);
                                        }
                                        else
                                        {
                                            $drsql = "INSERT INTO `admins_db`(`Email`, `Rang_strong`) VALUES ('$suemail','2')";
                                             
                                            $db->query($drsql);
                                        }
                                        $rangresult->close();
                                    }
                                }
                                if($_POST['radio_rangs'] == 3)
                                {
                                    

                                    if($rangresult = $db->query($rsql))
                                    {
                                        $rangs_number = $rangresult->num_rows;
                                        if($rangs_number == 1)
                                        {
                                        
                                            $drsql = "UPDATE `admins_db` SET `Rang_strong`='3' WHERE Email = '$suemail'";
                                             
                                            $db->query($drsql);
                                        }
                                        else
                                        {
                                            $drsql = "INSERT INTO `admins_db`(`Email`, `Rang_strong`) VALUES ('$suemail','3')";
                                             
                                            $db->query($drsql);
                                        }
                                        $rangresult->close();
                                    }
                                }

                                

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

                            $bsql = "SELECT * FROM banned_db WHERE Banned_email = '$suemail'";

                            if($banresult = $db->query($bsql))
                            {
                                $ban_number = $banresult->num_rows;
                                if($ban_number == 1)
                                {
                                    $Urangs=4;
                                }
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
                                case 4: 
                                    echo  " <label id='rang_style_headadmin'>BANNED</label>";
                                    break;
                                
                                
                            }
                            echo "<label>Status:</label>";

        
                            if($Uonline != 0)
                                echo  " <label id='user_online'>ON-LINE</label>";
                            else
                                echo  " <label id='user_offline'>OFF-LINE</label>";     




                            echo '<label>Join date:</label>';                                    
                            echo '<label id="user_join_date">'. $Ujdate .'</label>';


                            echo '<form name="user_control_form" action="write_ban_side.php" method="get">';
                            
                          
                            if($_SESSION['Rangs'] > 1 && $Uid != $_SESSION['id'])
                            {
                                if($Urangs != 4)
                                    echo '<input class="button_user" name="ban_user" type="submit" value="Banned">';
                            }


                            echo '<input name="ban_user_id" type="hidden" value="'.$Uid .'">';
                            echo '</form>'; 

                            echo '<form name="user_unban_form" action="unban.php" method="get">';
                            
                            if($Urangs == 4 && $_SESSION['Rangs'] == 3)
                                echo '<input class="button_user" name="unban_user" type="submit" value="Unban">';

                            echo '<input name="ban_user_id" type="hidden" value="'.$Uid .'">';
                            echo '<input name="ban_user_email" type="hidden" value="'.$suemail .'">';
                            echo '</form>'; 

                            echo '<form name="user_control_form" action="profil_user.php?author_id='.$Uid.'" method="post">';
                            
                          
                            if($_SESSION['Rangs'] == 3 && $Uid != $_SESSION['id'])
                            {
                                if($Urangs != 4)
                                {
                                    echo '<input onclick="showRangs()" class="button_user" name="show_rangs_button" type="button" value="Set rangs">';
                                    echo '<div id="contener_radio_rangs">';
                                        echo '<div id="contener_radio_user">';
                                            echo '<input id="radio_user" name="radio_rangs" type="hidden" value="0">';
                                            echo '<label id="user_label"></label>';
                                        echo '</div>';
                                        echo '<div id="contener_radio_mod">';
                                            echo '<input id="radio_mod" name="radio_rangs" type="hidden" value="1">';
                                            echo '<label id="mod_label"></label>';
                                        echo '</div>';
                                        echo '<div id="contener_radio_admin">';
                                            echo '<input id="radio_admin" name="radio_rangs" type="hidden" value="2">';
                                            echo '<label id="admin_label"></label>';
                                        echo '</div>';
                                        echo '<div id="contener_radio_hadmin">';
                                            echo '<input id="radio_hadmin" name="radio_rangs" type="hidden" value="3">';
                                            echo '<label id="hadmin_label"></label>';
                                        echo '</div>';

                                    echo '</div>';

                                    echo '<input id ="rangs_button"class="button_user" name="save_rangs_button" type="hidden" value="Save rangs">';
                                }
                            }
 

                             
                            echo '</form>'; 



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

            <script src="scriptrangs.js?<?=filemtime("scriptrangs.js")?>"></script>
        </div>
    </body>
</html>
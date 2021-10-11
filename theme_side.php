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
        <link href="theme_style.css?<?=filemtime("theme_style.css")?>" rel="stylesheet" type="text/css" />
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
                            echo' <a id="admin_look_all" href="user_list_side.php"><img class="image_header_icon" title="User list side" alt="Go to user list side icon" src="images/icon_link/profils.png" ></a>';
                   
                  
               
                    
                    ?>
                    <a id="user_go_ticket" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to Ticket side icon" src="images/icon_link/tickets.png" ></a> 
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out"  alt="Log out icon" src="images/icon_link/logout.png"></a>
                </div>

            </div>

            <div id="main">
            <?php      
               
                $aem;$themstat;
                $tid = $_GET['id_theme'];

                require_once "connect_mysql.php";
                $db = @mysqli_connect($host , $username, $userpassword, $namedb);


                if(!$db)
                    echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                else
                {
                    if(!empty($_POST['send_text']) && isset($_POST['send_text']))
                    {
                        $wid = $_SESSION['id'];
                        $datesecond = time(); 
                        $nowDate = date('Y-m-d', $datesecond);

                        $textval = $_POST['send_text'];

                        $umsgsql = "INSERT INTO `message_db` (`Writter_ID`, `Thema_ID`, `Date_added`, `Value`) VALUES ('$wid','$tid','$nowDate','$textval')";
                         
                        $db->query($umsgsql);

                        
                    }
                   
       
                    if(isset($_POST['radio_priority_form']))
                    {
                        if($_SESSION['Rangs'] >= 1)
                        {
                            if($_POST['radio_priority_form'] == 1)
                            {
                                $priorsql = "UPDATE `ticket_db` SET `Priority`='0' WHERE ID='$tid'";
                                 
                                
                                $db->query($priorsql);
        
                            }
                            elseif($_POST['radio_priority_form'] == 2)
                            {
                                $priorsql = "UPDATE `ticket_db` SET `Priority`='1' WHERE ID='$tid'";
                               
                                
                                $db->query($priorsql);
                            }
                            elseif($_POST['radio_priority_form'] == 3)
                            {
                                $priorsql = "UPDATE `ticket_db` SET `Priority`='2' WHERE ID='$tid'";
                                
                                
                                $db->query($priorsql);

                            }
                        }
                    }
                    if(isset($_POST['radio_status_form']))
                    { 
                        if($_SESSION['Rangs'] >= 1)
                        {
                            if($_POST['radio_status_form'] == 1)
                            {
                                $statrsql = "UPDATE `ticket_db` SET `Status`='1' WHERE ID='$tid'";
                                 
                                
                                $db->query($statrsql);

                                
                            }
                            elseif($_POST['radio_status_form'] == 2)
                            {
                                $statrsql = "UPDATE `ticket_db` SET `Status`='2' WHERE ID='$tid'";
                                 
                                
                                $db->query($statrsql);
                              
                            }
                            elseif($_POST['radio_status_form'] == 3)
                            {
                                $statrsql = "UPDATE `ticket_db` SET `Status`='0' WHERE ID='$tid'";
                                 
                                
                                $db->query($statrsql);
                                
                            }
                        }
                    }

                    $sql = "SELECT * FROM ticket_db WHERE ID = '$tid'";
                  
                            
                    if($resultr = $db->query($sql))
                    {
                        $users_number = $resultr->num_rows;
                        if($users_number == 1)
                        {

                          
                            $data = $resultr->fetch_assoc();
                            $aem = $data['Author_email'];
                            $themstat = $data['Status'];
                            echo '<title>' .$data["Title"] .' </title>';
                        }
                        else
                        {

                            header('location: profil_side.php');
                        }
                        $resultr->close();
                    }
                    $sql2 = "SELECT * FROM users_db WHERE Email = '$aem'";
                  
                    if($queryt = $db->query($sql2))
                    {
                       
                        
                        $urs = $queryt->num_rows;
                        if($urs == 1)
                        {   
                        
                            // $dataq['Join_Date'];
                            // $dataq['Images_url'];
                            // $dataq['Online'];
                            // $dataq['ID'];
                            $dataq = $queryt->fetch_assoc();
                           
                            $uid = $dataq['ID'];
                            $uimageurl = $dataq['Images_url'];
                            $uname = $dataq['Name'];
                            $usurname = $dataq['Surname'];
                            $ujdata = $dataq['Join_Date'];
                            $ustatus = $dataq['Online'];
                           


                            if($admquert = $db->query("SELECT Rang_strong FROM admins_db WHERE Email = '$aem'"))
                            {
                                 
                                $admrows = $admquert->num_rows;
                                if($admrows != 1)
                                    $urangs=0;
                                else
                                {
                                    $admins = $admquert->fetch_assoc();
                                    $urangs = $admins['Rang_strong'];
                                }
                                $admquert->close(); 
                            }


                            if($banquery = $db->query("SELECT * FROM banned_db WHERE Banned_email = '$aem'"))
                            {
                                 
                                $ban_num = $banquery->num_rows;
                                if($ban_num == 1)
                                    $urangs = 4;
                                
                                $banquery->close(); 
                            }
                            echo '<div id = "option_contener">';
                            echo '<div id = "profil_contener">';
                                
                                echo '<form  name="send_form" id="user_name_ticket" action="profil_user.php" method="get">';
                                    echo '<div id="profil_image_contener">';
                                        if(!empty($uimageurl))
                                            echo '<input id = "profil_image" type="image" src="User_profils\\'.$uid.'\\'.$uimageurl.'" alt="User image go to profil" />';
                                        else
                                            echo '<input id = "profil_image" type="image" src="User_profils\default_profil\default.png"  alt="User image go to profil" /> ';
                                    echo '</div>';
    
                                    echo '<div id = "profil_information">';
                                        // $uid;
                                    
                                        echo '<input  name="author_id"  type="hidden" value="'.$uid.'" /> ';

                                        switch($urangs)
                                        {
                                        
                                            case 0: 
                                                echo  ' <label id="user_name_user_label">'. $uname." ".$usurname.'</label>';
                                                echo  " <label id='rang_style_user'>User</label>";
                                                break;
                                            case 1: 
                                                echo  ' <label id="user_name_moderator_label">'. $uname." ".$usurname.'</label>';
                                                echo  " <label id='rang_style_moderator'>Moderator</label>";
                                                break;
                                            case 2: 
                                                echo  ' <label id="user_name_admin_label">'. $uname." ".$usurname.'</label>';
                                                echo  " <label id='rang_style_admin'>Administrator</label>";
                                                break;
                                            case 3: 
                                                echo  ' <label id="user_name_hadmin_label">'. $uname." ".$usurname.'</label>';
                                                echo  " <label id='rang_style_headadmin'>Head Administrator</label>";
                                                break;
                                            case 4: 
                                                echo  ' <label id="user_name_hadmin_label">'. $uname." ".$usurname.'</label>';
                                                echo  " <label id='rang_style_headadmin'>Banned</label>";
                                                break;
                                        
                                        
                                        }
                                
                                        echo "<label>Status:</label>";
                                        
                                       
                                        if($ustatus == 1)
                                            echo  " <label id='user_online'>ON-LINE</label>";
                                        else
                                            echo  " <label id='user_offline'>OFF-LINE</label>";
                
                                       
                                      
                            
                                    echo '</div>';
                                echo '</form>';
                            echo '</div>';

                        }
                        $queryt->close();
                    }
                    
                    if($result = $db->query($sql))
                    {
                        $users_number = $result->num_rows;
                        if($users_number == 1)
                        {

                            $data = $result->fetch_assoc();
                   
                            
    
                            echo '<div id = "settings_contener">';
                                echo '<div id = "title_settings_contener">';

                                

                                    echo 'Title: '.$data["Title"].'';
                                    switch($themstat)
                                    {   
                                        case 0:
                                            echo '<label id="label_status_close">Close</label>';
                                            break;
                                        case 1;
                                            echo '<label id="label_status_open">Open</label>';
                                            break;
                                        case 2;
                                            echo '<label id="label_status_answered">Answered</label>';
                                            break;
    
                                    }


                                    switch($data['Priority'])
                                    {   
                                        case 0:
                                            echo '<label id="label_priority_low">Low</label>';
                                            break;
                                        case 1;
                                            echo '<label id="label_priority_medium">Medium</label>';
                                            break;
                                        case 2;
                                            echo '<label id="label_priority_hight">Hight</label>';
                                            break;
    
                                    }
                                echo '</div>';
                
                                echo '<div id = "thema_settings_contener">';
                                    echo ''.$data["Value"].'';
                                  echo '</div>';
                             echo '</div>';
                
                            echo '</div>';
                            

                        }
                        $result->close();
                    }

                   
                    $msgsql = "SELECT * FROM message_db WHERE Thema_ID = '$tid'";
                      
                     
                            
                    if($resultmess = $db->query($msgsql))
                    {
                        $mess_number = $resultmess->num_rows;
                        if($mess_number != 0)
                        {
                            foreach ($resultmess as $item) 
                            {

                                $umid = $item['Writter_ID'];
                                $umsgsql = "SELECT * FROM users_db WHERE ID = '$umid'";

                                echo '<div id = "option_contener">';
                                if($resultuser = $db->query($umsgsql))
                                {
                                    $mess_user_number = $resultuser->num_rows;
                                    if($mess_user_number != 0)
                                    {
                                        $dataumess = $resultuser->fetch_assoc();
                                        echo '<div id = "profil_contener">';
                                        echo '<form  name="Message-'.$umid.'" id="user_name_ticket" action="profil_user.php" method="get">';
                                                    echo '<div id="profil_image_contener">';
                                                        if(empty($dataumess['Images_url']))
                                                            echo '<input id = "profil_image" type="image" src="User_profils/default_profil/default.png"  alt="User image go to profil" /> ';
                                                        else
                                                            echo '<input id = "profil_image" type="image" src="User_profils/'.$dataumess['ID'].'/'.$dataumess['Images_url'].'"  alt="User image go to profil" /> ';

                                                    echo '</div>';
                                                    
                                                echo '<div id = "profil_information">';

                                                    $urangs;
                                                    $aem = $dataumess['Email'];
                                                    if($admquert = $db->query("SELECT Rang_strong FROM admins_db WHERE Email = '$aem'"))
                                                    {
                                                        
                                                        $admrows = $admquert->num_rows;
                                                        if($admrows == 0)
                                                            $urangs=0;
                                                        else
                                                        {
                                                            $admins = $admquert->fetch_assoc();
                                                            $urangs = $admins['Rang_strong'];
                                                        }
                                                        $admquert->close(); 
                                                    }
                                                  
                                                
                                                    if($banquery = $db->query("SELECT * FROM banned_db WHERE Banned_email = '$aem'"))
                                                    {
                                                             
                                                        $ban_num = $banquery->num_rows;
                                                         if($ban_num == 1)
                                                            $urangs = 4;
                                                            
                                                        $banquery->close(); 
                                                    }
                                            
                                                    
                                                   
                                                    $ustatus = $dataumess['Online'];
                                                    $uname  = $dataumess['Name'];
                                                    $usurname  = $dataumess['Surname'];
                                                    switch($urangs)
                                                    {
                                                    
                                                        case 0: 
                                                            echo  ' <label id="user_name_user_label">'. $uname." ".$usurname.'</label>';
                                                            echo  " <label id='rang_style_user'>User</label>";
                                                            break;
                                                        case 1: 
                                                            echo  ' <label id="user_name_moderator_label">'. $uname." ".$usurname.'</label>';
                                                            echo  " <label id='rang_style_moderator'>Moderator</label>";
                                                            break;
                                                        case 2: 
                                                            echo  ' <label id="user_name_admin_label">'. $uname." ".$usurname.'</label>';
                                                            echo  " <label id='rang_style_admin'>Administrator</label>";
                                                            break;
                                                        case 3: 
                                                            echo  ' <label id="user_name_hadmin_label">'. $uname." ".$usurname.'</label>';
                                                            echo  " <label id='rang_style_headadmin'>Head Administrator</label>";
                                                            break;
                                                        case 4: 
                                                            echo  ' <label id="user_name_hadmin_label">'. $uname." ".$usurname.'</label>';
                                                            echo  " <label id='rang_style_headadmin'>Banned</label>";
                                                            break;
                                                    
                                                    }
                                            
                                                    echo "<label>Status:</label>";
                                                    
                                                
                                                    if($ustatus == 1)
                                                        echo  " <label id='user_online'>ON-LINE</label>";
                                                    else
                                                        echo  " <label id='user_offline'>OFF-LINE</label>";
                            
                                                    echo '<input  name="author_email"  type="hidden" value="'.$aem.'" /> ';

                                                


                                                echo '</div>';
                                        echo '</form>';
                                
                                    }
                                          
                                    $resultuser->close();
                                
                                }


                                    echo '</div>';
                                                
                                    echo '<div id = "settings_contener">';
                                        
                
                                        echo '<div id = "message_settings_contener">';
                                        
                                                echo ''.$item['Value'].'';
                
                                        echo '</div>';
                                    echo '</div>';
                
                                echo '</div>';

                            }
                        }
                        $resultmess->close();
                        
                        
                    }

               

            
                    echo '<div id = "option_contener">';
                 
                    

                    if($themstat == 1)
                    {
                        
                       
                        echo '<div id = "write_message_contener">';
                            
                            echo '<form  name="send_message_forms"  action="theme_side.php?id_theme='.$tid.'" method="post">';
                                echo '<div id = "write_message_contener">';
                                    echo '<div id = "message_contener">';
                                        echo '<textarea id="text_message" type="text" maxlength="325" name="send_text"></textarea>';

                                            if($_SESSION['Rangs'] >= 1)
                                            {
                                                echo '<div id = "radius_contener">';
                                                    echo '<label>Priority:</label> ';
                                                    echo '<div id = "radius_center_contener">';
                                                    echo '<input class="radio_priority_message" type="radio"  value="1" name="radio_priority_form"/>';
                                                    echo '<label for"radio_priority_form">Low</label> ';
                                                    echo '<input class="radio_priority_message" type="radio"  value="2" name="radio_priority_form"/>';
                                                    echo '<label for"radio_priority_form">Medium</label> ';
                                                    echo '<input class="radio_priority_message" type="radio" value="3"  name="radio_priority_form"/>';
                                                    echo '<label for"radio_priority_form">High</label> ';
                                                    echo '</div>';

                                                    echo '<label>Status:</label> ';
                                                    echo '<div id = "radius_center_contener">';
                                                    echo '<input  class="radio_status_message" type="radio" value="1"   name="radio_status_form"/>';
                                                    echo '<label for"radio_status_form">Open</label> ';
                                                    echo '<input  class="radio_status_message" type="radio" value="2"  name="radio_status_form"/>';
                                                    echo '<label for"radio_status_form">Answered</label> ';
                                                    echo '<input class="radio_status_message" type="radio"  value="3" name="radio_status_form"/>';
                                                    echo '<label for"radio_status_form">Close</label> ';
                                                    echo '</div>';
                                                echo '</div>';
                                            }

                                    
                                        
                                    echo '</div>';
                                    echo '<input id="button_message" type="submit" value="Send" name="send_button"/>';
                                    echo '<input name="id_theme" value="'.$tid.'" type="hidden">';
                                echo '</div>';
                            echo '</form>';
                    
                   
        
                        echo '</div>';
                    }
                    if($themstat == 2 && $_SESSION['Rangs'] >= 2)
                    {

                         
                        echo '<div id = "write_message_contener">';
                            
                            echo '<form  name="send_message_forms"  action="theme_side.php?id_theme='.$tid.'" method="post">';
                                echo '<div id = "write_message_contener">';
                                    echo '<div id = "message_contener">';
                                        echo '<textarea id="text_message" type="text" maxlength="325" name="send_text"></textarea>';

                                            if($_SESSION['Rangs'] >= 1)
                                            {
                                                echo '<div id = "radius_contener">';
                                                    echo '<label>Priority:</label> ';
                                                    echo '<div id = "radius_center_contener">';
                                                    echo '<input class="radio_priority_message" type="radio"  value="1" name="radio_priority_form"/>';
                                                    echo '<label for"radio_priority_form">Low</label> ';
                                                    echo '<input class="radio_priority_message" type="radio"  value="2" name="radio_priority_form"/>';
                                                    echo '<label for"radio_priority_form">Medium</label> ';
                                                    echo '<input class="radio_priority_message" type="radio" value="3"  name="radio_priority_form"/>';
                                                    echo '<label for"radio_priority_form">High</label> ';
                                                    echo '</div>';

                                                    echo '<label>Status:</label> ';
                                                    echo '<div id = "radius_center_contener">';
                                                    echo '<input  class="radio_status_message" type="radio"  value="1"  name="radio_status_form"/>';
                                                    echo '<label for"radio_status_form">Open</label> ';
                                                    echo '<input  class="radio_status_message" type="radio" value="2"  name="radio_status_form"/>';
                                                    echo '<label for"radio_status_form">Answered</label> ';
                                                    echo '<input class="radio_status_message" type="radio"  value="3" name="radio_status_form"/>';
                                                    echo '<label for"radio_status_form">Close</label> ';
                                                    echo '</div>';
                                                echo '</div>';
                                            }

                                    
                                        
                                    echo '</div>';
                                    echo '<input id="button_message" type="submit" value="Send" name="send_button"/>';
                                    echo '<input name="id_theme" value="'.$tid.'" type="hidden">';
                                echo '</div>';
                            echo '</form>';
                    
                   
        
                        echo '</div>';
                    }

                 
                    $db->close();
                }
                
                
           
            ?>
        </div>

        <div id="footer">

            <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


        </div>

            
        </div>
    </body>
</html>
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
               
                $aem;$themstat;$inarchive=false;
                $tid = $_GET['id_theme'];
                $_GET['id_theme'] = NULL;
                require_once "connect_mysql.php";
                $db = @mysqli_connect($host , $username, $userpassword, $namedb);


                if(!$db)
                    echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                else
                {


                    if(isset($_POST['submit_archive_button']))
                    {
                        $copysql = "SELECT * FROM `ticket_db` WHERE ID='$tid'";
                        if($copyresult = $db->query($copysql))
                        {
                            $copy_numer = $copyresult->num_rows;

                            
                            if($copy_numer == 1)
                            {
                                $data = $copyresult->fetch_assoc();

                                

                                $copyAdd = $data['Date_added'];	
                                $copyTitle = $data['Title'];	
                                $copyAuthorID = $data['Author_id'];	
                                $copyAuthorName = $data['Author_name'];	
                                $copyAuthorSurname = $data['Author_surname'];	
                                $copyAuthorEmail = $data['Author_email'];	
                                $copyStatus = $data['Status'];	
                                $copyPriority = $data['Priority'];	
                                $copyValue = $data['Value'];

                                
                                $delsql = "DELETE FROM `ticket_db` WHERE ID='$tid'";
                                $db->query($delsql);

                                $insql = "INSERT INTO `archive_db`(`ID`,`Date_added`, `Title`, `Author_id`, `Author_name`, `Author_surname`, `Author_email`, `Status`, `Priority`, `Value`)  VALUES ('$tid','$copyAdd','$copyTitle','$copyAuthorID','$copyAuthorName','$copyAuthorSurname','$copyAuthorEmail','0','$copyPriority','$copyValue')";
                                $db->query($insql);
                               


                            }



                            $copyresult->close();
                        }
                    }

                    if(isset($_POST['submit_edit_button']))
                    {
                       if(isset($_POST['send_edit_text']) && !empty($_POST['send_edit_text']))
                       {
                           $editValue = $_POST['send_edit_text'];
                           $lastValue =  $_POST['edit_value'];
                           if($_POST['edit_value'] !=  $_POST['send_edit_text'])
                           {
                                $priorsql = "UPDATE `ticket_db` SET `Value`='$editValue' WHERE ID='$tid'";
                                $db->query($priorsql);
                                $datesecond = time(); 
                                $nowDate = date('Y-m-d', $datesecond);
                                $wrid = $_SESSION['id'];
                                $editsql = "INSERT INTO `edit_db`( `Writter_ID`, `Thema_ID`, `Edit_value`, `Date_edit`) VALUES ('$wrid','$tid',' $lastValue','$nowDate')";
                                $db->query($editsql);

                                
                           }
                       }
                    }
                    
                    if(!empty($_POST['send_text']) && isset($_POST['send_text']))
                    {
                        $wid = $_SESSION['id'];
                        $datesecond = time(); 
                        $nowDate = date('Y-m-d', $datesecond);

                        $textval = $_POST['send_text'];

                        $umsgsql = "INSERT INTO `message_db` (`Writter_ID`, `Thema_ID`, `Date_added`, `Value`) VALUES ('$wid','$tid','$nowDate','$textval')";
                        
                        $db->query($umsgsql);
                        if($_SESSION['Rangs'] >= 1)
                        {
                            $db->query("UPDATE `ticket_db` SET `Status`='2' WHERE ID='$tid'");
                            $sendresult = $db->query("SELECT * FROM `ticket_db` WHERE ID='$tid'");
                            $send_num =  $sendresult->num_rows;
                            // if($send_num == 1)
                            
                            //     $data = $sendresult->fetch_assoc();
                            //     $to = "". $data['Author_email']."";
                            //     $subject = "Your ticket: ".$data['Title']."";
                                
                            //     $message = "<b>Hello ".$data['Author_name'].".</b> <h1>You have received a new reply in your subject line.</h1><br><h2>Click <a herf='localhost/projects/theme_side.php?id_theme=".$tid."' >here</a> </h2>";
                               
                              
                                
                            //     $headers =  'MIME-Version: 1.0' . "\r\n"; 
                            //     $headers .= 'From: Admin<info@devxord.com>' . "\r\n";
                            //     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
                                
                            //     $retval = mail ($to,$subject,$message,$headers  );
                                
                            //     if( $retval == true ) {
                            //     echo "Message sent successfully...";
                            //     }else {
                            //     echo "Message could not be sent...";
                            // }

                        }
                        else
                            $db->query("UPDATE `ticket_db` SET `Status`='1' WHERE ID='$tid'");
                             
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
                         
                            if($_POST['radio_status_form'] == 3)
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
                            $asql = "SELECT * FROM archive_db WHERE ID = '$tid'";
                            if($aresult = $db->query($asql))
                            {
                                $archive_number = $aresult->num_rows;
                                if($archive_number == 1)
                                {
                                    $data = $aresult->fetch_assoc();
                                    $aem = $data['Author_email'];
                                    $themstat = $data['Status'];
                                    echo '<title>' .$data["Title"] .' </title>';
                               
                                    $sql = "SELECT * FROM archive_db WHERE ID = '$tid'";  
            
                                    $inarchive = true;

                                }
                                else
                                    header('location: profil_side.php');
                                $aresult->close();
                            }
                        }
                         
                    }

                    $sql2 = "SELECT * FROM users_db WHERE Email = '$aem'";
                  
                    if($queryt = $db->query($sql2))
                    {
                       
                        
                        $urs = $queryt->num_rows;
                        if($urs == 1)
                        {   
                        
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
                                            echo '<label id="label_status_open">Expectancy</label>';
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
                                 
                                        if($inarchive == true)
                                        {
                                            echo '<div id = "thema_settings_contener">';
                                                echo '<label id="label_thema_value">'.$data["Value"].'</label>';
                                            echo '</div>';
                                        }
                                        else
                                        {
                   
                                            echo '<div id = "thema_settings_contener">';
                                                echo '<form id="edit_form" action="theme_side.php?id_theme='.$tid.'" method="post">';
                                                    echo '<textarea id="text_edit_message" type="hidden" maxlength="325" name="send_edit_text" >'.$data["Value"].'</textarea>';
                                                    echo '<label id="label_thema_value">'.$data["Value"].'</label>';
                                                    echo '<input name="edit_value" type="hidden" value="'.$data["Value"].'"/>';
                                                    echo '<input name="submit_edit_button" type="submit" id="submit_edits_button" value="Save"/>';
                                                echo '</form>';
                                                echo '</div>';
                                            }
                                        if($inarchive == false)
                                        {
                                             
                                            echo '<form id="archive_form" action="theme_side.php?id_theme='.$tid.'" method="post">';
                                            
                                                echo '<input name="submit_archive_button" type="submit" id="submit_archive_button" value="Go to archive"/>';
                                            echo '</form>';
                                        }

                                    if($themstat != 0 && $inarchive == false)
                                        echo '<input name="edit_button" type="button" id="edits_button" onclick="showeditthema()" value="Edit"/>';
                                    if($_SESSION['Rangs'] == 3)
                                    {
                                        $usid = $_SESSION['id'];
                                        $editsql = "SELECT * FROM edit_db WHERE Writter_ID = '$usid' ORDER BY ID DESC";
                                        if($editresult = $db->query($editsql))
                                        {
                                            $edit_number = $editresult->num_rows;
                                            if($edit_number >= 1)
                                            {
                                                foreach ($editresult as $item) {
                                                   
                                                    echo '<div id = "thema_settings_contener">';
                                        
                                                    echo '<label id="label_thema_value">Edited: '.$item["Date_edit"].'</label><br><br>';
                                                    echo '<label id="label_thema_value">'.$item["Edit_value"].'</label>';
                                                


                                                    echo '</div>';
                                                }
                                                 
                                            }
                                        }
                                            
                                         
                                    }
                             echo '</div>';
                
                            echo '</div>';
                           

                        }
                        $result->close();
                    }

                   
                    $msgsql = "SELECT * FROM message_db WHERE Thema_ID = '$tid' ORDER BY ID DESC";
                      
                     
                            
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
                                        
                                                 echo '<label id="label_message_value">'.$item["Value"].'</label>';
                                            echo '<input name="edit_value" type="hidden" value="'.$item["Value"].'"/>';
                                               
                                        echo '</div>';
                                       
                                        
                                   
                                   
                                     echo '</div>';


                
                                echo '</div>';

                            }
                        }
                        $resultmess->close();
                        
                        
                    }

               

            
                    echo '<div id = "option_contener">';
                 
                    

                        if(($themstat == 2 || ($themstat == 1 && $_SESSION['Rangs'] >= 2)) && $inarchive != true)
                        {

                            
                            echo '<div id = "write_message_contener">';
                                
                                echo '<form  name="send_message_forms"  action="theme_side.php?id_theme='.$tid.'" method="post">';
                                    echo '<div id = "write_message_contener">';
                                        echo '<div id = "message_contener">';
                                            echo '<textarea id="text_message" type="text" maxlength="325" name="send_text"></textarea>';

                                        
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
                                                        echo '<input class="radio_status_message" type="radio"  value="3" name="radio_status_form"/>';
                                                        echo '<label for"radio_status_form">Close</label> ';
                                                        echo '</div>';
                                                    echo '</div>';
                                                

                                        
                                            
                                        echo '</div>';
                                        echo '<input id="button_message" type="submit" value="Send" name="send_button"/>';
                                        echo '<input name="id_theme" value="'.$tid.'" type="hidden">';
                                    echo '</div>';
                                echo '</form>';
                        
                    
            
                            echo '</div>';
                        }
                    
                    echo '</div>';
                    $db->close();
                }
                if($inarchive == false )
                    echo '<script src="editscript.js?<?=filemtime("editscript.js")?>"></script>';
           
            ?>
            
          
        </div>

        <div id="footer">

            <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


        </div>

            
        </div>
    </body>
</html>
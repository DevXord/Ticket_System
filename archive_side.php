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
        <title>Archive List</title>
        <!-- <link rel="stylesheet" type="text/css" href="ticket_style.css" /> -->
        <link href="archive_style.css?<?=filemtime("archive_style.css")?>" rel="stylesheet" type="text/css" />

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
                   
 
                        }
                  
                    
                    ?>
                    <a id="user_go_ticket" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to Ticket side icon" src="images/icon_link/tickets.png" ></a>

                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out" alt="Log out icon"src="images/icon_link/logout.png"></a>
                </div>
            </div>



            <div id="main">
            <label id="archiv_label">Archive</label>
                <div id="ticket_conener">
                   
                    <div id="ticket_page">


                      

                        <?php 

                        echo '<form id="form_select"  action="archive_side.php" method="post">';
                     

                        echo '</form>'; 
                   
                            echo '<input form="form_select" class="label_class" name="click_checkall" type="submit" value="Check all"/>';
                          
                            echo '<input type="submit" form="form_select" name="click_id" class="label_class"  value="ID"/>';
                          
                            echo '<input type="submit" form="form_select" name="click_user" class="label_class"   value="User"/>';
                          
                            echo '<input type="submit" form="form_select" name="click_tit" class="label_class"   value="Title"/>';
                         
                            echo '<input type="submit" form="form_select" name="click_date" class="label_class"   value="Date added"/>';
                         
                            echo '<input type="submit" form="form_select" name="click_ststus" class="label_class" value="Status"/>';
                      
                            echo '<input type="submit" form="form_select" name="click_priorit" class="label_class"  value="Priority"/>';
                      
                         
                        ?>
                    </div>      
                    

                        
                    <div id="ticket_list_contener">
                        <?php
                            $listtickets = [];
                            $listuser = [];
                          
                            
                            require_once "connect_mysql.php";
                            $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                            if(!$db)
                                echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                            else
                            {
                                $aemail = $_SESSION['uemail'];

                                if(isset($_POST['click_checkall']))
                                {
                                    if($_SESSION['checkcl'] == false)
                                    {
                                        $_SESSION['checkcl'] = true;
                                    }
                                    else
                                    {
                                        $_SESSION['checkcl'] = false;
                                    }
                                }
                                
                                if(isset($_POST['click_id']))
                                    if( $_SESSION['cliid'] == true) 
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY ID DESC";
                                        $_SESSION['cliid'] = false;
                                    }
                                    else
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY ID";
                                        $_SESSION['cliid'] = true;
                                    }
                                elseif(isset($_POST['click_user']))
                                    if( $_SESSION['aunam'] == true) 
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Author_name DESC";
                                        $_SESSION['aunam'] = false;
                                    }
                                    else
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Author_name";
                                        $_SESSION['aunam'] = true;
                               
                                       
                                    }
                                elseif(isset($_POST['click_tit']))
                                    if( $_SESSION['tits'] == true) 
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Title DESC";
                                        $_SESSION['tits'] = false;
                                         
                                    }
                                    else
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Title";
                                        $_SESSION['tits'] = true;
                                        
                                    }
                                elseif(isset($_POST['click_date']))
                                    if($_SESSION['datas'] == true) 
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Date_added DESC";
                                        $_SESSION['datas'] = false;
                                    }
                                    else
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Date_added";
                                        $_SESSION['datas'] = true;
                                    }
                                elseif(isset($_POST['click_ststus']))
                                    if($_SESSION['status'] == true)
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Status DESC";          
                                        $_SESSION['status'] = false;
                                    }
                                    else
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Status"; 
                                        $_SESSION['status'] = true;
                                    }
                                elseif(isset($_POST['click_priorit']))
                                    if($_SESSION['priorit'] == true)
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Priority DESC"; 
                                        $_SESSION['priorit'] = false;
                                    }
                                    else
                                    {
                                        $usql = "SELECT * FROM `archive_db` ORDER BY Priority"; 
                                        $_SESSION['priorit'] = true;
                                    }
                                elseif(isset($_POST['radio_user']))
                                {
                                    $serch = $_POST['search_ticket_text'];
                                     
                                    if($_POST['radio_user'] == 1)
                                    {
                                        if(!empty($serch))
                                            $usql = "SELECT * FROM `archive_db` WHERE Author_name LIKE '$serch%'";
                                        else
                                            $usql = "SELECT * FROM `archive_db` ORDER BY Author_name DESC";

                                    }
                                    if($_POST['radio_user'] == 2)
                                    {
                                        if(!empty($serch))
                                            $usql = "SELECT * FROM `archive_db` WHERE Title LIKE '$serch%'";
                                        else
                                            $usql = "SELECT * FROM `archive_db` ORDER BY Title DESC";

                                    }
                                    if($_POST['radio_user'] == 3)
                                    {
                                        if(!empty($serch))
                                            $usql = "SELECT * FROM `archive_db` WHERE ID = '$serch'";
                                        else
                                            $usql = "SELECT * FROM `archive_db` ORDER BY ID DESC";

                                    }



                                }
                                else
                                {
                                    if($_SESSION['Rangs'] >= 1)
                                        $usql = "SELECT * FROM `archive_db` ORDER BY ID DESC";
                                    else
                                        $usql = "SELECT * FROM `archive_db` WHERE Author_email = '$aemail' ORDER BY ID DESC";
                            
                                }
                                
                                 
                             
                                if($result = $db->query($usql))
                                {
                                    $tcket_number = $result->num_rows;
                                    if($tcket_number != 0)
                                    {
                                       
                                        foreach ($result as $item) {

                                            $listtickets[$item['ID']] = $item;

                                            $uemail =  $item['Author_email'];

                                            $querty = "SELECT * FROM users_db WHERE Email = '$uemail'";
                                               

                                            if($Uresult = $db->query($querty))
                                            {

                                                $users_number = $Uresult->num_rows;
                                                if($users_number == 1)
                                                {
                                                    $data = $Uresult->fetch_assoc();
                                                   
                                                    
                                                    $listuser[$data['ID']] =  $data;
                                                }
                                                 
                                              
                                                $Uresult->close();
                                             }


                                        }
                                    }
                                    $result->close();
                                }
                             
                                foreach ($listtickets  as $item) {
                                    if(isset($_POST['checkeds-'.$item["ID"].'']))
                                    {
                                        
                                        $delid=$item["ID"];
                                        $delsql = "DELETE FROM `archive_db` WHERE ID = '$delid'";
                                        $db->query($delsql);
                                 
                                        unset($listtickets[$item['ID']]);
                                    }

                                }
 
 
                                echo '<form id="delete_form" action="archive_side.php" method="post">';
                                           
                                echo '</form>';
                                foreach ($listtickets  as $item) {

                             
                                    echo '<div id="ticket_list">';
                                      
                                            
                                        echo '<div id="contener_checkbox">';

                                    
                                        if($_SESSION['checkcl'] == true)
                                        {
                                            echo '<input form="delete_form" type="checkbox" "id="user_checkbox" value="'.$item["ID"].'" name="checkeds-'.$item["ID"].'"checked>';
                                                
                                        }
                                        else
                                        {
                                            echo '<input form="delete_form" type="checkbox" "id="user_checkbox" value="'.$item["ID"].'" name="checkeds-'.$item["ID"].'">';
                                             
                                        }
                                        

                                        echo '</div>';
                                        echo '<div id="contener_ticid">';
                                        echo '<label class="label_class_in_list"  id="user_id">'.$item["ID"].'</label>';
                                      
                                        echo '</div>';
                                    
                                    
                                        
                                            echo '<div id="contener_image">';
                                                if(!empty($listuser[$item['Author_id']]['Images_url']))
                                                    $srcim = "User_profils\\". $listuser[$item['Author_id']]['ID']."\\" . $listuser[$item['Author_id']]['Images_url'];
                                                else
                                                    $srcim = 'User_profils\default_profil\default.png';
                                                
                                                $s = "'User-".$listuser[$item['Author_id']]['ID']."'";
                                                
                                                echo '<form  name="'.$s.'" id="user_name_ticket" action="profil_user.php" method="get">';
                                                    echo '<input name ="image_inputs"type="image" id="image_user_in_list"  src="'.$srcim.'" alt="Submit Form"/>';
                                                
                
    
                                             
                                                    echo '<label class="label_class_in_list" id="name_label" >'.$listuser[$item['Author_id']]["Name"].'</label><br>';
                                                    echo '<label class="label_class_in_list" id="sname_label" >'.$listuser[$item['Author_id']]["Surname"].'</label><br>';
                                                    echo '<label class="label_class_in_list"  id="email_label">'.$listuser[$item['Author_id']]["Email"]. '</label>';
                                              
                                                    echo '<input name="author_id" type="hidden" value="'.$listuser[$item['Author_id']]['ID'].'">';
                                                echo '</form>';
                                                
         
                                            
                                               
                                            
                                        
        
                                    
                                
                                            echo '</div>';
        
        
        
        
                                            echo '<div id="contener_title">';

                                            $s = "'Thema-".$item['ID']."'";
                                            
                                            echo '<form name ='. $s.' action="theme_side.php" method="get">';
                                                
                                        
                                                echo '<input name="id_theme" type="hidden" value="'. $item["ID"].'">';
                        
                                                echo '<a id = "user_ticket" onclick="document.forms['.$s.'].submit();">'.$item["Title"].'</a>';
                                            echo '</form>';
                                        
                                        echo '</div>';
                                        echo '<div id="contener_date">';
                                            echo '<label class="label_class_in_list"  id="user_date">'.$item["Date_added"].'</label>';
                                    
                                        echo '</div>';
                                     
                                        echo '<div id="contener_status">';
                                         switch($item["Status"])
                                         {
                                            case 0:
                                                 echo '<label class="label_class_in_list"  id="user_status_close">Close</label>';
                                                 break;
                                            case 1:
                                                 echo '<label class="label_class_in_list"  id="user_status_open">Expectancy</label>';
                                                 break;
                                          
                                            case 2:
                                                 echo '<label class="label_class_in_list"  id="user_status_ans">Answered</label>';
                                                 break;
                                         }
                                         echo '</div>';
                                         echo '<div id="contener_priority">';
                                         switch($item["Priority"])
                                        {
                                            case 0:
                                                echo '<label class="label_class_in_list" id="user_priority_low">Low</label>';
                                                break;
                                            case 1:
                                                echo '<label class="label_class_in_list" id="user_priority_medium">Medium</label>';
                                                break;
                                            case 2:
                                                echo '<label class="label_class_in_list" id="user_priority_hight">Hight</label>';
                                                break;
                                        }
                                        echo '</div>';
                                                       
                               
                                     
                                     
                                     
                                    echo '</div>';
        
                                        

                                    
                                } 
                                
                                
 
                              
                                $db->close();  
                            }
                            
                            
                            
                        
                        ?>
                         
                        </div>
                   
                </div>

                

                <div id="button_contener"> 
                 
                
                
                    <div id="button_delete_contener"> 
                        <button class="button_ticket" id="delete_ticket_bt" form="delete_form"  type="submit">Delete ticket</button>
                    </div> 
                    
                        <form herf="#" action="archive_side.php" name="serch_form" method="post"> 
                            <div id="serch_form_contener">   
                                <input class="text_ticket" id="search_ticket_tx" type="search" placeholder="Write a keyword" name="search_ticket_text">
                            </div>
                            <div id="radio_form_contener"> 
                                <input class="radio_ticket" value="1" id="search_user_radio"type="radio" name="radio_user">  <label for="radio_user">User</label>
                                <input class="radio_ticket" value="2" id="search_tickets_radio"type="radio" name="radio_user"> <label for="radio_user">Title</label>
                                <input class="radio_ticket" value="3" id="search_tickets_radio"type="radio" name="radio_user"> <label for="radio_user">ID</label>
                            </div>
                        </form>
                    
                </div>
                
             
            </div>





            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>
        </div>
    </body>
</html>
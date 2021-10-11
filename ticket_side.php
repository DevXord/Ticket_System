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
        <title>Ticket List</title>
        <!-- <link rel="stylesheet" type="text/css" href="ticket_style.css" /> -->
        <link href="ticket_style.css?<?=filemtime("ticket_style.css")?>" rel="stylesheet" type="text/css" />

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
                    
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out" alt="Log out icon"src="images/icon_link/logout.png"></a>
                </div>
            </div>



            <div id="main">
                
                <div id="ticket_conener">
                    <div id="ticket_page">


                      



                        
                        <label class="label_class" for="user_check" id="user_check_all"><input type="checkbox" id="all_user_checkbox" name="all_user_checkbox"></label>
                        <label class="label_class" id="user_name_click">Ticket ID</label>
                        <label class="label_class" id="user_name_click">User</label>
                        <label class="label_class" id="user_ticket_click">Ticket</label>
                        <label class="label_class" id="user_date_click">Date added</label>
                        <label class="label_class" id="user_status_click">Status</label>
                        <label class="label_class" id="user_priority_click">Priority</label>
                    
                    </div>      
                    

                        
                    <div id="ticket_list_contener">
                        <?php
                            $listtickets = [];
                            $listuser = [];
                            $_SESSION['checked_list'] = [];
                            require_once "connect_mysql.php";
                            $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                            if(!$db)
                                echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                            else
                            {
                                $aemail = $_SESSION['uemail'];
                             
                              
                                
                                if($_SESSION['Rangs'] >= 1)
                                    $usql = "SELECT * FROM `ticket_db`";
                                else
                                    $usql = "SELECT * FROM `ticket_db` WHERE Author_email = '$aemail'";
                            
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
                            
                               
                               
                                echo '<form id="delete_form" action="ticket_side.php" method="get">';
                                           
                                echo '</form>';
                                foreach ($listtickets  as $item) {

                             
                                    echo '<div id="ticket_list">';
                                      
                                            
                                
                                            echo '<input form="delete_form" type="checkbox" "id="user_checkbox" value="'.$item["ID"].'" name="checkeds-'.$item["ID"].'">';

                                           
                                         
                                           
                                          
                            
                                     
    
                                        echo '<label class="label_class_in_list"  id="user_id">'.$item["ID"].'</label>';
                                      
                                        
                                    
                                    
                                        
                                            echo '<div id="contener_image">';
                                                if(!empty($listuser[$item['Author_id']]['Images_url']))
                                                    $srcim = "User_profils\\". $listuser[$item['Author_id']]['ID']."\\" . $listuser[$item['Author_id']]['Images_url'];
                                                else
                                                    $srcim = 'User_profils\default_profil\default.png';
                                                
                                                $s = "'User-".$listuser[$item['Author_id']]['ID']."'";
                                                
                                                echo '<form  name="'.$s.'" id="user_name_ticket" action="profil_user.php" method="get">';
                                                    echo '<input name ="image_inputs"type="image" id="image_user_in_list"  src="'.$srcim.'" alt="Submit Form"/>';
                                                
                
                                                
                                                    
                                                    echo '<label id="surname_label" >'.$listuser[$item['Author_id']]["Name"].'</label>';
                                                    echo '<label id="name_label" >'.$listuser[$item['Author_id']]["Surname"].'</label>';
                                                
                                                    echo '<input name="author_id" type="hidden" value="'.$listuser[$item['Author_id']]['ID'].'">';
                                                echo '</form>';
                                                
         
                                            
                                                echo '<label  id="email_label">'.$listuser[$item['Author_id']]["Email"]. '</label>';
                                            
                                        
        
                                    
                                
                                            echo '</div>';
        
        
        
        
        

                                            $s = "'Thema-".$item['ID']."'";
                                            echo '<form name ='. $s.' action="theme_side.php" method="get">';
                                                
                                        
                                                echo '<input name="id_theme" type="hidden" value="'. $item["ID"].'">';
                        
                                                echo '<a id = "user_ticket" onclick="document.forms['.$s.'].submit();">'.$item["Title"].'</a>';
                                                echo '</form>';
                                        
        
        
                                            echo '<label class="label_class_in_list"  id="user_date">'.$item["Date_added"].'</label>';
                                        
                                     
                                   
                                     
                                     
                                         switch($item["Status"])
                                         {
                                            case 0:
                                                 echo '<label class="label_class_in_list"  id="user_status"><img src="images\Theme_status\closed.png" id="image_status_icon" title="Status" alt="Status icon"></label>';
                                                 break;
                                            case 1:
                                                 echo '<label class="label_class_in_list"  id="user_status"><img src="images\Theme_status\open.png" id="image_status_icon" title="Status" alt="Status icon"></label>';
                                                 break;
                                          
                                            case 2:
                                                 echo '<label class="label_class_in_list"  id="user_status"><img src="images\Theme_status\answered.png" id="image_status_icon" title="Status" alt="Status icon"></label>';
                                                 break;
                                         }
                                       
           
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
        
                                        

                                    
                                } 
                                
                                
 
                              
                                $db->close();  
                            }
                            
                            
                            
                        
                        ?>
                         
                        </div>
                   
                </div>

                

                <div id="button_contener"> 
                    <a href="write_tickets_side.php"> <input class="button_ticket" id="add_ticket_bt" type="button" value="Add new ticket" title="Added" alt="Add new ticket" name="add_ticket_button"></a>
                     
                
                     
                    <button class="button_ticket" id="delete_ticket_bt" form="delete_form"  type="submit">Delete ticket</button>
                
                    <form herf="#" action="ticket_side.php" name="serch_form" method="post">   
                        <input class="text_ticket" id="search_ticket_tx" type="search" placeholder="Write a keyword" name="search_ticket_text">
                        <input class="radio_ticket" id="search_user__radio"type="radio" name="radio_user">  <label for="radio_user">User</label>
                        <input class="radio_ticket" id="search_tickets_radio"type="radio"   name="radio_user"> <label for="radio_user">Tickets</label>
                     </form>

                </div>
                
             
            </div>





            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>
        </div>
    </body>
</html>
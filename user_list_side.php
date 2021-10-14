<?php
    session_start();

    if(!empty($_SESSION['login']))
    {
       
        $userem = $_SESSION["uemail"];
       
    }
    else{
        
         
        header("location: logout.php");
        echo '<br><div id="error_contener"> Warning: You must be logged in!</div><br>';


    }

    



?>



<!DOCTYPE html>

<html lang="pl">
    <head>
        <meta charset="UTF-8" />
        <title>Profils</title>
        <!-- <link rel="stylesheet" type="text/css" href="write_tickets_style.css" /> -->
        <link href="user_list_style.css?<?=filemtime("user_list_style.css")?>" rel="stylesheet" type="text/css" />

        <link rel="icon" href="images\Favicon\side_icon.ico">
        <meta name="description" content="Ticket System" />
        <meta name="author" content="Patryk Kaszuba" />
      
    </head>

    <body>
        <div id="contener">

            <div id="header">
                <div id="link_contener">
                <?php
                        if($_SESSION['img'] == Null)
                            echo '<a id="user_go_profil" href="profil_side.php"><img class="image_header_icon" title="Profil side" alt="Go back to profil icon" src="User_profils\default_profil\default.png"></a>';
                        else
                        {
                            $pathi = "User_profils\\". $_SESSION['id'] ."\\".$_SESSION['img'];


                            echo "<a id='user_go_profil' href='profil_side.php'><img class='image_header_icon' title='Profil side' alt='Go back to profil icon' src='$pathi'></a>";
                       
                            if($_SESSION['Rangs'] >= 2)
                                echo' <a id="admin_look_all" href="archive_side.php"><img class="image_header_icon" title="Archive list side" alt="Go to archive list side icon" src="images/icon_link/archive.png" ></a>';

                        }
                     
                  
                    
                    ?>
                    
                    <a id="user_go_tickets" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to tickets icon" src="images/icon_link/tickets.png"></a>
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out" alt="Log out icon"src="images/icon_link/logout.png"></a>
                </div>
            </div>

     
            <div id="main">

                <div id="contener_for_list">
                    <?php
                          require_once "connect_mysql.php";
                          $listuser = [];
                          $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                          if(!$db)
                              echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                              
                          else
                          {
                            
                            $sql = "SELECT * FROM users_db";
                            if($result = $db->query($sql))  
                            {
                            
                                $user_number = $result->num_rows;
                                if($user_number >=1)
                                {
                                    foreach ($result as $item) {
                                        $listuser[$item['ID']] =  $item;
                                        $uemail =  $item['Email'];
                                        $rsql = "SELECT * FROM admins_db WHERE Email='$uemail'";
                                        if($rangresult = $db->query($rsql))  
                                        {
                                            $admins_number = $rangresult->num_rows;
                                            if($admins_number ==1)
                                            {
                                            
                                                $data = $rangresult->fetch_assoc();
                                                $listuser[$item['ID']]['Rangs'] = $data['Rang_strong'];
                                                $rangresult->close();
                                            }
                                            else
                                                $listuser[$item['ID']]['Rangs'] =0;
                                        }

                                        $bsql = "SELECT * FROM banned_db WHERE Banned_email='$uemail'";
                                        if($banresult = $db->query($bsql))  
                                        {
                                            $banned_number = $banresult->num_rows;
                                            if($banned_number == 1)                                     
                                                $listuser[$item['ID']]['Rangs'] = 4;

                                        }


                                    }
                                }
                               
                                  
                                   
                                
                                $result->close();
                            }
                            
                          

                            $db->close();
                          }


                          foreach ($listuser as $item) {
                            echo '<div id="contener_list">';

                            echo '<div id="user_id_contener">';

                                echo  '<label id="id_label">'.$item['ID'].'</label>';
                                
                            echo '</div>';

                            echo '<div id="user_image_contener">';

                            if(!empty($item['Images_url']))
                                $srcim = "User_profils\\". $item['ID']."\\" . $item['Images_url'];
                            else
                                $srcim = 'User_profils\default_profil\default.png';
                            
                            $s = "'User-".$item['ID']."'";
                            
                            echo '<form  name="'.$s.'" id="user_name_ticket" action="profil_user.php" method="get">';
                                echo '<input name ="image_inputs" type="image" id="image_user_in_list"  src="'.$srcim.'" alt="Submit Form"/>';
                            
                                echo '<input name="author_id" type="hidden" value="'.$item['ID'].'">';
                            echo '</form>';
                        

                            echo '</div>';

                            echo '<div id="user_name_contener">';
                                $d = "'User-".$item['ID']."'";
                                echo '<form  name='.$d.' id="user_name_ticket" action="profil_user.php" method="get">';
                            
                                    echo '<a id = "name_surname_label" onclick="document.forms['.$d.'].submit();">'.$item['Name'].'<br>'.$item['Surname'].'</a>';

                                    echo '<input name="author_id" type="hidden" value="'.$item['ID'].'">';
                                echo '</form>';
                            echo '</div>';


                            echo '<div id="user_rang_contener">';
                               
                                if($item['Rangs'] == 0)
                                    echo  '<label id="rang_style_user">User</label>';
                                if($item['Rangs'] == 1)
                                    echo  '<label id="rang_style_moderator">Moderator</label>';
                                if($item['Rangs'] == 2)
                                    echo  '<label id="rang_style_admin">Administrator</label>';
                                if($item['Rangs'] == 3)
                                    echo  '<label id="rang_style_headadmin">Head administrator</label>';
                                if($item['Rangs'] == 4)
                                    echo  '<label id="rang_style_headadmin">Banned</label>';

                            echo '</div>';

                            echo '<div id="user_status_contener">';
                                if($item['Online'] == 1)
                                    echo '<label id="user_online">On-line</label>';
                                else
                                    echo '<label id="user_offline">Off-line</label>';
                            echo '</div>';

                            echo '<div id="user_joindate_contener">';

                                echo '<label  id="join_date_label">'.$item['Join_Date'].'</label>';

                            echo '</div> ';   

                        echo '</div>';
                        }




                    ?>
                </div>
                        
 

                    
            </div>





            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>

        </div>
    </body>
</html>
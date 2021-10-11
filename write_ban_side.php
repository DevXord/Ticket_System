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
        <title>Write Ticket</title>
        <!-- <link rel="stylesheet" type="text/css" href="write_tickets_style.css" /> -->
        <link href="write_tickets_style.css?<?=filemtime("write_tickets_style.css")?>" rel="stylesheet" type="text/css" />

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
                        }
                        if($_SESSION['Rangs'] >= 2)
                            echo' <a id="admin_look_all" href="user_list_side.php"><img class="image_header_icon" title="User list side" alt="Go to user list side icon" src="images/icon_link/profils.png" ></a>';
                   
                  
                    
                    ?>
                    
                    <a id="user_go_tickets" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to tickets icon" src="images/icon_link/tickets.png"></a>
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out" alt="Log out icon"src="images/icon_link/logout.png"></a>
                </div>
            </div>

            <?php
                if(!empty($_GET['ban_reason']) && isset($_GET['ban_user_id']))
                {
                    require_once "connect_mysql.php";

                    $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                    if(!$db)
                        echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                        
                    else
                    {
                        $bannedid = $_GET['ban_user_id'];
                        $sql = "SELECT * FROM users_db WHERE ID = '$bannedid'";
                        if($result = $db->query($sql))  
                        {
                        
                            $user_number = $result->num_rows;
                            if($user_number = 1)
                            {
                                $data = $result->fetch_assoc();
                                $bemail =  $data['Email'];
                                $bname =  $data['Name'];
                                $breson = $_GET['ban_reason'];
                                $datesecond = time(); 
                                $nowDate = date('Y-m-d', $datesecond);
                                $aemail = $_SESSION['uemail'];

                                $sql2 = "INSERT INTO `banned_db`( `Banned_email`, `Banned_name`, `Banned_reason`, `Banned_date`, `Admin_email`) VALUES ('$bemail','$bname','$breson','$nowDate','$aemail')";
                                
                                $insertres = $db->query($sql2); 
                                if($insertres = $db->query($sql))   
                                {
                                    
                                    header("location: profil_side.php");
                                     
                                }
                                
                               
                            }
                            $result->close();
                        }

                        $db->close();
                        
                    }
                    
                }


            ?>


            <div id="main">


                <div id="xcontener">
                    <?php
                    $s = $_GET["ban_user_id"];
                    echo '<form action="write_ban_side.php" method="get">';
                        echo '<div id="write_tickets_contener">';
                            echo '<label class="label_text">Enter a reason for the ban:</label>';
                            echo '<input id="title_input" type="text" name="ban_reason" maxlength="50">';
                            echo '<input type="hidden" name="ban_user_id" value="'.$s.'">';
                            echo '<input id="send_text_input" type="submit" value="Send">';
                        echo '</div>';
                   echo  '</form>';
                echo '</div>';
                   ?>

                    
            </div>





            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>
        </div>
    </body>
</html>
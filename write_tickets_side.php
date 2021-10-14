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
        <link href="write_ban_style.css?<?=filemtime("write_ban_style.css")?>" rel="stylesheet" type="text/css" />

        <link rel="icon" href="images\Favicon\side_icon.ico">
        <meta name="description" content="Ticket System" />
        <meta name="author" content="Patryk Kaszuba" />
      
    </head>

    <body>
     

            <div id="header">
                <div id="link_contener">
                <?php
                        if($_SESSION['img'] == Null)
                            echo '<a id="user_go_profil" href="profil_side.php"><img class="image_header_icon" title="Profil side" alt="Go back to profil icon" src="User_profils\default_profil\default.png"></a>';
                        else
                        {
                            $pathi = "User_profils\\". $_SESSION['id'] ."\\".$_SESSION['img'];


                            if($_SESSION["Rangs"] >= 2)
                                echo' <a id="admin_look_all" href="archive_side.php"><img class="image_header_icon" title="Archive list side" alt="Go to archive list side icon" src="images/icon_link/archive.png" ></a>';

                            
                            echo "<a id='user_go_profil' href='profil_side.php'><img class='image_header_icon' title='Profil side' alt='Go back to profil icon' src='$pathi'></a>";
                        
                        
                        }
                    
                    ?>
                    
                    <a id="user_go_tickets" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to tickets icon" src="images/icon_link/tickets.png"></a>
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out" alt="Log out icon"src="images/icon_link/logout.png"></a>
                </div>
            </div>

            <?php
                if(isset($_POST['title_text']) &&isset($_POST['text_add']))
                {
                    require_once "connect_mysql.php";



                    $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                    if(!$db)
                        echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                        
                    else
                    {
                        $title = $_POST['title_text'];
                        $textt =  $_POST['text_add'];
                        $emailt = $_SESSION['uemail'];
                        $namet = $_SESSION['uname'];
                        $snamet = $_SESSION['usname'];
                        $aid = $_SESSION['id'];

                        $datesecond = time(); 
                        $nowDate = date('Y-m-d', $datesecond);

                        
                        $sql = "INSERT INTO `ticket_db`(`Date_added`, `Title`, `Author_id`, `Author_name`, `Author_surname`, `Author_email`, `Status`, `Priority`, `Value`) VALUES ('$nowDate','$title','$aid','$namet','$snamet','$emailt','1','0',' $textt')";
                        
                        
                        if($result = $db->query($sql))  
                             
                        $db->close();
                        
                    }
                    header("location: ticket_side.php");
                }


            ?>


            <div id="main">


                <div id="xcontener">

                    <form action="write_tickets_side.php" method="post">
                        <div id="write_tickets_contener">
                            <label class="label_text">Write your title:</label>
                            <input id="title_input" type="text" name="title_text" maxlength="54">
                            <label class="label_text">Write your message and clicked send</label>
                            <textarea id="text_input" name="text_add" maxlength="325"></textarea>
                            <input id="send_text_input" type="submit" value="Send">
                        </div>
                    </form>
                </div>
                   

                    
            </div>





            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>
    
    </body>
</html>
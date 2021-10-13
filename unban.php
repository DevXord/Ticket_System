<?php
    session_start();
    if(empty($_SESSION['login']))
    {
        
        header("location: logout.php");
        echo '<br><div id="error_contener"> Warning: You must be logged in!</div><br>';
     
       
    }

    if($_SESSION['Rangs'] == 3)
    {
        require_once 'connect_mysql.php';
        if(isset($_GET['ban_user_email']) && !empty($_GET['ban_user_email']))
        {

            $db = @mysqli_connect($host , $username, $userpassword, $namedb);
            if(!$db)
                echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
            else
            {
                $ubemail = $_GET['ban_user_email'];
                $sql = "DELETE FROM `banned_db` WHERE Banned_email = '$ubemail'";
                $banresult = $db->query($sql);
              
                header("location: profil_user.php?author_id=".$_GET['ban_user_id']."");
                $db-close();
            }
        }
    }
    
   
?>
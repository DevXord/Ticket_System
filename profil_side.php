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
        <title>Profil <?php echo "" .$_SESSION["uname"] . " ".$_SESSION["usname"] ;?></title>
        <!-- <link rel="stylesheet" type="text/css" href="profil_style.css" /> -->
        <link href="profil_style.css?<?=filemtime("profil_style.css")?>" rel="stylesheet" type="text/css" />
        <link rel="icon" href="images\Favicon\side_icon.ico">
        
           
       
        <meta name="description" content="Ticket System" />
        <meta name="author" content="Patryk Kaszuba" />
    </head>

    <body>
        <div id="contener">

            <?php
           
                include_once "connect_mysql.php";
                if(isset($_POST['password_input']) || isset($_POST['rpassword_input']) || isset($_POST['name_input']) || isset($_POST['sname_input']) || isset($_POST['email_input']) || isset($_POST['photo_input']))
                {
                    $db = @mysqli_connect($host , $username, $userpassword, $namedb);
                    if(!$db)
                        echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
                    else
                    {

                        $nnm = $_POST["name_input"];
                        $nsnm= $_POST["sname_input"];
                        $nema = $_POST["email_input"];
                        $nphot = $_FILES["photo_input"];
                        $npass = $_POST["password_input"];
                        $nrpass  = $_POST["rpassword_input"];


                        $usql = "SELECT * FROM `users_db` WHERE `Email`= '$userem'";
                      
                        if($result = $db->query($usql))
                        {

                        

                            $users_number = $result->num_rows;
                            if($users_number == 1)
                            {
                             
                                
                                if( isset($nnm) && !empty($nnm))
                                {
                                    $send = "UPDATE `users_db` SET `Name`='$nnm' WHERE `Email`= '$userem'";
                                    $resultx = $db->query($send);
                                    echo '<br><div id="info_contener"> info: The username has been successfully changed!</div><br>';
                                    $_SESSION['uname'] =   $nnm;
                                    
                                        
                                }
                               
                                if( isset($nsnm) && !empty($nsnm))
                                {
                                    $send = "UPDATE `users_db` SET `Surname`='$nsnm' WHERE `Email`= '$userem'";
                                    $resultx = $db->query($send);
                                    echo '<br><div id="info_contener"> info: User surname has been successfully changed!</div><br>';
                                    $_SESSION['usname'] = $nsnm;
                                    
                                }
                                     
                                


                                if( isset($nphot) && !empty($nphot))
                                {

                                   $fileName = $nphot['name'];
                                   $fileT = $nphot['type'];
                                   $fileTMPName = $nphot['tmp_name'];
                                   $fileError = $nphot['error'];
                                   $fileSize = $nphot['size'];

                                    if($fileError == 0)
                                    {
                                      
                                        if($fileSize <= 2097152)
                                        {
                                           
                                            
                                            $fileType = substr($fileT,6);
                                        
                                            $npatch = "User_profils/" .$_SESSION["id"]."/IMG-".$_SESSION["id"]."-PROFILPHOTO.".$fileType;
                                            $dbimg = "IMG-".$_SESSION['id']."-PROFILPHOTO.".$fileType;
                                         
                                            
                                            if(file_exists($npatch))
                                            {

                                                unlink($npatch);
                                                rmdir("User_profils/" .$_SESSION["id"]);
                                                mkdir("User_profils/" .$_SESSION["id"]."/",0777,true);
                                              
                                            }
                                            else
                                            {

                                                mkdir("User_profils/" .$_SESSION["id"]."/",0777,true);
                                              
                                            }
                                            
                                            copy($fileTMPName,$npatch);
                                           
                                            
                                            $_SESSION['img'] = $dbimg;
                                          

                                            $send = "UPDATE users_db SET Images_url='$dbimg' WHERE Email= '$userem'";
                                            $resultx = $db->query($send);
                                            echo '<br><div id="info_contener"> info: User icon has been successfully changed!</div><br>';
                                            $nphot = '';
                                            $fileName='';
                                            $fileT='';
                                            $fileTMPName='';
                                            $fileError='';
                                            $fileSize='';

                                        }
                                        else
                                            echo '<br><div id="error_contener"> Warning: The photo is too big!</div><br>';
                                      
                                    }
                                    else
                                        echo '<br><div id="error_contener"> Warning: Photo has not been uploaded!</div><br>';
                                    
                                   
                                }
                                    
                                     
                                    

                                if( isset($npass) && !empty($npass))
                                    if($npass == $nrpass)
                                    {
                                        $send = "UPDATE `users_db` SET `Password`='$npass' WHERE `Email`= '$userem'";
                                        $resultx = $db->query($send);
                                        echo "<br><div id='info_contener'> info: The user's password has been successfully changed!</div><br>";
                                        $_SESSION['upass'] =  $npass;
                                  
                                      
                                    }
                                       
                                      
                                    
                                if( isset($nema) && !empty($nema))
                                {
                                    $csql = "SELECT * FROM `users_db` WHERE `Email`= '$nema'";
                                    if($resultx = $db->query($csql))
                                    {
                                        $users_number = $resultx->num_rows;
                                        if($users_number == 0)
                                        {
                                            $send = "UPDATE `users_db` SET `Email`='$nema' WHERE `Email`= '$userem'";
                                            $resultxd = $db->query($send);
                                            echo '<br><div id="info_contener"> info: The e-mail address of the user has been successfully changed!</div><br>';
                                            $_SESSION['uemail'] = $nema;
            
                                        }
                                        else
                                            echo '<br><div id="error_contener"> Warning: This email is already in use!</div><br>';
                                        
                
                                        $resultx->close();
                                    }
                                }
                           
                                  
                              
                          
                                
                            }
                       
                           
                            
                            $result->close();
                         }
                   
                        
                        $db->close();  
                    }
                    
                }

                 
            ?>


            <div id="header">
              
                <div id="link_contener">
                    <a id="user_go_ticket" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to Ticket side icon" src="images/icon_link/tickets.png" ></a>
                   
                    <?php 
                        if($_SESSION['Rangs'] >= 2)
                        {
                            echo' <a id="admin_look_all" href="user_list_side.php"><img class="image_header_icon" title="User list side" alt="Go to user list side icon" src="images/icon_link/profils.png" ></a>';
                 
                            echo' <a id="admin_look_all" href="archive_side.php"><img class="image_header_icon" title="Archive list side" alt="Go to archive list side icon" src="images/icon_link/archive.png" ></a>';
                        }
                    ?>
                   
                    <a class="user_logout" href="logout.php"> <img class="image_header_icon" title="Log out"  alt="Log out icon" src="images/icon_link/logout.png"></a>
                </div>
            </div>
            <div id="main">
                <div id = "user_left_contener">
                

                     
                    <?php
                        
                        if(@$_SESSION['img'] == NULL)
                            echo '<img id= "user_photo_profil_id"  title="Your phot" alt="User photo" src="User_profils\default_profil\default.png">';
                        else
                        {
                            $pathi = "User_profils\\". $_SESSION['id'] ."\\".$_SESSION['img'];
                            echo "<img id= 'user_photo_profil_id'  title='Your photo' alt='User photo' src='$pathi'>";
                        }
                             

                        switch($_SESSION['Rangs'])
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
                        
                       
                        if(@$_SESSION['uonline'] == 1)
                            echo  " <label id='user_online'>ON-LINE</label>";
                        else
                            echo  " <label id='user_offline'>OFF-LINE</label>";


                        ?>
                    
                    <label>Join date:</label>
                    <label id='user_join_date'><?php echo "". $_SESSION['jdate']?></label>
                   

                    <input id="edit_button" onclick="editProfil()" title="Edit profil" type="button"  alt="Edit profil button" value="Edit Profil">
                </div>
                <div id="user_settings_contener">
  
                    <form action="profil_side.php" method="post" enctype="multipart/form-data">
                        <div id="user_form_contener">
                            <label class="inpit_label" id="change_name_label"></label>
                            <label for="name_input" class="user_value" id="user_name_label"><?php echo "" .$_SESSION["uname"];?></label>
                            <input type="hidden" class="edit_inputs" id="user_name_profil_id" name="name_input">

                            <label class="inpit_label" id="change_surname_label"></label>
                            <label for="name_input" class="user_value" id="user_surname_label"><?php echo "" .$_SESSION["usname"];?></label>
                            <input type="hidden" class="edit_inputs" id="user_surname_profil_id" name="sname_input">

                            <label class="inpit_label" id="change_email_label"></label>
                            <label for="email_input" class="user_value" id="user_email_label"><?php echo "" .$_SESSION["uemail"];?></label>  
                            <input type="hidden" class="edit_inputs" id="user_email_profil_id" name="email_input">

                            <label class="inpit_label" id="change_pass_label"></label> 
                            <input type="hidden" class="edit_inputs" name="password_input" id="user_password_edit" >

                            <label class="inpit_label" id="change_rpass_label"></label> 
                            <input type="hidden" class="edit_inputs" name="rpassword_input" id="user_rpassword_edit" >

                            <label class="inpit_label" id="change_photo_label"></label> 
                            <input type="hidden"  name="photo_input" id="user_photo_edit" accept="image/*">

                            <input id="save_button" title="Edit profil" type="hidden"  alt="Save profil button" value="Save Profil">

                        </div>
                    </form>
                </div>
            </div>
            
            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>
           
            <script src="script.js?<?=filemtime("script.js")?>"></script>
        </div>
    </body>
</html>

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
                    <a id="user_go_profil" href="profil_side.php"><img class="image_header_icon" title="Profil side" alt="Go back to profil icon" src="User_profils\default_profil\default.png"></a>
                    <a class="user_logout" href="index.php"> <img class="image_header_icon" title="Log out" alt="Log out icon"src="images/icon_link/logout.png"></a>
                </div>
            </div>



            <div id="main">
                
                <div id="ticket_conener">
                    <div id="ticket_page">
                        
                        <label for="user_check" id="user_check_all"><input type="checkbox" id="all_user_checkbox" name="all_user_checkbox"></label>
                        <label id="user_name_click">User</label>
                        <label id="user_ticket_click">Ticket</label>
                        <label id="user_date_click">Date</label>
                        <label id="user_status_click">Status</label>
                    
                    </div>      
                    

                        
                    <div id="ticket_list_contener">

                        <div id="ticket_list">
                
                            <label  id="user_check"><input type="checkbox" id="user_checkbox" name="all_user_checkbox"></label>
                            <a id= "user_name_ticket" href="profil_side.php"><img id="image_user_in_list" title="Profil side" alt="User profil icon" src="User_profils\default_profil\default.png">Krzffffffysu sdddddobiet</a>
                            <label  id="user_ticket">Problem z komddddddddpem</label>
                            <label  id="user_date">25/01/1992</label>
                            <label  id="user_status"><img src="images\Theme_status\closed.png" id="image_status_icon" title="Status" alt="Status icon"></label> 

                        </div>
                    </div>
                </div>
                <div id="button_contener"> 
                    <a href="write_tickets_side.php"> <input class="button_ticket" id="add_ticket_bt" type="button" value="Add new ticket" title="Added" alt="Add new ticket" name="add_ticket_button"></a>
                    <input class="button_ticket" id="delete_ticket_bt" type="button" value="Delete ticket" title="Deleted" alt="Delete ticket" name="delete_ticket_button">
                    <input class="text_ticket" id="search_ticket_tx" type="search" placeholder="Write a keyword" alt="Write a keyword" name="search_ticket_text">
                    <input class="radio_ticket" id="search_user__radio"type="radio" name="radio_user">  <label for="radio_user">User</label>
                    <input class="radio_ticket" id="search_tickets_radio"type="radio"   name="radio_user"> <label for="radio_user">Tickets</label>


                </div>
                
             
            </div>





            <div id="footer">

                <p>This project was created for the purposes of recruitment to the company <a id ="Link_coody"href="https://coody.it/">Coody.it</a> dealing with the creation of online stores</p>


            </div>
        </div>
    </body>
</html>
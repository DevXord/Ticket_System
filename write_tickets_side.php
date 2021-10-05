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
                    <a id="user_go_profil" href="profil_side.php"><img class="image_header_icon" title="Profil side" alt="Go to profil icon" src="User_profils\default_profil\default.png"></a>
                    <a id="user_go_tickets" href="ticket_side.php"><img class="image_header_icon" title="Ticket side" alt="Go to tickets icon" src="images/icon_link/tickets.png"></a>
                    <a class="user_logout" href="index.php"> <img class="image_header_icon" title="Log out" alt="Log out icon"src="images/icon_link/logout.png"></a>
                </div>
            </div>




            <div id="main">


                <div id="xcontener">

                    <form action="#" method="get">
                        <div id="write_tickets_contener">
                            <label class="label_text">Write your title:</label>
                            <input id="title_input" type="text" name="title_text" maxlength="54">
                            <label class="label_text">Write your message and clicked send</label>
                            <textarea id="text_input"  maxlength="325"></textarea>
                            <input id="send_text_input" type="submit" value="Send">
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
<?php
    session_start();
    require_once "connect_mysql.php";



    $db = @mysqli_connect($host , $username, $userpassword, $namedb);
    if(!$db)
        echo '<br><div id="error_contener"> Warning: Database not connected!</div><br>';
        
    else
    {
        $uemail =  $_SESSION['uemail'];
      
        $sqlt = "UPDATE users_db  SET `Online`='0' WHERE Email = '$uemail'";
        $db->query($sqlt);
        $_SESSION['uonline'] = 0;
        $db->close();
    }



    
   
    $_SESSION = array();
 
    if( ini_get( "session.use_cookies" ) ) {
        $params = session_get_cookie_params();

        setcookie(
        session_name()
        , ''
        , time() - 42000
        , $params[ "path"     ]
        , $params[ "domain"   ]
        , $params[ "secure"   ]
        , $params[ "httponly" ]
        );
    }
    if( session_status() === PHP_SESSION_ACTIVE ) { session_destroy(); }

    
    header("location: index.php");
    
 
?>
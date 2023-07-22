<?php

class LoginManager  {

    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifyLogin()   {
        //check for a session
        if (session_id() == '' && !isset($_SESSION)) {
            session_start();
        }

        // is anyone login
        if (isset($_SESSION['username'])) {
            return true;
        } else {
            //destroy session
            session_destroy();
            return false;
        }
        
    }
        
    
}

?>
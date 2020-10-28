<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = null)
        {
            $_SESSION['adminLogged'] = false;            
            $_SESSION['error'] = $message;
            
            require_once(VIEWS_PATH."login.php");
        }                
    }
?>

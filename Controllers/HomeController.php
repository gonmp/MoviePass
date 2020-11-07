<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = null)
        {   
            $_SESSION['error'] = null;
            $_SESSION['actualView'] = 'ShowSearchMovieView';
            
            header('location:' . FRONT_ROOT . '/Movie/ShowSearchMovieView');
        }   
        
        public function Logout ()
        {            
            $_SESSION['userLogged'] = false;

            $this->Index();
        }
    }
?>

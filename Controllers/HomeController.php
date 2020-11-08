<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = null)
        {   
            $_SESSION['error'] = null;
            $_SESSION['cinemaError'] = null;
            $_SESSION['actualView'] = 'ShowSearchMovieView';
            
            # header('location:' . FRONT_ROOT . '/Movie/ShowSearchMovieView');
            
            # TEST ADMIN
            header('location:' . FRONT_ROOT . '/AdminManager/ShowIndexAdmin');
        }   
        
        public function Logout ()
        {            
            $_SESSION['userLogged'] = false;

            $this->Index();
        }
    }
?>

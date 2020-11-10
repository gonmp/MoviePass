<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = null)
        {               
            $_SESSION['error'] = null;
            $_SESSION['cinemaError'] = null;
            $_SESSION['errorMovieShow'] = null;
            $_SESSION['actualView'] = 'ShowSearchMovieView';
            
            header('location:' . FRONT_ROOT . '/Movie/ShowAllMoviesPremieres');                        
        }   
        
        public function Logout()
        {            
            $_SESSION['userLogged'] = false;
            $_SESSION['adminLogged'] = false;            

            $this->Index();
        }        

        public static function CheckAdmin()
        {
            return ((!isset($_SESSION['adminLogged']) || $_SESSION['adminLogged'] == false) ? false : true);            
        }

        public static function ForceLogout()
        {
            $_SESSION['userLogged'] = false;
            $_SESSION['adminLogged'] = false;            

            $_SESSION['error'] = null;
            $_SESSION['cinemaError'] = null;
            $_SESSION['errorMovieShow'] = null;
            $_SESSION['actualView'] = 'ShowSearchMovieView';

            header('location:' . FRONT_ROOT . '/Home/Logout');
        }
    }
?>

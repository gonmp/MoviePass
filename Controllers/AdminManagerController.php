<?php
    namespace Controllers;

    use Controllers\CinemaController as CinemaController;
    use Controllers\MovieShowController as MovieShowController;       
    use DAO\MovieDAO as MovieDAO;

    class AdminManagerController 
    {
        private $movieDAO;
        private $cinemaController;
        private $movieShowController;        

        public function __construct()
        {
            $this->cinemaController = new CinemaController();
            $this->movieShowController = new MovieShowController();            

            $this->movieDAO = new MovieDAO();
        }

        public function ShowIndexAdmin()
        {
            $_SESSION['errorCinema'] = null;
            $_SESSION['error'] = null;
            $this->ShowAddCinemaView();
        }

        public function ShowAddMovieShowView()
        {
            $this->movieShowController->ShowAddMovieShow();            
        }        

        public function ShowAddCinemaView()
        {
            $_SESSION['errorCinema'] = null;
            $_SESSION['error'] = null;

            $this->cinemaController->ShowAddView();
        }
        
        public function UpdateDataBase()
        {
            if (!isset($_SESSION['adminLogged']) || $_SESSION['adminLogged'] == false)
            {
                header('location:' . FRONT_ROOT . '/Home/Logout');        
            }
            else
            {
                $this->movieDAO->UpdateDatabaseFromAPI();
                $this->ShowMovieList();
            }
        }

        public function ShowMovieList()
        {
            header('location:' . FRONT_ROOT . '/Movie/ShowAllMoviesPremieres');
        }
    }
?>
<?php
    namespace Controllers;

    use Controllers\CinemaController as CinemaController;
    use Controllers\MovieShowController as MovieShowController;       

    class AdminManagerController 
    {
        private $cinemaController;
        private $movieShowController;        

        public function __construct()
        {
            $this->cinemaControlller = new CinemaController();
            $this->movieShowController = new MovieShowController();            
        }

        public function ShowIndexAdmin()
        {
            $this->ShowAddMovieShowView();
        }

        public function ShowAddMovieShowView()
        {
            $this->movieShowController->ShowAddMovieShow();
            require_once(VIEWS_PATH."movie-show-add.php");
        }        
    }



?>
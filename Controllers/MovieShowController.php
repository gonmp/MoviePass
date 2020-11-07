<?php 
    namespace Controllers;
    
    use Models\MovieShow as MovieShow;
    use DAO\MovieShowDAO as MovieShowDAO;
    
    # para traer todas las peliculas y mostrarlas en la lista desplegable
    use DAO\MovieDAO as MovieDAO;

    # para traer todos los cines y mostrarlos en la lista desplegable
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;

    class MovieShowController
    {
        private $movieList;
        private $movieDAO;

        private $cinemaList;
        private $cinemaDAO;       

        #$this->movieShowDAO;                      

        public function __construct ()
        {
            $this->movieDAO = new MovieDAO();            
            $this->movieList = $this->movieDAO->GetAll();

            $this->cinemaDAO = new CinemaDAO();
            $this->cinemaList = $this->cinemaDAO->GetAll();
        }

        public function ShowIndexMovieShow ()
        {
            
        }

        public function ShowAddMovieShow ()
        {            
            require_once(VIEWS_PATH."movie-show-add.php");
        }

        public function Add ($movie = null, $date = null, $cine = null)
        {
            $movieShow = new MovieShow($movie, $date, $cine);

            $rowAffected = $this->movieShowDAO->Add($movieShow);

            if ($rowAffected == -1)
            {
                $_SESSION['error'] = 'error in add movie show';
            }
            else
            {
                $_SESSION['error'] = null;
            }
        }
    }

?>
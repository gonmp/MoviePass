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
        private $movieShowDAO;                      

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();            
            $this->movieList = $this->movieDAO->GetAll();

            $this->cinemaDAO = new CinemaDAO();
            $this->cinemaList = $this->cinemaDAO->GetAll();

            $this->movieShowDAO = new MovieShowDAO();
        }        

        public function ShowAddMovieShow()
        {   
            require_once(VIEWS_PATH."movie-show-add.php");      
            $this->ShowMovieShowList();      
        }

        public function ShowMovieShowList()
        {
            $movieShowList = $this->movieShowDAO->GetAll();
            require_once(VIEWS_PATH."movie-show-list.php");
        }

        public function Add($movieId, $cinemaId, $movieShowDate, $movieShowTime)
        {
            $movie = $this->GetMovieById($movieId);
            $cine = $this->GetCinemaById($cinemaId);            

            $movieShowDateTime = $movieShowDate . ' ' . $movieShowTime;

            $date = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));

            $movieShow = new MovieShow($movie, $cine, $date);            

            $rowAffected = $this->movieShowDAO->Add($movieShow);

            if ($rowAffected == -1)
            {                
                $_SESSION['error'] = 'error in add movie show';
            }
            else
            {
                $_SESSION['error'] = null;
            }

            $this->ShowAddMovieShow();
        }

        public function ShowMovieShowUpdate($movieShowId)
        {
            $movieShow = $this->movieShowDAO->Get($movieShowId);

            require_once(VIEWS_PATH . 'movie-show-update.php');
            $this->ShowMovieShowList();
        }

        public function Update($id, $movieId, $cinemaId, $movieShowDate, $movieShowTime)
        {
            $movie = $this->GetMovieById($movieId);
            $cinema = $this->GetCinemaById($cinemaId);            

            $movieShowDateTime = $movieShowDate . ' ' . $movieShowTime;
            $showDate = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));

            $movieShow = new MovieShow($movie, $cinema, $showDate);
            $movieShow->setId($id);

            $this->movieShowDAO->Update($movieShow);

            $this->ShowAddMovieShow();            
        }

        public function Delete($movieShowId)
        {
            $this->movieShowDAO->Delete($movieShowId);
            
            $this->ShowAddMovieShow();   
        }

        private function GetMovieById($movieId)
        {
            foreach($this->movieList as $movie)
            {
                if ($movieId == $movie->getId())
                {
                    return $movie;
                }
            }            
        }

        private function GetCinemaById($cinemaId)
        {
            foreach($this->cinemaList as $cinema)
            {
                if ($cinemaId == $cinema->getId())
                {
                    return $cinema;
                }
            }
        }
    }

?>
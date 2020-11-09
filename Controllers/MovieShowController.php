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
            $movieShowTime = $this->TimeToDateTime($movieShowTime);
            
            $movieShowDateTime = $movieShowDate . ' ' . $movieShowTime;            
            $date = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));
            
            if (!$this->ValidateMovieShow($movieId, $cinemaId, $date))
            {
                $this->ShowAddMovieShow();

                $_SESSION['errorMovieShow'] = "error";
                $this->ShowAddMovieShow();

                return;
            }            
            
            $movie = $this->GetMovieById($movieId);
            $cine = $this->GetCinemaById($cinemaId);          

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

        private function ValidateMovieShow($movieId, $cinemaId, $movieShowDateTime)
        {
            $validate = true;

            $movieShowList = $this->movieShowDAO->GetAllByCinemaId($cinemaId, $movieShowDateTime, $movieShowDateTime);
            
            if ($movieShowList != null)
            {   
                foreach($movieShowList as $movieShow)
                {
                    if ($movieShow->getMovie()->getId() == $movieId)
                    {
                        $validate = false;
                        break;
                    }
                }                            
            }

            return $validate;
        }

        private function TimeToDateTime($movieShowTime)
        {
            switch($movieShowTime)
            {
                case 9:
                    $movieShowTime = "9:00:00";
                break;                

                case 13:
                    $movieShowTime = "13:00:00";
                break;                

                case 17:
                    $movieShowTime = "17:00:00";
                break;                

                case 21:
                    $movieShowTime = "21:00:00";
                break;                
            }    
            
            return $movieShowTime;
        }

        public function ShowMovieShowUpdate($movieShowId)
        {
            $movieShow = $this->movieShowDAO->Get($movieShowId);

            require_once(VIEWS_PATH . 'movie-show-update.php');
            $this->ShowMovieShowList();
        }

        public function Update($id, $movieId, $cinemaId, $movieShowDate, $movieShowTime)
        {
            $movieShowTime = $this->TimeToDateTime($movieShowTime);

            $movieShowDateTime = $movieShowDate . ' ' . $movieShowTime;
            $date = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));

            if (!$this->ValidateMovieShow($movieId, $cinemaId, $date))
            {
                $this->ShowAddMovieShow();

                $_SESSION['errorMovieShow'] = "error";
                $this->ShowAddMovieShow();

                return;
            }   

            $movie = $this->GetMovieById($movieId);
            $cinema = $this->GetCinemaById($cinemaId);            

            $movieShow = new MovieShow($movie, $cinema, $date);
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
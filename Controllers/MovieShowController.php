<?php 
    namespace Controllers;

    use Controllers\HomeController as HomeController;  
    
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

            $this->DeleteOldMovieShow($movieShowList);

            require_once(VIEWS_PATH."movie-show-list.php");
        }

        private function DeleteOldMovieShow($movieShowList)
        {
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $dateNow = date_create(date("Y-m-d H:i"), timezone_open("America/Argentina/Buenos_Aires"));                       

            foreach($movieShowList as $movieShow)
            {
                if($movieShow->getShowDate() < $dateNow)
                {
                    $this->movieShowDAO->delete($movieShow->getId());
                }
            }            
            
            $movieShowList = $this->movieShowDAO->GetAll();
        }

        public function Add($movieId, $cinemaId, $movieShowDate, $movieShowTime)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

            # TODO: modularizar en la version final            

            $movieShowTime = $this->TimeToDateTime($movieShowTime);            
            
            if (!$this->ValidateMovieShow($movieId, $cinemaId, $movieShowDate, $movieShowTime))
            {
                $this->ShowAddMovieShow();

                $_SESSION['errorMovieShow'] = "error";
                $this->ShowAddMovieShow();

                return;
            }
            
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

        private function ValidateMovieShow($movieId, $cinemaId, $movieShowDate, $movieShowTime)
        {
            $movieShowDateTime = $movieShowDate . ' ' . $movieShowTime;                    
            
            $date = date_create($movieShowDate, timezone_open('America/Argentina/Buenos_Aires'));
            $dateTime = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));

            $validate = 
                $this->ValidateMovie($movieId, $cinemaId, $date) ? 
                $this->ValidateCinema($cinemaId, $dateTime) :
                false;            

            return $validate;
        }

        private function ValidateMovie($movieId, $cinemaId, $date)
        {
            $movieShowList = $this->movieShowDAO->GetAllByMovieIdOnlyDate($movieId, $date, $date);

            if ($movieShowList == null)
            {
                return true;
            }
            else
            {
                foreach($movieShowList as $movieShow)
                {
                    if ($movieShow->getCinema()->getId() == $cinemaId)
                    return true;
                }

                return false;
            }
        }

        private function ValidateCinema($cinemaId, $dateTime)
        {   
            # un cine no puede coincidir sus horarios           

            $movieShowList = $this->movieShowDAO->GetAllByCinemaId($cinemaId, $dateTime, $dateTime);                            
            return ($movieShowList == null);            
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
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

            $movieShowTime = $this->TimeToDateTime($movieShowTime);            

            if (!$this->ValidateMovieShow($movieId, $cinemaId, $movieShowDate, $movieShowTime))
            {
                $this->ShowAddMovieShow();

                $_SESSION['errorMovieShow'] = "error";
                $this->ShowAddMovieShow();

                return;
            }   

            $movie = $this->GetMovieById($movieId);
            $cine = $this->GetCinemaById($cinemaId);  

            $movieShowDateTime = $movieShowDate . ' ' . $movieShowTime;
            $date = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));

            $movieShow = new MovieShow($movie, $cine, $date);
            $movieShow->setId($id);

            $this->movieShowDAO->Update($movieShow);

            $this->ShowAddMovieShow();            
        }

        public function Delete($movieShowId)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

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
<?php 
    namespace Controllers;

    use Controllers\HomeController as HomeController;      
    
    use Models\MovieShow as MovieShow;
    use Models\Cinema as Cinema;

    use DAO\MovieShowDAO as MovieShowDAO;        
    use DAO\MovieDAO as MovieDAO;    
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;    

    class MovieShowController
    {
        private $movieList;
        private $movieDAO;
        private $cinemaList;
        private $cinemaDAO;       
        private $movieShowDAO;      
        private $roomDAO;        
        
        private $movieShowIdUpdate;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();            
            $this->movieList = $this->movieDAO->GetAll();
            $this->cinemaDAO = new CinemaDAO();
            $this->cinemaList = $this->cinemaDAO->GetAll();
            $this->movieShowDAO = new MovieShowDAO();
            $this->roomDAO = new RoomDAO();                        

            $this->movieShowIdUpdate = 0;
        }        

        // ************ VISTAS *************************

        public function ShowAddMovieShow()
        {               
            $this->SelectMovie();
            $this->ShowMovieShowList();
        }        

        public function ShowMovieShowList()
        {
            $movieShowList = $this->movieShowDAO->GetAll();           
            
            $this->DeleteOldMovieShow($movieShowList);
            
            require_once(VIEWS_PATH."movie-show-list.php");
        }
        
        // ******** MOVIE SHOW UPDATE *************************************

        // ESTE ES EL ENLACE AL QUE LLEVA AL BOTON DE MODIFICAR QUE ESTA EN LA LISTA DE MOVIESHOWS
        public function ShowMovieShowUpdate($movieShowId)
        {                       
            $this->movieShowIdUpdate = $movieShowId;

            $movieShow = $this->movieShowDAO->Get($movieShowId);            
            require_once(VIEWS_PATH . 'movie-show-details-for-update.php');
            $this->UpdateMovie($movieShowId, $movieShow->getMovie()->getId());
        }   
        
        // ACA VIENE AL TOCAR EL BOTON DE MODIFICAR MOVIE
        public function UpdateMovie($movieShowId, $movieId)
        {               
            $movieShow = $this->movieShowDAO->Get($movieShowId);
            $movie = $this->movieDAO->GetMovieById($movieId);
            
            $movieList = $this->movieDAO->getAll();                   
            
            # detalles del movie show
            require_once(VIEWS_PATH . 'movie-show-details-for-update.php');

            # lista de las peliculas para que seleccione una diferente
            require_once(VIEWS_PATH . 'movie-show-update-movie.php');             
        }

        // ACA VIENE CUANDO CAMBIA LA PELICULA
        public function ValidateUpdateMovie($movieShowId, $movieId)
        {            
            $movieShow = $this->movieShowDAO->Get($movieShowId);
            $movie = $this->movieDAO->GetMovieById($movieId);

            # la primer validacion tiene que ser si la pelicula seleccionada no es la misma que estaba
            if ($movieShow->getMovie()->getId() == $movieId)
            {
                echo "<h6 class='text-warning'>you are selected the same movie</h6>";
                $this->ShowMovieShowUpdate($movieShow->getId());
                return;
            }            
            
            # para validar la pelicula, la misma no puede estar en otro cine en la misma fecha
            # es decir, no puede estar reservada por otro cine

            # necesito la lista de todas las funciones del dia del movie show en donde aparezca la nueva
            # pelicula seleccionada
            
            $movieDate = $movieShow->getShowDate();
            $movieShowList = $this->movieShowDAO->GetFromMovieInDate($movieId, date_format($movieDate,"Y-m-d"));            

            # si la lista es nula, puedo modificar la pelicula
            if (sizeof($movieShowList) == 0)
            {
                echo "<h6 class='text-success'>update movie success</h6>";
                $this->Update($movieShowId, $movieId);
                $this->ShowMovieShowUpdate($movieShowId);
                return;
            }

            # si la lista no es nula, tengo que ver si la pelicula fue reservada por el mismo cine
            foreach($movieShowList as $show)
            {
                $room = $this->roomDAO->getRoomById($show['roomId']);

                if ($room->getCinema()->getId() == $movieShow->getRoom()->getCinema()->getId())
                {
                    echo "<h6 class='text-success'>same cinema. Update movie success</h6>";
                    $this->Update($movieShowId, $movieId);
                    $this->ShowMovieShowUpdate($movieShowId);
                    return;                   
                }                
            }

            # si la lista no es nula y el cine no la reservo, entonces no puedo realizar el cambio
            echo "<h6 class='text-danger'>the movie is already reserved in another cinema</h6>";
            $this->ShowMovieShowUpdate($movieShow->getId());            
        }

        // ******** WIZARD DE CREAR SALA **********
        
        public function SelectMovie()
        {
            $movieList = $this->movieDAO->getAll();                   
            require_once(VIEWS_PATH."movie-show-select-movie.php");             
        }
        
        public function SelectDate($movieId)
        {            
            $_SESSION['movieId'] = $movieId;            

            require_once(VIEWS_PATH.'movie-show-select-date.php');
            $this->ShowMovieShowList();
        }

        public function SelectCinema($movieDate)
        {
            $textoToAdmin = null;            
            $_SESSION['movieDate'] = $movieDate;            
            $allCinemaList = $this->cinemaDAO->getAllCinemasOnly();      

            $cinemaList = array();

            foreach($allCinemaList as $cinema)
            {
                if (sizeof($this->cinemaDAO->GetCinemaByName($cinema->getName())->getRooms()) > 0)
                {
                    array_push($cinemaList, $cinema);
                }
            }
            
            # necesito la lista de todos las proyecciones de esa pelicula para esa fecha   
            $date = date_create($_SESSION['movieDate'], timezone_open('America/Argentina/Buenos_Aires'));     
            $movieShowList = $this->movieShowDAO->GetAllByMovieIdOnlyDate($_SESSION['movieId'], $date, $date);            

            if ($movieShowList != null)
            {
                $cinemaList = array();
                $cinemaList[0] = $movieShowList[0]->getRoom()->getCinema();                             
                $textoToAdmin = "the movie is already reserved. You can only choose this cinema:";
            }                        
            
            require_once(VIEWS_PATH.'movie-show-select-cinema.php');
            $this->ShowMovieShowList();
        }

        public function SelectRoom($cinemaName)
        {
            $_SESSION['cinemaName'] = $cinemaName;

            $cinema = $this->cinemaDAO->GetCinemaByName($cinemaName);

            $_SESSION['cinemaId'] = $cinema->getId();

            $roomList = $cinema->getRooms();
            
            require_once(VIEWS_PATH."movie-show-select-room.php");      
            $this->ShowMovieShowList();      
        }        

        public function SelectTime($roomId)
        {
            $_SESSION['roomId'] = $roomId;

            $room = $this->roomDAO->getRoomById($roomId);

            require_once(VIEWS_PATH."movie-show-select-time.php");
            $this->ShowMovieShowList();
        }

        // ************ DAO *************************


        # movie room #dateTime
        public function Add($time)
        {
            if ($this->ValidateTime($time) == false)
            {
                echo "<h6 class='text-warning'>el horario ya esta reservado</h6>";
                $this->ShowAddMovieShow();
                return;
            }
            
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }                        

            $movie = $this->movieDAO->GetMovieById($_SESSION['movieId']);
            $room = $this->roomDAO->GetRoomById($_SESSION['roomId']);
            
            $movieShowDateTime = $_SESSION['movieDate'] . ' ' . $time;                                
            $date = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));            

            $movieShow = new MovieShow($movie, $room, $date);                        

            $rowAffected = $this->movieShowDAO->Add($movieShow);

            if ($rowAffected == -1)
            {                
               echo "<h6 class='text-warning'>error al cargar los datos</h6>";
            }           

            $this->ShowAddMovieShow();
        }    

        public function Update($id, $movieId = null, $cinemaId = null, $movieShowDate = null, $movieShowTime = null)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }                       

            $movieShow = $this->movieShowDAO->Get($id);

            if ($movieId != null)
            {
                $movieShow->setMovie($this->movieDAO->GetMovieById($movieId));
            }

            $this->movieShowDAO->Update($movieShow);

            $this->ShowMovieShowUpdate($id);            
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

        // ************ AUXILIARES *************************

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

        private function ValidateTime($time)
        {   
            $validate = true;            
            $roomReservations = $this->roomDAO->GetReservationsOfRoom($_SESSION['roomId']);            

            if (sizeof($roomReservations) == 0)
            {
                return true;
            }

            # si la sala tiene funciones, me fijo que no coincidan sus horarios
            else
            {
                # horario desde
                $movieShowDateFrom= $_SESSION['movieDate'] . ' ' . $time;            
                $dateFrom = date_create($movieShowDateFrom, timezone_open('America/Argentina/Buenos_Aires'));  

                # le sumo el horario de la pelicula mas los 15 minutos de descanso de la funcion
                $movieDuration = $this->movieDAO->GetMovieById($_SESSION['movieId'])->getDuration();          
                $movieShowDateTo = $_SESSION['movieDate'] . ' ' . $time;
                $dateTo = date_create($movieShowDateTo, timezone_open('America/Argentina/Buenos_Aires'));                  
                date_add($dateTo, date_interval_create_from_date_string('15 minutes'));            
                
                $timeMovieDuration = explode(':',$movieDuration);
                
                $hours = $timeMovieDuration[0];
                $minutes = $timeMovieDuration[1];
                
                date_add($dateTo, date_interval_create_from_date_string($hours . ' hours'));
                date_add($dateTo, date_interval_create_from_date_string($minutes . ' minutes'));           

                $validate = false;                

                # esta logicamente planteado de una manera que sea facil de leer y entender. Lo esta
                # pensado para que sea eficiente en la comparacion. 
                # la variable $validate es auxiliar para entender el razonamiento de las comprobaciones.

                foreach ($roomReservations as $reservation)
                {                    
                    # si el final de la nueva es menor al inicio de la reserva, true
                    if ($dateTo < $reservation['from'])
                    {
                        $validate = true;                        
                    }
                    
                    # si el inicio de la nueva es mayor al final de la reserva, true
                    else if ($dateFrom > $reservation['to'])
                    {
                        $validate = true;                        
                    }
                    else
                    {                        
                        return false;                                   
                    }
                }
            }           
            return $validate;             
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
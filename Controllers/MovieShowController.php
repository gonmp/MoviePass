<?php 
    namespace Controllers;

    use Controllers\HomeController as HomeController;      
    
    use Models\MovieShow as MovieShow;
    use Models\AuxMovieShow as AuxMovieShow;
    use Models\Cinema as Cinema;

    use DAO\MovieShowDAO as MovieShowDAO;        
    use DAO\MovieDAO as MovieDAO;    
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\PurchaseDAO as PurchaseDAO;    

    class MovieShowController
    {
        private $movieList;
        private $movieDAO;
        private $cinemaList;
        private $cinemaDAO;       
        private $movieShowDAO;      
        private $roomDAO;
        private $purchaseDAO;        

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();            
            $this->movieList = $this->movieDAO->GetAll();
            $this->cinemaDAO = new CinemaDAO();
            $this->cinemaList = $this->cinemaDAO->GetAll();
            $this->movieShowDAO = new MovieShowDAO();
            $this->roomDAO = new RoomDAO();
            $this->purchaseDAO = new PurchaseDAO();                                    
        }        

        // ************ VISTAS *************************

        public function ShowAddMovieShow()
        {               
            $_SESSION['updateMovieShow'] = null;
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
            $auxMovieShow = $this->movieShowDAO->Get($movieShowId);            
            $_SESSION['updateMovieShow'] = $auxMovieShow->getId();            

            // salvar los datos de la funcion auxiliar en un json
            $saveMovieShow = new AuxMovieShow();
            $saveMovieShow->setId($movieShowId);
            $saveMovieShow->setMovieId($auxMovieShow->getMovie()->getId());
            $saveMovieShow->setDateTime($auxMovieShow->getShowDate());       
            $saveMovieShow->setCinemaName($auxMovieShow->getRoom()->getCinema()->getName());
            $saveMovieShow->setRoomId($auxMovieShow->getRoom()->getId());
            $saveMovieShow->saveData();

            $auxMovieShow->setCinemaName($saveMovieShow->getCinemaName());
            
            require_once(VIEWS_PATH . 'movie-show-details-for-update.php');            
            $this->SelectMovie();
            $this->ShowMovieShowList();
        }   

        // ******** WIZARD DE CREAR SALA **********
        
        public function SelectMovie()
        {
            $movieSelected = null;
            if (isset($_SESSION['updateMovieShow']))
            {
                $auxMovieShow = AuxMovieShow::read();
                $auxMovieId = $auxMovieShow->getMovieId();
                $movieSelected = $this->movieDAO->GetMovieById($auxMovieId);
            }

            $movieList = $this->movieDAO->getAll();                   
            require_once(VIEWS_PATH."movie-show-select-movie.php");             
        }
        
        public function SelectDate($movieId)
        {               
            $_SESSION['movieId'] = $movieId;         
            $dateSelected = null;   

            if (isset($_SESSION['updateMovieShow']))
            {
                # leo los datos del json
                $jsonMovieShow = AuxMovieShow::read();  
                
                # actualizo los datos del json
                $jsonMovieShow->setMovieId($movieId); 
                $jsonMovieShow->saveData();               
                
                $auxMovieShow = $this->movieShowDAO->Get($jsonMovieShow->getId());
                $movie = $this->movieDAO->GetMovieById($movieId);                                
                $auxMovieShow->setMovie($movie);        
                $auxMovieShow->setCinemaName($jsonMovieShow->getCinemaName()); 

                require_once(VIEWS_PATH . 'movie-show-details-for-update.php');                
            }            
            
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
            
            $selectedCinema = null;
            if (isset($_SESSION['updateMovieShow']))
            {
                # obtengo el movieshow
                $jsonMovieShow = AuxMovieShow::read(); 
                $auxMovieShow = $this->movieShowDAO->Get($jsonMovieShow->getId());
                
                # muestro la pelicula
                $movie = $this->movieDAO->GetMovieById($jsonMovieShow->getMovieId());                
                $auxMovieShow->setMovie($movie);                                

                # actualizo la nueva fecha
                $time = date_format($jsonMovieShow->getDateTime(), "H:i");
                $newDate = $movieDate . ' ' . $time;                
                $auxDate = date_create($newDate, timezone_open('America/Argentina/Buenos_Aires'));               

                $auxMovieShow->setShowDate($auxDate);                
                $jsonMovieShow->setDateTime($auxDate);
                $jsonMovieShow->saveData();

                $auxMovieShow->setCinemaName($jsonMovieShow->getCinemaName());        

                $selectedCinema = $auxMovieShow->getCinemaName();
                require_once(VIEWS_PATH . 'movie-show-details-for-update.php');                
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

            if (isset($_SESSION['updateMovieShow']))
            {
                # obtengo el movieshow
                $jsonMovieShow = AuxMovieShow::read(); 
                $auxMovieShow = $this->movieShowDAO->Get($jsonMovieShow->getId());
                
                # muestro la pelicula
                $movie = $this->movieDAO->GetMovieById($jsonMovieShow->getMovieId());                
                $auxMovieShow->setMovie($movie);                                      

                # actualizo la fecha
                $auxMovieShow->setShowDate($jsonMovieShow->getDateTime());                

                # actualizo el cinema
                $jsonMovieShow->setCinemaName($cinemaName);
                $jsonMovieShow->saveData();

                $auxMovieShow->setCinemaName($cinemaName);                
                require_once(VIEWS_PATH . 'movie-show-details-for-update.php');                
            }      
            
            require_once(VIEWS_PATH."movie-show-select-room.php");      
            $this->ShowMovieShowList();      
        }        

        public function SelectTime($roomId)
        {
            $timeSelected = null;
            if (isset($_SESSION['updateMovieShow']))
            {
                # obtengo el movieshow
                $jsonMovieShow = AuxMovieShow::read(); 
                $auxMovieShow = $this->movieShowDAO->Get($jsonMovieShow->getId());
                
                # muestro la pelicula
                $movie = $this->movieDAO->GetMovieById($jsonMovieShow->getMovieId());                
                $auxMovieShow->setMovie($movie);          
                
                # actualizo el cine
                $auxMovieShow->setCinemaName($jsonMovieShow->getCinemaName());

                # actualizo el room
                $room = $this->roomDAO->GetRoomById($roomId);
                $auxMovieShow->setRoom($room);

                $jsonMovieShow->setRoomId($roomId);
                $jsonMovieShow->saveData();

                $timeSelected = date_format($auxMovieShow->getShowDate(),"H:i");

                require_once(VIEWS_PATH . 'movie-show-details-for-update.php');                
            }    

            $_SESSION['roomId'] = $roomId;

            $room = $this->roomDAO->getRoomById($roomId);

            require_once(VIEWS_PATH."movie-show-select-time.php");
            $this->ShowMovieShowList();
        }

        // ************ DAO *************************

        public function Add($time)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }                                    

            $movieShowId = null;
            $jsonMovieShow = AuxMovieShow::read();

            if(isset($_SESSION['updateMovieShow']))
            {                
                $movieShowId = $jsonMovieShow->getId();
            }                        

            if ($this->ValidateTime($time, $movieShowId) == false)
            {
                echo "<h6 class='text-warning'>error: the room is already reserved</h6>";
                $this->ShowAddMovieShow();
                return;
            }
            
            # update            
            if(isset($_SESSION['updateMovieShow']))
            {
                $roomId = $jsonMovieShow->getRoomId();
                $room = $this->roomDAO->GetRoomById($roomId);

                $movieId = $jsonMovieShow->getMovieId();
                $movie = $this->movieDAO->GetMovieById($movieId);

                $day = $jsonMovieShow->getDateTime();
                $day = date_format($day, "Y-m-d");                
                $movieShowDateTime = $day . ' ' . $time;                                                
                $date = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));                           

                $movieShow = new MovieShow($movie, $room, $date);                                        
                $movieShow->setId($jsonMovieShow->getId());

                $rowAffected = $this->movieShowDAO->Update($movieShow);            
            }

            # add
            else
            {
                $movie = $this->movieDAO->GetMovieById($_SESSION['movieId']);
                
                $room = $this->roomDAO->GetRoomById($_SESSION['roomId']);                
                
                $movieShowDateTime = $_SESSION['movieDate'] . ' ' . $time;                                
                
                $date = date_create($movieShowDateTime, timezone_open('America/Argentina/Buenos_Aires'));                            

                $movieShow = new MovieShow($movie, $room, $date);                                        
                
                $rowAffected = $this->movieShowDAO->Add($movieShow);
            }

            if ($rowAffected == -1)
            {                
               echo "<h6 class='text-warning'>error adding to database</h6>";
            }           

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

        private function ValidateTime($time, $movieShowId)
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
                    # me fijo si la reserva no es la misma sala, en caso de update
                    if ($movieShowId != null)
                    {
                        if ($movieShowId == $reservation['id'])
                        {
                            $validate = true;
                        }                
                        else
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
                    else
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
<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use Models\Cinema as Cinema;
    use Controllers\HomeController as HomeController;    

    class CinemaController
    {        
        private $cinemaDAO;
        private $roomDAO;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
        }        

        // ********************** ROOMS **************************

        public function ShowAddRoom($cinemaName)
        {
            $cinema = $this->cinemaDAO->GetCinemaByName($cinemaName);                        
            
            require_once(VIEWS_PATH."room-add.php");
            
            $this->ShowRoomList($cinemaName);
        }
        
        public function ShowRoomList($cinemaName)
        {
            $cinema = $this->cinemaDAO->GetCinemaByName($name);            
            $roomsList = $roomDAO->getRooms();

            require_once(VIEWS_PATH."room-list.php");
        }

        // ********************** CINEMAS **************************

        public function ShowUpdateView($name)
        {
            $cinema = $this->cinemaDAO->GetCinemaByName($name);            
            require_once(VIEWS_PATH."cinema-modify.php");

            $this->ShowListView();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cinema-add.php");
            $this->ShowListView();
        }

        public function ShowListView()
        {   
            $cinemaList = $this->cinemaDAO->GetAll();

            require_once(VIEWS_PATH."cinema-list.php");
        }        

        # MP : 
        #   . saque el getID del dao y del constructor de cinema. Lo hace la base de datos ahora.
        #   . ahora checkea que el nombre del cine sea unico antes de agregarlo.

        public function Add($name, $totalCapacity, $address, $ticketValue)
        {   
            if (HomeController::CheckAdmin() == true) 
            {
                $cinemaExist = $this->cinemaDAO->GetCinemaByName($name);            

                # TODO: modularizar esto de ver si el cine existe

                if ($cinemaExist)
                {
                    # TODO: hacer que sea un cartel de error mas agradable 
                    $_SESSION['cinemaError'] = 'The name of the cinema already exists. Choose another';
                }
                else
                {
                    $_SESSION['cinemaError'] = null;
                    $cinema = new Cinema($name, $totalCapacity, $address, $ticketValue, true);            
                    $this->cinemaDAO->Add($cinema);
                }

                 header('location:' . FRONT_ROOT . '/AdminManager/ShowAddCinemaView');
            }            
            else
            {
                HomeController::ForceLogout();
            }            
        }

        public function Update($id, $name, $totalCapacity, $address, $ticketValue)
        {   
            if (HomeController::CheckAdmin() == true) 
            {
                # solo realiza el update si el nombre del cine no existe en la base de datos
                # tambien se fija que el nombre no sea el nombre del propio cinema, para eso compara los id

                $changeCinema = false;

                $cinemaExist = $this->cinemaDAO->GetCinemaByName($name);        
                if ($cinemaExist)
                {
                    if ($cinemaExist->getId() == $id)
                    {                 
                        $changeCinema = true;                                          
                    }                                
                }
                else
                {
                    $changeCinema = true;                      
                }

                if ($changeCinema)
                {
                    $cinema = new Cinema(                
                        $name,
                        $totalCapacity,
                        $address,
                        $ticketValue,
                        true
                    );

                    $cinema->setId($id);

                    $this->cinemaDAO->Update($cinema);

                    $_SESSION['cinemaError'] = null;

                    $this->ShowAddView();
                }
                else
                {
                    $_SESSION['cinemaError'] = 'The name of the cinema already exists. Choose another';  
                    $this->ShowUpdateView($name);
                }      
            }            
            else
            {
                HomeController::ForceLogout();
            }
        }    
        
        public function Delete($cinemaId)
        {
            if (HomeController::CheckAdmin() == true) 
            {
                $this->cinemaDAO->Delete($cinemaId);            
                $this->ShowAddView();
            }            
            else
            {
                HomeController::ForceLogout();
            }
        }
    }
?>

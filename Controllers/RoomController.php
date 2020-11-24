<?php 
    namespace Controllers;

    use Controllers\HomeController as HomeController;             
    use DAO\RoomDAO as RoomDAO;
    use Models\Room as Room;
    use DAO\CinemaDAO as CinemaDAO;

    use Models\Cinema as Cinema;

    class RoomController
    {        
        private $roomDAO;
        private $cinemaDAO;
        private $cinemaList;        
        
        public function __construct()
        {
            $this->roomDAO = new RoomDAO();            
            $this->cinemaDAO = new CinemaDAO();
        }        


        // *******************  VISTAS    ***********************

        public function ShowAddRoom($cinemaName)
        {
            $cinema = $this->cinemaDAO->GetCinemaByName($cinemaName);
            require_once(VIEWS_PATH."room-add.php");
            
            $this->ShowRoomList($cinemaName);
        }

        public function ShowRoomList($cinemaName)
        {
            $cinema = $this->cinemaDAO->GetCinemaByName($cinemaName);            
            $roomsList = $cinema->getRooms();

            require_once(VIEWS_PATH."room-list.php");
        }

        public function ShowUpdateView ($roomId)
        {
            $room = $this->roomDAO->GetRoomById($roomId);
            
            require_once(VIEWS_PATH."room-update.php");            
            $this->ShowRoomList($room->getCinema()->getName());            
        }

        // *******************     DAO         *******************************

        public function Add($cinemaName, $name, $capacity, $ticketValue)
        {   
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }                     
            
            $cinema = $this->cinemaDAO->GetCinemaByName($cinemaName);             
            $roomList = $cinema->getRooms();          

            foreach($roomList as $room)
            {
                if ($room->getName() == $name)
                {
                    echo "<h6 class='text-warning               '>The name of the room already exists.</h6>";
                    $this->ShowAddRoom($cinemaName);
                    return;
                }
            }
                        
            $room = new Room($capacity, $cinema, $ticketValue, $name);     

            $rowAffected = $this->roomDAO->Add($room);

            if ($rowAffected == -1)
            {                   
                $this->ShowAddRoom($cinemaName);
            }            

            $this->ShowAddRoom($cinemaName);
        }

        public function Delete($roomId)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

            $cinema = $this->roomDAO->GetRoomById($roomId)->getCinema();
        
            $this->roomDAO->Delete($roomId);
            
            $this->ShowAddRoom($cinema->getName());   
        }  

        public function Update($roomId, $cinemaName, $name, $capacity, $ticketValue)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }                        
            
            $cinema = $this->cinemaDAO->getCinemaByName($cinemaName);
            $roomsList = $cinema->getRooms();

            foreach($roomsList as $room)
            {
                if ($room->getName() == $name)
                {
                    if ($room->getId() != $roomId)
                    {
                        echo "<h6 class='text-warning'>The name of the room is already in use.</h6>";        
                        $this->ShowUpdateView($roomId);                        
                        return;                        
                    }
                    else
                    {
                        break;
                    }
                }
            }    
            
            $thisRoom = new Room($capacity, $cinema, $ticketValue, $name);
            $thisRoom->setId($roomId);

            $this->roomDAO->Update($thisRoom);

            $this->ShowAddRoom($cinema->getName());
        }
    }
?>
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

        public function Add($cinemaName, $capacity, $ticketValue, $name)
        {            
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }                     
            
            $cinema = $this->cinemaDAO->GetCinemaByName($cinemaName);    

            $room = new Room($capacity, $cinema, $ticketValue, $name);

            $rowAffected = $this->roomDAO->Add($room);

            if ($rowAffected == -1)
            {                
                $_SESSION['error'] = 'error in add movie show';
            }
            else
            {
                $_SESSION['error'] = null;
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

        public function Update($id, $ticketValue, $capacity, $name, $oldName)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }            

            if ($name != $oldName)
            {
                $room = $this->roomDAO->GetRoomById($id);
                $cinema = $room->getCinema();

                $roomsList = $cinema->getRooms();

                foreach($roomsList as $thisRoom)
                {
                    if ($name == $thisRoom->getName())
                    {
                        echo "<h1 class'h6 text-warning>The name of the room is already in use.</h1>";        
                        $this->ShowUpdateView($id);
                        
                        return;
                    }
                }

                $theRoom = new Room($capacity, $cinema, $ticketValue, $name);
                $theRoom->setId($id);

                $this->roomDAO->Update($theRoom);
            }
            else
            {
                echo "<h1 class'h6 text-warning>The old name and the new name are the same.</h1>";                
            }            

            $this->ShowUpdateView($id);
        }
    }
?>
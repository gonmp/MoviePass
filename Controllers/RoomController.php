<?php 
    namespace Controllers;

    use Controllers\HomeController as HomeController;             
    use DAO\RoomDAO as RoomDAO;
    use Models\Room as Room;
    use DAO\CinemaDAO as CinemaDAO;

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

        public function ShowAddRoom()
        {   
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

            $this->cinemaList = $this->cinemaDAO->GetALL();
            require_once(VIEWS_PATH."room-add.php");            
        }        

        public function Add($cinemaName, $capacity, $ticketValue, $name)
        {
            /*
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            } */                      
            
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

            header('location:' . FRONT_ROOT . 'Cinema/ShowAddRoom?cinemaName?' . $cinemaName);
        }        
        
        public function ShowRoomUpdate($roomId)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

            $room = $this->roomDAO->Get($roomId);

            require_once(VIEWS_PATH . 'room-update.php');            
        }

        public function Update($id, $cinemaName, $ticketValue, $capacity, $name)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }            

            $cinema = $cinemaDAO->GetCinemaByName($cinemaName);            
            $room = new Room($capacity, $cinema, $ticketValue, $name);
            $room->setId($id);            

            $this->movieShowDAO->Update($room);

            $this->ShowCinemaDetails();            
        }

        public function Delete($roomId)
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

            $this->movieShowDAO->Delete($roomId);
            
            $this->ShowCinemaDetails();   
        }        

        public function ShowCinemaDetails()
        {
            if (HomeController::CheckAdmin() != true) 
            {
                HomeController::ForceLogout();
                return;
            }

            require_once(VIEWS_PATH."cinema-details.php");
        }
    }

?>
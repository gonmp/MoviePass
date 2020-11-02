<?php
    namespace Controllers;

    use DAO\CinemaDAO as cinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaController{
        
        private $cinemaDAO;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }        

        public function ShowModifyView($idCinema)
        {
            $cinema = $this->cinemaDAO->GetCinemaById($idCinema);            

            require_once(VIEWS_PATH."cinema-modify.php");
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."cinema-add.php");
        }

        public function ShowListView(){            

            $cinemaList = $this->cinemaDAO->GetAll();

            require_once(VIEWS_PATH."cinema-list.php");
        }

        public function Add($name, $totalCapacity, $address, $ticketValue) {    
            
            $cinema = new Cinema($this->cinemaDAO->GetNewID(), $name, $totalCapacity, $address, $ticketValue, true);            
            $this->cinemaDAO->Add($cinema);
            $this->ShowAddView();
        }

        public function Modify($id, $name, $totalCapacity, $address, $ticketValue)
        {            
            $this->cinemaDAO->Modify($id, $name, $totalCapacity, $address, $ticketValue);
            $this->ShowListView();
        }

        public function Delete($cinemaId)
        {
            $cinema = $this->cinemaDAO->GetCinemaById($cinemaId);

            if ($cinema->getEnabled())
            {
                $this->cinemaDAO->Delete($cinemaId);
            }
            else
            {
                $this->cinemaDAO->UnDelete($cinemaId);
            }
            
            $this->ShowListView();
        }

        public function GoHome()
        {
            $_SESSION['adminLogged'] = null;            
            $_SESSION['userLogged'] = null; 

            $_SESSION['error'] = 'Forced logout by using URL to navigate';
            
            require_once(VIEWS_PATH."login.php");        
        }
    }
?>

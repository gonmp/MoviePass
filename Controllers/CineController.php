<?php
    namespace Controllers;

    use DAO\CineDAO as cineDAO;
    use Models\Cine as Cine;

    class CineController{
        
        private $cineDAO;

        public function __construct(){
            $this->cineDAO = new CineDAO();
        }

        public function ShowModifyView($idCine)
        {
            require_once(VIEWS_PATH."cine-modify.php");
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."cine-add.php");
        }

        public function ShowListView(){

            # el admin deberia poder ver todos, el cliente no
            # $cineList = $this->cineDAO->GetAllEnabled();

            $cineList = $this->cineDAO->GetAll();

            require_once(VIEWS_PATH."cine-list.php");
        }

        public function Add($name, $totalCapacity, $address, $ticketValue) {    
            
            $cine = new Cine($this->cineDAO->GetNewID(), $name, $totalCapacity, $address, $ticketValue, true);
            
            $this->cineDAO->Add($cine);

            $this->ShowAddView();
        }

        public function Delete($cineId)
        {
            $this->cineDAO->Delete($cineId);
            $this->ShowListView();
        }
    }
?>

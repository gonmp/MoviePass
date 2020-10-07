<?php
    namespace Controllers;

    use DAO\CineDAO as cineDAO;
    use Models\Cine as Cine;

    class CineController{

        private $cineDAO;

        public function __construct(){
            $this->cineDAO = new CineDAO();
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."cine-add.php");
        }

        public function ShowListView(){

            $cineList = $this->cineDAO->GetAll();

            require_once(VIEWS_PATH."cine-list.php");
        }

        public function Add($name, $totalCapacity, $address, $ticketValue) {    
            
            $cine = new Cine($name, $totalCapacity, $address, $ticketValue);
            
            $this->cineDAO->Add($cine);

            $this->ShowAddView();
        }
    }
?>

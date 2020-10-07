<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use Models\Cine asi Cine;

    class CineController{

        private $cineDAO;

        public function __construct(){
            $this->cineDAO = new CineDAO();
        }

        public function ShowAddView(){
            require_once(VIEW_PATH."cine-alta.php");
        }

        public function ShowListView(){

            $cineList = $this->cineDAO->GetAll();

            require_once(VIEW_PATH."cine-list.php");
        }

        public function Add(){

            //INSERTE ADD AQUI
        }
    }
?>

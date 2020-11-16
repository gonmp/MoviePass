<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use Models\Cinema as Cinema;
    use Controllers\HomeController as HomeController;    
    use Controllers\RoomController as RoomController;

    class CinemaController
    {        
        private $cinemaDAO;
        private $roomDAO;
        private $roomController;
        

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();

            $this->roomController = new RoomController();
        }      

        // // ************************ FUNCIONES RELACIONADAS A LAS VISTAS **************************
        
        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cinema-add.php");
            $this->ShowListView();
        }

        public function ShowUpdateView($name)
        {
            $cinema = $this->cinemaDAO->GetCinemaByName($name);            
            
            require_once(VIEWS_PATH."cinema-modify.php");

            $this->ShowListView();
        }

        public function ShowListView()
        {   
            $cinemaList = $this->cinemaDAO->GetAllCinemasOnly();            
            require_once(VIEWS_PATH."cinema-list.php");       
        }        

        public function ShowRooms($cinemaName)
        {
            $this->roomController->ShowAddRoom($cinemaName);
        }


        // ************************ FUNCIONES RELACIONADAS AL DAO *********************************

        public function Add($name, $address)
        {               
            if (HomeController::CheckAdmin() == true) 
            {                
                $cinemaExist = $this->cinemaDAO->GetCinemaByName($name);                                            

                if ($cinemaExist->getId() != null)
                {        
                    echo "<h1 class='text-warning h5'>cinema's name already in use</h1>";
                }
                else
                {                   
                    $cinema = new Cinema($name, $address);            
                    $this->cinemaDAO->Add($cinema);                   
                }

                 $this->ShowAddView();
            }            
            else
            {
                HomeController::ForceLogout();
            }            
        }

        public function Update($id, $name, $oldName, $address)
        {   
            if (HomeController::CheckAdmin() == true) 
            {
                # solo realiza el update si el nombre del cine no existe en la base de datos
                # tambien se fija que el nombre no sea el nombre del propio cinema, para eso compara los id

                if ($name != $oldName)
                {   
                    $cinemaExist = $this->cinemaDAO->GetCinemaByName($name);    
                    
                    if ($cinemaExist->getId() == null)
                    {
                        $cinema = new Cinema($name,$address);
                        $cinema->setId($id);
    
                        $this->cinemaDAO->Update($cinema);
                        $this->ShowAddView();
                    }
                    else
                    {
                        echo "<h1 class='h6 text-warning'>The name of the cinema already exists. Choose another.</h1>";  
                        $this->ShowUpdateView($name);
                    }
                }
                else
                {
                    echo "<h1 class='h6 text-warning'>The old name and the new name are the same.</h1>";  
                    $this->ShowUpdateView($oldName);
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

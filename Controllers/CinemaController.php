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

        public function Update($id, $name, $address)
        {   
            if (HomeController::CheckAdmin() == true) 
            {                
                $cinemaExist = $this->cinemaDAO->GetCinemaByName($name);   

                if ($cinemaExist->getId() != null)
                {
                    if ($cinemaExist->getId() == $id)
                    {
                        # dejo el nombre sin cambiar
                        $cinema = new Cinema($name,$address);
                        $cinema->setId($id);
    
                        $this->cinemaDAO->Update($cinema);
                        $this->ShowAddView();
                    }
                    else
                    {
                        # el nombre elegido pertenece a otro cine
                        echo "<h1 class='h6 text-warning'>The name of the cinema already exists. Choose another.</h1>";  
                                              
                        $thisCinema = $this->cinemaDAO->GetCinemaById($id);
                        $this->ShowUpdateView($thisCinema->getName());
                    }
                }
                else
                {
                    # dejo el nombre sin cambiar
                    $cinema = new Cinema($name,$address);
                    $cinema->setId($id);

                    $this->cinemaDAO->Update($cinema);
                    $this->ShowAddView();
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

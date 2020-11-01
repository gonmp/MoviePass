<?php
    namespace Controllers;   

    use DAO\UserDAO as UserDAO;    
    use Models\User as User;
    use Controllers\CineController as CineController;
    use Controllers\MovieController as MovieController;

    class UserController
    {        
        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }        

        public function Add ($userName, $password)
        {
            if ($this->userDAO->CheckUserName($userName) == true)
            {
                $this->Error("username is already in use");
            }
            else
            {
                $user = new User($userName, $password);
                $this->userDAO->Add($user);
                $_SESSION["error"] = null;
                
                $this->ShowLoginView();
            }            
        }

        public function ShowLoginView ()
        {
            require_once(VIEWS_PATH."login.php");
        }

        public function ShowRegisterView ()
        {
            require_once(VIEWS_PATH."register.php");
        }        

        public function Login ($user = null, $password = null)
        {  
            # chekear si es admin

            if ($this->userDAO->CheckAdmin($user, $password))
            {                           
                $_SESSION["validLogin"] = true;
                $_SESSION['adminLogged'] = true;

                $cineController = new CineController();
                $cineController->ShowListView();
            }   

            # chekear si es un usuario valido

            else if ($this->userDAO->CheckUser($user, $password))
            {                
                $_SESSION["validLogin"] = true;
                $_SESSION["userLogged"] = true;                                         

                $movieController = new MovieController();
                $movieController->ShowSearchMovieView();    
            }

            # enviarlo a login e informarle del error

            else
            {   
                $this->Error("wrong username or password");
            }
        }

        private function Error ($errorMessage)
        {            
            $_SESSION["error"] = $errorMessage;

            $this->GoHome();
        }

        public function GoHome()
        {
            require_once(VIEWS_PATH."login.php");            
        }
    }
?>

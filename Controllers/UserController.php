<?php
    namespace Controllers;   

    use DAO\UserDAO as UserDAO;    
    use Models\User as User;
    use Controllers\CinemaController as CinemaController;
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

        public function Login ($user, $password)
        {  
            # chekear si es admin

            if ($this->userDAO->CheckAdmin($user, $password))
            {                           
                $_SESSION['userLoged'] = true;
                $cinemaController = new CinemaController();
                $cinemaController->ShowListView();
            }   

            # chekear si es un usuario valido

            else if ($this->userDAO->CheckUser($user, $password))
            {
                // TODO: enviarlo al inicio para el usuario
                $_SESSION['userLoged'] = true;                

                $movieController = new MovieController();
                $movieController->ShowSearchMovieView();
                
                #require_once(VIEWS_PATH."user-movie-form.php");                                
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

            require_once(VIEWS_PATH."login.php");            
        }
    }
?>

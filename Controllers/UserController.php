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
            $user = new User($this->userDAO->GetNewID(), $userName, $password);
            $this->userDAO->Add($user);
            
            $this->ShowLoginView();
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
                $cineController = new CineController();
                $cineController->ShowListView();
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
                $this->LoginError("usuario incorrecto");
            }
        }

        private function LoginError ($errorMessage)
        {
            // TODO: ir a la ventana de login mostrando el error
            $_SESSION["error"] = $errorMessage;

            require_once(VIEWS_PATH."login.php");            
        }
    }
?>

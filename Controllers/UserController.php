<?php
    namespace Controllers;   

    use DAO\UserDAO as UserDAO;    
    use Models\User as User;
    use Controllers\CineController as CineController;

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
            if ($this->userDAO->CheckAdmin($user, $password))
            {                           
                $cineController = new CineController();
                $cineController->ShowListView();
            }   
            else if ($this->userDAO->CheckUser($user, $password))
            {
                require_once(VIEWS_PATH."cine-add.php");                

                // TODO: enviarlo a algun lugar
            }
            else
            {                
                $this->LoginError("usuario incorrecto");
            }
        }

        private function LoginError ($error)
        {
            // TODO: ir a la ventana de login mostrando el error

            require_once(VIEWS_PATH."login.php");            
        }
    }
?>

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
            $admin = 0;
            $user = new User($userName, $password, $admin);
            $rowsAffected = $this->userDAO->Add($user);
            if ($rowsAffected == -1)
            {
                $this->Error("Username is already in use");
            }
            else
            {
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

        public function Login ($name = null, $password = null)
        {  
            if (!$name || !$password)
            {
                $this->Error('Forced logout by using URL for navigate');
            }

            $user = $this->userDAO->GetUserByName($name);
            # chekear si es un usuario valido
            if($user != null && $user->GetPassword() == $password)
            {
                # chekear si es admin
                if($user->GetAdmin())
                {
                    $_SESSION["validLogin"] = true;
                    $_SESSION['adminLogged'] = true;
                    $cinemaController = new CinemaController();
                    $cinemaController->ShowListView();
                }
                else
                {
                    $_SESSION["validLogin"] = true;
                    $_SESSION["userLogged"] = true;                                         

                    $movieController = new MovieController();
                    $movieController->ShowSearchMovieView();
                }
            }
            else
            {   
                # enviarlo a login e informarle del error
                $this->Error("Wrong username or password");
            }            
        }

        private function Error ($errorMessage)
        {            
            $_SESSION["error"] = $errorMessage;

            $this->GoHome();
        }

        public function GoHome()
        {
            $_SESSION['adminLogged'] = null;            
            $_SESSION['userLogged'] = null; 

            require_once(VIEWS_PATH."login.php");            
        }
    }
?>

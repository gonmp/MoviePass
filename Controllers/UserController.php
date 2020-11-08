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
                $_SESSION["error"] = "username is already in use";
                $this->ShowRegisterView();
            }
            else
            {
                $_SESSION["error"] = null;
                $_SESSION['userLogged'] = $user;

                header('location:' . FRONT_ROOT . 'Home/Index');
            }            
        }

        public function ShowLoginView ()
        {
            $_SESSION['actualView'] = 'login';
            require_once(VIEWS_PATH."login.php");
        }

        public function ShowRegisterView ()
        {
            if ($_SESSION['actualView'] != 'register')
            {
                $_SESSION['error'] = null;
            }
            
            $_SESSION['actualView'] = 'register';            
            require_once(VIEWS_PATH."register.php");
        }        

        public function Login ($name = null, $password = null)
        {  
            if (!$name || !$password)
            {
                #$this->Error('Forced logout by using URL for navigate');
            }

            $user = $this->userDAO->GetUserByName($name);
            
            # chekear si es un usuario valido
            if($user != null && $user->GetPassword() == $password)
            {
                $_SESSION['userLogged'] = $user;

                # chekear si es admin
                if($user->GetAdmin())
                {   
                    $cinemaController = new CinemaController();
                }
                else
                {   
                    $movieController = new MovieController();
                }                
                header('location:' . FRONT_ROOT . '/Movie/ShowSearchMovieView');
            }
            else
            {                   
                $_SESSION['error'] = "wrong username or password";
                header('location:' . FRONT_ROOT . 'Movie/ShowSearchMovieView');
            }            
        }       

        public function GoHome()
        {            
            $_SESSION['userLogged'] = null; 
            header('location:' . FRONT_ROOT . 'Home/Index');
        }
    }
?>

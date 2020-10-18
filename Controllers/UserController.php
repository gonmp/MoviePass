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

        public function Login ($user, $password)
        {
            $loginUser = new User($user, $password);          

            if ($this->CheckUserName($loginUser))
            {
                if ($this->CheckUserPassword($loginUser))
                {
                    // TODO: si es admin, ir a la ventana de administracion de CINES
                    //       si es usuario, ir a una ventana cualquiera con el mensaje de login realizado con exito                    
                    
                    if ($this->CheckAdmin($loginUser))
                    {                           
                        require_once(FRONT_ROOT."Cine/ShowListView");                    
                    }   
                    else
                    {
                        // TODO: esto despues lo ponemos con el link que corresponde

                        require_once(VIEWS_PATH."index.php");
                        echo "logueado correctamente";
                    }                                     
                }
                else
                {
                    // TODO: error en la password
                    $this->LoginError("password incorrecta");
                }
            }
            else
            {
                // TODO: error en el usuario
                $this->LoginError("usuario incorrecto");
            }
        }
        
        private function CheckUserName ($loginUser)
        {
            // TODO: devolver lo que de el DAO

            return true;
        }
        private function CheckUserPassword ($loginPassword)
        {
            // TODO: devolver lo que de el DAO

            return true;
        }
        
        private function CheckAdmin ($loginUser)
        {
            // TODO: devolver lo que de el DAO

            return $loginUser->GetAdmin();
        }

        private function LoginError ($error)
        {
            // TODO: ir a la ventana de login mostrando el error
            require_once(VIEWS_PATH."login.php");            
        }
    }
?>

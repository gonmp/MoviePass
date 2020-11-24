<?php
    namespace Controllers;   

    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use DAO\MovieShowDAO as MovieShowDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\PurchaseDAO as PurchaseDAO;
    use DAO\UserDAO as UserDAO;
    
    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use Models\MovieShow as MovieShow;
    use Models\Room as Room;
    use Models\Cinema as Cinema;
    use Models\Purchase as Purchase;
    use Models\User as User;    

    class PurchaseController
    {        
        private $movieDAO;
        private $genreDAO;
        private $movieShowDAO;
        private $cinemaDAO;
        private $roomDAO;
        private $purchaseDAO;
        private $userDAO;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
            $this->movieShowDAO = new MovieShowDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            $this->purchaseDAO = new PurchaseDAO();
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

        public function ShowPurchaseView ()
        {
            $movieShow = $this->movieShowDAO->Get(1);
            $remanentSpots = 3;
            require_once(VIEWS_PATH."purchase.php");
        }

        public function ShowPurchaseViewTwo ()
        {
            $movieShowId = $_GET['movieShowId'];
            $numberOfTickets = $_POST['numberOfTickets'];
            $movieShow = $this->movieShowDAO->Get($movieShowId);
            require_once(VIEWS_PATH."purchaseTwo.php");
        }

        public function ShowPurchaseViewThree ()
        {
            $movieShowId = $_GET['movieShowId'];
            $numberOfTickets = $_GET['numberOfTickets'];
            require_once(VIEWS_PATH."purchaseThree.php");
        }

        public function ValidatePayment()
        {
            $movieShowId = $_GET['movieShowId'];
            $numberOfTickets = $_GET['numberOfTickets'];
            
            $cardNumber = $_POST['cardnumber'];
            \Stripe\Stripe::setApiKey('sk_test_51HqJvNKO2Y0Jg2sUua2odEVQdzvU0ii3xCg5aC9o92AECMfEsE4518uDUZCxwod1fcypzeuSWBlYaUmBYs2k8YZy00rLKQGklE');

            $stripe = new \Stripe\StripeClient(
            'sk_test_51HqJvNKO2Y0Jg2sUua2odEVQdzvU0ii3xCg5aC9o92AECMfEsE4518uDUZCxwod1fcypzeuSWBlYaUmBYs2k8YZy00rLKQGklE'
            );
            try
            {
                $response = $stripe->tokens->create([
                    'card' => [
                        'number' => $cardNumber,
                        'exp_month' => 07,
                        'exp_year' => 2025,
                        'cvc' => '135',
                    ],
                ]);

                $movieShow = $this->movieShowDAO->Get($movieShowId);

                $user = $this->userDAO->GetUserById(5);

                $date = date_create(null, timezone_open('America/Argentina/Buenos_Aires'));

                $purchase = new Purchase($date, $user, $movieShow, $numberOfTickets);

                var_dump($purchase);

                $result = $this->purchaseDAO->Add($purchase);

                var_dump($result);
                    
            }
            catch(\Exception $ex)
            {
                var_dump("Hubo un error durante el pago");
            }
            
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
                    $_SESSION['adminLogged'] = true;
                }
                else
                {   
                    $movieController = new MovieController();
                }                                
            }
            else
            {                   
                $_SESSION['error'] = "wrong username or password";
            }            
            
            header('location:' . FRONT_ROOT . 'Movie/ShowAllMoviesPremieres');
        }               
    }
?>

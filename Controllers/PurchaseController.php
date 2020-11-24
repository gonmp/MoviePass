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

        private $movieList;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
            $this->movieShowDAO = new MovieShowDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            $this->purchaseDAO = new PurchaseDAO();
            $this->userDAO = new UserDAO();
            $this->movieList = $this->movieDAO->GetAll();
            $this->cinemaList = $this->cinemaDAO->GetAllCinemasOnly();
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
            $date = date_create(null, timezone_open('America/Argentina/Buenos_Aires'));
            $user = $this->userDAO->GetUserById($_SESSION['userLogged']->GetId());
            $purchase = new Purchase($date, $user, $movieShow, $numberOfTickets);
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
            $email = $_POST['email'];
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

                $user = $this->userDAO->GetUserById($_SESSION['userLogged']->GetId());

                $date = date_create(null, timezone_open('America/Argentina/Buenos_Aires'));

                $purchase = new Purchase($date, $user, $movieShow, $numberOfTickets);

                $result = $this->purchaseDAO->Add($purchase);

                $purchaseId = $this->purchaseDAO->GetLastPurchaseId();

                $this->SendEmail($email, $user->getUserName(), $purchaseId);

                require_once(VIEWS_PATH."payment-success.php");
                    
            }
            catch(\Exception $ex)
            {
                require_once(VIEWS_PATH."payment-error.php");
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
        
        public function SendEmail($email, $userName, $purchaseId)
        {
            $tickets = $this->purchaseDAO->Get($purchaseId)->getTickets();

            $text = "<h3>Dear ".$userName." , your bougth was successfull!!!. Your tickets are:\n</h3>";

            foreach($tickets as $ticket)
            {
                $text = $text . $ticket->getQr() . "\n";
            }

            $body = [
                'Messages' => [
                    [
                    'From' => [
                        'Email' => "moviepass.mmfg@gmail.com",
                        'Name' => "MoviePass"
                    ],
                    'To' => [
                        [
                        'Email' => $email,
                        'Name' => $userName
                        ]
                    ],
                    'Subject' => "Your bougth was successfull!!!",
                    'HTMLPart' => $text
                    ]
                ]
            ];
            
            $json = json_encode($body);
            
            $ch = curl_init();

            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json')
            );
            curl_setopt($ch, CURLOPT_USERPWD, "52ddfcf3aa336fb4c9544a049a5410d1:5494cc2be143533fb007b505d4f6b326");
            $server_output = curl_exec($ch);
            curl_close ($ch);

            $response = json_decode($server_output);
        }

        public function ShowAdminPurchasesMovie()
        {
            require_once(VIEWS_PATH."admin-purchase-movie.php");
        }

        public function ShowAdminPurchasesMovieResults()
        {
            $movieId = $_POST['movieId'];

            $dateFrom = date_create(
                $_POST['startDate'],
                timezone_open('America/Argentina/Buenos_Aires')
            );
            
            $dateTo = date_create(
                $_POST['endDate'],
                timezone_open('America/Argentina/Buenos_Aires')
            );

            $dateFromString = date_format($dateFrom, "Y-m-d");

            $dateToString = date_format($dateTo, "Y-m-d");

            $movieSelect = $this->movieDAO->GetMovieById($movieId);

            $total = $this->purchaseDAO->GetTotalByMovieId($movieId, $dateFrom, $dateTo);

            if($total == null)
            {
                $total = 0;
            }

            require_once(VIEWS_PATH."admin-purchase-movie-results.php");
        }

        public function ShowAdminPurchasesCinema()
        {
            require_once(VIEWS_PATH."admin-purchase-cinema.php");
        }

        public function ShowAdminPurchasesCinemaResults()
        {
            $cinemaId = $_POST['cinemaId'];

            $dateFrom = date_create(
                $_POST['startDate'],
                timezone_open('America/Argentina/Buenos_Aires')
            );
            
            $dateTo = date_create(
                $_POST['endDate'],
                timezone_open('America/Argentina/Buenos_Aires')
            );

            $dateFromString = date_format($dateFrom, "Y-m-d");

            $dateToString = date_format($dateTo, "Y-m-d");

            $cinemaSelect = $this->cinemaDAO->GetCinemaById($cinemaId);

            $total = $this->purchaseDAO->GetTotalByCinemaId($cinemaId, $dateFrom, $dateTo);

            if($total == null)
            {
                $total = 0;
            }

            require_once(VIEWS_PATH."admin-purchase-cinema-results.php");
        }
    }
?>

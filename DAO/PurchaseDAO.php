<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\IPurchaseDAO as IPurchaseDAO;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;
    use DAO\TicketDAO as TicketDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\MovieShowDAO as MovieShowDAO;

    class PurchaseDAO implements IPurchaseDAO
    {
        private $connection;
        private $purchaseList = array();
        private $table = "purchases";
        private $ticketDAO;

        public function __construct()
        {
            $this->ticketDAO = new TicketDAO();
            $this->userDAO = new UserDAO();
            $this->movieShowDAO = new MovieShowDAO();
        }

        public function Add(Purchase $purchase)
        {
            $this->connection;
             
            $query = 'INSERT INTO ' . $this->table . ' (purchaseDate, total, discount, userId, numberOfTickets, movieShowId) VALUES (:purchaseDate, :total, :discount, :userId, :numberOfTickets, :movieShowId);';

            $parameters = array(
                ':purchaseDate' => date_format($purchase->getPurchaseDate(), "Y-m-d H:i:s"), 
                ':total' => $purchase->getTotal(), 
                ':discount' => $purchase->getDiscount(), 
                ':userId' => $purchase->getUser()->getId(),
                ':numberOfTickets' => $purchase->getNumberOfTickets(),
                ':movieShowId' => $purchase->getMovieShow()->getId()
            );

            $this->connection = Connection::GetInstance();
                    
            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);

                $query = 'SELECT MAX(id) FROM purchases';
                $result = $this->connection->Execute($query);
                $purchase->setId($result[0][0]);

                for($i = 0; $i < $purchase->getNumberOfTickets(); $i++)
                {
                    $query = 'SELECT MAX(id) FROM tickets';
                    $result = $this->connection->Execute($query);
                    
                    $id = $result[0][0] + 1;

                    $qr = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$id."/".$purchase->getMovieShow()->getMovie()->getTitle()."/".$purchase->getMovieShow()->getRoom()->getCinema()->getName()."/".$purchase->getMovieShow()->getRoom()->getName()."/".date_format($purchase->getMovieShow()->getShowDate(), "Y-m-d H:i:s")."&choe=UTF-8";
                    $qr = str_replace(" ","+",$qr);

                    $ticket = new Ticket($qr, $purchase->getMovieShow(), $purchase);

                    $this->ticketDAO->Add($ticket);
                }

                return $rowAffected;
            }
            catch(\Exception $ex)
            {                
                return -1;
            }     
        }

        public function GetAll()
        {
            $this->purhcaseList = array();

            $query = "SELECT purchases.id,
            purchases.purchaseDate,
            purchases.total,
            purchases.discount,
            purchases.numberOfTickets,
            users.id,
            movieshow.id,
            GROUP_CONCAT(tickets.id, '¿', tickets.qr SEPARATOR ',' )
            FROM purchases
            LEFT OUTER JOIN users ON purchases.userId = users.id
            LEFT OUTER JOIN movieshow ON purchases.movieShowId = movieshow.id
            LEFT OUTER JOIN tickets ON tickets.purchaseId = purchases.id
            GROUP BY purchases.id;";

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                $this->purchaseList = array();

                foreach($results as $result)
                {
                    $date = date_create($result['purchaseDate'], timezone_open('America/Argentina/Buenos_Aires'));
                    $user = $this->userDAO->GetUserById($result[5]);
                    $movieShow = $this->movieShowDAO->Get($result[6]);

                    $purchase = new Purchase($date, $user, $movieShow, $result[4]);
                    $purchase->setId($result[0]);

                    if($result[7] != null)
                    {
                        $ticketsArray = explode(",", $result[7]);

                        $tickets = array();

                        foreach($ticketsArray as $ticket)
                        {
                            $singleTicketArray = explode("¿", $ticket);
                            $ticketId = $singleTicketArray[0];
                            $ticketQr = $singleTicketArray[1];
                            $newTicket = new Ticket($ticketQr, $movieShow, $purchase);
                            $newTicket->setId($ticketId);
                            array_push($tickets, $newTicket);
                        }

                        $purchase->setTickets($tickets);
                    }

                    array_push($this->purchaseList, $purchase);
                }

                return $this->purchaseList;
            }

            catch(\Exception $ex)
            {
                throw $ex;                
            }
        }

        public function Get($id)
        {
            $this->purhcaseList = array();

            $query = "SELECT purchases.id,
            purchases.purchaseDate,
            purchases.total,
            purchases.discount,
            purchases.numberOfTickets,
            users.id,
            movieshow.id,
            GROUP_CONCAT(tickets.id, '¿', tickets.qr SEPARATOR ',' )
            FROM purchases
            LEFT OUTER JOIN users ON purchases.userId = users.id
            LEFT OUTER JOIN movieshow ON purchases.movieShowId = movieshow.id
            LEFT OUTER JOIN tickets ON tickets.purchaseId = purchases.id
            WHERE purchases.id = :id
            GROUP BY purchases.id;";

            $parameters = array(':id' => $id);

            $this->connection = Connection::GetInstance();

            try
            {
                $result = $this->connection->Execute($query, $parameters);

                $date = date_create($result[0]['purchaseDate'], timezone_open('America/Argentina/Buenos_Aires'));
                $user = $this->userDAO->GetUserById($result[0][5]);
                $movieShow = $this->movieShowDAO->Get($result[0][6]);

                $purchase = new Purchase($date, $user, $movieShow, $result[0][4]);
                $purchase->setId($result[0][0]);

                if($result[0][7] != null)
                {
                    $ticketsArray = explode(",", $result[0][7]);

                    $tickets = array();

                    foreach($ticketsArray as $ticket)
                    {
                        $singleTicketArray = explode("¿", $ticket);
                        $ticketId = $singleTicketArray[0];
                        $ticketQr = $singleTicketArray[1];
                        $newTicket = new Ticket($ticketQr, $movieShow, $purchase);
                        $newTicket->setId($ticketId);
                        array_push($tickets, $newTicket);
                    }

                    $purchase->setTickets($tickets);
                }

                return $purchase;
            }

            catch(\Exception $ex)
            {
                throw $ex;                
            }
        }

        public function Update(Purchase $purchase)
        {
            $query = 'UPDATE ' . $this->table . ' SET purchaseDate = :purchaseDate, total = :total, discount = :discount, userId = :userId, numberOfTickets = :numberOfTickets, movieShowId = :movieShowId WHERE id = :id';
            
            var_dump($query);

            $parameters = array(':purchaseDate' => $purchase->getPurchaseDate(),
                ':total' => $purchase->getTotal(),
                ':discount' => $purchase->getDiscount(),
                ':userId' => $purchase->getUser()->getId(),
                ':numberOfTickets' => $purchase->getNumberOfTickets(),
                ':movieShowId' => $purchases->getMovieShow()->getId(),
                ':id' => $user->getId()
            );

            $this->connection = Connection::GetInstance();

            try
            {
                $rowsAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowsAffected;
            }
            catch(\Exception $ex)
            {
                return -1;
            }
        }
        
        public function Delete($id)
        {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            
            #var_dump($query);

            $parameters = array(':id' => $id);

            $this->connection = Connection::GetInstance();

            try
            {
                $rowsAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowsAffected;
            }
            catch(\Exception $ex)
            {
                throw $ex; 
            }
        }
    }
?>
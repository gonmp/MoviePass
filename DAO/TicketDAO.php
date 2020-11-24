<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use Models\Purchase as Purchase;
    use Models\Ticket as Ticket;

    use DAO\UserDAO as UserDAO;
    use DAO\MovieShowDAO as MovieShowDAO;

    class TicketDAO
    {
        private $connection;
        private $ticketsList = array();
        private $table = "tickets";

        private $userDAO;
        private $movieShowDAO;

        public function __construct()
        {
            $this->movieShowDAO = new MovieShowDAO();
            $this->userDAO = new UserDAO();
        }

        public function Add(Ticket $ticket)
        {
            $this->connection;
             
            $query = 'INSERT INTO ' . $this->table . ' (idMovieShow, qr, purchaseId) VALUES (:idMovieShow, :qr, :purchaseId);';

            $parameters = array(
                ':idMovieShow' => $ticket->getMovieShow()->getId(), 
                ':qr' => $ticket->getQr(), 
                ':purchaseId' => $ticket->getPurchase()->getId());

            $this->connection = Connection::GetInstance();
                    
            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowAffected;
            }
            catch(\Exception $ex)
            {                
                return -1;
            }     
        }

        public function GetAll()
        {
            $this->ticketsList = array();

            $query = "SELECT tickets.id,
            tickets.idMovieShow,
            tickets.qr,
            purchases.id,
            purchases.userId,
            purchases.total,
            purchases.discount,
            purchases.purchaseDate,
            purchases.numberOfTickets
            FROM tickets
            LEFT OUTER JOIN purchases ON tickets.purchaseId = purchases.id
            GROUP BY tickets.id;";

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                $this->purchaseList = array();

                foreach($results as $result)
                {
                    $date = date_create($result['purchaseDate'], timezone_open('America/Argentina/Buenos_Aires'));
                    $movieShow = $this->movieShowDAO->Get($result['idMovieShow']);
                    $user = $this->userDAO->GetUserById($result[4]);

                    $purchase = new Purchase($date, $user, $movieShow, $result['numberOfTickets']);
                    $purchase->setId($result[3]);

                    $ticket = new Ticket($result['qr'], $movieShow, $purchase);
                    $ticket->setId($result['id']);

                    array_push($this->ticketsList, $ticket);
                }

                return $this->ticketsList;
            }

            catch(\Exception $ex)
            {
                throw $ex;                
            }
        }

        public function Get($id)
        {

            $query = "SELECT tickets.id,
            tickets.idMovieShow,
            tickets.qr,
            purchases.id,
            purchases.userId,
            purchases.total,
            purchases.discount,
            purchases.purchaseDate,
            purchases.numberOfTickets
            FROM tickets
            LEFT OUTER JOIN purchases ON tickets.purchaseId = purchases.id
            WHERE tickets.id = :id
            GROUP BY tickets.id;";

            $parameters = array(':id' => $id);

            $this->connection = Connection::GetInstance();

            try
            {
                $result = $this->connection->Execute($query, $parameters);

                $date = date_create($result[0]['purchaseDate'], timezone_open('America/Argentina/Buenos_Aires'));
                $movieShow = $this->movieShowDAO->Get($result[0]['idMovieShow']);
                $user = $this->userDAO->GetUserById($result[0][4]);

                $purchase = new Purchase($date, $user, $movieShow, $result[0]['numberOfTickets']);
                $purchase->setId($result[0][3]);

                $ticket = new Ticket($result[0]['qr'], $movieShow, $purchase);
                $ticket->setId($result[0]['id']);

                return $ticket;
            }

            catch(\Exception $ex)
            {
                throw $ex;                
            }
        }

        public function Update(Ticket $ticket)
        {
            $query = 'UPDATE ' . $this->table . ' SET idMovieShow = :idMovieShow, qr = :qr, purchaseId = :purchaseId WHERE id = :id';
            
            var_dump($query);

            $parameters = array(
                ':idMovieShow' => $ticket->getMovieShow()->getId(), 
                ':qr' => $ticket->getQr(), 
                ':purchaseId' => $ticket->getPurchase()->getId(),
                ':id' => $ticket->getId());

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
<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\IPurchaseDAO as IPurchaseDAO;
    use Models\Purchase as Purchase;

    class PurchaseDAO implements IPurchaseDAO
    {
        private $connection;
        private $userList = array();
        private $table = "purchases";

        public function AddPurchase(Purchase $purchase)
        {
            $this->connection;
             
            $query = 'INSERT INTO ' . $this->table . ' (purchaseDate, total, discount, user) VALUES (:purchaseDate, :total, :discount, :user);';

            $parameters = array(
                ':purchaseDate' => $purchase->getPurchaseDate(), 
                ':total' => $purchase->getTotal(), 
                ':discount' => $purchase->getDiscount(), 
                ':user' => $purchase->getUser());

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
            $this->purhcaseList = array();

            $query = "SELECT id, purchaseDate, total, discount, user FROM " . $this->table;

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                foreach($results as $result)
                {
                    $purchase = new Purchase($result['purchaseDate'], $result['total'], $result['discount'], $result['user']);
                    $purchase->setId($result['id']);
                    array_push($this->purchaseList, $purchase);
                }

                return $this->purchaseList;
            }

            catch(\Exception $ex)
            {
                throw $ex;                
            }
        }

        public function Update(Purchase $purchase)
        {
            $query = 'UPDATE ' . $this->table . ' SET purchaseDate = :purchaseDate, total = :total, discount = :discount, user = :user WHERE id = :id';
            
            var_dump($query);

            $parameters = array(':purchaseDate' => $purchase->getPurchaseDate(), ':total' => $purchase->getTotal(), ':discount' => $purchase->getDiscount(), ':user' => $purchase->getUser(), ':id' => $user->getId());

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
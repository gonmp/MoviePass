<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaDAO implements ICinemaDAO
    {
        private $connection;        
        private $cinemaList = array();
        private $table = "cinemas";
        
        public function Add(Cinema $cinema)
        {
            $query = 'INSERT INTO ' . $this->table . '(name, totalCapacity, address, ticketValue, enable) VALUES (:name, :totalCapacity, :address, :ticketValue, :enable);';

            $parameters = array(
                ':name' => $cinema->getName(),
                ':totalCapacity'  => $cinema->getTotalCapacity(),
                ':address' => $cinema->getAddress(),
                ':ticketValue' => $cinema->getTicketValue(),
                ':enable' => $cinema->getEnabled()
            );

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

        public function GetCinemaByName ($name)
        {
            try
            {
                
                $query = 'SELECT * FROM ' . $this->table . ' WHERE name = :name;';
                $parameters = array(':name' => $name);
                
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);

                if ($result == null)
                {
                    # el cine no fue encontrado
                    return null;
                }

                $cinema = new Cinema(
                    $result[0]['name'],
                    $result[0]['totalCapacity'],
                    $result[0]['address'],
                    $result[0]['ticketValue'],
                    $result[0]['enable']
                );

                $cinema->setId($result[0]['id']);

                return $cinema;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function GetCinemaById ($id)
        {
            try
            {
                
                $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id;';
                $parameters = array(':id' => $id);
                
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);

                if ($result == null)
                {
                    # el cine no fue encontrado
                    return null;
                }

                $cinema = new Cinema(
                    $result[0]['name'],
                    $result[0]['totalCapacity'],
                    $result[0]['address'],
                    $result[0]['ticketValue'],
                    $result[0]['enable']
                );

                $cinema->setId($result[0]['id']);

                return $cinema;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            $this->cinemaList = array();

            $query = 'SELECT * FROM ' . $this->table;

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                foreach($results as $result)
                {
                    $cinema = new Cinema(
                        $result['name'],
                        $result['totalCapacity'],
                        $result['address'],
                        $result['ticketValue'],
                        $result['enable']
                    );

                    $cinema->setId($result['id']);

                    array_push($this->cinemaList, $cinema);
                }

                return $this->cinemaList;
            }            
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }        
        
        public function Update(Cinema $cinema)
        {
            $query = 'UPDATE ' . $this->table . ' SET name = :name, totalCapacity = :totalCapacity, address = :address, ticketValue = :ticketValue, enable = :enable WHERE id = :id;';
            $parameters = array(
                ':id' => $cinema->getId(),
                ':name' => $cinema->getName(),
                ':totalCapacity' => $cinema->getTotalCapacity(),
                ':address' => $cinema->getAddress(),
                ':ticketValue' => $cinema->getTicketValue(),
                ':enable' => $cinema->getEnabled()
            );

            $this->connection = Connection::GetInstance();

            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowAffected;
            }
            catch(\Exception $ex)
            {
                # TODO: implementar un mejor manejo de excepciones
                return -1;
            }
        }

        public function Delete($id)
        {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id;';

            $parameters = array(':id' => $id);

            $this->connection = Connection::GetInstance();

            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowAffected;
            }
            catch(\Exception $ex)
            {
                # TODO: mejorar el manejo de excepciones con un cartel en pantalla
                return -1;
            }
        }
    }
?>
<?php
    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use Models\RoomForCinema as RoomForCinema;

    class CinemaDAO implements ICinemaDAO
    {
        private $connection;        
        private $cinemaList = array();
        private $table = "cinemas";
        
        public function Add(Cinema $cinema)
        {
            $query = 'INSERT INTO ' . $this->table . '(name, address) VALUES (:name, :address);';

            $parameters = array(
                ':name' => $cinema->getName(),
                ':address' => $cinema->getAddress()
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
                
                $query = "SELECT cinemas.id, cinemas.name, cinemas.address, GROUP_CONCAT(rooms.id, '/', rooms.capacity, '/', rooms.ticketValue, '/', rooms.name SEPARATOR ',' ) FROM " . $this->table . " LEFT OUTER JOIN rooms ON rooms.cinemaId = cinemas.id WHERE cinemas.name = :name;";
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
                    $result[0]['address']
                );

                $cinema->setId($result[0]['id']);

                if($result[0][3] != null)
                {
                    $roomsArray = array();

                    $roomsArray = explode(",", $result[0][3]);

                    $rooms = array();
                    foreach($roomsArray as $room)
                    {
                        $singleRoomArray = explode("/", $room);
                        $roomId = $singleRoomArray[0];
                        $roomCapacity = $singleRoomArray[1];
                        $roomTicketValue = $singleRoomArray[2];
                        $roomName = $singleRoomArray[3];
                        $newRoom = new RoomForCinema($roomCapacity, $roomTicketValue, $roomName);
                        $newRoom->setId($roomId);
                        array_push($rooms, $newRoom);
                    }

                    $cinema->setRooms($rooms);
                }

                return $cinema;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function GetCinemaById($id)
        {
            try
            {
                
                $query = "SELECT cinemas.id, cinemas.name, cinemas.address, GROUP_CONCAT(rooms.id, '/', rooms.capacity, '/', rooms.ticketValue, '/', rooms.name SEPARATOR ',' ) FROM " . $this->table . " LEFT OUTER JOIN rooms ON rooms.cinemaId = cinemas.id WHERE cinemas.id = :id;";
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
                    $result[0]['address']
                );

                $cinema->setId($result[0]['id']);

                if($result[0][3] != null)
                {
                    $roomsArray = array();

                    $roomsArray = explode(",", $result[0][3]);

                    $rooms = array();
                    foreach($roomsArray as $room)
                    {
                        $singleRoomArray = explode("/", $room);
                        $roomId = $singleRoomArray[0];
                        $roomCapacity = $singleRoomArray[1];
                        $roomTicketValue = $singleRoomArray[2];
                        $roomName = $singleRoomArray[3];
                        $newRoom = new RoomForCinema($roomCapacity, $roomTicketValue, $roomName);
                        $newRoom->setId($roomId);
                        array_push($rooms, $newRoom);
                    }

                    $cinema->setRooms($rooms);
                }

                return $cinema;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAllCinemasOnly()
        {
            $this->cinemaList = array();

            $query = "SELECT * FROM $this->table;";

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);                                

                foreach($results as $result)
                {
                    $cinema = new Cinema($result['name'], $result['address']);
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

        public function GetAll()
        {
            $this->cinemaList = array();

            $query = "SELECT cinemas.id, cinemas.name, cinemas.address, GROUP_CONCAT(rooms.id, '/', rooms.capacity, '/', rooms.ticketValue, '/', rooms.name SEPARATOR ',' ) FROM " . $this->table . " LEFT OUTER JOIN rooms ON rooms.cinemaId = cinemas.id;";

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);                

                foreach($results as $result)
                {
                    $cinema = new Cinema(
                        $result['name'],
                        $result['address']
                    );

                    $cinema->setId($result['id']);

                    if($result[3] != null)
                    {
                        $roomsArray = array();

                        $roomsArray = explode(",", $result[3]);

                        $rooms = array();
                        foreach($roomsArray as $room)
                        {
                            $singleRoomArray = explode("/", $room);
                            $roomId = $singleRoomArray[0];
                            $roomCapacity = $singleRoomArray[1];
                            $roomTicketValue = $singleRoomArray[2];
                            $roomName = $singleRoomArray[3];
                            $newRoom = new RoomForCinema($roomCapacity, $roomTicketValue, $roomName);
                            $newRoom->setId($roomId);
                            array_push($rooms, $newRoom);
                        }

                        $cinema->setRooms($rooms);
                    }

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
            $query = 'UPDATE ' . $this->table . ' SET name = :name, address = :address WHERE id = :id;';
            $parameters = array(
                ':id' => $cinema->getId(),
                ':name' => $cinema->getName(),
                ':address' => $cinema->getAddress()
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
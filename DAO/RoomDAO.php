<?php
    namespace DAO;

    //use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Room as Room;
    use Models\Cinema as Cinema;

    class RoomDAO
    {
        private $connection;        
        private $roomList = array();
        private $table = "rooms";
        
        public function GetReservationsOfRoomOnDay($roomId, $day)
        {
            $reservations = $this->GetReservationsOfRoom($roomId);
            $results = array();
            
            foreach($reservations as $reservation)
            {
                if (date_format($reservation['from'], "d-m-Y") == date_format($day, "d-m-Y"))
                {
                    array_push($results, $reservation);
                }
            }
                        
            return $results;
        }

        public function GetReservationsOfRoom($roomId)
        {
            $query = "SELECT ms.id, ms.showDate, DATE_ADD(DATE_ADD(ms.showDate, INTERVAL DATE_FORMAT(m.duration,'%H:%i') HOUR_MINUTE), INTERVAL 15 MINUTE) FROM movieshow ms JOIN movies m ON ms.movieId = m.id WHERE ms.roomId = :roomId;";
            $parameters = array(':roomId' => $roomId);

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query, $parameters);
                $reservations = array();

                foreach($results as $result)
                {                    
                    $dateFrom = date_create($result[1], timezone_open('America/Argentina/Buenos_Aires'));
                    $dateTo = date_create($result[2], timezone_open('America/Argentina/Buenos_Aires'));    

                    $reservation['id'] = $result[0];
                    $reservation['from'] = $dateFrom;
                    $reservation['to'] = $dateTo;

                    array_push($reservations, $reservation);
                }

                return $reservations;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }            
        }

        public function Add(Room $room)
        {
            $query = 'INSERT INTO ' . $this->table . '(cinemaId, capacity, ticketValue, name) VALUES (:cinemaId, :capacity, :ticketValue, :name);';

            $parameters = array(
                ':cinemaId'  => $room->getCinema()->getId(),
                ':capacity' => $room->getCapacity(),
                ':ticketValue' => $room->getTicketValue(),
                ':name' => $room->getName(),
            );

            $this->connection = Connection::GetInstance();       

            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);               

                return $rowAffected;
            }
            catch(\Exception $ex)
            {
                var_dump($ex);
                return -1;
            }            
        }

        public function GetAll()
        {
            try
            {
                $query = 'SELECT rooms.id, rooms.capacity, rooms.ticketValue, rooms.name, cinemas.id, cinemas.name, cinemas.address FROM ' . $this->table . ' LEFT OUTER JOIN cinemas ON rooms.cinemaId = cinemas.id';;
                
                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query);

                $this->roomList = array();

                foreach($results as $result)
                {
                    $cinema = new Cinema(
                        $result[5],
                        $result['address']
                    );

                    $cinema->setId($result[4]);

                    $room = new Room(
                        $result['capacity'],
                        $cinema,
                        $result['ticketValue'],
                        $result[3]
                    );
                    $room->setId($result[0]);

                    array_push($this->roomList, $room);
                }
                
                return $this->roomList;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetRoomById($id)
        {
            try
            {
                
                $query = 'SELECT rooms.id, rooms.capacity, rooms.ticketValue, rooms.name, cinemas.id, cinemas.name, cinemas.address FROM ' . $this->table . ' LEFT OUTER JOIN cinemas ON rooms.cinemaId = cinemas.id WHERE rooms.id = :id;;';
                $parameters = array(':id' => $id);
                
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);

                if ($result == null)
                {
                    # el room no fue encontrado
                    return null;
                }

                $cinema = new Cinema(
                    $result[0][5],
                    $result[0]['address']
                );
                $cinema->setId($result[0][4]);

                $room = new Room(
                    $result[0]['capacity'],
                    $cinema,
                    $result[0]['ticketValue'],
                    $result[0][3]
                );
                $room->setId($result[0][0]);

                return $room;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }

        public function Update(Room $room)
        {
            $query = 'UPDATE ' . $this->table . ' SET cinemaId = :cinemaId, capacity = :capacity, ticketValue = :ticketValue, name = :name WHERE id = :id;';
            $parameters = array(
                ':id' => $room->getId(),
                ':cinemaId' => $room->getCinema()->getId(),
                ':capacity' => $room->getCapacity(),
                ':ticketValue' => $room->getTicketValue(),
                ':name' => $room->getName()
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
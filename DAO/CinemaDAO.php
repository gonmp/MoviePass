<?php
    /* funcionalidades: 
            . agregar cinema
            . modicar cinema
            . borrar cine (de forma logica)

            . obtener todos los cines de la lista
            . obtener un cine de la lista segun el id    
            . obtener el ultimo id de la lista de cines
    */

    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;

    class CinemaDAO implements ICinemaDAO
    {
        private $cinemaList = array();

        public function GetNewId()
        {
            # devuelve el ID correspondiente al nuevo cinema

            $this->RetrieveData();
            $newId = 0;

            foreach($this->cinemaList as $cinema)
            {
                if ($cinema->getId() > $newId)
                {
                    $newId = $cinema->getId();
                }
            }
            
            return ($newId + 1);   
        }

        public function Add(Cinema $cinema)
        {
            # agrega un cinema
            
            $this->RetrieveData();

            $cinema->setId($this->GetNewId());
            
            array_push($this->cinemaList, $cinema);

            $this->SaveData();
        }

        public function Modify($id, $name, $totalCapacity, $address, $ticketValue)
        {
            # modifica el cinema del id con los datos actualizados

            $this->RetrieveData();           

            $cinema = $this->GetCinemaById($id);

            $cinema->setName($name);
            $cinema->setTotalCapacity($totalCapacity);
            $cinema->setAddress($address);
            $cinema->setTicketValue($ticketValue);            

            $this->SaveData();
        }

        public function Delete($id)
        {
            # borra un cinema

            $this->RetrieveData();

            $cinema = $this->GetCinemaById($id);

            $cinema->SetEnabled(false);
            
            $this->SaveData();
        }        
        
        public function UnDelete($id)
        {
            # habilita un cinema

            $this->RetrieveData();

            $cinema = $this->GetCinemaById($id);

            $cinema->SetEnabled(true);
            
            $this->SaveData();
        }        

        public function GetAllEnabled ()
        {
            # devuelve todos los cinemas de la lista que no fueron borrados de forma logica            

            $this->RetrieveData();

            $enabledCinemaList = array();

            foreach($this->cinemaList as $cinema)
            {
                if ($cinema->GetEnabled() == true)
                {
                    array_push($enabledCinemaList, $cinema);
                }
            }

            return $enabledCinemaList;
        }

        public function GetCinemaById ($id)
        {            
            # devuelve el cinema correspondiente al paramatro id

            $this->RetrieveData();            

            foreach($this->cinemaList as $cinema)
            {
                if ($cinema->getId() == $id) 
                return $cinema;
            }            
        }

        public function GetAll()
        {
            # devuelve todos los cinemas de la lista

            $this->RetrieveData();                      

            return $this->cinemaList;
        }        

        private function SaveData()
        {
            # salva los cinemas en Json

            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {                
                $valuesArray["id"] = $cinema->getId();
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["totalCapacity"] = $cinema->getTotalCapacity();
                $valuesArray["address"] = $cinema->getAddress();
                $valuesArray["ticketValue"] = $cinema->getTicketValue();
                $valuesArray["enabled"] = $cinema->getEnabled();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/cinemas.json', $jsonContent);
        }

        private function RetrieveData()
        {
            # obtiene todos los cinemas de un json y los pone en cinemaList

            $this->cinemaList = array();

            if(file_exists('Data/cinemas.json'))
            {
                $jsonContent = file_get_contents('Data/cinemas.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new cinema(
                        $valuesArray["id"],
                        $valuesArray["name"],
                        $valuesArray["totalCapacity"],
                        $valuesArray["address"],
                        $valuesArray["ticketValue"],
                        $valuesArray["enabled"]
                    );

                    array_push($this->cinemaList, $cinema);
                }
            }
        }
    }
?>
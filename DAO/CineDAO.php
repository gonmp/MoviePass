<?php
    /* funcionalidades: 
            . agregar cine
            . modicar cine
            . borrar cine (de forma logica)

            . obtener todos los cines de la lista
            . obtener un cine de la lista segun el id    
            . obtener el ultimo id de la lista de cines
    */

    namespace DAO;

    use DAO\ICineDAO as ICineDAO;
    use Models\Cine as Cine;

    class CineDAO implements ICineDAO
    {
        private $cineList = array();

        public function GetNewId()
        {
            # devuelve el ID correspondiente al nuevo cine

            $this->RetrieveData();
            $newId = 0;

            foreach($this->cineList as $cine)
            {
                if ($cine->getId() > $newId)
                {
                    $newId = $cine->getId();
                }
            }
            
            return ($newId + 1);   
        }

        public function Add(Cine $cine)
        {
            # agrega un cine
            
            $this->RetrieveData();

            $cine->setId($this->GetNewId());
            
            array_push($this->cineList, $cine);

            $this->SaveData();
        }

        public function Modify($id, $name, $totalCapacity, $address, $ticketValue)
        {
            # modifica el cine del id con los datos actualizados

            $this->RetrieveData();           

            $cine = $this->GetCineById($id);

            $cine->setName($name);
            $cine->setTotalCapacity($totalCapacity);
            $cine->setAddress($address);
            $cine->setTicketValue($ticketValue);            

            $this->SaveData();
        }

        public function Delete($id)
        {
            # borra un cine

            $this->RetrieveData();

            $cine = $this->GetCineById($id);

            $cine->SetEnabled(false);
            
            $this->SaveData();
        }        
        
        public function UnDelete($id)
        {
            # habilita un cine

            $this->RetrieveData();

            $cine = $this->GetCineById($id);

            $cine->SetEnabled(true);
            
            $this->SaveData();
        }        

        public function GetAllEnabled ()
        {
            # devuelve todos los cines de la lista que no fueron borrados de forma logica            

            $this->RetrieveData();

            $enabledCineList = array();

            foreach($this->cineList as $cine)
            {
                if ($cine->GetEnabled() == true)
                {
                    array_push($enabledCineList, $cine);
                }
            }

            return $enabledCineList;
        }

        public function GetCineById ($id)
        {            
            # devuelve el cine correspondiente al paramatro id

            $this->RetrieveData();            

            foreach($this->cineList as $cine)
            {
                if ($cine->GetId() == $id) 
                return $cine;
            }            
        }

        public function GetAll()
        {
            # devuelve todos los cines de la lista

            $this->RetrieveData();                      

            return $this->cineList;
        }        

        private function SaveData()
        {
            # salva los cines en Json

            $arrayToEncode = array();

            foreach($this->cineList as $cine)
            {                
                $valuesArray["id"] = $cine->getId();
                $valuesArray["name"] = $cine->getName();
                $valuesArray["totalCapacity"] = $cine->getTotalCapacity();
                $valuesArray["address"] = $cine->getAddress();
                $valuesArray["ticketValue"] = $cine->getTicketValue();
                $valuesArray["enabled"] = $cine->getEnabled();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/cines.json', $jsonContent);
        }

        private function RetrieveData()
        {
            # obtiene todos los cines de un json y los pone en cineList

            $this->cineList = array();

            if(file_exists('Data/cines.json'))
            {
                $jsonContent = file_get_contents('Data/cines.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine = new cine(
                        $valuesArray["id"],
                        $valuesArray["name"],
                        $valuesArray["totalCapacity"],
                        $valuesArray["address"],
                        $valuesArray["ticketValue"],
                        $valuesArray["enabled"]
                    );

                    array_push($this->cineList, $cine);
                }
            }
        }
    }
?>
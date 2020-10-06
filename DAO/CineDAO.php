<?php
    namespace DAO;

    use DAO\ICineDAO as ICineDAO;
    use Models\Cine as Cine;

    class CineDAO implements ICineDAO
    {
        private $cineList = array();

        public function Add(Cine $cine)
        {
            $this->RetrieveData();
            
            array_push($this->cineList, $cine);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cineList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cineList as $cine)
            {
                $valuesArray["name"] = $cine->getName();
                $valuesArray["totalCapacity"] = $cine->getTotalCapacity();
                $valuesArray["address"] = $cine->getAddress();
                $valuesArray["ticketValue"] = $cine->getTicketValue();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/cines.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cineList = array();

            if(file_exists('Data/cines.json'))
            {
                $jsonContent = file_get_contents('Data/cines.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine = new cine();
                    $cine->setName($valuesArray["name"]);
                    $cine->setTotalCapacity($valuesArray["totalCapacity"]);
                    $cine->setAddress($valuesArray["address"]);
                    $cine->setTicketValue($valuesArray["ticketValue"]);

                    array_push($this->cineList, $cine);
                }
            }
        }
    }
?>
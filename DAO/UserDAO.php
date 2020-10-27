<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $userList = array();

        public function GetNewId()
        {
            $this->RetrieveData();
            $newId = 0;
            
            foreach($this->userList as $user)
            {
                if ($user->GetId() > $newId)
                {
                    $newId = $user->GetId();
                }
            }
            
            return ($newId + 1);   
        }

        public function Add(User $user)
        {            
            $this->RetrieveData();

            $user->SetId($this->GetNewId());
            
            array_push($this->userList, $user);

            $this->SaveData();
        }

        public function CheckUser($userName, $password)
        {
            $this->RetrieveData();

            foreach($this->userList as $user)
            {
                if ($userName == $user->GetUserName()
                &&  $password == $user->GetPassword())
                {
                    return true;
                }
            }

            return false;
        }

        public function CheckUserName ($userName)
        {
            $this->RetrieveData();

            foreach($this->userList as $user)
            {
                if ($userName == $user->GetUserName())
                {
                    return true;
                }
            }

            return false;
        }

        public function CheckAdmin ($userName, $password)
        {            
            return ($userName == "admin" && $password == "admin");            
        }

        /*
        public function Modify($id, $name, $totalCapacity, $address, $ticketValue)
        {
            # modifica el user del id con los datos actualizados

            $this->RetrieveData();           

            $user = $this->GetuserById($id);

            $user->setName($name);
            $user->setTotalCapacity($totalCapacity);
            $user->setAddress($address);
            $user->setTicketValue($ticketValue);            

            $this->SaveData();
        }

        public function Delete($id)
        {
            # borra un user

            $this->RetrieveData();

            $user = $this->GetUserById($id);

            $user->SetEnabled(false);
            
            $this->SaveData();
        }        
        
        public function UnDelete($id)
        {
            # habilita un user

            $this->RetrieveData();

            $user = $this->GetUserById($id);

            $user->SetEnabled(true);
            
            $this->SaveData();
        }        
        
        public function GetAllEnabled ()
        {
            # devuelve todos los users de la lista que no fueron borrados de forma logica            

            $this->RetrieveData();

            $enabledUserList = array();

            foreach($this->userList as $user)
            {
                if ($user->GetEnabled() == true)
                {
                    array_push($enabledUserList, $user);
                }
            }

            return $enabledUserList;
        }
                
        public function GetUserById ($id)
        {            
            # devuelve el user correspondiente al paramatro id

            $this->RetrieveData();            

            foreach($this->userList as $user)
            {
                if ($user->GetId() == $id) 
                return $user;
            }            
        }

        public function GetAll()
        {
            # devuelve todos los users de la lista

            $this->RetrieveData();                      

            return $this->userList;
        }        
        */

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {                
                $valuesArray["id"] = $user->GetId();
                $valuesArray["userName"] = $user->GetUserName();
                $valuesArray["password"] = $user->GetPassword();                

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/users.json', $jsonContent);
        }

        private function RetrieveData()
        {           
            $this->userList = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new user(                        
                        $valuesArray["userName"],
                        $valuesArray["password"],                        
                    );

                    $user->SetId($valuesArray["id"]);

                    array_push($this->userList, $user);
                }
            }
        }
    }
?>
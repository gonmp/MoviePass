<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $connection;
        private $userList = array();
        private $table = "Users";

        public function Add(User $user)
        {
            
            $query = 'INSERT INTO ' . $this->table . ' (name, password, admin) VALUES (:name, :password, :admin);';

            $parameters = array(':name' => $user->getUserName(), ':password' => $user->getPassword(), ':admin' => $user->getAdmin());

            $this->connection = Connection::GetInstance();

            try
            {
                $rowsAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowsAffected;
            }
            catch(\Exception $ex)
            {
                #El nombre ya existe en la base de datos
                if($ex->errorInfo[0] == '23000' && $ex->errorInfo[1] == '1062')
                {
                    return -1;
                } 
            }            
        }

        public function GetUserById($id)
        {
            try
            {
                $query = "SELECT id, name, password, admin FROM " . $this->table . " WHERE id = :id;";
                
                $this->connection = Connection::GetInstance();
                
                $parameters = array(':id' => $id);
                
                $result = $this->connection->Execute($query, $parameters);

                if($result == null)
                {
                    return null;
                }
                
                $user = new User($result[0]['name'], $result[0]['password'], $result[0]['admin']);
                
                $user->setId($result[0]['id']);

                return $user;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }   
        }

        public function GetUserByName($name)
        {
            try
            {
                $query = "SELECT id, name, password, admin FROM " . $this->table . " WHERE name = :name;";
                
                $this->connection = Connection::GetInstance();
                
                $parameters = array(':name' => $name);
                
                $result = $this->connection->Execute($query, $parameters);

                if($result == null)
                {
                    return null;
                }
                
                $user = new User($result[0]['name'], $result[0]['password'], $result[0]['admin']);
                
                $user->setId($result[0]['id']);

                return $user;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }   
        }

        public function GetAll()
        {
            $this->userList = array();

            $query = "SELECT id, name, password, admin FROM " . $this->table;

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                foreach($results as $result)
                {
                    $user = new User($result['name'], $result['password'], $result['admin']);
                    $user->setId($result['id']);
                    array_push($this->userList, $user);
                }

                return $this->userList;
            }
            # MP : corregido Excecption por Exception
            catch(\Exception $ex)
            {
                throw $ex;                
            }
        }


        # MP : puse como comentario var_dump($query)

        public function Update(User $user)
        {
            $query = 'UPDATE ' . $this->table . ' SET name = :name, password = :password, admin = :admin WHERE id = :id';
            
            # var_dump($query);

            $parameters = array(':name' => $user->getUserName(), ':password' => $user->getPassword(), ':admin' => $user->getAdmin(), ':id' => $user->getId());

            $this->connection = Connection::GetInstance();

            try
            {
                $rowsAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowsAffected;
            }
            catch(\Exception $ex)
            {
                #El nombre ya existe en la base de datos
                if($ex->errorInfo[0] == '23000' && $ex->errorInfo[1] == '1062')
                {
                    return -1;
                }
            }
        }

        # MP : puse el var_dump como comentario

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
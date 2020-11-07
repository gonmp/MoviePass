<?php
    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;
    

    class GenreDAO implements IGenreDAO
    {

        private $connection;
        private $genreList = array();
        private $table = "genres";

        public function Add(Genre $genre)
        {
            
            $query = 'INSERT INTO ' . $this->table . ' (id, name) VALUES (:id, :name);';

            $parameters = array(':id' => $genre->getIdGenre(), ':name' => $genre->getNameGenre());

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

        public function GetGenreById($idGenre)
        {
            try
            {
                $query = "SELECT id, name FROM " . $this->table . " WHERE id = :id;";
                
                $this->connection = Connection::GetInstance();
                
                $parameters = array(':id' => $idGenre);
                
                $result = $this->connection->Execute($query, $parameters);

                if($result == null)
                {
                    return null;
                }
                                
                $genre = new Genre($result[0]['id'], $result[0]['name']);
                
                return $genre;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }   
        }

        public function GetAll()
        {
            $this->genreList = array();

            $query = "SELECT id, name FROM " . $this->table;

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                foreach($results as $result)
                {
                    $genre = new Genre($result['id'], $result['name']);
                    array_push($this->genreList, $genre);
                }

                return $this->genreList;
            }
            
            catch(\Exception $ex)
            {
                throw $ex;                
            }
        }

                
        public function Delete($idGenre)
        {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
                        
            $parameters = array(':id' => $idGenre);

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

        public function GetGenresFromAPI()
        {
            $this->DeleteAll();

            $handle =curl_init();
            
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            
            curl_setopt($handle, CURLOPT_URL,"https://api.themoviedb.org/3/genre/movie/list?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US%22");

            $result=curl_exec($handle);
            
            curl_close($handle);

            $objectTODecode=json_decode($result);

            $affectedRows = $this->UpdateAllGenres($objectTODecode->genres);

            return $affectedRows;
            
        }

        public function UpdateAllGenres($objectTODecode)
        {
            # obtiene todos los genres de un json y los pone en genreList
            $contador = 0;

            foreach($objectTODecode as $valuesArray)
            {
                $genre = new Genre(
                    $valuesArray->id,
                    $valuesArray->name
                );

                $contador = $contador + $this->Add($genre);
            }

            return $contador;
        }

        public function DeleteAll()
        {
            $query = 'DELETE FROM ' . $this->table;
                        
            $parameters = array();

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

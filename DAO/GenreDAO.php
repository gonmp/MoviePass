<?php
    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;
    

    class GenreDAO implements IGenreDAO
    {

        private $genreList = array();


        public function GetNewGenreId()
        {

            $this->RetrieveData();
            $newId = 0;

            foreach($this->genreList as $genre)
            {

                if($genre->getGenreId() > $newId)
                {

                    $newId = $genre->getGenreId();
                }
            }

            return $newId + 1;
        }

        public function AddGenre(Genre $genre)
        {
            
            $this->RetrieveData();

            $genre->getGenreId($this->GetNewGenreId());
            
            array_push($this->genreList, $genre);

            $this->SaveData();
        }

        public function GetGenreById ($idGenre)
        {            

            $this->RetrieveData();            

            foreach($this->genreList as $genre)
            {

                if ($genre->getIdGenre() == $idGenre) 
                return $genre;
            }            
        }

        public function ModifyGenre($idGenre, $nameGenre)
        {

            $this->RetrieveData();           

            $genre = $this->getGenreById($idGenre);

            $genre->setNameGenre($nameGenre);            

            $this->SaveData();
        }

        public function GetAllGenres()
        {

            $this->RetrieveData();                      

            return $this->genreList;
        }   

        public function GetGenresFromAPI()
        {

            # obtiene el json con todos los genres de la API

            //  Initiate curl session
            $handle =curl_init();
            // Will return the response, if false it prints the response
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            // Set the url
            curl_setopt($handle, CURLOPT_URL,"https://api.themoviedb.org/3/genre/movie/list?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US");

            // Execute the session and store the contents in $result y lo muestra

            $result=curl_exec($handle);
            // Closing the session
            curl_close($handle);

            #Paso el JSON a array
            $arrayToDecode=json_decode($result);

            #Paso el array a JSON para que se vea PRETTY
            $jsonContent = json_encode($arrayToDecode, JSON_PRETTY_PRINT);

            #Guardo el json en un archivo
            file_put_contents('Data/genres.json', $jsonContent);

        }
        

        private function SaveData()
        {

            $arrayToEncode = array();

            foreach($this->genreList as $genre)
            {                
                $valuesArray["idGenre"] = $genre->getIdGenre();
                $valuesArray["nameGenre"] = $genre->getNameGenre();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/genres.json', $jsonContent);
        }

        private function RetrieveData()
        {
            
            $this->genreList = array();

            if(file_exists('Data/genres.json'))
            {
                $jsonContent = file_get_contents('Data/genres.json');

                $objectTODecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($objectTODecode["genres"] as $valuesArray)
               
                {
                    $genre = new Genre(
                        $valuesArray["id"],
                        $valuesArray["name"]
                    );

                    array_push($this->genreList, $genre);
                }
                
            }
        }
    }

?>

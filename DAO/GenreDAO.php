<?php

/* funcionalidades: 
            . agregar 
            . modicar 
            . borrar  (de forma logica)

            . obtener todos los de la lista
            . obtener uno de la lista segun el id    
            . obtener el ultimo id de la lista
    */

    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use Models\Genre as Genre;

    class GenreDAO implements IGenreDAO{

        private $genreList = array();


        /*public getNewGenreId(){

            $this->RetrieveData();
            $newId = 0;

            foreach($this->genreList as $genre){

                if($genre->getGenreId() > $newId){

                    $newId = $genre->getGenreId();
                }
            }

            return $newId + 1;
        }*/

        public function addGenre(Genre $genre){
            
            $this->retrieveData();

            $genre->setGenreId($this->getNewGenreId());
            
            array_push($this->genreList, $genre);

            $this->SaveData();
        }

        public function getGenreById ($idGenre){            

            $this->retrieveData();            

            foreach($this->genreList as $genre)
            {
                if ($genre->getGenreId() == $idGenre) 
                return $genre;
            }            
        }

        public function modifyGenre($idGenre, $nameGenre){

            $this->RetrieveData();           

            $genre = $this->getGenreById($idGenre);

            $genre->setNameGenre($nameGenre);            

            $this->SaveData();
        }

        public function getGenreFromAPI(){

            //  Initiate curl session
            $handle = curl_init();
            // Will return the response, if false it prints the response
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            // Set the url
            curl_setopt($handle, CURLOPT_URL, "https://api.themoviedb.org/3/genre/movie/list?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US");
            // Execute the session and store the contents in $result
            $result=curl_exec($handle);
            // Closing the session
            curl_close($handle);

            /*
            ///Ahora usaremos la función file_get_contents() para obtener los datos JSON de la URL y la función json_decode() para convertir la cadena JSON en una matriz.

            $result = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US");
            
            $array = json_decode($result, true);
            
            var_dump($array);*/

        }

        private function SaveData(){

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

        private function RetrieveData(){
            
            $this->genreList = array();

            if(file_exists('Data/genres.json'))
            {
                $jsonContent = file_get_contents('Data/genres.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
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

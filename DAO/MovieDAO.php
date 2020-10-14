<?php
    /* funcionalidades: 
            . agregar movie
            . modicar movie
            . borrar movie (de forma logica)

            . obtener todas las movies de la lista de la api
            . obtener una movie de la lista segun el id    
            . obtener el ultimo id de la lista de movies
            
    */

    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;

    class MovieDAO implements IMovieDAO
    {
        private $movieList = array();

        public function GetNewId()
        {
            # devuelve el ID correspondiente a la nueva movie

            $this->RetrieveData();
            $newId = 0;

            foreach($this->movieList as $movie)
            {
                if ($movie->getId() > $newId)
                {
                    $newId = $movie->getId();
                }
            }
            
            return ($newId + 1);   
        }

        public function Add(movie $movie)
        {
            # agrega una movie
            
            $this->RetrieveData();

            $movie->setId($this->GetNewId());
            
            array_push($this->movieList, $movie);

            $this->SaveData();
        }

        public function Modify($popularity, $voteCount, $video, $posterPath, $id, $adult, $backdropPath, $originalLenguage, $originalTitle, #$genreIds,
        $title, $voteAverage, $overview, $releaseDate)
        {
            # modifica la movie del id con los datos actualizados

            $this->RetrieveData();           

            $movie = $this->GetmovieById($id);
           
            $movie->setPopularity($popularity);
            $movie->setVoteCount($voteCount);
            $movie->setVideo($video);
            $movie->setPosterPath($posterPath);
            $movie->setAdult($adult);
            $movie->setBackdropPath($backdropPath);
            $movie->setOriginalLenguage($originalLenguage);
            $movie->setOriginalTitle($originalTitle);
            #$movie->setGenreIds($genreIds);
            $movie->setTitle($title);
            $movie->setVoteAverage($voteAverage);
            $movie->setOverview($overview);
            $movie->setReleaseDate($releaseDate);            

            $this->SaveData();
        }

        public function Delete($id)
        {
            # borra una movie

            $this->RetrieveData();

            $movie = $this->GetmovieById($id);

            $movie->SetEnabled(false);
            
            $this->SaveData();
        }        
        
        public function UnDelete($id)
        {
            # habilita un movie

            $this->RetrieveData();

            $movie = $this->GetmovieById($id);

            $movie->SetEnabled(true);
            
            $this->SaveData();
        }        

        public function GetAllEnabled ()
        {
            # devuelve todos los movies de la lista que no fueron borrados de forma logica            

            $this->RetrieveData();

            $enabledmovieList = array();

            foreach($this->movieList as $movie)
            {
                if ($movie->GetEnabled() == true)
                {
                    array_push($enabledmovieList, $movie);
                }
            }

            return $enabledmovieList;
        }

        public function GetmovieById ($id)
        {            
            # devuelve el movie correspondiente al paramatro id

            $this->RetrieveData();            

            foreach($this->movieList as $movie)
            {
                if ($movie->GetId() == $id) 
                return $movie;
            }            
        }

        public function GetAll()
        {
            # devuelve todos los movies de la lista

            $this->RetrieveData();                      

            return $this->movieList;
        }        

        private function SaveData()
        {
            # salva los movies en Json

            $arrayToEncode = array();

            foreach($this->movieList as $movie)
            {                
                $valuesArray["popularity"] = $movie->getPopularity();
                $valuesArray["voteCount"] = $movie->getVoteCount();
                $valuesArray["video"] = $movie->getVideo();
                $valuesArray["posterPath"] = $movie->getPosterPath();
                $valuesArray["id"] = $movie->getId();
                $valuesArray["adult"] = $movie->getAdult();
                $valuesArray["backdropPath"] = $movie->getBackdropPath();
                $valuesArray["originalLenguage"] = $movie->getOriginalLenguage();
                $valuesArray["originalTitle"] = $movie->getOriginalTitle();
               # $valuesArray["genreIds"] = $movie->getGenreIds();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["voteAverage"] = $movie->getVoteAverage();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["releaseDate"] = $movie->getReleaseDate();
                $valuesArray["enabled"] = $movie->getEnabled();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/movies.json', $jsonContent);

           
        }

        private function RetrieveData()
        {
            # obtiene todos los movies de un json y los pone en movieList

            $this->movieList = array();

            if(file_exists('Data/movies.json'))
            {
                $jsonContent = file_get_contents('Data/movies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new movie(
                        $valuesArray["popularity"],
                        $valuesArray["voteCount"],
                        $valuesArray["video"],
                        $valuesArray["posterPath"],
                        $valuesArray["id"],
                        $valuesArray["adult"],
                        $valuesArray["backdropPath"],
                        $valuesArray["originalLenguage"],
                        $valuesArray["originalTitle"],
                #        $valuesArray["genreIds"],
                        $valuesArray["title"],
                        $valuesArray["voteAverage"],
                        $valuesArray["overview"],
                        $valuesArray["releaseDate"],
                        $valuesArray["enabled"]
                    );

                    array_push($this->movieList, $movie);
                }
            }
        }

        public function getMoviesFromAPI()
        {

            # obtiene el json con todos los movies de la API

            //  Initiate curl session
            $handle =curl_init();
            // Will return the response, if false it prints the response
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            // Set the url
            curl_setopt($handle, CURLOPT_URL,"https://api.themoviedb.org/3/movie/now_playing?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US&page=1%22%22");

            // Execute the session and store the contents in $result y lo muestra
        
            $result=curl_exec($handle);
            // Closing the session
            curl_close($handle);

            #Paso el JSON a array
            $arrayToDecode=json_decode($result);

            #Paso el array a JSON para que se vea PRETTY
            $jsonContent = json_encode($arrayToDecode, JSON_PRETTY_PRINT);
        
            #Guardo el json en un archivo
            file_put_contents('Data/movies.json', $jsonContent);



            
            
        }
    }
?>
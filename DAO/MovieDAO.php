<?php
    /* funcionalidades: 

    IMPORTANTE: NO SE PUEDE HACER BORRADO LOGICO PORQUE NO ESTÁ EL ATRIBUTO, LO AGREGO? TENDRIA QUE UTILIZAR EL MODEL MOVIEGENRE...
            . agregar movie
            . modicar movie
            . obtener todas las movies de la lista de la api
            . obtener una movie de la lista segun el id    
            . obtener el ultimo id de la lista de movies
            
    */

    namespace DAO;

    use DAO\IMovieDAO as IMovieDAO;
    use Models\Movie as Movie;
    use Models\MovieGenre as MovieGenre;
    use Models\Genre as Genre;
    use DAO\GenreDAO as GenreDAO;

    class MovieDAO implements IMovieDAO
    {
        private $movieList = array();
        private $genreList = array();
        private $idList = array();
        private $genreDAO;
        private $movieGenre = array();

        public function __construct ()
        {
            $this->genreDAO= new GenreDAO();
        }
        
        public function GetNewId()
        {
            # devuelve el ID correspondiente a la nueva movie

            $this->RetrieveDataMovie();
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
            
            $this->RetrieveDataMovie();

            $movie->setId($this->GetNewId());
            
            array_push($this->movieList, $movie);

            $this->SaveDataMovie();
        }

        public function Modify($popularity, $vote_count, $video, $poster_path, $id, $adult, $backdrop_path, $original_language, $original_title, $title, $vote_average, $overview, $release_date)
        {
            # modifica la movie del id con los datos actualizados

            $this->RetrieveDataMovie();           

            $movie = $this->GetmovieById($id);
           
            $movie->setPopularity($popularity);
            $movie->setvote_count($vote_count);
            $movie->setVideo($video);
            $movie->setposter_path($poster_path);
            $movie->setAdult($adult);
            $movie->setbackdrop_path($backdrop_path);
            $movie->setoriginal_language($original_language);
            $movie->setOriginalTitle($original_title);
            $movie->setTitle($title);
            $movie->setvote_average($vote_average);
            $movie->setOverview($overview);
            $movie->setrelease_date($release_date);            

            $this->SaveDataMovie();
        }
    
        public function GetmovieById ($id)
        {            
            # devuelve el movie correspondiente al paramatro id

            $this->RetrieveDataMovie();            

            foreach($this->movieList as $movie)
            {
                if ($movie->GetId() == $id) 
                return $movie;
            }            
        }

        public function GetAll()
        {
            # devuelve todos los movies de la lista

            $this->RetrieveDataMovie();
            

            return $this->movieList;
        }        

        private function SaveDataMovie()
        {
            # salva los movies en Json

            $arrayToEncode = array();

            foreach($this->movieList as $movie)
            {                
                $valuesArray["popularity"] = $movie->getPopularity();
                $valuesArray["vote_count"] = $movie->getvote_count();
                $valuesArray["video"] = $movie->getVideo();
                $valuesArray["poster_path"] = $movie->getposter_path();
                $valuesArray["id"] = $movie->getId();
                $valuesArray["adult"] = $movie->getAdult();
                $valuesArray["backdrop_path"] = $movie->getbackdrop_path();
                $valuesArray["original_language"] = $movie->getoriginal_language();
                $valuesArray["original_title"] = $movie->getoriginal_title();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["vote_average"] = $movie->getvote_average();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["release_date"] = $movie->getrelease_date();
        
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/movies.json', $jsonContent);
        }

        private function SaveDataMovieGenre()
        {
            # salva los moviesGenre 

            $this->getMoviesFromAPI();

            $this->movieList = array();

            if(file_exists('Data/movies.json'))
            {
                $jsonContent = file_get_contents('Data/movies.json');
                
                $objectTODecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($objectTODecode["results"] as $valuesArray)
                {
                    $movie = new Movie(
                        $valuesArray["popularity"],
                        $valuesArray["vote_count"],
                        $valuesArray["video"],
                        $valuesArray["poster_path"],
                        $valuesArray["id"],
                        $valuesArray["adult"],
                        $valuesArray["backdrop_path"],
                        $valuesArray["original_language"],
                        $valuesArray["original_title"],
                        $valuesArray["title"],
                        $valuesArray["vote_average"],
                        $valuesArray["overview"],
                        $valuesArray["release_date"]
                    );

                    #Recorro el arreglo de generos
                    foreach ( $valuesArray["genre_ids"] as $id)
                    {
                        #guardo el id de genero
                        $arrayIds["idGenre"]=$id;
                        $arrayIds["idMovie"]=$valuesArray["id"];
                        
                        #Guardo en el arreglo los valores id pelicula e id genero
                        array_push($this->idList, $arrayIds);
                    }
                    array_push($this->movieList, $movie);
                }
                $this->SaveDataMovie();  
                $jsonContent = json_encode($this->idList, JSON_PRETTY_PRINT);
            
                #Salva los movieGenre
                file_put_contents('Data/movieGenreIds.json', $jsonContent);
            }
        }

        private function RetrieveDataMovie()
        {
            # obtiene todos los movies de un json y los pone en movieList

            $this->movieList = array();

            if(file_exists('Data/movies.json'))
            {
                $jsonContent = file_get_contents('Data/movies.json');

                $objectTODecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
        
                foreach($objectTODecode as $valuesArray)
                {
                    $movie = new movie(
                        $valuesArray["popularity"],
                        $valuesArray["vote_count"],
                        $valuesArray["video"],
                        $valuesArray["poster_path"],
                        $valuesArray["id"],
                        $valuesArray["adult"],
                        $valuesArray["backdrop_path"],
                        $valuesArray["original_language"],
                        $valuesArray["original_title"],
                        $valuesArray["title"],
                        $valuesArray["vote_average"],
                        $valuesArray["overview"],
                        $valuesArray["release_date"]
                    );

                    array_push($this->movieList, $movie);
                }
            }
        }

        public function GetMoviesByGenre($genreId) //RetrieveDataMovieGenre
        {
        
           $moviesGenre = array();

           if(file_exists('Data/movieGenreIds.json'))
            {
                $jsonContent = file_get_contents('Data/movieGenreIds.json');

                $objectTODecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                $this->idList = array();

                foreach($objectTODecode as $id)
                {
                    $arrayIds=$id;
                    
                     #Guardo en el arreglo los valores id pelicula e id genero

                     array_push($this->idList, $arrayIds);       
                }

                foreach($objectTODecode as $id)
                {
                    if($id["idGenre"] == $genreId)
                    {
                        $movie = $this->GetmovieById($id["idMovie"]);

                        $valuesArray["popularity"] = $movie->getPopularity();
                        $valuesArray["vote_count"] = $movie->getvote_count();
                        $valuesArray["video"] = $movie->getVideo();
                        $valuesArray["poster_path"] = $movie->getposter_path();
                        $valuesArray["id"] = $movie->getId();
                        $valuesArray["adult"] = $movie->getAdult();
                        $valuesArray["backdrop_path"] = $movie->getbackdrop_path();
                        $valuesArray["original_language"] = $movie->getoriginal_language();
                        $valuesArray["original_title"] = $movie->getoriginal_title();
                        $valuesArray["title"] = $movie->getTitle();
                        $valuesArray["vote_average"] = $movie->getvote_average();
                        $valuesArray["overview"] = $movie->getOverview();
                        $valuesArray["release_date"] = $movie->getrelease_date();

                        $arrayGenre = array();

                        foreach($this->idList as $movieGenreIds){

                            if($movieGenreIds['idMovie']==$valuesArray["id"]){

                                array_push($arrayGenre, $this->genreDAO->GetGenreById($movieGenreIds["idGenre"]));
                                
                            }                   
                        }
                
                        $valuesArray["genre"] =$arrayGenre;

                        array_push($moviesGenre, $valuesArray);
                    }
                }                
            }
            return $moviesGenre;           
        }
        
        public function GetAllMoviesGenre()
        {
            $this->RetrieveDataMovie();
           
            $this->idList = array();

            if(file_exists('Data/movieGenreIds.json'))
            {
                $jsonContent = file_get_contents('Data/movieGenreIds.json');

                $objectTODecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($objectTODecode as $id)
                {
                    $arrayIds=$id;
                        
                    #Guardo en el arreglo los valores id pelicula e id genero
                
                    array_push($this->idList, $arrayIds);    
                }   
            }
        
            foreach($this->movieList as $movie)
            {
                $valuesArray["popularity"] = $movie->getPopularity();
                $valuesArray["vote_count"] = $movie->getvote_count();
                $valuesArray["video"] = $movie->getVideo();
                $valuesArray["poster_path"] = $movie->getposter_path();
                $valuesArray["id"] = $movie->getId();
                $valuesArray["adult"] = $movie->getAdult();
                $valuesArray["backdrop_path"] = $movie->getbackdrop_path();
                $valuesArray["original_language"] = $movie->getoriginal_language();
                $valuesArray["original_title"] = $movie->getoriginal_title();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["vote_average"] = $movie->getvote_average();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["release_date"] = $movie->getrelease_date();

                $arrayGenre = array();

                foreach($this->idList as $movieGenreIds)
                {
                    if($movieGenreIds['idMovie']==$valuesArray["id"])
                    {
                        array_push($arrayGenre, $this->genreDAO->GetGenreById($movieGenreIds["idGenre"]));
                    }
                }
                
                $valuesArray["genre"] =$arrayGenre;

                array_push($this->movieGenre, $valuesArray);
            }
        
            return $this->movieGenre;
        }

        private function getMoviesFromAPI()
        {
     
            # obtiene el json con todos los movies de la API
    
            $handle =curl_init();
        
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handle, CURLOPT_URL,"https://api.themoviedb.org/3/movie/now_playing?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US&page=1%22%22");
     
            $result=curl_exec($handle);
            
            curl_close($handle);
     
            #Paso el JSON a array
            $objectTODecode=json_decode($result);
    
            #Paso el array a JSON para que se vea PRETTY
            $jsonContent = json_encode($objectTODecode, JSON_PRETTY_PRINT);
            
            #Guardo el json en un archivo
            file_put_contents('Data/movies.json', $jsonContent);      
        }
    }
?>
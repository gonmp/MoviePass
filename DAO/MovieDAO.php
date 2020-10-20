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
    use Models\Genre as Genre;
    use DAO\GenreDAO as GenreDAO;

    class MovieDAO implements IMovieDAO
    {
        private $movieList = array();
        private $genreList = array();
        private $idList = array();
        private $genreDAO;
        private $movieGenre = array();

        public function __construct (){

            $this->genreDAO= new GenreDAO();

        }
        
        

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

            $this->SaveDataMovie();
        }

        public function Modify($popularity, $vote_count, $video, $poster_path, $id, $adult, $backdrop_path, $original_language, $original_title, #$genre_ids,
        $title, $vote_average, $overview, $release_date)
        {
            # modifica la movie del id con los datos actualizados

            $this->RetrieveData();           

            $movie = $this->GetmovieById($id);
           
            $movie->setPopularity($popularity);
            $movie->setvote_count($vote_count);
            $movie->setVideo($video);
            $movie->setposter_path($poster_path);
            $movie->setAdult($adult);
            $movie->setbackdrop_path($backdrop_path);
            $movie->setoriginal_language($original_language);
            $movie->setOriginalTitle($original_title);
            #$movie->setgenre_ids($genre_ids);
            $movie->setTitle($title);
            $movie->setvote_average($vote_average);
            $movie->setOverview($overview);
            $movie->setrelease_date($release_date);            

            $this->SaveDataMovie();
        }

        public function Delete($id)
        {
            # borra una movie

            $this->RetrieveData();

            $movie = $this->GetmovieById($id);

            $movie->SetEnabled(false);
            
            $this->SaveDataMovie();
        }        
        
        public function UnDelete($id)
        {
            # habilita un movie

            $this->RetrieveData();

            $movie = $this->GetmovieById($id);

            $movie->SetEnabled(true);
            
            $this->SaveDataMovie();
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
               # $valuesArray["genre_ids"] = $movie->getgenre_ids();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["vote_average"] = $movie->getvote_average();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["release_date"] = $movie->getrelease_date();
               # $valuesArray["enabled"] = $movie->getEnabled();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/movies.json', $jsonContent);

        }

        private function SaveDataGenre()
        {
           

            
        }

        public function RetrieveData()
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
                        $valuesArray["release_date"],
                        
                    );

                    array_push($this->movieList, $movie);
                }
            } 
            
            $this->idList = array();

            if(file_exists('Data/movieGenre.json'))
            {
                $jsonContent = file_get_contents('Data/movieGenreIds.json');

                $objectTODecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($objectTODecode as $id)
                {
                    $arrayIds["idGenre"]=$id;
                    $arrayIds["idMovie"]=$valuesArray["id"];

                     #Guardo en el arreglo los valores id pelicula e id genero
                     array_push($this->idList, $arrayIds);
                }
            }

        

            foreach($this->movieList as $movie){

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

                $valuesArray["genre"].concat($arrayGenre);
                #array_push($valuesArray["genre"],$arrayGenre);
                
                array_push($this->movieGenre, $valuesArray);
                }


               var_dump($this->movieGenre);

            }

     
            public function getMoviesFromAPI()
            {
     
                # obtiene el json con todos los movies de la API
    
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
                $objectTODecode=json_decode($result);
    
                #Paso el array a JSON para que se vea PRETTY
                $jsonContent = json_encode($objectTODecode, JSON_PRETTY_PRINT);
            
                #Guardo el json en un archivo
                file_put_contents('Data/movies.json', $jsonContent);
                
                $this->movieList = array();

            if(file_exists('Data/movies.json'))
            {
                $jsonContent = file_get_contents('Data/movies.json');


                $objectTODecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                #var_dump($objectTODecode);

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
                        $valuesArray["release_date"],
                      
                    );

                    #Recorro el arreglo de generos
                    foreach ( $valuesArray["genre_ids"] as $id){

                    #guardo el id de genero
                    $arrayIds["idGenre"]=$id;
                    $arrayIds["idMovie"]=$valuesArray["id"];
                    
                    #Guardo en el arreglo los valores id pelicula e id genero
                    array_push($this->idList, $arrayIds);
                    }
                  

                    array_push($this->movieList, $movie);

                  
                    }

                    $jsonContent = json_encode($this->idList, JSON_PRETTY_PRINT);
            
                    file_put_contents('Data/movieGenreIds.json', $jsonContent);
                    
                    $this->SaveDataMovie();
            
                }
            
           }

        }
    
?>
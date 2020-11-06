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
        private $connection;
        private $table = "movies";
        private $tableMovieGenre = "moviesgenres";
        
        public function __construct ()
        {
            $this->genreDAO= new GenreDAO();
        }

        public function Add(Movie $movie)
        {
            $query = 'INSERT INTO ' . $this->table . ' (id, title, popularity, vote_count, video, poster_path, adult, backdrop_path, original_language, original_title, vote_average, overview) VALUES (:id, :title, :popularity, :vote_count, :video, :poster_path, :adult, :backdrop_path, :original_language, :original_title, :vote_average, :overview);';

            $parameters = array(
                ':id' => $movie->getId(),
                ':title' => $movie->getTitle(),
                ':popularity' => $movie->getPopularity(),
                ':vote_count'  => $movie->getVote_count(),
                ':video' => $movie->getVideo(),
                ':poster_path' => $movie->getPoster_path(),
                ':adult' => $movie->getAdult(),
                ':backdrop_path' => $movie->getBackdrop_path(),
                ':original_language' => $movie->getOriginal_language(),
                ':original_title' => $movie->getOriginal_title(),
                ':vote_average' => $movie->getVote_average(),
                ':overview' => $movie->getOverview()
            );

            $this->connection = Connection::GetInstance();

            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowAffected;
            }
            catch(\Exception $ex)
            {
                var_dump($ex);
            }
        }

        public function AddMovieGenre(MovieGenre $movieGenre)
        {
            $query = 'INSERT INTO ' . $this->tableMovieGenre . ' (movieId, genreId) VALUES (:movieId, :genreId);';

            $parameters = array(
                ':movieId' => $movieGenre->getIdMovie(),
                ':genreId' => $movieGenre->getIdGenre(),
            );

            $this->connection = Connection::GetInstance();

            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowAffected;
            }
            catch(\Exception $ex)
            {
                var_dump($ex);
            }
        }

        public function UpdateAllMovies($objectTODecode)
        {
            # obtiene todos los movies de un json y los pone en movieList

            foreach($objectTODecode as $valuesArray)
            {
                $movie = new Movie(
                    $valuesArray->id,
                    $valuesArray->title,
                    $valuesArray->popularity,
                    $valuesArray->vote_count,
                    $this->transformBoolean($valuesArray->video),
                    $valuesArray->poster_path,
                    $this->transformBoolean($valuesArray->adult),
                    $valuesArray->backdrop_path,
                    $valuesArray->original_language,
                    $valuesArray->original_title,
                    $valuesArray->vote_average,
                    $this->transformBoolean($valuesArray->overview),
                );
               
                foreach($valuesArray->genre_ids as $genreId){

                    $movieGenre = new MovieGenre(

                        $valuesArray->id,
                        $genreId,
                    );
                    
                    $this->AddMovieGenre($movieGenre);
                }
                
                $this->Add($movie);
            } 
        }

        public function getMoviesFromAPI()
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
            var_dump($objectTODecode);
            $this->UpdataAllMovies($objectTODecode->results);  
        }
        /*
        public function GetMovieByTitle ($title)
        {
            try
            {
                
                $query = 'SELECT * FROM ' . $this->table . ' WHERE title = :title;';
                $parameters = array(':title' => $title);
                
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);

                if ($result == null)
                {
                    # la pelicula no fue encontrada
                    return null;
                }

                $movie = new Movie(
                    $result[0]['popularity'],
                    $result[0]['vote_count'],
                    $result[0]['video'],
                    $result[0]['poster_path'],
                    $result[0]['id'],
                    $result[0]['adult'],
                    $result[0]['backdrop_path'],
                    $result[0]['original_language'],
                    $result[0]['original_title'],
                    $result[0]['title'],
                    $result[0]['vote_average'],
                    $result[0]['overview'],
                    $result[0]['release_date'],
                );

                $movie->setId($result[0]['id']);

                return $movie;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }
        */
        public function GetAll()
        {
            $this->movieList = array();

            $query = 'SELECT * FROM ' . $this->table;

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                foreach($results as $result)
                {
                    $movie = new Movie(
                        $result['popularity'],
                        $result['vote_count'],
                        $result['video'],
                        $result['poster_path'],
                        $result['id'],
                        $result['adult'],
                        $result['backdrop_path'],
                        $result['original_language'],
                        $result['original_title'],
                        $result['title'],
                        $result['vote_average'],
                        $result['overview'],
                        $result['release_date'],
                    );

                    $movie->setId($result['id']);

                    array_push($this->movieList, $movie);
                }

                return $this->movieList;
            }            
            catch(\Exception $ex)
            {
                throw $ex;
            }
        } 
        
        public function Update(Movie $movie)
        {
            $query = 'UPDATE ' . $this->table . ' SET popularity = :popularity, vote_count = :vote_count, video = :video, poster_path = :poster_path, adult = :adult, bachdrop_path = :bachdrop_path, original_language = :original_language, original_title = :original_title, title = :title, vote_average = :vote_average, overview = :overview, release_date = :release_date) VALUES (:popularity, :vote_count, :video, :poster_path, :id, :adult, :bachdrop_path, :original_lenguage, :original_title, :title, :vote_average. :overview, :release_date WHERE id = :id;';
            $parameters = array(
                ':popularity' => $movie->getPopularity(),
                ':vote_count'  => $movie->getVote_count(),
                ':video' => $movie->getVideo(),
                ':poster_path' => $movie->getPoster_path(),
                ':id' => $movie->getId(),
                ':adult' => $movie->getAdult(),
                ':backdrop_path' => $movie->getBackdrop_path(),
                ':original_language' => $movie->getOriginal_language(),
                ':original_title' => $movie->getOriginal_title(),
                ':title' => $movie->getTitle(),
                ':vote_average' => $movie->getVoe_average(),
                ':overview' => $movie->getOverview(),
                ':release_date' => $movie->getRelease_date()
            );

            $this->connection = Connection::GetInstance();

            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowAffected;
            }
            catch(\Exception $ex)
            {
                # TODO: implementar un mejor manejo de excepciones
                return -1;
            }
        }

        public function Delete($id)
        {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id;';

            $parameters = array(':id' => $id);

            $this->connection = Connection::GetInstance();

            try
            {
                $rowAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowAffected;
            }
            catch(\Exception $ex)
            {
                # TODO: mejorar el manejo de excepciones con un cartel en pantalla
                return -1;
            }
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
                $this->Add($valuesArray);
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

        

        public function transformBoolean($bool){

            if($bool)
            {

                return 1;
            }
            else
            {
                return 0;
            }
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
    }
?>
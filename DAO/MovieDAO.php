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
                //return -1;
            }
        }

        public function AddMovieGenre(MovieGenre $movieGenre)
        {
            $query = 'INSERT INTO ' . $this->tableMovieGenre . '(movieId, genreId) VALUES (:movieId, :genreId);';

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
                return -1;
            }
        }

        public function Update(Movie $movie)
        {
            $query = 'UPDATE ' . $this->table . ' SET title = :title, popularity = :popularity, vote_count = :vote_count, video = :video, poster_path = :poster_path, adult = :adult, backdrop_path = :backdrop_path, original_language = :original_language, original_title = :original_title, vote_average = :vote_average, overview = :overview  WHERE id = :id;';
            
            # var_dump($query);

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
                $rowsAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowsAffected;
            }
            catch(\Exception $ex)
            {
                var_dump($ex);
                //return -1;
            }
        }

        public function UpdateMovieGenre(MovieGenre $movieGenre)
        {
            $query = 'INSERT INTO ' . $this->tableMovieGenre . '(movieId, genreId) VALUES (:movieId, :genreId);';

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
                return -1;
            }
        }


        public function UpdateDatabaseFromAPI()
        {
            $affectedRowsGenres = $this->genreDAO->GetGenresFromAPI();

            $numberPages = $this->GetMoviesPagesFromAPI();

            $rowsAffectedTotal = 0;

            for($i = 1; $i <= $numberPages; $i++)
            {
                $rowsAffected = $this->UpdateDatabasePage($i);

                $rowsAffectedTotal = $rowsAffectedTotal + $rowsAffected;
            }

            return $rowsAffected;
        }


        public function UpdateDatabasePage($numberPage)
        {
            # obtiene el json con todos los movies de la API
    
            #Borra la tabla
            $handle =curl_init();
        
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handle, CURLOPT_URL,"https://api.themoviedb.org/3/movie/now_playing?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US&page=" . $numberPage);
     
            $result=curl_exec($handle);
            
            curl_close($handle);
     
            #Paso el JSON a array
            $objectTODecode=json_decode($result);

            $affectedRows = $this->UpdateAllMovies($objectTODecode->results); 
            
            return $affectedRows;
        }

        public function GetMoviesPagesFromAPI()
        {
            # obtiene el json con todos los movies de la API
    
            #Borra la tabla

            $affectedRowsGenres = $this->genreDAO->GetGenresFromAPI();
            
            $handle =curl_init();
        
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handle, CURLOPT_URL,"https://api.themoviedb.org/3/movie/now_playing?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US&page=1%22%22");
     
            $result=curl_exec($handle);
            
            curl_close($handle);
     
            #Paso el JSON a array
            $objectTODecode=json_decode($result);

            $totalPages = $objectTODecode->total_pages; 
            
            return $totalPages;
        }

        private function UpdateAllMovies($objectTODecode)
        {
            # obtiene todos los movies de un json y los pone en movieList
            $contador = 0;
            foreach($objectTODecode as $valuesArray)
            {
                $movie = new Movie(
                    $valuesArray->id,
                    $valuesArray->title,
                    $valuesArray->popularity,
                    $valuesArray->vote_count,
                    $this->transformBoolean2Int($valuesArray->video),
                    $valuesArray->poster_path,
                    $this->transformBoolean2Int($valuesArray->adult),
                    $valuesArray->backdrop_path,
                    $valuesArray->original_language,
                    $valuesArray->original_title,
                    $valuesArray->vote_average,
                    $valuesArray->overview
                );

                $movieDatabase = $this->GetMovieById($movie->getId());

                if($movieDatabase == null)
                {
                    $this->Add($movie);
                }
                else
                {
                    $this->Update($movie);
                }               
                
                $contador = $contador + 1;

                foreach($valuesArray->genre_ids as $genreId)
                {
                    $movieGenre = new MovieGenre($valuesArray->id, $genreId);
                    $this->AddMovieGenre($movieGenre);
                }
            } 

            return $contador;
        }

        public function GetMoviesByGenre($genreId)
        {
            $this->movieList = array();

            $query = "SELECT movies.id,
            movies.title,
            movies.popularity,
            movies.vote_count,
            movies.video,
            movies.poster_path,
            movies.adult,
            movies.backdrop_path,
            movies.original_language,
            movies.original_title,
            movies.vote_average,
            movies.overview,
            genres.id,
            genres.name,
            GROUP_CONCAT(genres.id, '/', genres.name SEPARATOR ',' )
            FROM " . $this->table . "
            LEFT OUTER JOIN moviesgenres ON movies.id = moviesgenres.movieId
            LEFT OUTER JOIN genres ON moviesgenres.genreId = genres.id
            WHERE genres.id = :id
            GROUP BY movies.id;";

            $parameters = array(':id' => $genreId);

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query, $parameters);

                foreach($results as $result)
                {
                    $movie = new Movie(
                    $result['id'],
                    $result['title'],
                    $result['popularity'],
                    $result['vote_count'],
                    $result['video'],
                    $result['poster_path'],
                    $result['adult'],
                    $result['backdrop_path'],
                    $result['original_language'],
                    $result['original_title'],
                    $result['vote_average'],
                    $result['overview']
                    );

                    $movie->setId($result[0]);

                    if($result[14] != null)
                    {
                        $genresArray = explode(",", $result[14]);

                        $genres = array();

                        foreach($genresArray as $genre)
                        {
                            $singleGenreArray = explode("/", $genre);
                            $genreId = $singleGenreArray[0];
                            $genreName = $singleGenreArray[1];
                            $newGenre = new Genre($genreId, $genreName);
                            array_push($genres, $newGenre);
                        }

                        $movie->setGenres($genres);
                    }                    

                    array_push($this->movieList, $movie);
                }

                return $this->movieList;
            }            
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function GetMovieById($id)
        {
            try
            {
                
                $query = "SELECT movies.id,
                movies.title,
                movies.popularity,
                movies.vote_count,
                movies.video,
                movies.poster_path,
                movies.adult,
                movies.backdrop_path,
                movies.original_language,
                movies.original_title,
                movies.vote_average,
                movies.overview,
                genres.id,
                genres.name,
                GROUP_CONCAT(genres.id, '/', genres.name SEPARATOR ',' )
                FROM " . $this->table . "
                LEFT OUTER JOIN moviesgenres ON movies.id = moviesgenres.movieId
                LEFT OUTER JOIN genres ON moviesgenres.genreId = genres.id
                WHERE movies.id = :id;";

                $parameters = array(':id' => $id);
                
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);

                if ($result[0][0] == null)
                {
                    # la pelicula no fue encontrada
                    return null;
                }

                $movie = new Movie(
                    $result[0]['id'],
                    $result[0]['title'],
                    $result[0]['popularity'],
                    $result[0]['vote_count'],
                    $result[0]['video'],
                    $result[0]['poster_path'],
                    $result[0]['adult'],
                    $result[0]['backdrop_path'],
                    $result[0]['original_language'],
                    $result[0]['original_title'],
                    $result[0]['vote_average'],
                    $result[0]['overview']
                );

                $movie->setId($result[0][0]);
                
                if($result[0][14] != null)
                {
                    $genresArray = array();

                    $genresArray = explode(",", $result[0][14]);

                    $genres = array();
                    foreach($genresArray as $genre)
                    {
                        $singleGenreArray = explode("/", $genre);
                        $genreId = $singleGenreArray[0];
                        $genreName = $singleGenreArray[1];
                        $newGenre = new Genre($genreId, $genreName);
                        array_push($genres, $newGenre);
                    }

                    $movie->setGenres($genres);
                }
                return $movie;
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function GetAll()
        {
            $this->movieList = array();

            $query = "SELECT movies.id, movies.title, movies.popularity, movies.vote_count, movies.video, movies.poster_path, movies.adult, movies.backdrop_path, movies.original_language, movies.original_title, movies.vote_average, movies.overview, genres.id, genres.name, GROUP_CONCAT(genres.id, '/', genres.name SEPARATOR ',' ) FROM " . $this->table . " LEFT OUTER JOIN moviesgenres ON movies.id = moviesgenres.movieId LEFT OUTER JOIN genres ON moviesgenres.genreId = genres.id GROUP BY movies.id;";

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                foreach($results as $result)
                {
                    $movie = new Movie(
                    $result['id'],
                    $result['title'],
                    $result['popularity'],
                    $result['vote_count'],
                    $result['video'],
                    $result['poster_path'],
                    $result['adult'],
                    $result['backdrop_path'],
                    $result['original_language'],
                    $result['original_title'],
                    $result['vote_average'],
                    $result['overview']
                    );

                    $movie->setId($result[0]);

                    if($result[14] != null)
                    {
                        $genresArray = explode(",", $result[14]);

                        $genres = array();

                        foreach($genresArray as $genre)
                        {
                            $singleGenreArray = explode("/", $genre);
                            $genreId = $singleGenreArray[0];
                            $genreName = $singleGenreArray[1];
                            $newGenre = new Genre($genreId, $genreName);
                            array_push($genres, $newGenre);
                        }

                        $movie->setGenres($genres);
                    }                    

                    array_push($this->movieList, $movie);
                }

                return $this->movieList;
            }            
            catch(\Exception $ex)
            {
                throw $ex;
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

        private function DeleteAll()
        {
            $query = 'DELETE FROM ' . $this->table;

            $parameters = array();

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

        public function transformBoolean2Int($bool)
        {
            if($bool)
            {

                return 1;
            }
            else
            {
                return 0;
            }
        }

        public function transformInt2Bool($int)
        {
            if($int == 0)
            {
                return false;
            }
            elseif($int == 1)
            {
                return true;
            }
            else
            {
                return "Error al transformar booleano";
            }
        }
    }
?>
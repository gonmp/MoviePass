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
                var_dump($ex);
            }
        }


        public function getMoviesFromAPI()
        {
            # obtiene el json con todos los movies de la API
    
            #Borra la tabla

            DeleteAll();
            
            $handle =curl_init();
        
            curl_setopt($handle,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($handle, CURLOPT_URL,"https://api.themoviedb.org/3/movie/now_playing?api_key=32629d64c451c1bd620ae0ad25053beb&language=en-US&page=1%22%22");
     
            $result=curl_exec($handle);
            
            curl_close($handle);
     
            #Paso el JSON a array
            $objectTODecode=json_decode($result);
            $this->UpdateAllMovies($objectTODecode->results);  
        }
        
        public function Get($id)
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

        public function DeleteAll()
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

        public function transformBoolean($bool)
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
    }
?>
<?php

    namespace DAO;

    use DAO\IMovieShowDAO as IMovieShowDAO;
    use Models\MovieShow as MovieShow;
    use Models\Movie as Movie;
    use Models\Cinema as Cinema;
    use Models\Genre as Genre;

    class MovieShowDAO implements IMovieShowDAO
    {
        private $movieShowList;
        private $connection;
        private $table = "movieshow";
        private $tableMovies = "movies";
        private $tableCinemas = "cinemas";
        private $movieDAO;
        private $cinemaDAO;
        
        public function __construct ()
        {
            $this->movieDAO = new MovieDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->movieShowList = array();
        }

        public function GetAll()
        {
            $query = "SELECT movieshow.id,
            movies.id,
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
            GROUP_CONCAT(genres.id, '/', genres.name SEPARATOR ',' ),
            cinemas.id,
            cinemas.name,
            cinemas.totalCapacity,
            cinemas.address,
            cinemas.ticketValue,
            cinemas.enable,
            movieshow.showDate
            FROM movieshow
            LEFT OUTER JOIN movies ON movieshow.movieId = movies.id
            LEFT OUTER JOIN moviesgenres ON movies.id = moviesgenres.movieId
            LEFT OUTER JOIN genres ON moviesgenres.genreId = genres.id
            LEFT OUTER JOIN cinemas ON movieshow.cinemaId = cinemas.id GROUP BY movieshow.id;";

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query);

                $this->movieShowList = array();

                foreach($results as $result)
                {
                    $movie = new Movie(
                        $result[1],
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
        
                    if($result[13] != null)
                    {
                        $genresArray = explode(",", $result[13]);
    
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
    
                    $cinema = new Cinema(
                        $result['name'],
                        $result['totalCapacity'],
                        $result['address'],
                        $result['ticketValue'],
                        $result['enable']
                    );
    
                    $cinema->setId($result[14]);
    
                    $showDate = date_create($result['showDate'], timezone_open('America/Argentina/Buenos_Aires'));
    
                    $movieShow = new MovieShow($movie, $cinema, $showDate);

                    $movieShow->SetId($result[0]);

                    array_push($this->movieShowList, $movieShow);

                }

                return $this->movieShowList;

            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAllBetweenDates($startDateTime, $endDateTime)
        {
            $query = "SELECT movieshow.id,
            movies.id,
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
            GROUP_CONCAT(genres.id, '/', genres.name SEPARATOR ',' ),
            cinemas.id,
            cinemas.name,
            cinemas.totalCapacity,
            cinemas.address,
            cinemas.ticketValue,
            cinemas.enable,
            movieshow.showDate
            FROM movieshow
            LEFT OUTER JOIN movies ON movieshow.movieId = movies.id
            LEFT OUTER JOIN moviesgenres ON movies.id = moviesgenres.movieId
            LEFT OUTER JOIN genres ON moviesgenres.genreId = genres.id
            LEFT OUTER JOIN cinemas ON movieshow.cinemaId = cinemas.id
            WHERE movieshow.showDate BETWEEN :startDateTime  AND :endDateTime
            GROUP BY movieshow.id;";

            $parameters = array(':startDateTime' => date_format($startDateTime, "Y-m-d H:i:s"), ':endDateTime' => date_format($endDateTime, "Y-m-d H:i:s"));

            $this->connection = Connection::GetInstance();

            try
            {
                $results = $this->connection->Execute($query, $parameters);

                $this->movieShowList = array();

                foreach($results as $result)
                {
                    $movie = new Movie(
                        $result[1],
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

                    if($result[13] != null)
                    {
                        $genresArray = explode(",", $result[13]);

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

                    $cinema = new Cinema(
                        $result['name'],
                        $result['totalCapacity'],
                        $result['address'],
                        $result['ticketValue'],
                        $result['enable']
                    );

                    $cinema->setId($result[14]);

                    $showDate = date_create($result['showDate'], timezone_open('America/Argentina/Buenos_Aires'));

                    $movieShow = new MovieShow($movie, $cinema, $showDate);

                    $movieShow->SetId($result[0]);

                    array_push($this->movieShowList, $movieShow);

                }

                return $this->movieShowList;

            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
        }

        public function Get($id)
        {
            $query = "SELECT movieshow.id,
            movies.id,
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
            GROUP_CONCAT(genres.id, '/', genres.name SEPARATOR ',' ),
            cinemas.id,
            cinemas.name,
            cinemas.totalCapacity,
            cinemas.address,
            cinemas.ticketValue,
            cinemas.enable,
            movieshow.showDate
            FROM movieshow
            LEFT OUTER JOIN movies ON movieshow.movieId = movies.id
            LEFT OUTER JOIN moviesgenres ON movies.id = moviesgenres.movieId
            LEFT OUTER JOIN genres ON moviesgenres.genreId = genres.id
            LEFT OUTER JOIN cinemas ON movieshow.cinemaId = cinemas.id
            WHERE movieshow.id = :id
            GROUP BY movieshow.id;";

            $parameters = array(':id' => $id);

            $this->connection = Connection::GetInstance();

            try
            {
                $result = $this->connection->Execute($query, $parameters);

                if ($result == null)
                {
                    # la pelicula no fue encontrada
                    return null;
                }

                $movie = new Movie(
                $result[0][1],
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

                if($result[0][13] != null)
                {
                    $genresArray = explode(",", $result[0][13]);

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

                $cinema = new Cinema(
                    $result[0]['name'],
                    $result[0]['totalCapacity'],
                    $result[0]['address'],
                    $result[0]['ticketValue'],
                    $result[0]['enable']
                );

                $cinema->setId($result[0][14]);

                $showDate = date_create($result[0]['showDate'], timezone_open('America/Argentina/Buenos_Aires'));

                $movieShow = new MovieShow($movie, $cinema, $showDate);

                $movieShow->SetId($result[0][0]);

                return $movieShow;

            }
            catch(\Exception $ex)
            {
                throw $ex;
            }            
        }
        
        public function Add(MovieShow $movieShow)
        {
            $query = 'INSERT INTO ' . $this->table . ' (movieId, cinemaId, showDate) VALUES (:movieId, :cinemaId, :showDate);';

            $parameters = array(
                ':movieId' => $movieShow->getMovie()->getId(),
                ':cinemaId' => $movieShow->getCinema()->getId(),
                ':showDate' => date_format($movieShow->getShowDate(), "Y-m-d H:i:s")
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

        function Update(MovieShow $movieShow)
        {
            $query = 'UPDATE ' . $this->table . ' SET movieId = :movieId, cinemaId = :cinemaId, showDate = :showDate WHERE id = :id';
            
            # var_dump($query);

            $parameters = array(':movieId' => $movieShow->getMovie()->getId(),
            ':cinemaId' => $movieShow->getCinema()->getId(),
            ':showDate' => date_format($movieShow->getShowDate(), "Y-m-d H:i:s"),
            ':id' => $movieShow->getId());

            $this->connection = Connection::GetInstance();

            try
            {
                $rowsAffected = $this->connection->ExecuteNonQuery($query, $parameters);
                return $rowsAffected;
            }
            catch(\Exception $ex)
            {
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
    }
?>
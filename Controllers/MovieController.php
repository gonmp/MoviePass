<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use DAO\GenreDAO as GenreDAO;
    use DAO\MovieShowDAO as MovieShowDAO;
    
    use Models\Movie as Movie;
    use Models\Genre as Genre;
    use Models\MovieShow as MovieShow;    

    class MovieController
    {
        private $movieDAO;
        private $genreDAO;
        private $movieShowDAO;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
            $this->movieShowDAO = new MovieShowDAO();
        }
        
        // MOSTRAR DETALES DE UNA PELICULA 
        public function ShowMovieDetails($movieId)
        {
            # mostrar pelicula
            $movie = $this->movieDAO->GetMovieById($movieId);

            # mostrar proyecciones en cines
            $startDate = date_create(null, timezone_open('America/Argentina/Buenos_Aires'));
            
            $endDate = date_create(date_format($startDate, "Y-m-d H:i:s"), timezone_open('America/Argentina/Buenos_Aires'));
            $endDate = date_add($endDate, date_interval_create_from_date_string("7 days")); 

            $movieShowList = $this->movieShowDAO->GetAllByMovieId($movieId, $startDate, $endDate);

            require_once(VIEWS_PATH.'movie-details.php');
        }

        // DETALES DE LA PELICULA 
        public function ShowResultMovieView($categoryId)
        {               
            $dateFrom = date_create(
                $_POST['startDate'],
                timezone_open('America/Argentina/Buenos_Aires')
            );
            
            $dateTo = date_create(
                $_POST['endDate'],
                timezone_open('America/Argentina/Buenos_Aires')
            );

            # para tener la lista de generos en el menu
            $genresList = $this->genreDAO->GetAll();       
            
            $list = null;
            if ($categoryId == "all")
            {
                $list = $this->movieShowDAO->GetAllBetweenDates($dateFrom, $dateTo);
            }
            else
            {
                $list = $this->movieShowDAO->GetAllByGenreId($categoryId, $dateFrom, $dateTo);            
            }            
            
            require_once(VIEWS_PATH."user-movie-form.php");
            require_once(VIEWS_PATH."user-movie-results.php");
        }        

        // MOSTRAR TODOS LOS ESTRENOS DE LA SEMANA
        public function ShowAllMoviesPremieres()
        {
            $startDate = date_create(null, timezone_open('America/Argentina/Buenos_Aires'));

            $endDate = date_create(date_format($startDate, "Y-m-d H:i:s"), timezone_open('America/Argentina/Buenos_Aires'));
            $endDate = date_add($endDate, date_interval_create_from_date_string("7 days"));          

            $genresList = $this->genreDAO->GetAll();       
            $list = $this->movieShowDAO->GetAllBetweenDates($startDate, $endDate);                        

            require_once(VIEWS_PATH."user-movie-form.php");
            require_once(VIEWS_PATH."user-movie-results.php");
        }

        // MOSTRAR TODAS LAS PELICULAS
        public function ShowAllMovies()
        {
            $genresList = $this->genreDAO->GetAll();       
            $list = $this->movieDAO->GetAll();                     

            require_once(VIEWS_PATH."user-movie-form.php");
            require_once(VIEWS_PATH."user-show-all-movies.php"); 
        }        

        public function GoHome()
        {
            $_SESSION['adminLogged'] = null;            
            $_SESSION['userLogged'] = null; 

            $_SESSION['error'] = 'Forced logout by using URL to navigate';

            require_once(VIEWS_PATH."login.php");            
        }
    }
?>
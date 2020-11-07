<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    use DAO\GenreDAO as GenreDAO;
    use Models\Genre as Genre;

    class MovieController
    {
        private $movieDAO;
        private $genreDAO;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->genreDAO = new GenreDAO();
        }

        public function ShowSearchMovieView()
        {
            $genresList = $this->genreDAO->GetAllGenres();

            //var_dump($genresList);

            require_once(VIEWS_PATH."user-movie-form.php");
        }

        public function ShowResultMovieView($categoryId = null)
        {
            if (!$categoryId)
            {
                $this->GoHome();
            }
            else
            {
                $genresList = $this->genreDAO->GetAllGenres();
                $list = $this->movieDAO->GetMoviesByGenre($_POST['categoryId']);
                
                require_once(VIEWS_PATH."user-movie-results.php");
            }            
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
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

        public function ShowResultMovieView($categoryId)
        {
            $genresList = $this->genreDAO->GetAllGenres();
            $list = $this->movieDAO->GetMoviesByGenre($_POST['categoryId']);
            //var_dump($list);
            require_once(VIEWS_PATH."user-movie-results.php");
        }
    }
?>
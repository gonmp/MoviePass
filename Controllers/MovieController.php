<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class MovieController
    {

        public function ShowSearchMovieView()
        {
            require_once(VIEWS_PATH."user-movie-form.php");
        }

        public function ShowResultMovieView()
        {
            require_once(VIEWS_PATH."user-movie-results.php");
        }
    }
?>
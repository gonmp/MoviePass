<?php
    namespace DAO;

    use Models\Movie as Movie;
    use Models\MovieGenre as MovieGenre;
    
    interface IMovieDAO
    {
        function Add(Movie $movie);
        function Delete($id);
        function AddMovieGenre(MovieGenre $movieGenre);
        function UpdateDatabaseFromAPI();
        function GetMovieById($id);
        function GetAll();
    }
?>
<?php
    namespace DAO;

    use Models\MovieGenre as MovieGenre;

    interface IMovieGenreDAO
    {
        function Add(MovieGenre $movieGenre);
        function GetAllEnabled();
    }
?>
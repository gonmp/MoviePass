<?php
    namespace DAO;

    use Models\MovieShow as MovieShow;
    use Models\Movie as Movie;
    use Models\Cinema as Cinema;
    
    interface IMovieShowDAO
    {
        function GetAll();
        function GetAllBetweenDates($startDateTime, $endDateTime);
        function GetAllByMovieId($movieId, $startDateTime, $endDateTime);
        function GetAllByGenreId($genreId, $startDateTime, $endDateTime);
        function GetAllByCinemaId($cinemaId, $startDateTime, $endDateTime);
        function GetAllByMovieIdOnlyDate($movieId, $startDateTime, $endDateTime);
        function Get($id);
        function Add(MovieShow $movieShow);
        function Update(MovieShow $movieShow);
        function Delete($id);
    }
?>
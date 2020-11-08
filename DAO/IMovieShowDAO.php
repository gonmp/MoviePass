<?php
    namespace DAO;

    use Models\MovieShow as MovieShow;
    use Models\Movie as Movie;
    use Models\Cinema as Cinema;
    
    interface IMovieShowDAO
    {
        function GetAll();
        function GetAllBetweenDates($startDateTime, $endDateTime);
        function Get($id);
        function Add(MovieShow $movieShow);
        function Update(MovieShow $movieShow);
        function Delete($id);
    }
?>
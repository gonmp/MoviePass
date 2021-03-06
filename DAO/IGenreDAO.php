<?php
    namespace DAO;

    use Models\Genre as Genre;

    interface IGenreDAO
    {
        function Add(Genre $genre);
        function GetGenreById($idGenre);
        function GetAll();        
        function Delete($idGenre);
        function GetGenresFromAPI();
        function UpdateAllGenres($objectTODecode);
        
    }
?>
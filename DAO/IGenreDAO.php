<?php
    namespace DAO;

    use Models\Genre as Genre;

    interface IGenreDAO
    {
        function AddGenre(Genre $genre);
        function GetNewGenreId();
        function GetGenreById ($idGenre);
        function ModifyGenre($idGenre, $nameGenre);
        function GetAllGenres();
        function GetGenresFromAPI();
        
    }
?>
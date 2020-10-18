<?php
    namespace DAO;

    use Models\Genre as Genre;

    interface IGenreDAO
    {
        function AddGenre(Genre $genre);
        function GetAllGenreEnabled();
    }
?>
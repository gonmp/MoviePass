<?php
    namespace DAO;

    use Models\Movie as Movie;
    
    interface IMovieDAO
    {
        function GetNewId();
        function Add(Movie $movie);
        function Modify($popularity, $vote_count, $video, $poster_path, $id, $adult, $backdrop_path, $original_language, $original_title, $title, $vote_average, $overview, $release_date);
        function GetmovieById ($id);
        function GetMoviesByGenre($genreId);
        function GetAllMoviesGenre();              
        function Update(Movie $movie);
        function Delete($id); 
        function UpdateAllMovies($objectTODecode); 
    }
?>
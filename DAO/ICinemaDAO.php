<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAO
    {        
        function Add(Cinema $cinema);             
        function GetCinemaByName ($name);
        function GetAll();        
        function Update(Cinema $cinema);
        function Delete($id);
    }
?>
<?php
    namespace DAO;

    use Models\Room as Room;
    
    interface IMovieDAO
    {
        function Add(Room $room);
        function GetAll();
        function GetRoomById($id);
        function Update(Room $room);
        function Delete($id);
    }
?>
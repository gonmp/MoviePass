<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAO
    {
        function GetNewId();
        function Add(Cinema $cinema);
        function Modify($id, $name, $totalCapacity, $address, $ticketValue);
        function Delete($id);
        function UnDelete($id);
        function GetCinemaById ($id);
        function GetAll();
        function GetAllEnabled();
    }
?>
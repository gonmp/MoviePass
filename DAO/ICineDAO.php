<?php
    namespace DAO;

    use Models\Cine as Cine;

    interface ICineDAO
    {
        function GetNewId();
        function Add(Cine $cine);
        function Modify($id, $name, $totalCapacity, $address, $ticketValue);
        function Delete($id);
        function UnDelete($id);
        function GetCineById ($id);
        function GetAll();
        function GetAllEnabled();
    }
?>
<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        function GetNewId();
        function Add(User $user); 
        function CheckUser($userName, $password);       
        function CheckAdmin ($userName, $password);        
    }
?>
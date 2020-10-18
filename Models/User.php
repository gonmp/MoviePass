<?php
namespace Models;

class User 
{    
    public function __construct ($user, $password)
    {

    }

    public function GetAdmin ()
    {
        return true;
    }
}

?>
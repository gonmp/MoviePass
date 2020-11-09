<?php
    if (!isset($_SESSION['adminLogged']) || !$_SESSION['adminLogged'])
    {
        header('location:' . FRONT_ROOT . '/Home/Logout');        
    }
    else
    {
        require_once('nav.php');
    }
?>
<?php   #algunas funciones que voy necesitando
namespace Scripts;

class Utils
{
    public static function GetTime()
    {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $dateNow = date_create(date("Y-m-d H:i"), timezone_open("America/Argentina/Buenos_Aires"));    

        $time = $dateNow->format("H:i");
        
        return $time;
    }
}
?>
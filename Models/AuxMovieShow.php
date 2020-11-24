<?php
namespace Models;

class AuxMovieShow
{
    private $id;
    private $movieId;
    private $dateTime;
    private $cinemaName;
    private $roomId;
    
    public function __construct()    
    {
        $this->id = null;
        $this->movieId = null;
        $this->dateTime = null;        
        $this->cinemaName = null;
        $this->roomId = null;
    }    

    public function setId($movieShowId)
    {
        $this->id = $movieShowId;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;        
    }
    public function getMovieId()
    {
        return $this->movieId;
    }

    public function setDateTime($dateTime)
    {   
        $this->dateTime = $dateTime;                
    }
    public function getDateTime()
    {
        $thisDate = date_create($this->dateTime['date'], timezone_open('America/Argentina/Buenos_Aires'));        
        
        return $thisDate;
    }   

    public function setCinemaName($cinemaName)
    {
        $this->cinemaName = $cinemaName;
    }
    public function getCinemaName()
    {
        return $this->cinemaName;
    }

    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    }
    public function getRoomId()
    {
        return $this->roomId;
    }

    public function saveData()
    {
        $arrayValues = array();
        $arrayValues['id'] = $this->id;          
        $arrayValues['movieId'] = $this->movieId;
        $arrayValues['dateTime'] = $this->dateTime;
        $arrayValues['cinemaName'] = $this->cinemaName;
        $arrayValues['roomId'] = $this->roomId;

        $jsonContent = json_encode($arrayValues, JSON_PRETTY_PRINT);
        file_put_contents('Data/auxMovieShow.json', $jsonContent);
    }

    public static function read()
    {
        $jsonContent = file_get_contents('Data/auxMovieShow.json');        
        $arrayValues = json_decode($jsonContent, true);

        $auxMovieShow = new AuxMovieShow();        
        $auxMovieShow->setId($arrayValues['id']);
        $auxMovieShow->setMovieId($arrayValues['movieId']);
        $auxMovieShow->setDateTime($arrayValues['dateTime']);
        $auxMovieShow->setCinemaName($arrayValues['cinemaName']);
        $auxMovieShow->setRoomId($arrayValues['roomId']);

        return $auxMovieShow;
    }
}
?>
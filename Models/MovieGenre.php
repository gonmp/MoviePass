<?php
namespace Models;

class MovieGenre
{
    private $idGenre;
    private $idMovie;
 
    public function __construct ($idMovie,$idGenre)
    {
        $this->setIdMovie($idMovie);
        $this->setIdGenre($idGenre);
    }
    
    public function setIdMovie ($idMovie) {$this->idMovie = $idMovie;}
    public function setIdGenre ($idGenre) {$this->idGenre = $idGenre;}
    
    public function getIdMovie () {return $this->idMovie;}
    public function getIdGenre () {return $this->idGenre;}
}

?>
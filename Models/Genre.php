<?php

namespace Models;

class Genre
{

    private $idGenre;
    private $nameGenre;


    public function __construct ($idGenre, $nameGenre)
    {

        $this->setIdGenre($idGenre);
        $this->setNameGenre($nameGenre);
    }

    public function setIdGenre($idGenre){$this->idGenre= $idGenre;}
    public function setNameGenre($nameGenre){$this->nameGenre= $nameGenre;}

    public function getIdGenre(){return $this->idGenre;}
    public function getNameGenre(){return $this->nameGenre;}
}

?>


<?php

namespace Models;

class Genre{

    private $idGenre;
    private $nameGenre;


    public function __construct ($idGenre, $nameGenre){

        $this->SetIdGenre($idGenre);
        $this->SetNameGenre($nameGenre);
    }

    public function SetIdGenre($idGenre){$this->idGenre= $idGenre;}
    public function SetNameGenre($nameGenre){$this->nameGenre= $nameGenre;}

    public function GetIdGenre(){return $this->idGenre;}
    public function GetNameGenre(){return $this->nameGenre;}
}

?>


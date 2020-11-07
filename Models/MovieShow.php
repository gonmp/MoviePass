<?php

    namespace Models;

    class MovieShow
    {

        private $idShow;
        private $idMovie;
        private $idCinema;
        private $dateShow;

        public function __construct($idShow, $idMovie, $idCinema, $showDate)
        {
            $this->setIdShow($idShow);
            $this->setIdMovie($idMovie);
            $this->setIdCinema($idCinema);
            $this->setDateShow($dateShow);
        }

        public function setIdShow($idShow) {$this->idShow = $idShow;}
        public function setIdMovie($idMovie) {$this->idMovie = $idMovie;}
        public function setIdCinema($idCinema) {$this->idCinema = $idCinema;}
        public function setDateShow($dateShow) {$this->dateShow = $dateShow;}

        public function getIdShow() {return $this->idShow;}
        public function getIdMovie() {return $this->idMovie;}
        public function getIdCinema() {return $this->idCinema;}
        public function getDateShow() {return $this->dateShow;}
    }
?>
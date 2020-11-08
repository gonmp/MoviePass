<?php

    namespace Models;

    class MovieShow
    {
        private $idShow;
        private $movie;
        private $cinema;
        private $dateShow;

        public function __construct($movie, $cinema, $dateShow)
        {
            $this->setMovie($movie);
            $this->setCinema($cinema);
            $this->setDateShow($dateShow);
        }

        public function setIdShow($idShow) {$this->idShow = $idShow;}
        public function setMovie($movie) {$this->movie = $movie;}
        public function setCinema($cinema) {$this->cinema = $cinema;}
        public function setDateShow($dateShow) {$this->dateShow = $dateShow;}

        public function getIdShow() {return $this->idShow;}
        public function getMovie() {return $this->movie;}
        public function getCinema() {return $this->cinema;}
        public function getDateShow() {return $this->dateShow;}
    }
?>
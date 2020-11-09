<?php

    namespace Models;

    class MovieShow
    {
        private $idShow;
        private $movie;
        private $cinema;
        private $showDate;

        public function __construct($movie, $cinema, $showDate)
        {
            $this->setMovie($movie);
            $this->setCinema($cinema);
            $this->setShowDate($showDate);
        }

        public function setId($idShow) {$this->idShow = $idShow;}
        public function setMovie($movie) {$this->movie = $movie;}
        public function setCinema($cinema) {$this->cinema = $cinema;}
        public function setShowDate($showDate) {$this->showDate = $showDate;}

        public function getId() {return $this->idShow;}
        public function getMovie() {return $this->movie;}
        public function getCinema() {return $this->cinema;}
        public function getShowDate() {return $this->showDate;}        
    }
?>
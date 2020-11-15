<?php

    namespace Models;

    class MovieShow
    {
        private $idShow;
        private $movie;
        private $room;
        private $showDate;
        private $duration;

        public function __construct($movie, $room, $showDate)
        {
            $this->setMovie($movie);
            $this->setRoom($room);
            $this->setShowDate($showDate);
            $this->setDuration(strtotime("+15 minutes", strtotime($movie->getDuration())));
        }

        public function setId($idShow) {$this->idShow = $idShow;}
        public function setMovie($movie) {$this->movie = $movie;}
        public function setRoom($room) {$this->room = $room;}
        public function setShowDate($showDate) {$this->showDate = $showDate;}
        public function setDuration($duration) {$this->duration = date("h:i:s", $duration);}

        public function getId() {return $this->idShow;}
        public function getMovie() {return $this->movie;}
        public function getRoom() {return $this->room;}
        public function getShowDate() {return $this->showDate;}
        public function getDuration() {return $this->duration;}        

        public function getShowDateNumber()
        {
            $theDate = $this->showDate->format("H");
            return $theDate;
        }
    }
?>
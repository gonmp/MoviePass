<?php
    namespace Models;

    class Ticket
    {
        private $id;
        private $qr;
        private $movieShow;

        public function __construct($qr, $movieShow){
            $this->qr=$qr;
            $this->movieShow=$movieShow;
        }

        public function getId() {return $this->id;}
        public function getQr() {return $this->qr;}
        public function getMovieShow() {return $this->movieShow;}

        public function setId($id) {$this->id = $id;}
        public function setQR($qr) {$this->qr = $qr;}
        public function setMovieShow($movieShow) {$this->movieShow = $movieShow;}
    }
?>
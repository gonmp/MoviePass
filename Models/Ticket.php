<?php
    namespace Models;

    class Ticket
    {
        private $id;
        private $qr;
        private $movieShow;
        private $purchase;

        public function __construct($qr, $movieShow, $purchase){
            $this->qr=$qr;
            $this->movieShow=$movieShow;
            $this->purchase=$purchase;
        }

        public function getId() {return $this->id;}
        public function getQr() {return $this->qr;}
        public function getMovieShow() {return $this->movieShow;}
        public function getPurchase() {return $this->purchase;}

        public function setId($id) {$this->id = $id;}
        public function setQr($qr) {$this->qr = $qr;}
        public function setMovieShow($movieShow) {$this->movieShow = $movieShow;}
        public function setPurchase($purchase) {$this->purchase = $purchase;}
    }
?>
<?php

    namespace Models;

    class Purchase
    {
        private $id;
        private $purchaseDate;
        private $total;
        private $discount;
        private $user;
        private $movieShow;
        private $numberOfTickets;
        private $tickets;

        public function __construct($purchaseDate, $user, $movieShow, $numberOfTickets){
            $this->purchaseDate = $purchaseDate;
            $this->user=$user;
            $this->movieShow = $movieShow;
            $this->numberOfTickets = $numberOfTickets;
            $this->setDiscount();
            $this->setTotal();
            $this->tickets = array();
        }

        public function getId() {return $this->id;}
        public function getPurchaseDate() {return $this->purchaseDate;}
        public function getTotal() {return $this->total;}
        public function getDiscount() {return $this->discount;}
        public function getUser() {return $this->user;}
        public function getMovieShow() {return $this->movieShow;}
        public function getNumberOfTickets() {return $this->numberOfTickets;}
        public function getTickets() {return $this->tickets;}
 
        public function setId($id) {$this->id = $id;}
        public function setPurchaseDate($purchaseDate) {$this->purchaseDate = $purchaseDate;}
        public function setUser($user) {$this->user = $user;}
        public function setMovieShow($movieShow) {$this->movieShow = $movieShow;}
        public function setNumberOfTickets($numberOfTickets) {$this->numberOfTickets = $numberOfTickets;}
        public function setTickets($tickets) {$this->tickets = $tickets;}

        private function setDiscount()
        {
            $dw = date("w", date_timestamp_get($this->movieShow->getShowDate()));
            if(($dw == 1 || $dw == 2) && $this->numberOfTickets > 1)
            {
                $this->discount = 0.25;
            }
            else
            {
                $this->discount = 0;
            }
        }

        private function setTotal()
        {
            $this->total = $this->movieShow->getRoom()->getTicketValue() * $this->numberOfTickets;

            $this->total = $this->total - ($this->total * $this->discount);
        }
    }
?>
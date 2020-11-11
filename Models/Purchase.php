<?php

    namespace Models;

    class Purchase
    {
        private $id;
        private $purchaseDate;
        private $total;
        private $discount;
        private $user;

        public function __construct($purchaseDate, $total, $discount, $user){
            $this->purchaseDate = $purchaseDate;
            $this->total = $total;
            $this->discount = $discount;
            $this->user=$user;
        }

        public function getId() {return $this->id;}
        public function getPurchaseDate() {return $this->purchaseDate;}
        public function getTotal() {return $this->total;}
        public function getDiscount() {return $this->discount;}
        public function getUser() {return $this->user;}
 
        public function setId($id) {$this->id = $id;}
        public function setPurchaseDate($purchaseDate) {$this->purchaseDate = $purchaseDate;}
        public function setTotal($total) {$this->total = $total;}
        public function setDiscount($discount) {$this->discount = $discount;}
        public function setUser($user) {$this->user = $user;}
    }
?>
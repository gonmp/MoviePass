<?php
 namespace Models;

 class RoomForCinema
 {
     
     private $id;
     private $name;
     private $capacity;
     private $ticketValue;

     public function __construct($capacity, $ticketValue, $name){
         $this->name = $name;
         $this->capacity=$capacity;
         $this->ticketValue = $ticketValue;
     }
     
     public function getId() {return $this->id;}
     public function getName() {return $this->name;}
     public function getCapacity() {return $this->capacity;}
     public function getTicketValue() {return $this->ticketValue;}
     
     public function setId($id) {$this->id=$id;}
     public function setName($name) {return $this->name;}
     public function setCapacity($capacity) {$this->capacity = $capacity;}
     public function setTicketValue($ticketValue) {$this->ticketValue = $ticketValue;}
 }
?>
<?php
 namespace Models;

 class Room
 {     
     private $id;
     private $capacity;
     private $cinema;
     private $ticketValue;
     private $name;

     public function __construct ($capacity, $cinema, $ticketValue, $name)
     {
         $this->capacity = $capacity;
         $this->cinema = $cinema;
         $this->ticketValue = $ticketValue;
         $this->name = $name;
     }

     public function getId() {return $this->id;}
     public function getName() {return $this->name;}
     public function getCapacity() {return $this->capacity;}
     public function getCinema() {return $this->cinema;}
     public function getTicketValue() {return $this->ticketValue;}
     
     public function setId($id) {$this->id = $id;}
     public function setName($name) {$this->name = $name;}
     public function setCapacity($capacity) {$this->capacity = $capacity;}
     public function setCinema($cinema) {$this->cinema = $cinema;}
     public function setTicketValue($ticketValue) {$this->ticketValue = $ticketValue;}
 }
?>

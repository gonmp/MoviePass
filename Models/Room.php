<?php
 namespace Models;

 class CinemaRoom
 {     
     private $id;
     private $capacity;
     private $cinema;
     private $ticketValue;
     private $name;

     public function __construct($capacity, $cinema, $ticketValue, $name)
     {
         $this->capacity = $capacity;
         $this->cinema = $cinema;
         $this->ticketValue = $ticketValue;
         $this->name = $name;
     }
     
     public function getId() {return $this->id;}
     public function getCapacity() {return $this->capacity;}
     public function getCinema() {return $this->cinema;}
     public function getTicket() {return $this->ticketValue;}
     public function getName() {return $this->name;}

     
     public function setId($id) {$this->id=$id;}
     public function setCapacity($capacity) {$this->capacity = $capacity;}
     public function setCinema($cinema) {$this->cinema = $cinema;}
     public function setTicket($ticketValue) {$this->ticketValue = $ticketValue;}
     public function setName($name) {$this->name = $name;}
 }
?>
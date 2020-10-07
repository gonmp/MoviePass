<?php
namespace Models;

class Cine
{
    private $id;
    private $name;
    private $totalCapacity;
    private $address;
    private $ticketValue;
    
    public function __construct ($id, $name, $totalCapacity, $address, $ticketValue)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setTotalCapacity($totalCapacity);
        $this->setAddress($address);
        $this->setTicketValue($ticketValue);
    }
    
    public function setId ($id) {$this->id = $id;}
    public function setName ($name) {$this->name = $name;}
    public function setTotalCapacity ($totalCapacity) {$this->totalCapacity = $totalCapacity;}
    public function setAddress ($address) {$this->address = $address;}
    public function setTicketValue ($ticketValue) {$this->ticketValue = $ticketValue;}

    public function getId () {return $this->id;}
    public function getName () {return $this->name;}
    public function getTotalCapacity () {return $this->totalCapacity;}
    public function getAddress () {return $this->address;}
    public function getTicketValue () {return $this->ticketValue;}
}

?>
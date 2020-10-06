<?php
namespace Models;

class Cine
{
    private string name;
    private int totalCapacity;
    private string address;
    private float ticketValue;

    public function __construct (){}
    public function __construct ($name, $totalCapacity, $address, $ticketValue)
    {
        setName($name);
        setTotalCapacity($totalCapacity);
        setAddress($address);
        setTicketValue($ticketValue);
    }
    
    public function setName ($name) {$this->name = $name;}
    public function setTotalCapacity ($totalCapacity) {$this->totalCapacity = $totalCapacity;}
    public function setAddress ($address) {$this->address = $address;}
    public function setTicketValue ($ticketValue) {$this->ticketValue = $ticketValue;}

    public function getName () {return $this->name;}
    public function getTotalCapacity () {return $this->totalCapacity;}
    public function getAddress () {return $this->address;}
    public function getTicketValue () {return $this->ticketValue;}
}

?>
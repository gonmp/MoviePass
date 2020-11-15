<?php
namespace Models;

class Cinema
{
    private $id;
    private $name;
    private $address;
    private $rooms;
    
    public function __construct ($name, $address)
    {    
        $this->setName($name);
        $this->setAddress($address);
        $this->rooms = array();
    }
    
    public function setId ($id) {$this->id = $id;}
    public function setName ($name) {$this->name = $name;}
    public function setAddress ($address) {$this->address = $address;}
    public function setRooms ($rooms) {$this->rooms = $rooms;}

    public function getId () {return $this->id;}
    public function getName () {return $this->name;}
    public function getAddress () {return $this->address;}
    public function getRooms () {return $this->rooms;}
}

?>
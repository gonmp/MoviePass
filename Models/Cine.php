<?php
<<<<<<< HEAD
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

=======
    namespace Models;
//ada  registro  debe 
// tener  el  nombre  del  cine,  su  capacidad  total,  dirección  y valor único de entrada.
    class Cine{

        private $nombreCine;
        private $capacidadTotal;
        private $direccionCine;
        private $valorEntrada;

        public function getNombreCine(){
            return $this->nombreCine;
        }

        public function setNombreCine($nombreCine){
            $this->nombreCine=$nombreCine;
        }

        public function getCapacidadTotal(){
            return $this->capacidadTotal;
        }

        public function setCapacidadTotal($capacidadTotal){
            $this->capacidadTotal=$capacidadTotal;
        }

        public function getDireccionCine(){
            return $this->direccionCine;
        }

        public function setDireccionCine($direccionCine){
            $this->direccionCine= $direccionCine;
        }

        public function getValorEntrada(){
            return $this->valorEntrada;
        }

        public function setValorEntrada(){
            $this->valorEntrada= $valorEntrada;
        }
    }
>>>>>>> PantallasCine
?>
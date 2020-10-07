<?php
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
?>
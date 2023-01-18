<?php

class Formations {
    private $arrayFormations; 

    public function __construct()
    {
        echo "création d'un objet formations"; 
        $this->arrayFormations = array();
    }

    public function ajoutFormation($uneFormation) {
        $this->arrayFormations[] = $uneFormation; 
    }


    public function getNbFormations() {
        return count($this->arrayFormations);
    }

    public function getLesFormations() {
        return $this->arrayFormations; 
    }
}
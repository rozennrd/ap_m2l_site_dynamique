<?php

class Formations {
    private $arrayFormations; 

    public function __construct()
    {
        $this->arrayFormations = array();
    }

    public function ajoutFormation($uneFormation) {
        $this->arrayFormations[] = $uneFormation; 
    }

    public function getLesFormations() {
        return $this->arrayFormations; 
    }
}
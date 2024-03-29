<?php
class Formation {
    use Hydrate;
    private $idForma; 
    private $intitule ;
    private $descriptif ;
    private $duree; 
    private $dateOuvertureInscription; 
    private $dateClotureInscription;
    private $effectifMax;

    public function __construct() {}
    
    public function setIdForma($unIdForma) {
        $this->idForma = $unIdForma; 
    }

    public function setIntitule($unIntitule) {
        $this->intitule = $unIntitule; 
    }

    public function setDescriptif($unDescriptif) {
        $this->descriptif = $unDescriptif;
    }

    public function setDuree($uneDuree) {
        $this->duree = $uneDuree;
    }

    public function setDateOuvertureInscription($uneDateOuvertureInscription) {
        $this->dateOuvertureInscription = $uneDateOuvertureInscription; 
    }

    public function setDateClotureInscription($uneDateClotureInscription) {
        $this->dateClotureInscription = $uneDateClotureInscription; 
    }

    public function setEffectifMax($unEffectifMax) {
        $this->effectifMax = $unEffectifMax; 
    }

    public function getIdForma() {
        return $this->idForma; 
    } 

    public function getIntitule(){
        return $this->intitule; 
    }

    public function getId() {
        return $this->getIdForma();
    }

    public function getDescriptif() {
        return $this->descriptif;
    }

    public function getDuree() {
        return $this->duree . " jours"; 
    }

    public function getDateOuvertureInscription() {
        return date("d/m/Y", strtotime($this->dateOuvertureInscription));
    }

    public function getDateClotureInscription() {
        return date("d/m/Y", strtotime($this->dateClotureInscription));
    }
    
    public function getEffectifMax() {
        return $this->effectifMax;
    }

    public function estOuverte() {
        $dateDuJour = date_create();
        if ($dateDuJour > $this->getDateClotureInscription() || $dateDuJour < $this->getDateOuvertureInscription()) 
        {
            return false;
        }
        else 
        {
            return true; 
        }
    }

    public function getClass() {
        return "Formation";
    }
    
}
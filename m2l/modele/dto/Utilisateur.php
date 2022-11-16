<?php 

class Utilisateur {
    // Attributs
    private $iduser; 
    private $idligue; 
    private $idfonc; 
    private $idclub; 
    private $nom; 
    private $prenom; 
    private $login;
    private $mdp ; 
    private $statut; 
    private $typeuser; 
    
    // Constructeur
    public function __construct($_iduser, $_idligue, $_idfonc, $_idclub, $_nom, $_prenom, $_login, $_mdp, $_statut, $_typeuser) {
        $this->iduser = $_iduser; 
        $this->idligue = $_idligue; 
        $this->idfonc = $_idfonc; 
        $this->idclub = $_idclub; 
        $this->nom = $_nom; 
        $this->prenom = $_prenom; 
        $this->login = $_login; 
        $this->mdp = $_mdp; 
        $this->statut = $_statut; 
        $this->typeuser = $_typeuser; 
    }

    // Setters
    public function setIdUser($unIdUser) {
        $this->iduser = $unIdUser; 
    }
    public function setIdLigue($unIdLigue) {
        $this->idligue = $unIdLigue; 
    }
    public function setIdFonc($unIdFonc) {
        $this->idfonc = $unIdFonc; 
    }
    public function setIdClub($unIdClub) {
        $this->idclub = $unIdClub; 
    }
    public function setNom($unNom) {
        $this->nom = $unNom; 
    }
    public function setPrenom($unPrenom) {
        $this->prenom = $unPrenom; 
    }
    public function setLogin($unLogin) {
        $this->login = $unLogin; 
    }
    public function setMdp($unMdp) {
        $this->mdp = $unMdp; 
    }
    public function setStatut($unStatut) {
        $this->statut = $unStatut; 
    }
    public function setTypeUser($unTypeUser) {
        $this->typeuser = $unTypeUser; 
    }

    // Getters
    public function getIdUser() {
        return $this->iduser; 
    }
    

}
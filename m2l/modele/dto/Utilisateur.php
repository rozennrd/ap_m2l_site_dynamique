<?php 
require_once "modele/traits/hydrate.php";

class Utilisateur {
    use Hydrate;
    // Attributs
    private $idUser; 
    private $idLigue; 
    private $idFonc; 
    private $idClub; 
    private $nom; 
    private $prenom; 
    private $login;
    private $mdp ; 
    private $statut; 
    private $typeUser; 
    
    // Constructeur
    /* public function __construct($_iduser, $_idligue, $_idfonc, $_idclub, $_nom, $_prenom, $_login, $_mdp, $_statut, $_typeuser) {
        $this->idUser = $_iduser; 
        $this->idLigue = $_idligue; 
        $this->idFonc = $_idfonc; 
        $this->idClub = $_idclub; 
        $this->nom = $_nom; 
        $this->prenom = $_prenom; 
        $this->login = $_login; 
        $this->mdp = $_mdp; 
        $this->statut = $_statut; 
        $this->typeUser = $_typeuser; 
    } */

    public function __construct() {
        // rien (hydrate)
    }

    // Setters
    public function setIdUser($unIdUser) {
        $this->idUser = $unIdUser; 
    }
    public function setIdLigue($unIdLigue) {
        $this->idLigue = $unIdLigue; 
    }
    public function setIdFonc($unIdFonc) {
        $this->idFonc = $unIdFonc; 
    }
    public function setIdClub($unIdClub) {
        $this->idClub = $unIdClub; 
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
        $this->typeUser = $unTypeUser; 
    }

    // Getters
    public function getIdUser() {
        return $this->idUser; 
    }

    public function getIdLigue() {
        return $this->idLigue; 
    }

    public function getIdFonc() {
        return $this->idFonc; 
    }

    public function getIdClub() {
        return $this->idClub; 
    }

    public function getNom() {
        return $this->nom; 
    }
    
    public function getPrenom() {
        return $this->prenom; 
    }
    public function getLogin() {
        return $this->login; 
    }
    public function getMdp() {
        return $this->mdp; 
    }

    public function getStatut() {
        return $this->statut; 

    }public function getTypeUser() {
        return $this->typeUser; 
    }


}
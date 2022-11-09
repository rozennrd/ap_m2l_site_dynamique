<?php 

class Utilisateur {
    private iduser; 
    private idligue; 
    private idfonc; 
    private idclub; 
    private nom; 
    private prenom; 
    private login;
    private mdp ; 
    private statut; 
    private typeuser; 
    
    public function __construct(_iduser, _idligue, _idfonc, _idclub, _nom, _prenom, _login, _mdp, _statut, _typeuser) {
        $this->iduser = _iduser; 
        $this->idligue = _idligue; 
        $this->idfonc = _idfonc; 
        $this->idclub = _idclub; 
        $this->nom = _nom; 
        $this->prenom = _prenom; 
        $this->login = _login; 
        $this->mdp = _mdp; 
        $this->statut = _statut; 
        $this->typeuser = _typeuser; 
    }

    public function getIdUser() {
        return $this->iduser; 

    }

}
<?php
require_once "modele/dao/dBConnex.php";

class UtilisateurDAO {
    public static function verification(Utilisateur $unUtilisateur) {
        
        $requetePrepa = dBConnex::getInstance()->prepare("SELECT idUser FROM utilisateur WHERE login=:login AND mdp=:mdp;");
        $login = $unUtilisateur->getLogin(); 
        $mdp = $unUtilisateur->getMdp(); // Dans l'idéal, à sécuriser avec la fonction hash("sha512", mot_de_passe) + sécuriser lors de l'enregistrement en bdd. 
        $requetePrepa->bindParam(":login", $login);
        $requetePrepa->bindParam(":mdp", $mdp);
        $requetePrepa->execute();
        $idUser = $requetePrepa->fetch();
        return $idUser[0];
    }

    public static function getUtilisateur($unIdUtilisateur) {
        $requetePrepa = dBConnex::getInstance()->prepare("SELECT * FROM utilisateur WHERE id=:id");
        $requetePrepa->bindParam(":id", $unIdUtilisateur);
        $requetePrepa->execute();
        $utilisateurTab = $requetePrepa->fetch();

        $utilisateur = new Utilisateur();
        $utilisateur->hydrate($utilisateurTab);
        return $utilisateur; 
    }



}

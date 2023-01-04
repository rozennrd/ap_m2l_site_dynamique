<?php
require_once "modele/dao/dBConnex.php";

class UtilisateurDAO {
    public static function verification(Utilisateur $unUtilisateur) {
        echo "bonjour on vérifie l'utilisateur";
        
        $requetePrepa = dBConnex::getInstance()->prepare("SELECT idUser FROM utilisateur WHERE login=:login AND mdp=:mdp;");
        $login = $unUtilisateur->getLogin(); 
        $mdp = $unUtilisateur->getMdp(); // Dans l'idéal, à sécuriser avec la fonction hash("sha512", mot_de_passe) + sécuriser lors de l'enregistrement en bdd. 
        echo "<script>alert(\" $login, $mdp\");</script>";
        $requetePrepa->bindParam(":login", $login);
        $requetePrepa->bindParam(":mdp", $mdp);
        $requetePrepa->execute();
        $idUser = $requetePrepa->fetch();
        
        echo "<script>alert(\" $login, $mdp\");</script>";
        return $idUser[0];
    }

}

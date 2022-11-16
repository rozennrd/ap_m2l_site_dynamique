<?php
require_once "modele/dao/dBConnex.php";

class UtilisateurDAO {
    public static function verification(Utilisateur $unUtilisateur) {
        $requetePrepa = dBConnex::getInstance()->prepare("SELECT login FROM utilisateur WHERE login=:login AND mdp=:mdp");
        $login = $unUtilisateur->getLogin(); 
        $mdp = $unUtilisateur->getMdp(); // Dans l'idéal, à sécuriser avec la fonction hash("sha512", mot_de_passe) + sécuriser lors de l'enregistrement en bdd. 
        $requetePrepa->bindParam(":login", $login); 
        $requetePrepa->bindParam(":mdp", $mdp);
        $requetePrepa->execute();
        $idUser = $requetePrepa->fetch();
        echo "<script>alert(\"$idUser , $login, $mdp\")</script>";
        return $idUser[0];
    }

    

}



?>

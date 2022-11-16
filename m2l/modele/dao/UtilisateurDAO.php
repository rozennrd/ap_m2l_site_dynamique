<?php

class UtilisateurDAO {
    public static function verification(Utilisateur $unUtilisateur) {
        $requetePrepa = dBConnex::getInstance->prepare("SELECT iduser FROM utilisateur WHERE login=:login AND mdp=:mdp");
        $login = $unUtilisateur.getLogin(); 
        $mdp = $unUtilisateur.getMdp(); 
        $requetePrepa->bindParam(":login", $login); 
        $requetePrepa->bindParam(":mdp", $mdp);
        $requetePrepa->execute();
        $idUser = $requetePrepa->fetch();
        return $idUser[0];
    }

    

}



?>

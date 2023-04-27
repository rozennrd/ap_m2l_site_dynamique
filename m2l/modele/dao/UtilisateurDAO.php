<?php
require_once "modele/dao/dBConnex.php";

class UtilisateurDAO {
    public static function verification(Utilisateur $unUtilisateur) {
        
        $requetePrepa = dBConnex::getInstance()->prepare("SELECT * FROM utilisateur WHERE login=:login AND mdp=:mdp;");
        $login = $unUtilisateur->getLogin(); 
        $mdp = $unUtilisateur->getMdp(); // Dans l'idéal, à sécuriser avec la fonction hash("sha512", mot_de_passe) + sécuriser lors de l'enregistrement en bdd. 
        $requetePrepa->bindParam(":login", $login);
        $requetePrepa->bindParam(":mdp", $mdp);
        $requetePrepa->execute();
        $resultat = $requetePrepa->fetch(PDO::FETCH_ASSOC);
        $user = new Utilisateur();
        $user->hydrate($resultat);
        echo "idUser = ". $user->getIdUser();
        return $user->getIdUser();
    }

    public static function getUtilisateur($unIdUtilisateur) {
        $requetePrepa = dBConnex::getInstance()->prepare("SELECT * FROM utilisateur WHERE idUser=:id");
        $requetePrepa->bindParam(":id", $unIdUtilisateur);
        $requetePrepa->execute();
        $utilisateurTab = $requetePrepa->fetch();

        $utilisateur = new Utilisateur();
        $utilisateur->hydrate($utilisateurTab);
        return $utilisateur; 
    }

    // Fonction renvoyant le statut de l'inscription, ou null si l'utilisateur
    // n'est pas inscrit. 
    public static function getStatutInscription($idUtilisateur, $idForma) {
        $sql = "select statutDemande from demandeinscription where idUser = :idUtilisateur and idForma = :idForma";
        $req = dbConnex::getInstance()->prepare($sql);
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->bindParam(":idForma", $idForma);
        $req->execute();
        $res = $req->fetch();
        return $res; // Si aucun statut n'est trouvé, retourne null : l'utilisateur n'est pas inscrit
        // Sinon, on retourne le statut 
        // Si l'utilisateur s'inscrit, alors la demande sera a minima "en attente"
    }

}

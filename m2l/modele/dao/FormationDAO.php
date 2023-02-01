<?php
require_once "modele/dto/Formation.php";
require_once "modele/dto/Formations.php";


class FormationDAO {
    
    public static function getLesFormationsOuvertes() {
        $formaOuvertes = new Formations();

        $query = dBConnex::getInstance()->prepare("select * from formation where dateOuvertureInscription<now() and dateClotureInscription>now();");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $formation)
        {
            $forma = new Formation();
            $forma->hydrate($formation);
            $formaOuvertes->ajoutFormation($forma);
        }

        return $formaOuvertes;
    }

    public static function getFormationParId($idFormation) {
        // Gestion de la requête
        $sql = "select * from formation where idForma = :id";
        $req = dBConnex::getInstance()->prepare($sql);
        $req->bindParam(":id", $idFormation);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        // création de l'objet formation
        $formation = new Formation();
        $formation->hydrate($result);
        return $formation;
    }
}
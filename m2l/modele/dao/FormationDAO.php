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


    public static function getToutesLesFormations() {
        $formaArr = new Formations();

        $query = dBConnex::getInstance()->prepare("select * from formation");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $formation)
        {
            $forma = new Formation();
            $forma->hydrate($formation);
            $formaArr->ajoutFormation($forma);
        }

        return $formaArr;
    }

    public static function compterFormations() {
        $sql = "select count(*) from formation; ";
        $req = DBConnex::getInstance()->prepare($sql);
        $req->execute(); 
        $res = $req->fetch(); 
        return $res[0];
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

    public static function modifierFormation($idForma, $tabAModifier) {
        // Fonction prenant en arguments l'id de la formation à modifier, ainsi 
        // que tous les attributs modifiés
        if (count($tabAModifier) > 0) {
            $sql = "update formation set ";
            foreach($tabAModifier as $k=>$v){
                $sql .= $k . "= :un" . $k. ", ";
            }
            $sql = substr($sql, 0, -2);
            $sql.=" where idForma=:id"; 
            echo $sql; 
            $req = DBConnex::getInstance()->prepare($sql); 
            foreach($tabAModifier as $k=>$v) {
                $req->bindParam(":un".$k, $v);
            }
            $req->bindParam(":id", $idForma);

            $req->execute(); 
        }
    }

    public static function ajouterFormation($intitule, $descriptif, $duree, $dateOuverture, $dateCloture, $effectifMax) {
        $sql = "insert into formation (idForma,intitule, descriptif, duree, dateOuvertureInscription, dateClotureInscription, effectifMax) values (:id, :intitule, :descriptif, :duree, :dateOuverture, :dateCloture, :effectifMax)";
        $req = dBConnex::getInstance()->prepare($sql);
        $id =  substr($intitule, 0, 2) . FormationDAO::compterFormations();
        $req->bindParam(":id", $id); 
        $req->bindParam(":intitule", $intitule);
        $req->bindParam(":descriptif", $descriptif);
        $req->bindParam(":duree", $duree);
        $req->bindParam(":dateOuverture", $dateOuverture);
        $req->bindParam(":dateCloture", $dateCloture);
        $req->bindParam(":effectifMax", $effectifMax);
        $req->execute(); 


    }

    public static function supprimerFormation($idForma) {
        $sql = "delete from formation where idForma = :id"; 
        $req = dBConnex::getInstance()->prepare($sql);
        $req->bindParam(":id", $idForma);
        $req->execute(); 
    }

}
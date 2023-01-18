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
            echo $forma->getIntitule();
            $formaOuvertes->ajoutFormation($forma);
            
        }
        echo $formaOuvertes->getNbFormations();
        return $formaOuvertes;
    }

}
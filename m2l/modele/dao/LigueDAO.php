<?php
/*dans la dao, faudrait dans le controleur ligue que j'aille chercher toutes les ligues pour faire afficher*/
class LigueDAO{
public static function lesLigues(){
    $result = [];
    $requetePrepa = DBConnex::getInstance()->prepare("select * from ligue" );
    
    $requetePrepa->execute();
    $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($liste)){
        foreach($liste as $ligue){
            $uneLigue = new Ligue(null,null);
            $uneLigue->hydrate($ligue);
            $result[] = $uneLigue;
        }
    }
    return $result;
}

public static function supprimerLigue($idLigue){

    $requetePrepa = DBConnex::getInstance()->prepare("delete from ligue where  idLigue = :idLigue  " );
    $requetePrepa->bindParam(":idLigue", $idLigue);
    return $requetePrepa->execute();

}

public static function ajouterLigue($idLigue){
    $requetePrepa = DBConnex::getInstance()->prepare("insert into ligue (idLigue , nomLigue , site , descriptif ) values (:idLigue , :nomLigue , :site , :descriptif)");
    
    $requetePrepa->bindParam(":nomLigue", $unNomLigue);
    $requetePrepa->bindParam(":site", $unSite);
    $requetePrepa->bindParam(":descriptif", $unDescriptif);
            
    return $requetePrepa->execute();
}

public static function modifierLigue($idLigue){
    $requetePrepa = DBConnex::getInstance()->prepare("update ligue set nomLigue=:nomLigue , site=:site , descriptif=:descriptif WHERE idLiguee=:idLigue");

    $requetePrepa->bindParam(":idLigue", $idLigue);
    $requetePrepa->bindParam(":nomLigue", $unNomLigue);
    $requetePrepa->bindParam(":site", $unSite);
    $requetePrepa->bindParam(":descriptif", $unDescriptif);
            
    return $requetePrepa->execute();

}




}
<?php
/*je dois finir de faire le dao, le dto et controleur Ligues*/
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













}
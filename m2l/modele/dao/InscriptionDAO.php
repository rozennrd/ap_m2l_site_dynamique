<?php
class InscriptionDAO {
    public static function enregistrerNvInscription($idUtilisateur, $idForma) {
        $sql = "insert into demandeinscription values(:idUtilisateur, :idForma, \"En attente\");";
        $req = dBConnex::getInstance()->prepare($sql);
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->bindParam(":idForma", $idForma);
        return $req->execute();
    }

    public static function supprimerInscription($idUtilisateur, $idForma) {
        $sql = "delete from demandeinscription where idUser = :idUtilisateur and idForma = :idForma;";
        $req = dBConnex::getInstance()->prepare($sql);
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->bindParam(":idForma", $idForma);
        return $req->execute();
    }
}
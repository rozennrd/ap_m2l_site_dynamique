<?php 

class DemandeFormationDAO {
    public static function getDemandesFormation() {
        $sql = "SELECT idUser, idForma, statutDemande FROM `demandeinscription`";
        $req = dBConnex::getInstance()->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        $tab = [] ;
        $i=0;
        foreach($result as $res)
        {
            $utilisateur = UtilisateurDAO::getUtilisateur($res["idUser"]);
            $formation = FormationDAO::getFormationParId($res['idForma']);

            // Gestion des places restantes
            $sqlPlacesRestantes = 'select effectifMax - count(idUser) as total  from formation natural join demandeinscription where formation.idForma = :idForma and statutDemande="Acceptée";';
            $rPlacesRestantes = dBConnex::getInstance()->prepare($sqlPlacesRestantes);
            $idForma = $formation->getId();
            $rPlacesRestantes->bindParam(":idForma", $idForma);
            $rPlacesRestantes->execute();
            $placesRestantes = $rPlacesRestantes->fetch() or $formation->getEffectifMax();
            
            // Gestion du formulaire d'acceptation ou d'annulation de la demande;
            // Si refus, pas de possibilité de revenir dessus
            /*if ($res['statutDemande'] == "Acceptée" ){
                // On laisse la possibilité d'annuler (retour en attente)
                $url = $_SERVER['HTTP_REFERER']. "&id=voirDemandes=true";
                $form = new Formulaire("post", $url, "annulAcceptationDemande", null);
                $idFormation = $form->creerInputHidden("idForma", $formation->getId());
                $idUser = $form->creerInputHidden("idUser", $utilisateur->getIdUser());
                $submit = $form->creerInputSubmit("submitAnnulationDemande", "submitAnnulationDemande", "Révoquer acceptation");
                $form->ajouterComposants
            }*/

            // Création du tableau
            $tab[$i] = ["Utilisateur" => $utilisateur->getNom(). " " . $utilisateur->getPrenom(),
                        "Formation" => $formation->getIntitule(),
                        "Places restantes" => $placesRestantes['total'], 
                        "Statut" => $res['statutDemande']
                        ];
            if( $res['statutDemande'] == "En attente"){
                // Deux boutons, accepter ou refuser. 
                $url = $_SERVER['HTTP_REFERER']. "&voirDemandes=true";
                $form = new Formulaire("post", $url, "annulAcceptationDemande", "form-dans-tab");
                $idFormation = $form->creerInputHidden("idForma", $formation->getId());
                $idUser = $form->creerInputHidden("idUser", $utilisateur->getIdUser());
                $submitAccepter = $form->creerInputSubmit("submitModifDemande", "submitModifDemande", "Accepter");
                $submitRefuser = $form->creerInputSubmit("submitModifDemande", "submitModifDemande", "Refuser");
                $form->ajouterComposants([$idFormation, $idUser, $submitAccepter, $submitRefuser]);
                $tab[$i]["formulaire"] = $form->creerFormulaire(); 
            }
            $i++;
        }
        return $tab;
    }

    public static function accepterDemande($idForma, $idUser) {
        $sql = 'update demandeinscription set statutDemande = "Acceptée" where idUser=:idUser and idForma=:idForma';
        $req = DBConnex::getInstance()->prepare($sql);
        $req->bindParam(':idUser', $idUser);
        $req->bindParam(":idForma", $idForma);
        $req->execute(); 
    }

    public static function refuserDemande($idForma, $idUser) {
        $sql = 'update demandeinscription set statutDemande = "Refusée" where idUser=:idUser and idForma=:idForma';
        $req = DBConnex::getInstance()->prepare($sql);
        $req->bindParam(':idUser', $idUser);
        $req->bindParam(":idForma", $idForma);
        $req->execute(); 
    }

}
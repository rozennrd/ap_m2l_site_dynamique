<?php
require_once "modele/dao/FormationDAO.php";
require_once "modele/dao/InscriptionDAO.php";
require_once "lib/tableau.php";
// Définition des objets à utiliser sur la page : l'utilisateur et la formation
echo "post :";


$utilisateurActuel = UtilisateurDAO::getUtilisateur($_SESSION['identification']);
if (isset($_GET['id'])&& $_GET['id']){
    $formationAAfficher = FormationDAO::getFormationParId($_GET['id']);
}


if(isset($_POST['sumbitInscription']) && $_POST['sumbitInscription'] == "S'inscrire") {
    // Si quelqu'un souhaite s'inscrire (et a donc appuyé sur le bouton "s'inscrire")
    // Envoyer la requête avec le numéro de l'utilisateur actuel & le numéro de la formation
    InscriptionDAO::enregistrerNvInscription($utilisateurActuel->getIdUser(), $formationAAfficher->getId());
}

// Si un id est précisé, on affiche la formation en question et
// On propose à l'utilisateur de s'inscrire. 
if(isset($_GET["id"]) && $_GET['id']) {
    
    if ($utilisateurActuel->getIdFonc() == "rf") {
        // Todo : si rff, alors formulaire pour modifier

    } else {
        $statutDemandeInscriptionFormation = UtilisateurDAO::getStatutInscription($utilisateurActuel->getIdUser(), $formationAAfficher->getIdForma());
        if(!$statutDemandeInscriptionFormation){
            $url = $_SERVER['HTTP_REFERER']. "&id=".urlencode($formationAAfficher->getId()); 
            $formulaireDemandeInscription = new Formulaire("post", $url, "formulaireInscription", null);
            $submit = $formulaireDemandeInscription->creerInputSubmit("sumbitInscription", "submitInscription", "S'inscrire");
            $formulaireDemandeInscription->ajouterComposantLigne($submit);
            $formulaireDemandeInscription->ajouterComposantTab();
            $formulaireDemandeInscription->creerFormulaire();
        } else {
            $url = $_SERVER['HTTP_REFERER']. "&id=".urlencode($formationAAfficher->getId()); 
            $formulaireDemandeInscription = new Formulaire("post", $url, "formulaireAnnulationInscription", null);
            $submit = $formulaireDemandeInscription->creerInputSubmit("sumbitAnnulationInscription", "submitAnnulationInscription", "Annuler ma demande d'inscription");
            $formulaireDemandeInscription->ajouterComposantLigne($submit);
            $formulaireDemandeInscription->ajouterComposantTab();
            $formulaireDemandeInscription->creerFormulaire();
        }
    }
} else {
    // Todo : ajouter bouton "Voir mes demandes de formation" => lien vers mesFormations.php, affichage de toutes les formations concernant la personne + statut de la formation
    // TODO : si user.idFonc== rf, voir toutes les formations, voir celles dont les inscriptions sont ouvertes, pouvoir modifier au lieu de voirplus

    
    $lesFormationsOuvertes = FormationDAO::getLesFormationsOuvertes();

    echo $_SERVER['HTTP_REFERER'];
    if ($lesFormationsOuvertes && $lesFormationsOuvertes->getNbFormations() > 0) {
        $formationsHead = array (
            "Intitulé" => "intitule",
            "Description"=>"descriptif", 
            "Fermeture inscriptions" => "dateClotureInscription",
            "Durée" =>"duree"
        );
        $tab = new Tableau($formationsHead, $lesFormationsOuvertes->getLesFormations());
        $tabAAfficher = $tab->editer(true);
    } else {
        $tabAAfficher = "<div class='message'><p>Pas de formation ouverte pour le moment!</p></div> ";
    }
}


require_once 'vue/vueFormations.php' ;
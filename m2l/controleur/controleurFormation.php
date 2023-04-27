<?php
require_once "modele/dao/FormationDAO.php";
require_once "modele/dao/InscriptionDAO.php";
require_once "modele/dao/DemandeFormation.php";
require_once "lib/tableau.php";
// Définition des objets à utiliser sur la page : l'utilisateur et la formation


var_dump($_SESSION);
if (isset($_SESSION['identification'])) {
    
    $utilisateurActuel = UtilisateurDAO::getUtilisateur($_SESSION['identification']);
    
    //echo("Booléen utilisateur actuel = " + ($utilisateurActuel->getIdFonc() == "rf" || $utilisateurActuel == "rf"));
    if (($utilisateurActuel->getIdFonc() == "rf") || ($utilisateurActuel == "rf")){
        $utilisateurEstResponsableForma = true; 
    } else {$utilisateurEstResponsableForma = false; };
    echo "utilisateur responsableforma";
    var_dump($utilisateurEstResponsableForma);


    if($utilisateurEstResponsableForma) {
        echo "coucou";
        // Modifier et supprimer les formations (réalisation des opérations avant les divers affichages)
        if (isset($_GET['id'])&& $_GET['id']){
            if (isset($_GET["supprimer"])&& $_GET["supprimer"] == true) {
                FormationDAO::supprimerFormation($_GET["id"]);
                $url = $_SERVER['HTTP_REFERER'];
                header("location: $url");
            }
            // gestion de la modification
            else if (isset($_POST['submitModifForma'])){
                $infosAChanger = [];
                foreach($_POST as $elem=>$val) {
                    $method = "get" . ucfirst($elem);
                    if (method_exists($formationAAfficher, $method)) {
                        if ($formationAAfficher->$method() != $val) {
                            $infosAChanger[$elem] = $val;
                            $setMethod = "set" . ucfirst($elem);
                            $formationAAfficher->$setMethod($val);
                        }
                    }
                }
                FormationDAO::modifierFormation($formationAAfficher->getId(), $infosAChanger);
            }
        }

        // pouvoir voir les demandes de l'utilisateur, les accepter et les refuser
        else if (isset($_GET['voirDemandes'])&& $_GET['voirDemandes'] == 'true' && $utilisateurEstResponsableForma) {
            if (isset($_POST["submitModifDemande"])) {
                // si la demande est acceptée, accepter la demande
                if ($_POST["submitModifDemande"] == "Accepter") {
                    DemandeFormationDAO::accepterDemande($_POST["idForma"], $_POST["idUser"]);
                // Sinon, refuser
                } else if ($_POST["submitModifDemande"] == "Refuser") {
                    DemandeFormationDAO::refuserDemande($_POST["idForma"], $_POST["idUser"]);
                }
            }
            
            $demandes = DemandeFormationDAO::getDemandesFormation();
            $thead = ["Utilisateur", "Formation","Places disponibles","Statut"];
            $tabDemandes = Tableau::editerAsTable($demandes, $thead);
        }

        

        // Ajout de la formation
        else if (isset($_POST["submitAjoutForma"])){
            $intitule=$_POST['intitule'];
            $descriptif=$_POST['descriptif'];
            $duree=$_POST['duree'];
            $dateOuvertureInscr=$_POST['dateOuvertureInscription'];
            $dateFermetureInscr=$_POST['dateClotureInscription'];
            $effectifMax=$_POST["effectifMax"];
            FormationDAO::ajouterFormation($intitule,$descriptif, $duree, $dateOuvertureInscr, $dateFermetureInscr, $effectifMax);
        
        }

        else if(isset($_GET["id"]) && $_GET['id']) {
            $formationAAfficher = FormationDAO::getFormationParId($_GET['id']);
             // Affichage du formulaire de modification de la formation
            
            $url = $_SERVER['HTTP_REFERER']. "&id=".urlencode($formationAAfficher->getId());
            $formulaireModificationFormation = new Formulaire("post", $url, "modifFormation", null); 
            $intitule = $formulaireModificationFormation->creerInputTexte("intitule", "intitule", $formationAAfficher->getIntitule(), 0, null, null); 
            $descriptif = $formulaireModificationFormation->creerInputTexte("descriptif", "descriptif", $formationAAfficher->getDescriptif(), 0, null, null);
            $duree = $formulaireModificationFormation->creerInputTexte("duree", "duree", $formationAAfficher->getDuree(), 0, null, null);
            $dateOuverture = $formulaireModificationFormation->creerInputDate("dateOuvertureInscription", "dateOuvertureInscription", $formationAAfficher->getDateOuvertureInscription(), 0, null, null);
            $dateCloture = $formulaireModificationFormation->creerInputDate("dateClotureInscription", "dateClotureInscription", $formationAAfficher->getDateClotureInscription(), 0, null, null);; 
            $effectifMax = $formulaireModificationFormation->creerInputTexte("effectifMax", "effectifMax", $formationAAfficher->getEffectifMax(), 0, null, null);;
            $submit = $formulaireModificationFormation->creerInputSubmit("submitModifForma", "submitModifForma", "Envoyer");
            $formulaireModificationFormation->ajouterComposants(
                [$intitule, $descriptif, $duree, $dateOuverture, $dateCloture, $effectifMax, $submit]
            );
            
        }
        // Formulaire ajout formation
        if (isset($_GET['ajouterFormation'])) {
            $url = $_SERVER['HTTP_REFERER'];
            $formulaireAjoutFormation = new Formulaire("post", $url, "ajoutFormation", null); 
            $intitule = $formulaireAjoutFormation->creerInputTexte("intitule", "intitule", null, 0, "Intitulé", null); 
            $descriptif = $formulaireAjoutFormation->creerInputTexte("descriptif", "descriptif", null, 0, "Descriptif", null);
            $duree = $formulaireAjoutFormation->creerInputTexte("duree", "duree", null, 0, "Durée", null);
            $dateOuverture = $formulaireAjoutFormation->creerInputDate("dateOuvertureInscription", "dateOuvertureInscription", null, 0, "Date ouverture des inscriptions", null);
            $dateCloture = $formulaireAjoutFormation->creerInputDate("dateClotureInscription", "dateClotureInscription", null, 0, "Date clôture des inscriptions", null);; 
            $effectifMax = $formulaireAjoutFormation->creerInputTexte("effectifMax", "effectifMax", null, 0, "Effectif maximal", null);;
            $submit = $formulaireAjoutFormation->creerInputSubmit("submitAjoutForma", "submitAjoutForma", "Envoyer");
            $formulaireAjoutFormation->ajouterComposants(
                [$intitule, $descriptif, $duree, $dateOuverture, $dateCloture, $effectifMax, $submit]
            );
        // Si l'utilisateur actuel est le responsable formation, les formations à afficher sont 
        // toutes les formations
        } else { // Affichage de toutes les formations + bouton ajout formations
            echo "bonjour";
            $lesFormationsAAfficher = FormationDAO::getToutesLesFormations();
            // Voir les demandes de formation
            $url = "index.php?m2lMP=Formation&voirDemandes=true"; 
            $formulaireVoirDemandesFormations = new Formulaire("post", $url, "formulaireVoirDemandesForma", null);
            $submit = $formulaireVoirDemandesFormations->creerInputSubmit("submitVoirDemandesForma", "sumbitVoirDemandesForma", "Voir demandes de formation");
            $formulaireVoirDemandesFormations->ajouterComposantLigne($submit);
            $formulaireVoirDemandesFormations->ajouterComposantTab();
            $formulaireVoirDemandesFormations->creerFormulaire();
            
            // Bouton ajout formation
            $url = "index.php?m2lMP=Formation&ajouterFormation=true"; 
            $formulaireAjoutForma = new Formulaire("post", $url, "formulaireAjoutForma", null);
            $submit = $formulaireAjoutForma->creerInputSubmit("submitAjoutForma", "submitAjoutForma", "Ajouter une formation");
            $formulaireAjoutForma->ajouterComposantLigne($submit);
            $formulaireAjoutForma->ajouterComposantTab();
            $formulaireAjoutForma->creerFormulaire();
            if (isset($lesFormationsAAfficher) && $lesFormationsAAfficher->getNbFormations() > 0) {
                // S'il existe un nombre non nul de formations à afficher, on les affiche
                $formationsHead = array(
                    "Intitulé" => "intitule",
                    "Description" => "descriptif",
                    "Fermeture inscriptions" => "dateClotureInscription",
                    "Durée" => "duree"
                );
                // Si l'utilisateur actuel est responsable des formations, il pourra les modifier
                // Sinon, il pourra seulement en savoir plus sur la formation
                
                $texte = "Modifier";
                
                $tab = new Tableau($formationsHead, $lesFormationsAAfficher->getLesFormations()); 
                $tabAAfficher = $tab->editer(true, $texte, true);
            // Si pas de formations à afficher, on affiche un message
            }
        
        }
    
            
            
        


    } else { // L'utilisateur n'est pas responsable de formation
        echo "utilisateur"; 
        var_dump($utilisateurActuel);
        var_dump(isset($_GET['id'])&& $_GET['id']);
        if (isset($_GET['id'])&& $_GET['id']){
            echo "coucou";
            $formationAAfficher = FormationDAO::getFormationParId($_GET['id']);
            var_dump(isset($formationAAfficher));
            //on affiche la formation en question et
            // On propose à l'utilisateur de s'inscrire. 
            var_dump($utilisateurActuel->getIdUser());
            var_dump($formationAAfficher->getIdForma());

            $statutDemandeInscriptionFormation = UtilisateurDAO::getStatutInscription($utilisateurActuel->getIdUser(), $formationAAfficher->getIdForma());
            echo "statut demande inscription formation ";
            var_dump($statutDemandeInscriptionFormation)    ;
            if(!$statutDemandeInscriptionFormation){
                $url = $_SERVER['HTTP_REFERER']. "&id=".urlencode($formationAAfficher->getId()); 
                $formulaireDemandeInscription = new Formulaire("post", $url, "formulaireInscription", null);
                $submit = $formulaireDemandeInscription->creerInputSubmit("sumbitInscription", "submitInscription", "S'inscrire");
                $formulaireDemandeInscription->ajouterComposantLigne($submit);
                $formulaireDemandeInscription->ajouterComposantTab();
                $formulaireDemandeInscription->creerFormulaire();
            } else {

                $url = $_SERVER['HTTP_REFERER']. "&id=".urlencode($formationAAfficher->getId()); 
                var_dump($_SERVER['HTTP_REFERER']);
                $formulaireDemandeInscription = new Formulaire("post", $url, "formulaireAnnulationInscription", null);
                $submit = $formulaireDemandeInscription->creerInputSubmit("sumbitAnnulationInscription", "submitAnnulationInscription", "Annuler ma demande d'inscription");
                $formulaireDemandeInscription->ajouterComposantLigne($submit);
                $formulaireDemandeInscription->ajouterComposantTab();
                $formulaireDemandeInscription->creerFormulaire();
            }
            if(isset($_POST['sumbitInscription']) && $_POST['sumbitInscription'] == "S'inscrire") {
                // Si quelqu'un souhaite s'inscrire (et a donc appuyé sur le bouton "s'inscrire")
                // Envoyer la requête avec le numéro de l'utilisateur actuel & le numéro de la formation
                InscriptionDAO::enregistrerNvInscription($utilisateurActuel->getIdUser(), $formationAAfficher->getId());
            } else if(isset($_POST['sumbitAnnulationInscription'])) {
                // Si quelqu'un souhaite se désinscrire (et a donc appuyé sur le bouton "annuler ma demande")
                // Envoyer la requête avec le numéro de l'utilisateur actuel & le numéro de la formation
                InscriptionDAO::supprimerInscription($utilisateurActuel->getIdUser(), $formationAAfficher->getId());
      
                
            }
        }
    
         else {
            // Todo : ajouter bouton "Voir mes demandes de formation" => lien vers mesFormations.php, affichage de toutes les formations concernant la personne + statut de la formation
           
            
            // Sinon, n'afficher que les formations ouvertes
            $lesFormationsAAfficher = FormationDAO::getLesFormationsOuvertes();
    
            if (isset($lesFormationsAAfficher) && $lesFormationsAAfficher->getNbFormations() > 0) {
                // S'il existe un nombre non nul de formations à afficher, on les affiche
                $formationsHead = array(
                    "Intitulé" => "intitule",
                    "Description" => "descriptif",
                    "Fermeture inscriptions" => "dateClotureInscription",
                    "Durée" => "duree"
                );
                // Si l'utilisateur actuel est responsable des formations, il pourra les modifier
                // Sinon, il pourra seulement en savoir plus sur la formation
            
                    $texte = "Voir plus";
                
                $tab = new Tableau($formationsHead, $lesFormationsAAfficher->getLesFormations()); 
                $tabAAfficher = $tab->editer(true, $texte, false);
            // Si pas de formations à afficher, on affiche un message
            } else {
                $tabAAfficher = "<div class='message'><p>Pas de formation ouverte pour le moment!</p></div> ";
            }
        }
    }
    //echo isset($formationAAfficher);

} 
require_once 'vue/vueFormations.php' ;
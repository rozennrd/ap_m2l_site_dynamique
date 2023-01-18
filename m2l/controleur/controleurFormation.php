<?php

require_once "modele/dao/FormationDAO.php";
require_once "lib/tableau.php";

$lesFormationsOuvertes = FormationDAO::getLesFormationsOuvertes();

if ($lesFormationsOuvertes && $lesFormationsOuvertes->getNbFormations() >0) {
    $formationsHead = array (
        "Intitulé" => "intitule",
        "Description"=>"description", 
        "Fermeture inscriptions" => "dateFermetureInscriptions",
        "Durée" =>"duree"
    );
    // TODO : afficher les formations ouvertes dans la vue. 
    $tab = new Tableau($formationsHead, $lesFormationsOuvertes);
    $tabAAfficher = $tab->editer(true);
} else {
    $tabAAfficher = "<div class='message'><p>Pas de formation ouverte pour le moment!</p></div> ";
}
require_once 'vue/vueFormations.php' ;
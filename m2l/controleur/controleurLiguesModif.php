<?php

/*****************************************************************************************************
 * Supprimer la ligue selectionnée
 *****************************************************************************************************/

if(isset($_POST['submitSupprimer'] )){
//&& isset($_SESSION['ligue']) && $_SESSION['ligue'] != '0'){

 	$reponseSGBD = LigueDAO::supprimerLigue($_SESSION['ligue']);
	if ($reponseSGBD==1 ) {
		$_SESSION['ligue']="0";
	}

}



/*****************************************************************************************************
 * Ajouter d'une nouvelle ligue
 *****************************************************************************************************/
	if(isset($_POST['submitAjouter'])){
		$_SESSION['ligue']="0";
	}

/*****************************************************************************************************
 * Enregistrement d'une nouvelle ligue
 *****************************************************************************************************/
if (isset($_POST['submitEnregistrer'] )){

	$reponseSGBD = LigueDAO::ajouterLigue($_POST['nomLigue'], $_POST['site'], $_POST['description']);


}


/*****************************************************************************************************
 * Modifier les informations d'une ligue
 *****************************************************************************************************/
	if(isset($_POST['submitConfirmModifier'])){

		$reponseSGBD = LigueDAO::modifierLigue($_SESSION['ligue'], $_POST['nomLigue'], $_POST['site'], $_POST['description']);
		

	}

/*****************************************************************************************************
 * Instancier un objet contenant la liste des Ligues et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeLigues'] = new Ligues(LigueDAO::lesLigues());

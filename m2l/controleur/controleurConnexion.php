<?php


if(!isset($_SESSION['identification']) || $_SESSION['identification'] == null) {

	$formulaireConnexion = new Formulaire('post', 'index.php', 'fConnexion', 'fConnexion');
	
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Identifiant :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputTexte('login', 'login', '', 1, 'Entrez votre identifiant', ''));
	$formulaireConnexion->ajouterComposantTab();

	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Mot de Passe :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('mdp', 'mdp',  1, 'Entrez votre mot de passe', ''));
	$formulaireConnexion->ajouterComposantTab();

	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion-> creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
	$formulaireConnexion->ajouterComposantTab();
	
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerMessage($messageConnexion));
	$formulaireConnexion->ajouterComposantTab();
	
	$formulaireConnexion->creerFormulaire();

	$_SESSION['m2lMP']="accueil";
	require_once 'vue/vueConnexion.php' ;

}
else
{
	$_SESSION['identification']=null;
	$utilisateurActuel = null; 
	$_SESSION['m2lMP']="accueil";
	
	header('location: index.php');
}
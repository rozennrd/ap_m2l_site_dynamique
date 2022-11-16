<?php
/***** INCLUSIONS *****/
require_once "modele/dto/Utilisateur.php"; 
require_once "modele/dao/UtilisateurDAO.php";

/***** CREATION / GESTION DE LA SESSION *****/


$messageErreurConnexion = '';
//echo "<script>alert(\""+$_SESSION['identification']+"\")</script>";

if(isset($_POST['login'])) 
{
	// Création d'un utilisateur + irrigation avec le login et le mdp récupérés
	$unUtilisateur = new Utilisateur();
	$unUtilisateur->setLogin($_POST['login']); 
	$unUtilisateur->setMdp($_POST['mdp']);
	
	$_SESSION['identification'] = UtilisateurDAO::verification($unUtilisateur); // Vérification 
	if (isset($_SESSION['identification']) && $_SESSION['identification']) 
	{
		$messageErreurConnexion = "Vous êtes connecté";
		// Insérer ici vos modifications / les choses qui dépendent de si votre utilisateur est identifié
	}
	else 
	{
		$messageErreurConnexion = "Login ou mot de passe incorrect"; 
	}
}

/***** DECONNEXION *****/
if(isset($_POST['connexion'])) {
	
}


/********************/
if(isset($_GET['m2lMP'])){
	$_SESSION['m2lMP']= $_GET['m2lMP'];
}
else
{
	if(!isset($_SESSION['m2lMP'])){
		$_SESSION['m2lMP']="accueil";
	}
}

// TODO : Tester la connexion 


// Comment gérer l'identification ?
if (isset($_SESSION['identification']) && $_SESSION["identification"]) // S'il existe une valeur d'identification dans la session && qu'elle n'est pas nulle 
{
	// Insérer les choses qui nécessitent d'être identifié

	// Gestion de l'item de connexion du menu
	$texteItemConnexion = "Se déconnecter"; 

}
else 
{
	// Gestion de l'item de connexion du menu
	$texteItemConnexion = "Se connecter"; 
}


$m2lMP = new Menu("m2lMP");

$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", $texteItemConnexion));

$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');


include_once dispatcher::dispatch($_SESSION['m2lMP']);


<?php


/*****************************************************************************************************
 * Instancier un objet contenant la liste des Ligues et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeLigues'] = new Ligues(LigueDAO::lesLigues());
//echo("test0");
//var_dump($_SESSION['listeLigues']);



/*****************************************************************************************************
 * Conserver dans une variable de session l'item actif du menu ligue
 *****************************************************************************************************/

 if(isset($_GET['ligue'])){
	
	$_SESSION['ligue']= $_GET['ligue'];
}
else
{
	
	if(!isset($_SESSION['ligue'])){
		
		$_SESSION['ligue']="0";
	}
}


/*****************************************************************************************************
 * Créer un menu vertical à partir de la liste des ligues
 *****************************************************************************************************/
$menuLigue = new Menu("menuLigue");


foreach ($_SESSION['listeLigues']->getLigues() as $uneLigue){
	//echo("test1");
	//var_dump($uneLigue);
	$menuLigue->ajouterComposant($menuLigue->creerItemLien($uneLigue->getNomLigue() ,$uneLigue->getIdLigue()));
}

$leMenuLigues = $menuLigue->creerMenuLigues($_SESSION['ligue']);


/*****************************************************************************************************
 * Récupérer la ligue sélectionnée
 *****************************************************************************************************/
$ligueActive = $_SESSION['listeLigues']->chercheLigue($_SESSION['ligue']);
/*echo("test3");
var_dump($_SESSION['ligue']);
echo("test2");
var_dump($ligueActive);*/

$formuLigue = new Formulaire('post', 'index.php' , 'formuLigue', 'formuLigue' );

if($_SESSION['ligue']!= '0'){

	$composant = $formuLigue->creerImage('imageLigue', 'imageLigue' , 'images/' . strToLower($ligueActive->getIdLigue()) . '.png');
	$formuLigue->ajouterComposantLigne($composant , 1 );

	$composant = $formuLigue->creerLabel($ligueActive->getNomLigue() ,'titre');
	$formuLigue->ajouterComposantLigne($composant , 1 );

	$formuLigue->ajouterComposantTab();


	$composant = $formuLigue->creerLabel('nom :' , 'labelLigue');

	$formuLigue->ajouterComposantLigne($composant , 1 );

	$composant = $formuLigue->creerInputTexte('nomLigue', 'nomLigue', $ligueActive->getNomLigue() , 1 , '', 1);
	$formuLigue->ajouterComposantLigne($composant , 1 );

	$formuLigue->ajouterComposantTab();

	/***************************************************************************************************/

	$composant = $formuLigue->creerLabel('site :' , 'labelLigue');

	$formuLigue->ajouterComposantLigne($composant , 1 );

	$composant = $formuLigue->creerInputTexte('site', 'site', $ligueActive->getSite() , 1 , '', 1);
	$formuLigue->ajouterComposantLigne($composant , 1 );

	$formuLigue->ajouterComposantTab();

		/************************************************************************************************/

	$composant = $formuLigue->creerLabel('Descriptif :' , 'labelLigue');

	$formuLigue->ajouterComposantLigne($composant , 1 );

	$composant = $formuLigue->creerInputTexte('Descriptif', 'Descriptif', $ligueActive->getDescriptif() , 1 , '', 1);
	$formuLigue->ajouterComposantLigne($composant , 1 );

	$formuLigue->ajouterComposantTab();
	
		/*************************************************************************************************/

	$formuLigue->creerFormulaire();


	

}
else{

	$composant = $formuLigue->creerLabel('Veuillez ......' , 'labelChoisirLigue');

	$formuLigue->ajouterComposantLigne($composant , 1 );

	$formuLigue->ajouterComposantTab();

	$formuLigue->creerFormulaire();
}





require_once 'vue/ligue/vueLigues.php' ;

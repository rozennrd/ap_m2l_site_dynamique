<?php


/*****************************************************************************************************
 * Instancier un objet contenant la liste des Ligues et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeLigues'] = new Ligues(LigueDAO::lesLigues());




/*****************************************************************************************************
 * Conserver dans une variable de session l'item actif du menu equipe
 *****************************************************************************************************/
if(isset($_GET['equipe'])){
	$_SESSION['equipe']= $_GET['equipe'];
}
else
{
	if(!isset($_SESSION['equipe'])){
		$_SESSION['equipe']="0";
	}
}













require_once 'vue/ligue/vueLigues.php' ;

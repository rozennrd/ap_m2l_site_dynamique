<?php


/*****************************************************************************************************
 * Instancier un objet contenant la liste des Equipes et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeLigues'] = new Ligues(LigueDAO::lesLigues());




















require_once 'vue/ligue/vueLigues.php' ;

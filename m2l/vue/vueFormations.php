

<div class="conteneur">
    <header>
		<?php include 'haut.php' ;?>
	</header>
    <main>
        <div class="articles">
        
        <?php if (isset($tabAAfficher)) { ?>
            <h3>Formations Ouvertes</h3>
            <?php echo $tabAAfficher;
        } else if (isset($formationAAfficher) && $formationAAfficher) {?>
            <div class="texteAccueil">  
            <h3><?php echo $formationAAfficher->getIntitule(); ?></h3>
            <p>Durée : <?php echo $formationAAfficher->getDuree();?></p>
            <p><?php echo $formationAAfficher->getDescriptif();?></p>
            <p>Inscriptions ouvertes du <?php echo $formationAAfficher->getDateOuvertureInscription()?> au <?php echo $formationAAfficher->getDateClotureInscription(); ?></p>
            
            <?php if(isset($statutDemandeInscriptionFormation) && !$statutDemandeInscriptionFormation) {?>
                <?php echo $formulaireDemandeInscription->afficherFormulaire();?>
                <!--<form action="<?php echo $_SERVER['HTTP_REFERER']. $formationAAfficher->getId()?>" method="post">
                    <input type=hidden name="inscriptionFormation" value="inscriptionFormation">    
                    <button type="submit">S'inscrire</button>
                </form>-->
            <?php } else { ?> 
                <p>Vous avez envoyé une demande d'inscription. Votre demande d'inscription est <b><?php echo lcfirst($statutDemandeInscriptionFormation[0])?></b>.</p>
                <?php echo $formulaireDemandeInscription->afficherFormulaire(); ?>   
            <?php } ?>
            </div>
        <?php } ?>
        </div>
    </main>
    <footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>
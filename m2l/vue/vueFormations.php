

<div class="conteneur">
    <header>
		<?php include 'haut.php' ;?>
	</header>
    <main>
        <div class="articles">
        
        <!-- Voir les demandes de formation -->
        <?php if(isset($tabDemandes) ){
            ?>
            <div class=texteAccueil>
            <a class="texteAccueil" href="index.php?m2lMP=Formation">Retour</a>
            </div>
            <?php
            echo $tabDemandes;
        } else {?>
        <div class="texteAccueil flex">
            <p>
                <?php if(isset($formulaireVoirDemandesFormations)) {
                    echo $formulaireVoirDemandesFormations->afficherFormulaire();
                    echo $formulaireAjoutForma->afficherFormulaire();
                }?>
            </p>
        </div>
        <?php if (isset($formulaireAjoutFormation)){?>
            <div class="texteAccueil">
                <h3>Ajouter une formation</h3>
            
            <?php
            
            echo $formulaireAjoutFormation->afficherFormulaire();
            ?></div><?php
        ?>
        <!-- Affichage des formations --> 
        <!-- Si l'utilisateur est responsable des formations -> toutes les formations --> 
        <!-- Sinon : seulement les formations ouvertes --> 
        <?php } else if (isset($tabAAfficher)) { ?>
            <h3>Formations Ouvertes</h3>
            <?php echo $tabAAfficher;

        } else if (isset($formationAAfficher) && $formationAAfficher) {?>
        <!-- Voir une formation en particulier ; si responsable, formulaire de modification-->
            <?php if (isset($formulaireModificationFormation)){
                ?>
                <div  class="texteAccueil">
                <a class="texteAccueil" href="index.php?m2lMP=Formation">Retour</a>
                <h3>Modifier la formation <?php $formationAAfficher->getIntitule();?></h3>
                <?php
                echo $formulaireModificationFormation->afficherFormulaire(); ?>
                </div>
            
            <?php } else {?>
            <!-- Si l'utilisateur n'est pas responsable, affichage des infos + demande d'inscription -->
            <div class="texteAccueil">  
            <a class="texteAccueil" href="index.php?m2lMP=Formation">Retour</a>
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
            <?php } else if(isset($statutDemandeInscriptionFormation)) { ?> 
                <p>Vous avez envoyé une demande d'inscription. Votre demande d'inscription est <b><?php echo lcfirst($statutDemandeInscriptionFormation[0])?></b>.</p>
                <?php echo $formulaireDemandeInscription->afficherFormulaire(); ?>   
            <?php } ?>
            </div>
        <?php } } 
        }?>
        </div>
    </main>
    <footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>
# ap_m2l_site_dynamique

Page du projet d'AP "M2L site dynamique". 
Les consignes sont trouvables dans le fichier pdf. 
Le trello pour l'organisation est trouvable à cette adresse : https://trello.com/b/M3Mu6Iba/gestion-des-t%C3%A2ches // Lien d'invitation pour participer au trello : https://trello.com/invite/ap_m2l_site_dynamique/ATTId8e0b872b3e31da7009c93a35cc222afB77CD5DA 

## Commandes utiles pour contribuer au projet : 
### Initialisation du répertoire : 
Pour cloner le répertoire, se positionner dans le fichier où l'on souhaite travailler, puis clic droit > "git bash here". 

Entrer la commande `git clone https://github.com/rozennrd/ap_m2l_site_dynamique.git`

Le répertoire est alors créé, et vous vous retrouvez sur la branche main. 
Pour créer votre branche sur laquelle travailler sans interférer avec le travail des autres, utiliser la commande `git branch -b <nomdemabranche>`. 

Importez le fichier sql `script_sql_m2l_dynamique.txt` dans votre base de données mysql (phpmyadmin)

### Comment procéder ? 
A chaque fin de session (lorsque vous avez fini de travailler avec votre fichier), entrez les commandes suivantes : 

* `git add -A` (ajoute toutes les modifications en attente) 
* `git commit -m "<commentaire>"`
* `git push`

Si vous n'êtes pas sûrs d'avoir commité ou push, utilisez la commande `git status` qui vous permettra d'avoir une vue d'ensemble. 

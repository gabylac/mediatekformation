# Mediatekformation
## Présentation
Ce site, développé avec Symfony 6.4, permet d'accéder aux vidéos d'auto-formation proposées par une chaîne de médiathèques et qui sont aussi accessibles sur YouTube.<br> 
La partie front office a été développée, le lien vers le readme de son développement est :<br>
https://github.com/CNED-SLAM/mediatekformation
## Pages de la partie back office
### Gestion des formations
La page de gestion des formations affiche la liste de la totalité des formations avec le nom de la formation, la date de création, la playlist d’appartenance, la catégorie d’appartenance et les actions possibles sur chaque ligne. Le tri par titre des colonnes de la liste ou par filtre est également possible.<br>
![Capture d'écran 2025-05-05 183342](https://github.com/user-attachments/assets/702bdb3c-a12d-41f2-bba3-a23c61601bf1)
#### Ajout d’une formation
Il est possible d’ajouter une nouvelle formation via le clic sur le bouton ‘ajouter une formation’. Une page contenant un formulaire apparaît, il est possible de saisir un titre et une description de la formation  et de choisir dans les combos une playlist et une ou plusieurs catégories, la date par défaut est celle du jour mais elle peut être changée. Le clic sur le bouton ‘enregistrer’ permet une redirection sur la page des formations contenant la nouvelle formation enregistrée.<br>
![Capture d'écran 2025-05-05 183550](https://github.com/user-attachments/assets/19ce6cca-f7fb-4d7b-8c71-24ba09b26d72)
#### Suppression d’une formation
La suppression d’une formation peut se faire via le clic sur le bouton ‘supprimer’ présent sur la ligne de la formation concernée. Un message de confirmation s’affiche, le clic sur le bouton ‘oui’ supprime la formation.<br>
#### Modification d’une formation
La modification d’une formation peut de faire via le clic sur le bouton ‘éditer’ présent sur la ligne de la formation concernée. Il redirige vers une page formulaire présentant les informations de la formation. Il est alors possible de modifier ces informations et de les enregistrer.
### Gestion des playlists
La page de gestion des playlists est sensiblement la même que celle des formations ; elle affiche la liste de la totalité des playlists avec le nom de la playlist et les actions possibles sur chaque ligne. Le tri par titre des colonnes ou par filtre est également possible.<br>
#### Ajout d’une playlist
L’ajout d’une playlist se fait sur le clic du bouton `ajouter une playlist` sur la page de la liste des playlists. Le clic redirige vers une page contenant un formulaire dans lequel il est possible de saisir un titre ainsi qu’une description de la playlist et d’enregistrer la nouvelle playlist.<br>
#### Suppression d’une playlist
La suppression d’une playlist se fait de la même manière que la suppression d’une formation.<br>
#### Modification d’une playlist
La modification d’une playlist se fait de la même manière que la modification d’une formation sauf que les seuls champs concernés sont le titre et la description.<br>
### Gestion des catégories
La page de gestion des catégories affiche la liste des catégories avec le nom de la catégorie et les actions possibles.<br>
![Capture d'écran 2025-05-05 184055](https://github.com/user-attachments/assets/7bc30f1b-5bd1-4548-afc6-70266f206d83)
L’ajout d’une catégorie se fait directement sur la page via un formulaire intégré qui permet de saisir le nom de la catégorie à ajouter et de l’enregistrer. Si le nom existe déjà, il sera impossible d’ajouter la catégorie. <br>
La suppression d’une catégorie se fait par le clic sur le bouton ‘supprimer’ présent sur la ligne de la catégorie concernée. Une catégorie ne peut être supprimée que si aucune formation n’y est rattachée.<br>
### Gestion de l’authentification
Une authentification a été mise en place afin d’accéder aux fonctionnalités de la partie back office et de pouvoir gérer les formations, les playlists et les catégories.<br>
Les saisies d’un login valide et d’un mot de passe sont demandés avant de pouvoir accéder à la partie back office.<br>
### Installation et utilisation de l'application en local
Pour installer l'application, il suffit de récupérer le zip du dépôt distant présent,
Vérifier que wampServer, Composer et Git sont installés,
Dézipper le dossier récupéré dans www de wamp,
En invite de commande reconstituer le dossier vendor avec la commande composer install,
Se connecter à phpMyAdmin, créer la base de données mediatekformation et executer le script mediatekformation.sql contenu dans le dossier dézippé,
Le site doit normalement être accessible avec l'url suivante : localhost/mediatekformation/public/index.php



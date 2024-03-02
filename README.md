
# Air Quality Gate

Ce petit projet consiste à récupérer la qualité de l'air de 2 villes sur les 30 derniers jours via l'API Air Quality de Google.


## Installation

Ce projet est un projet simple écrit en PHP 8.2.12, pour le lancer vous avez seulement besoin d'un serveur Web de type Apache/Nginx.

- PHP 8.2.12
- HTML
- CSS / Boostrap 5.3
- Javascript

Vous avez également la possibilité de lancer le projet de manière conteneurisé avec Docker, pour cela il vous suffit de vous rendre sur la branche suivante : 

`docker-branch`

Les instructions complémentaires se trouve dans le Readme de cette branche.

## Variables d'envrionnement

Pour exécuter ce projet, vous devrez ajouter les variables d’environnement suivantes à votre fichier **.env.local**.

`API_KEY`

Pour cela il vous suffit de copier/coller le fichier **.env** en **.env.local** et de rajouter la clé API.


## Features

- Sélection d'une ville et d'une date via un formulaire
- Execution d'un appel à l'API Google Air quality pour récupérer les données
- Restitution des données API dans un tableau datatable permetant de filtrer les données



## Dépendances

Les dépendances du projet ont été ajouté via dess CDN pour simplifier au maximum l'execution du projet, l'ajout des dépendances via un package manager serait meilleure.

- [Bootstrap](https://getbootstrap.com/)
- [Datatables](https://datatables.net/)
- [Datepicker Bootstrap](https://bootstrap-datepicker.readthedocs.io/en/latest/)


## Auteur

- [@aubinM](https://github.com/aubinM)




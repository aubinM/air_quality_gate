
# Air Quality Gate

Ce petit projet consiste à récupérer la qualité de l'air de 2 villes sur les 30 derniers jours via l'API Air Quality de Google.

## Variables d'envrionnement

Pour exécuter ce projet, vous devrez ajouter les variables d’environnement suivantes à votre fichier **.env.local**.

`API_KEY`

Pour cela il vous suffit de copier/coller le fichier **.env** en **.env.local** et de rajouter la clé API.

## Installation

Ce projet est une migration du projet précédent vers le Framework Symfony version 7.0.5, pour le lancer vous avez seulement besoin des éléments suivants :

- Installation de PHP 8.2 ou supérieur
- Installation de [Composer](https://getcomposer.org/download/) (< Version 2)
- Installation de [Symfony CLI](https://symfony.com/download) (< Version 5)
- Installation de [NodeJS](https://nodejs.org/en/download) (< Version 20)

Après installation, vérifier que l'installation est correct avec la commande suivante :

````
symfony check:requirements
````

Si la commande retourne [OK], bravo vous avez toutes les exigences technique pour initialiser le projet. Veuillez maintenant procéder à l'initialisation.

Installation des paquets Symfony : 

````
composer install
````

Installation des modules Node : 

````
npm install
````

Compilation des assets node : 

````
npm run dev
````

Installation du certficat d'autorité pour connexion HTTPS : 

````
symfony server:ca:install
````

Lancement du serveur Web Symfony : 

````
symfony serve -d
````

Accéder à l'application avec l'url : 

````
https://localhost:8000
````

Arrêt du serveur Web avec docker : 

````

symfony serve:stop
````


## Features

- Sélection d'une ville et d'une date via un formulaire
- Execution d'un appel à l'API Google Air quality pour récupérer les données
- Restitution des données API dans un graphique hightchart


## Dépendances

Les dépendances du projet ont été ajouté via dess CDN pour simplifier au maximum l'execution du projet, l'ajout des dépendances via le package manager npm serait meilleure.

- [Boostrap](https://getbootstrap.com/)
- [HightChart](https://www.highcharts.com/)
- [Datepicker Bootstrap](https://bootstrap-datepicker.readthedocs.io/en/latest/)


## Auteur

- [@aubinM](https://github.com/aubinM)




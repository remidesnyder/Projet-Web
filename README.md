# 🇫🇷 Projet Web / 🇬🇧 Web project

Voici le repository destiné au "Projet Web", un projet réalisé dans notre école, l'IG2I (Centrale Lille), où le but est de réaliser un site web, en utilisant les différentes méthodes vues en cours, sur un sujet libre. Nous avons choisi de réaliser un site intitulé "MovieList", qui a pour but de permettre à des utilisateurs de se connecter à un compte, et d'y ajouter les films vus, ou à voir, de laisser des commentaires, ou même noter des films. Nous disposons d'un temps imparti pour réaliser ce projet.

## 🇫🇷 Projet : MovieList

Le projet MovieList est une application web permettant à l'utilisateur de créer et de gérer une liste de films. L'utilisateur peut ajouter des films qu'il a vus ou qu'il souhaite voir dans le futur. Il peut également noter les films, donner son acteur préféré et ajouter des commentaires sur les films.

Le système est basé sur une base de données SQL pour stocker les informations sur les films, les utilisateurs et les commentaires. De plus, nous utilisons une API qui nous permet de rechercher les films. L'interface utilisateur est développée en PHP et HTML/CSS, offrant une expérience utilisateur agréable et intuitive.

La MovieList offre également des fonctionnalités de recherche et de tri, permettant aux utilisateurs de trouver facilement des films en fonction de leurs préférences.

## 🇬🇧 Project : MovieList

The MovieList project is a web application that allows users to create and manage a list of movies. Users can add movies they have seen or want to watch in the future. They can also rate the movies, give their favorite actor and add comments about the movies.

The system is based on a SQL database to store information about movies, users, and comments. In addition, we use an API that allows us to search for movies. 
The user interface is developed using PHP and HTML/CSS, providing a pleasant and intuitive user experience.

MovieList also offers search and sorting capabilities, allowing users to easily find movies based on their preferences.

## Charte graphique

| Color             | Hex                                                                |
| ----------------- | ------------------------------------------------------------------ |
| Couleur de Fond | ![#1e1e2a](https://via.placeholder.com/10/1e1e2a?text=+) #1e1e2a |
| Couleur du texte | ![#f1f1f1](https://via.placeholder.com/10/f1f1f1?text=+) #f1f1f1 |
| Couleur Principale | ![#7a3e3e](https://via.placeholder.com/10/7a3e3e?text=+) #7a3e3e |
| Couleur Succès | ![#198754](https://via.placeholder.com/10/198754?text=+) #198754 |
| Couleur Avertissement | ![#ffc107](https://via.placeholder.com/10/ffc107?text=+) #ffc107 |
| Couleur Refus | ![#dc3545](https://via.placeholder.com/10/dc3545?text=+) #dc3545 |


## Variables d'environnement

Pour exécuter ce projet, vous devrez ajouter les variables d'environnement suivantes à votre fichier .env

`API_KEY`


## Comment récupérer une clé API TMDb:

 - Rendez-vous sur le site web de [TMDb](https://www.themoviedb.org/)
 - Créez un compte en cliquant sur "S'inscrire" en haut à droite de la page d'accueil. 
 - Remplissez les champs demandés et cliquez sur "S'inscrire".
 - Une fois que vous avez créé un compte et que vous êtes connecté, cliquez sur votre nom d'utilisateur en haut à droite de la page d'accueil.
 - Dans le menu déroulant, cliquez sur "Paramètres".
 - Dans le menu de gauche, cliquez sur "API".
 - Dans la section "Créer une nouvelle application", donnez un nom à votre application dans le champ "Nom de l'application".
 - Cochez les cases "Accepter les conditions d'utilisation" et "Je ne suis pas un robot".
 - Cliquez sur "Créer".
 - Vous devriez maintenant voir votre clé API TMDb sous la section "Paramètres de l'API". Copiez cette clé pour l'utiliser dans votre code.

Assurez-vous de garder votre clé API TMDb privée et ne la partagez pas avec d'autres personnes.
## Captures d'écran

La page d'accueil en mode connecté
![Page d'accueil](/screenshots/page_d_accueil.png?raw=true "Page d'accueil")

La liste des films populaires
![Page film populaire](/screenshots/film_populaire.png?raw=true "Page film populaire")

La page de recherche
![Page film populaire](/screenshots/recherche.png?raw=true "Page film populaire")

## Démonstration

 - Vidéo de démonstration de la vue sans être connecté : https://youtu.be/dbgBlbG12PM
 - Vidéo de démonstration de la vue de création de compte : https://youtu.be/ZyCfclbmPVw
 - Vidéo de démonstration de la vue en étant connecté : https://youtu.be/d8yNbH_Gwn0
 - Vidéo de démonstration de la vue administrateur : https://youtu.be/lhplJ5nS-NQ

## Fonctionnalités

- Création d'utilisateurs et assignements de rôles
- Ajout par l'utilisateur des films vus, à voir, et de ses films favoris / préférés
- L'utilisateur peut choisir l'acteur qu'il a préféré dans ce film
- Une partie administrateur qui permet de gérer les membres, et notamment de modérer les commentaires qui ont été mis par les membres
- Tableau de bord de l'utilisateur, regroupant le nombre d'heures de films vus, les statistiques sur les acteurs...
- Un accès en mode déconnecté différent de celui en mode connecté


## Langages utilisés

**Client :** HTML, CSS, JavaScript

**Serveur :** PHP, SQL


## Auteurs

- [@RemiDesnyder](https://www.github.com/remidesnyder)
- [@CharlesAugustinVidelaine](https://www.github.com/EnisuVI)


![Logo-IG2I-couleur-RVB](https://user-images.githubusercontent.com/66905063/232838860-f5d11e41-380e-4a44-b00d-0fc4306be969.png)

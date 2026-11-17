# UrbanPulse PHP

Portail d'informations sur la ville de Cergy, développé en PHP.
> **Projet d'apprentissage en cours.** Fin prévue le 10 janvier 2027.
## Contexte

Ce projet est une réécriture en PHP natif d'UrbanPulse, un projet web réalisé en groupe lors de ma première année d'école d'ingénieur à CY Tech.
Mon objectif est d'apprendre PHP en construisant une application complète,
étape par étape.
Dans le projet de groupe, j'avais surtout réalisé la page d'accueil, la recherche et l'interface. Ici, je réécris tout, y compris la partie « serveur » (comptes utilisateurs, base de données, droits d'accès) que je n'avais pas développée moi-même.

## Où j'en suis au départ
 
- **Déjà acquis :** les bases du langage PHP (variables, opérateurs, boucles, tableaux) et la programmation orientée objet, que je pratique déjà en Java.
- **À apprendre dans ce projet :** les formulaires, les sessions, la base de données avec PDO, la sécurité (mots de passe, droits d'accès), les tests automatiques et la création d'une API.
  
## Statut

En cours de développement (commencé en novembre 2026).

## Ce que le site proposera
 
Quatre niveaux d'accès :
 
| Niveau d'accès | Ce qu'il peut faire |
| --- | --- |
| Visiteur (non connecté) | Voir la page d'accueil et chercher des lieux (par quartier, par type) |
| Habitant (inscrit) | S'inscrire, se connecter, modifier son profil, gagner des points |
| Gestionnaire | Gérer des objets connectés et demander leur suppression |
| Administrateur | Valider les inscriptions, gérer les rôles, décider des demandes de suppression, exporter les utilisateurs |
 
À la fin, le site proposera aussi une petite API (un point d'accès qui renvoie des données au format JSON) et trois tests automatiques.

## Fonctionnalités prévues

- [x] Page d'accueil
- [x] Structure commune des pages (header / footer)
- [x] Liste des lieux de la ville (parcs, équipements, services)
- [x] Recherche de lieux
- [ ] Stockage des données en base MySQL (PDO)
- [ ] Inscription, connexion sécurisée et niveaux d'accès
- [ ] Espace habitant (profil, points, membres)
- [ ] Espace gestionnaire (objets connectés)
- [ ] Espace administrateur (validation des inscriptions, export CSV)
- [ ] API JSON et tests automatiques

## Mon plan en 8 phases
 
| Phase | Dates | Objectif |
| --- | --- | --- |
| 1. Bases du web en PHP | 16 au 22 novembre | Formulaires, pages communes (header / footer), recherche avec des données écrites en dur, sessions ; Git et cahier des charges |
| 2. Base de données | 23 au 29 novembre | MySQL avec PDO, requêtes préparées, classes PHP, Composer : accueil et recherche sur une vraie base |
| 3. Connexion et rôles | 30 novembre au 6 décembre | Inscription, connexion sécurisée, pages réservées à chaque niveau d'accès |
| 4. Espace habitant | 7 au 13 décembre | Profil, points, niveaux, liste des membres |
| 5. Espace gestionnaire | 14 au 20 décembre | Gérer les objets connectés et demander leur suppression |
| 6. Administration | 21 au 27 décembre | Valider les inscriptions, décider des demandes, export CSV |
| 7. API, JavaScript, tests | 28 décembre au 3 janvier | Une API JSON, une page qui l'utilise, 3 tests automatiques |
| 8. Finition | 4 au 10 janvier | README final, captures d'écran, nettoyage du code |
 
Les dates sont des repères : si je prends du retard sur une semaine, je décale les suivantes.

## Technologies

- PHP 8
- HTML / CSS
- MySQL
- Prévus plus tard : Composer, PHPUnit (tests), un peu de JavaScript pour la page qui utilise l'API (assistée par IA)


## Lancer le projet en local

Prérequis : PHP 8 installé (`php -v` pour vérifier).

    git clone https://github.com/yas-el05/urbanPulse-php.git
    cd urbanPulse-php
    php -S localhost:8000 -t public

Puis ouvrir http://localhost:8000 dans le navigateur.

## Suivi

Le fichier `journal.md` retrace l'avancement du projet et ce que j'apprends à chaque étape.

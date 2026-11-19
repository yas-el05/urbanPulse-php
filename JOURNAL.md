# Journal de développement – UrbanPulse

## 14 novembre 2026

### Objectifs de la phase 0
- [x] Créer le dépôt GitHub
- [x] Cloner le dépôt sur mon Mac
- [x] Configurer Git dans VS Code
- [x] Créer `public/index.php`
- [x] Installer PHP et Composer
- [x] Tester ma première page PHP
- [x] Faire mon premier commit et push
- [ ] Apprendre les branches et les Pull Requests

## 15 novembre 2026

### Ce que j'ai fait
- Création du README, du `.gitignore` et du journal
- Première page PHP (`public/index.php`) avec des variables et `date()`
- Mise en ligne sur GitHub

### Ce que j'ai compris
- Le code PHP s'exécute sur le serveur : le navigateur ne reçoit que du HTML.

### Difficultés
- Le push était refusé : GitHub n'accepte plus les mots de passe. Résolu avec un token.

## 17 novembre 2026 – Phase 1 : les pages

### Ce que j'ai fait
- Header et footer communs, inclus dans chaque page avec `require`
- Liste des lieux de Cergy à partir d'un tableau PHP
- Page de détail d'un lieu (`lieu.php?id=...`)
- Recherche avec trois filtres : mot-clé, quartier, type
- Mise en forme CSS responsive (mobile d'abord, puis `@media` pour les grands écrans)
- Début de la phase 2 : installation de MySQL, création de la base et de la table des lieux avec des fichiers `.sql`

### Ce que j'ai compris
- Un site web, c'est trois parties : le navigateur (affiche), PHP (prépare la page), MySQL (garde les données).
- `require` colle le contenu d'un fichier ; les variables doivent être définies avant.
- Un paramètre d'URL (`?id=3`) fonctionne comme un argument : une seule page `lieu.php` fabrique la fiche de chaque lieu.
- `$_GET` contient ce qui est dans l'adresse ; il faut toujours le vérifier (`(int)`, `isset`).
- `htmlspecialchars` protège l'affichage contre la faille XSS.
- Dans un `<option>`, `value` est ce qui est envoyé, le texte entre les balises est ce qui est affiché.

### Difficultés
- Confusion entre le mot de passe de `root` et celui de l'utilisateur `urbanpulse`.

## 18 novembre 2026 – Phase 2 : PHP et MySQL

### Ce que j'ai fait
- Fichier de configuration (`config/config.php`, ignoré par Git) et son modèle
- Connexion à MySQL avec PDO (`includes/db.php`)
- Les pages Lieux et Lieu lisent maintenant les données dans la base
- Ajout d'une page Contact dans le menu

### Ce que j'ai compris
- `include` continue si le fichier manque, `require` s'arrête.
- `$titre` s'affiche dans l'onglet du navigateur, `<h1>` dans la page.

## 19 novembre 2026 – Phase 2 : requêtes SQL

### Ce que j'ai fait
- Fiche d'un lieu avec une requête préparée
- Recherche faite par MySQL : requête construite selon les filtres remplis
- Listes déroulantes remplies avec `SELECT DISTINCT`
- Nombre de lieux affiché sur l'accueil avec `COUNT(*)`

### Ce que j'ai compris
- MySQL est un logiciel séparé qui garde les données ; `db.php` ne contient que de quoi s'y connecter.
- PDO est une classe : `new PDO(...)` ouvre la connexion, puis ses méthodes envoient les requêtes.
- `query` pour une requête sans valeur de l'utilisateur ; `prepare` + `execute` dès qu'il y en a une, pour éviter l'injection SQL.
- Les valeurs vont dans `$params`, jamais directement dans la requête. Les `%` du `LIKE` vont dans la valeur.
- `fetchAll` récupère toutes les lignes, `fetch` une seule, `fetchColumn` une seule valeur.
- Utiliser `===` plutôt que `==` pour éviter les conversions automatiques.

### Difficultés
- Construire la requête du mot-clé : guillemets, parenthèses autour du `OR`, espaces au début de chaque morceau.
- Les balises `<?php` et `?>` mal placées.

### Prochaine étape
- Phase 3 : inscription et connexion.
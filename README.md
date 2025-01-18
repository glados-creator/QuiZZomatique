# QuizzOmatique

**QuizzOmatique** est un système de gestion de quizz. Il inclut des fonctionnalités pour gérer les quiz, les utilisateurs et l'importation de quizz depuis un fichier JSON.

## Contributeurs

- Arthur PAVARD
- Clément RENAUDIN

---

## Structure du Projet

Le projet inclut les pages et fonctionnalités suivantes :

1. **Index** : La page d'entrée principale.
2. **Compte** : Gestion des comptes utilisateurs.
3. **Admin** : Tableau de bord admin pour gérer les quiz, les utilisateurs et voir les réponses soumises par les utilisateurs.
4. **Quiz** : Page pour afficher les quiz et permettre aux utilisateurs de répondre.

### Fonctionnalités

- **Gestion des Utilisateurs** : Vous pouvez créer des utilisateurs (utilisateurs normaux et professeurs).
- **Tableau de Bord Admin** : Accessible par les administrateurs, permettant de gérer les quiz, les utilisateurs et de voir les réponses soumises par les utilisateurs.
- **Importation de Quiz** : Les quiz peuvent être importés depuis un fichier JSON via `?action=importQuiz`.
- **Gestion de Session** : L'application utilise des sessions PHP pour stocker les informations des utilisateurs (utilisateurs connectés, statut admin).
- **PDO** : Les interactions avec la base de données sont effectuées en utilisant PDO pour des requêtes SQL sécurisées.
- **Autoloader** : Le chargeur automatique PHP est utilisé pour charger automatiquement les classes.
- **Schéma de la Base de Données** : La structure de la base de données comprend les entités suivantes :
    - **User** : Stocke les informations des utilisateurs.
    - **Quiz** : Stocke les détails des quiz.
    - **Answer** : Stocke les réponses soumises par les utilisateurs aux quiz.

il y a un bug PDO ou php juste ne marche pas 
tester si on a pdo dans php
php -m | grep pdo

on peut importer un quizz.json avec 
php import_json.php --filePath=data/test.json
on peut cree un proffeseur avec 
php import_prof.php --id=ID --email=EMAIL --nom=NOM --prenom=PRENOM --password=PASSWORD
faire tourner le site 
php -S localhost:8080

# Projet de Stage de Ein d'étude : Gestion des Matériels Universitaires


* Description
Ce projet est une application web réalisée en PHP permettant la gestion des matériels au sein d'une université. Elle propose trois niveaux d'accès : Admin, Professeur, et Étudiant.
      - Chaque rôle a des fonctionnalités spécifiques pour gérer les demandes de matériel et suivre les emprunts.


L'authentification basée sur les sessions est un mécanisme courant pour gérer la connexion des utilisateurs dans les applications web. Lorsqu'un utilisateur soumet ses identifiants (généralement un nom d'utilisateur et un mot de passe), le serveur vérifie ces informations en les comparant à celles stockées dans une base de données. Si elles sont correctes, le serveur crée une session unique pour l'utilisateur, identifiée par un identifiant de session (session ID) généré de manière aléatoire.

Cet identifiant est ensuite stocké dans un cookie sur le navigateur de l'utilisateur. À chaque requête ultérieure vers le serveur, le navigateur envoie automatiquement le cookie contenant l'ID de session. Le serveur vérifie cet ID pour identifier l'utilisateur, maintenir son état de connexion, et lui accorder l'accès aux ressources protégées.

Les sessions sont généralement stockées sur le serveur (dans la mémoire ou une base de données), et elles expirent après une certaine période d'inactivité pour des raisons de sécurité. Ce système permet de s'assurer que l'utilisateur reste authentifié sur plusieurs pages de l'application sans avoir à se reconnecter à chaque fois.
  

<img width="960" alt="image" src="https://github.com/user-attachments/assets/91939924-27b1-457f-83ca-9f915b7f02e5">


Fonctionnalités principales :
* Accès administrateur :

Gestion des demandes : L'administrateur peut approuver ou rejeter les demandes de matériels.
Gestion des professeurs : L'administrateur peut ajouter, modifier ou supprimer des comptes de professeur.
Gestion des étudiants : L'administrateur peut ajouter des étudiants en important un fichier CSV contenant toutes les informations des étudiants de l'université. Il peut aussi modifier et supprimer des comptes étudiants.
Suivi des emprunts : L'administrateur peut consulter l'historique des emprunts effectués par les étudiants et professeurs, ainsi que leur état (emprunté, retourné, en retard, etc.).
Génération de rapport PDF : L'administrateur peut générer un rapport en PDF contenant tous les emprunts effectués durant une période définie.
<img width="960" alt="image" src="https://github.com/user-attachments/assets/4864edbb-7091-4fd2-8b86-4ca476cf9fe2">
<img width="960" alt="image" src="https://github.com/user-attachments/assets/27cc7529-60f4-44de-95ac-e891c7655f64">
<img width="785" alt="image" src="https://github.com/user-attachments/assets/af065a57-4449-4a65-b84a-a0f8f1dcd232">
<img width="960" alt="image" src="https://github.com/user-attachments/assets/4b06c966-0d52-495c-ba34-ff9999bbee16">
<img width="960" alt="image" src="https://github.com/user-attachments/assets/55af18ba-4a74-4821-9e67-83c919953263">
<img width="960" alt="image" src="https://github.com/user-attachments/assets/e63d2810-d7fe-4ec8-8ece-3c502109578b">
<img width="721" alt="image" src="https://github.com/user-attachments/assets/22f88ada-ae44-49b8-b220-1da0853e0377">

# Explication des fonctionnalités
* Gestion des demandes :

L'admin voit la liste des demandes d'emprunt. Il peut approuver ou refuser chaque demande en cliquant sur un bouton. L'état de la demande est alors mis à jour dans la base de données.
Gestion des professeurs et étudiants :

L'admin peut gérer les comptes des utilisateurs. Il peut les ajouter, modifier ou supprimer en accédant à des formulaires dédiés.
Suivi des emprunts :

L'admin peut voir une liste des matériels empruntés par les utilisateurs. Cette liste affiche les informations sur l'utilisateur, le matériel, la date de début et de fin de l'emprunt, ainsi que son statut.





* Accès professeur :

Demande de matériel : Les professeurs peuvent soumettre des demandes d'emprunt de matériel pour une période donnée.
Modification de profil : Chaque professeur peut modifier ses informations personnelles telles que le mot de passe et l'adresse email.
<img width="960" alt="image" src="https://github.com/user-attachments/assets/917236d1-1485-4dd2-b704-721dceb620df">
<img width="960" alt="image" src="https://github.com/user-attachments/assets/505d3b84-677b-473f-b060-1034de012d05">
<img width="745" alt="image" src="https://github.com/user-attachments/assets/fc8256b1-c46a-490a-99b0-b5712b2a7c61">


* Accès étudiant :

Consultation du profil : Les étudiants peuvent consulter leurs informations personnelles ainsi que les matériels empruntés et leurs statuts.
Emprunt de matériel : Les étudiants peuvent faire des demandes d'emprunt de matériel sous réserve d'approbation par l'administrateur.

<img width="959" alt="image" src="https://github.com/user-attachments/assets/aad2dcf0-a7e9-4461-9cc3-d9421335c25c">
<img width="960" alt="image" src="https://github.com/user-attachments/assets/8bf20586-2b9a-4b93-8d6d-c94cdb4a4c58">
* Fonctionnalités supplémentaires
Import CSV : Le fichier CSV doit être formaté correctement pour que l'importation réussisse. Assurez-vous que les colonnes correspondent aux champs requis dans la base de données.
Génération PDF : Un bouton est disponible pour générer un rapport des emprunts en format PDF, trié par date et par utilisateur.




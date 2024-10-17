# Gestion des Matériels Universitaires

* Description
  
Ce projet est une application web réalisée en PHP permettant la gestion des matériels au sein d'une université. Elle propose trois niveaux d'accès : Admin, Professeur, et Étudiant. Chaque rôle a des fonctionnalités spécifiques pour gérer les demandes de matériel et suivre les emprunts.

Fonctionnalités principales :
* Accès administrateur :

Gestion des demandes : L'administrateur peut approuver ou rejeter les demandes de matériels.
Gestion des professeurs : L'administrateur peut ajouter, modifier ou supprimer des comptes de professeur.
Gestion des étudiants : L'administrateur peut ajouter des étudiants en important un fichier CSV contenant toutes les informations des étudiants de l'université. Il peut aussi modifier et supprimer des comptes étudiants.
Suivi des emprunts : L'administrateur peut consulter l'historique des emprunts effectués par les étudiants et professeurs, ainsi que leur état (emprunté, retourné, en retard, etc.).
Génération de rapport PDF : L'administrateur peut générer un rapport en PDF contenant tous les emprunts effectués durant une période définie.
Accès professeur :

Demande de matériel : Les professeurs peuvent soumettre des demandes d'emprunt de matériel pour une période donnée.
Modification de profil : Chaque professeur peut modifier ses informations personnelles telles que le mot de passe et l'adresse email.
Accès étudiant :

Consultation du profil : Les étudiants peuvent consulter leurs informations personnelles ainsi que les matériels empruntés et leurs statuts.
Emprunt de matériel : Les étudiants peuvent faire des demandes d'emprunt de matériel sous réserve d'approbation par l'administrateur.

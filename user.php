<?php
session_start();
include("modele/Connexion.php");

if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
    $email = $_POST['email'];
    $mdp = $_POST['pwd'];

    // Créer une instance de la classe Connexion
    $connexion = new Connexion();
    $pdo = $connexion->getPDO();

    // Requête SQL pour vérifier la connexion de l'administrateur
    $sql = "SELECT * FROM admin WHERE email = :email AND mdp = :mdp";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->execute();

    // Vérifier si la connexion est réussie pour l'administrateur
    if ($stmt->rowCount() > 0) {
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin'] = $admin['id_admin']; // Stocker l'ID de l'administrateur dans la session
        header("Location: admin.php"); // Rediriger vers la page admin.php
        exit();
    }

    // Requête SQL pour vérifier la connexion de l'étudiant
    $sql = "SELECT * FROM etudiant WHERE  email = :email AND mdp = :mdp";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->execute();

    // Vérifier si la connexion est réussie pour l'étudiant
    if ($stmt->rowCount() > 0) {
        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['etudiant'] = $etudiant['id_etudiant']; // Stocker l'ID de l'étudiant dans la session
        header("Location: etudiant.php"); // Rediriger vers la page etudiant.php
        exit();
    }


    // Requête SQL pour vérifier la connexion du professeur
    $sql = "SELECT * FROM prof WHERE email = :email AND mdp = :mdp";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->execute();

    // Vérifier si la connexion est réussie pour le professeur
    if ($stmt->rowCount() > 0) {
        $professeur = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['prof'] = $professeur['id_prof']; // Stocker l'ID du professeur dans la session
        header("Location: prof.php"); // Rediriger vers la page profil.php
        exit();
    }


    // Redirection vers la page d'accueil si la connexion échoue
    header("Location: index.php");
    exit();
}
?>

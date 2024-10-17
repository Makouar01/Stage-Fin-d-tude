<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esto";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer l'ID depuis la requête GET
$id = $_GET['id'];


// Mettre à jour la base de données avec la valeur "Emprunté" et la date d'emprunt
$query = "UPDATE demande SET emprunter = 1, date_emprunt = NOW() WHERE id = $id";
$result = $conn->query($query);

if ($result) {
  // Récupérer les informations de la demande
  $selectQuery = "SELECT * FROM demande WHERE id = $id";
  $selectResult = $conn->query($selectQuery);
  
  if ($selectResult->num_rows > 0) {
    $row = $selectResult->fetch_assoc();
    $quantiteDemande = $row['qauntit'];
    $nomMateriel = $row['nom_materiel'];
    
    // Mettre à jour la quantité dans la table materiel
    $updateQuery = "UPDATE materiel SET quantite = quantite- $quantiteDemande, quantite_e = quantite_e + $quantiteDemande WHERE nom_materiel = '$nomMateriel'";
    $updateResult = $conn->query($updateQuery);
    

  }
  
  header("Location: demande.php");
} else {
  echo "Erreur lors de l'emprunt : " . $conn->error;
}



?>

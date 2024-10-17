<?php

session_start();
if (isset($_SESSION['prof'])){

?>



<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css" />
  <link rel="shortcut icon" href="" />
  <link rel="stylesheet" href="CSS/theme.css" />
  <link rel="stylesheet" href="CSS/esto.css" />
  <title>ESTO</title>
</head>

<body>



  <div class="jumbotron">
    <div class="col-lg-8">
      <a href="http://esto.ump.ma/"><span class="ESTO-logo">ESTO UMP<span class="dot"></span></span></a>
    </div>
    <div class="col-lg-4">
      <div id="logoright">Gestion des Matériels</div>
    </div>
  </div>
  <div class="col-lg-6">
    <ul class="nav nav-pills">

        <li ><a href="prof.php">Matériels</a></li>
        <li class="active"><a href="etudiant3.php">Étudiant</a></li>


    </ul>
  </div>
  <div>
  <form action="deconnexion.php">

    <button class = "logout-button" ><table class="table-responsive" >Deconnexion</table></button>
    </form>
  </div>
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

// Requête SQL pour sélectionner les données du tableau
$sql = "SELECT * FROM etudiant";
$result = $conn->query($sql);

// Création du tableau HTML
echo " <div class='col-lg-12'>
<h3 class = 'active'>Liste des étudiantes</h3>

<div class='table-responsive'>
  <table class='table table-striped table-bordered table-hover'>
    <thead>
      <tr>
        <th>Nom et Prénom</th>
        <th>CNE</th>
        <th>Filière </th>
        <th>Matériel</th>
        <th>Date de prend le matériel</th>

        
";
if ($result->num_rows > 0) {
    // Parcourir les données et ajouter chaque ligne au tableau HTML
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["nom_etudiant"]."</td><td>".$row["cne"]."</td><td>".$row["filier"]."</td><td>".$row["materiel_prend"]."</td><td>".$row["date_prend_materiel"]."</td></tr>";


    }
} else {
    echo "<tr><td colspan='5'>Aucun résultat trouvé</td></tr>";
}
}
else{
  header('Location:index.php');
}
?>

      

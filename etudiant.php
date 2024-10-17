<?php

session_start();
if (isset($_SESSION['etudiant']))
{

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
<?php
  
?>

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
        <li class="active"><a href="etudiant.php">Matériels</a></li>
        <li><a href="profil.php">Profil</a></li>    

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
$sql = "SELECT * FROM materiel WHERE sup=1";
$result = $conn->query($sql);

// Création du tableau HTML
echo " <div class='col-lg-12'>
<h3  id='logoright'>Matériels disponibles</h3>

<div class='table-responsive'>
  <table class='table table-striped table-bordered table-hover'>
    <thead>
      <tr>
        <th>Matériel</th>
        <th>Description</th>
        <th>Marque</th>
        <th>Quantité</th>
        <th>Demander</th>
        
";
if ($result->num_rows > 0) {
    // Parcourir les données et ajouter chaque ligne au tableau HTML
    while($row = $result->fetch_assoc()) {
        ?>
      <tr>
      <td><?=$row['nom_materiel']?></td>
      <td><?=$row['description']?></td>
      <td><?=$row['marque']?></td>

      <td><?=$row['quantite']?></td>

        <td><a href="rempli_demande1.php?id=<?=$row['id']?>"><img src='IMG/demande.png' width='45'></a></td>
                </tr>
                <?php


    
  }
} else {
  ?>
    <tr><td colspan='5'>Aucun résultat trouvé</td></tr>

    <?php
}
?>
    </table>
    
    </div>
</br></br></br></br></br></br>
</br></br></br>
</br></br></br>

    <div class="col-lg-12">
    <footer class="footer">
      <?php include('composant/footer.php'); ?>
    </footer>
  </div>
  <?php

}else{
  header('location:index.php');
}
?>

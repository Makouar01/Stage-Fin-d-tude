<?php

session_start();
if (isset($_SESSION['admin'])){



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

        <li><a href="etudiant2.php">Étudiant</a></li>
        <li><a href="prof2.php">Enseignant</a></li>
        <li class="active"><a href="admin.php">Matériels</a></li>
        <li><a href="demande.php">Demande</a></li>
        <li><a href="suiver.php">Emprunts</a></li>

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
$sql = "SELECT * FROM materiel WHERE sup = 1 AND quantite > 0";
$result = $conn->query($sql);
?>
<!-- Création du tableau HTML-->
<div class='col-lg-12'>
<h3  id="logoright">Matériels disponibles</h3>


<div class='table-responsive'>
  <table class='table table-striped table-bordered table-hover'>
    <thead>
      <tr>
        <th>Matériel</th>
        <th>Description</th>
        <th>Quantité disponibles</th>
        <th>Quantité Empruntée</th>
        <th>Marque</th>
        <th>Action</th>
        <th>Empruntée</th>
<?php
        

if ($result->num_rows > 0) {
    // Parcourir les données et ajouter chaque ligne au tableau HTML
    while($row = $result->fetch_assoc()) {

      ?>
      <tr>
      <td><?=$row['nom_materiel']?></td>
      <td><?=$row['description']?></td>
      <td><?=$row['quantite']?></td>
      <td><?=$row['quantite_e']?></td>

      <td><?=$row['marque']?></td>

      <!--Nous alons mettre l'id de chaque employé dans ce lien -->

      <td><a href="modifier.php?id=<?=$row['id']?>"><img src="IMG/pen.png" width="25"></a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <a onclick="return confirm('êtes-vous sûr de vouloir supprimer ce matériel')" href="supprimer.php?id=<?=$row['id']?>"><img src="IMG/trash.png" width="25"></a></td>
    <td>
     <a href="em_pro.php?id=<?=$row['id']?>"> <button  class="green-button">Professeur</button></a>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <a href= "em_etu.php?id=<?=$row['id']?>" >  <button  class="green-button">Etudiant</button></td></a>
  </tr>
<?php
      }}else {
        ?>
          <tr><td colspan='7'>Aucun résultat trouvé</td></tr>
          <?php
      }
     
    




echo "</td>
</thead>
</table>


</div>
<div class='col-lg-6'>
<ul class='nav nav-pills'>


    <li><a href='add_materiel.php'>Ajouter un Materiél</a></li>

    </br>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>


    

</ul>
</div>
</div>";
?>
<div class='col-lg-12'>
<footer class='footer'>
  <?php include('composant/footer.php'); ?>
</footer>
</div>
<?php

// Fermeture de la connexion
$conn->close();
?>
<?php

}else{
  header('location:index.php');
}
?>
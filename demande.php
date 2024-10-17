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
<script>

  function emprunter(id) {
    var button = document.getElementById('btnEmprunter' + id);
    button.innerHTML = 'Déjà emprunté';
    button.disabled = true;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Action à effectuer lorsque la requête est réussie
        alert(this.responseText);
      }
    };
    xhttp.open("GET", "emprunter.php?id=" + id, true);
    xhttp.send();
  }
</script>



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
        <li><a href="admin.php">Matériels</a></li>
        <li class = "active"><a href="demande.php">Demande</a></li>
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
$sql = "SELECT * FROM demande";
$result = $conn->query($sql);
?>

<!-- Création du tableau HTML-->
<div class='col-lg-12'>
<h3  id="logoright"> Liste des demandes</h3>


<div class='table-responsive'>
  <table class='table table-striped table-bordered table-hover'>
    <thead>
      <tr>
        <th>Nom et prénom</th>
        <th>CNI</th>
        <th>Nom de Matériel</th>
        <th>Quantité</th>
        <th>Date de demande le Matériel</th>
        <th>Empruntée</th>
        <th>Supprimer</th>
<?php
        

if ($result->num_rows > 0) {
    // Parcourir les données et ajouter chaque ligne au tableau HTML
    while($row = $result->fetch_assoc()) {
      if ($row['sup']) {

      ?>
      <tr>
      <td><?=$row['nom_user']?></td>
      <td><?=$row['cni_user']?></td>
      <td><?=$row['nom_materiel']?></td>
      <td><?=$row['qauntit']?></td>
      <td><?=$row['date_demande']?></td>
     <!-- Ajoutez ce code à l'endroit approprié dans votre tableau HTML -->
<td>
  <?php
    if ($row['emprunter'] == 1) {
      echo "<p style='color:green;'>Bien emprunté";
    } else {
  
      // Vérifier si la quantité demandée est disponible dans le tableau materiel
      $materiel = $row['nom_materiel'];
      $quantiteDemandee = $row['qauntit'];
      $sql2 = "SELECT quantite FROM materiel WHERE nom_materiel='$materiel'";
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        $quantiteDisponible = $row2['quantite'];
        if ($quantiteDemandee <= $quantiteDisponible) {
          echo "<a href='emprunter.php?id=".$row['id']."' ><div style='text-align: center;'>
                <button style='background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 4px;'>Emprunter</button>
              </div></a>";
        } else {
          ?>
          <p style = 'color:red;'><?= $quantiteDisponible?> piéce disponible. </p>
          <?php
        }
      } 
    }
  ?>
</td>



      <!--Nous alons mettre l'id de chaque employé dans ce lien -->


      
      <td><a onclick="return confirm('êtes-vous sûr de vouloir supprimer ce Demande')" href="supprimer1.php?id=<?=$row['id']?>"><img src="IMG/trash.png" width="25"></a></td>
  </tr>
<?php
      
      
  }
}
}

echo "</td>
</thead>
</table>
</div>
";

?>



    </br>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    </br></br></br></br>
    
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
}
else{
  header('location:index.php');
}
?>

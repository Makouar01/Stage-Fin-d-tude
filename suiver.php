<?php
session_start();
if (isset($_SESSION['admin'])) {
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
      <li><a href="demande.php">Demande</a></li>
      <li class="active"><a href="suiver.php">Emprunts</a></li>

    </ul>
  </div>
  <div>
    <form action="deconnexion.php">
      <button class="logout-button">
        <table class="table-responsive">Deconnexion</table>
      </button>
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
  $sql = "SELECT * FROM demande WHERE emprunter = 1";
  $result = $conn->query($sql);
  ?>

  <!-- Création du tableau HTML-->
  <div class='col-lg-12'>
    <div class='table-responsive'>

      <h3 id="logoright"> Liste des Empruntes effectués</h3>


      <table class='table table-striped table-bordered table-hover'>
        <thead>
          <tr>
            <th>Nom et prénom</th>
            <th>CNI</th>
            <th>Nom de Matériel</th>
            <th>Quantité</th>
            <th>Date d'Emprunt</th>
            <th>Restauré</th>
          </tr>
        </thead>
        <tbody>

          <?php
          if ($result->num_rows > 0) {
            // Parcourir les données et ajouter chaque ligne au tableau HTML
            while ($row = $result->fetch_assoc()) {
              $dateEmprunt = strtotime($row['date_emprunt']);
              $now = time();
              $diff = $now - $dateEmprunt;
              $oneMonth = 30 * 24 * 60 * 60; // 1 mois en secondes
              $nineMonths = 9 * 30 * 24 * 60 * 60; // 9 mois en secondes

              echo "<tr";

              if ($diff >= $oneMonth && $row['cni_user'] == "etudiante") {
                // Date d'emprunt dépassée d'1 mois pour une étudiante
                echo " style='color: red;'";
              } elseif ($diff >= $nineMonths && $row['cni_user'] == "prof") {
                // Date d'emprunt dépassée de 9 mois pour un professeur
                echo " style='color: red;'";
              }
              echo ">";
              echo "<td>" . $row['nom_user'] . "</td>";
              echo "<td>" . $row['cni_user'] . "</td>";
              echo "<td>" . $row['nom_materiel'] . "</td>";
              echo "<td>" . $row['qauntit'] . "</td>";
              echo "<td>" . $row['date_emprunt'] . "</td>";

              echo "<td>";
              if ($row['date_r'] == null) {
                echo "<a href='rs.php?id=" . $row['id'] . "'><button class='btn btn-success' value='Restaurer'>Restaurer</button></a>";
              } else {
                echo "<p style='color:blue';>Restaurer le " . $row['date_r']."</p>";
              }
              echo "</td>";

              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
      <form method="post" action="generer_rapport.php">
    <button type="submit" name="telecharger_rapport" class="btn btn-primary">Télécharger rapport</button>
  </form>      </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

    </div>
  </div>


  </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

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
} else {
  header('location:index.php');
}
?>

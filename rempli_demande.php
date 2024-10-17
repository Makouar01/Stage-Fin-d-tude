<?php
session_start();
if(isset($_SESSION['prof'])){
  include('modele/esto.php');

  // Vérifier la connexion à la base de données
  $con = mysqli_connect("localhost", "root", "", "esto");
  if (!$con) {
    echo "Vous n'êtes pas connecté à la base de données";
    exit(); // Arrêter l'exécution du script si la connexion échoue
  }
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
      <li><a href="prof.php">Retour</a></li>
      <li><a href="profil1.php">Profil</a></li>
    </ul>
  </div>
  <div>
    <form action="deconnexion.php">
      <button class="logout-button"><table class="table-responsive">Deconnexion</table></button>
    </form>
  </div>

  <?php
  if (!empty($_POST['nom_materiel']) && !empty($_POST['quantite'])) {
    $demande = new demande();
    try {
      $idMateriel = $_POST['id_materiel'];
      $idprof = $_SESSION['prof'];
      $prof = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM prof WHERE id_prof = $idprof"));
      $demande->rempli_demandeP($prof['nom_prof'], $prof['cni'], $_POST['nom_materiel'], $row['marque_materiel'], $_POST['quantite']);
      header("location: prof.php");
      exit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  $con = mysqli_connect("localhost", "root", "", "esto");
  if (!$con) {
    echo "Vous n'êtes pas connecté à la base de données";
  }

  // On vérifie si la clé 'id' existe dans $_GET
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête pour afficher les informations d'un Matériel
    $req = mysqli_query($con, "SELECT * FROM materiel WHERE id = $id");
    $row = mysqli_fetch_assoc($req);
    $profid = $_SESSION['prof'];
    $prof = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM prof WHERE id_prof = $profid"));
  } else {
    // Gérer le cas où la clé 'id' n'existe pas
    echo "L'identifiant du matériel n'est pas spécifié.";
    exit(); // Arrêter l'exécution du script
  }
  ?>
  <h1></h1></br>
  <h3 id="logoright">Demander le Matériel :<?= $row['nom_materiel'] ?> </h3>

  <fieldset>
    <form action="rempli_demande.php" method="post">
      <input type="hidden" name="id_materiel" value="<?php echo $id; ?>">
      <table class="login_table">
        <tr>
          <td>Nom de matériel</td>
          <td><input value="<?php echo $row['nom_materiel']; ?>" type="text" name="nom_materiel" readonly></td>
        </tr>
        <tr>
        

        <tr>
          <td>Quantité</td>
          <td><input value=1  type="number" name="quantite" min= 1 max="<?php echo $row['quantite']; ?>"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Demander le matériel" name="button"></td>
        </tr>
        <tr>
          <td></td>
          <td></br></br></br></td>
        </tr>
      </table>
    </form>
  </fieldset>

  </br>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    </br></br></br>
    <div class='col-lg-12'> 
<footer class='footer'>
  <?php include('composant/footer.php'); ?>
</footer>
</div>
  <?php
} // Fermeture de la condition if(isset($_SESSION['prof']))
?>
</body>
</html>

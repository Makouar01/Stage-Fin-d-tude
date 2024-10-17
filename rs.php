<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

$con = mysqli_connect("localhost", "root", "", "esto");
if (!$con) {
    echo "Vous n'êtes pas connecté à la base de données";
    exit;
}

// on récupère l'id dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $req = mysqli_query($con, "SELECT * FROM demande WHERE id = $id");

    // Vérifier si une demande correspond à l'id spécifié
    if ($row1 = mysqli_fetch_assoc($req)) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dateRestauration = $_POST["date_r"];

            // Mettre à jour la table demande avec la date de restauration
            $updateQuery = "UPDATE demande SET date_r = '$dateRestauration' WHERE id = $id";
            if (mysqli_query($con, $updateQuery)) {
                // Mise à jour des quantités dans la table materiel
                $updateQuantitiesQuery = "UPDATE materiel SET quantite = quantite + {$row1['qauntit']}, quantite_e = quantite_e - {$row1['qauntit']} WHERE nom_materiel = '{$row1['nom_materiel']}'";
                if (mysqli_query($con, $updateQuantitiesQuery)) {
                    echo "Le matériel a été restauré avec succès.";
                    header("Location: suiver.php");
                } else {
                    echo "Erreur lors de la mise à jour de la table materiel: " . mysqli_error($con);
                }
            } else {
                echo "Erreur lors de la mise à jour de la table demande: " . mysqli_error($con);
            }
        }
    } else {
        echo "Aucune demande correspondant à cet identifiant.";
        exit;
    }
} else {
    echo "L'identifiant de la demande n'a pas été spécifié.";
    exit;
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
            <li><a href="etudiant2.php">Étudiant</a></li>
            <li><a href="prof2.php">Enseignant</a></li>
            <li><a href="admin.php">Matériels</a></li>
            <li><a href="demande.php">Demande</a></li>
            <li><a href="suiver.php">Emprunts</a></li>

        </ul>
    </div>
    <div>
        <form action="deconnexion.php">
            <button class="logout-button">
                <table class="table-responsive">Déconnexion</table>
            </button>
        </form>
    </div>
    <form action="rs.php?id=<?= $id ?>" method="post">
        <div class='col-lg-12'>
            <h3 id="logoright">Restaurer le Matériel : <?= $row1['nom_materiel'] ?> </h3>

            <table class="login_table">
                <tr>
                    <td>Nom et prénom :</td>
                    <td><input disabled value="<?= $row1['nom_user'] ?>" type="text" name="nom" id="nom"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>CNI :</td>
                    <td><input disabled value="<?= $row1['cni_user'] ?>" type="text" name="nom" id="nom"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Quantité :</td>
                    <td><input disabled value="<?= $row1['qauntit'] ?> " type="text" name="quantit" id="quantit"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Date de Restauration :</td>
                    <td> <input type="date" id="date_r" name="date_r" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-success" name="restaurer" value="Restaurer">Restaurer</button></td>
                </tr>
            </table>

        </div>
    </form>
</body>

</html>
</br></br></br></br></br></br>
</br></br></br>
</br></br></br>

    <div class="col-lg-12">
    <footer class="footer">
      <?php include('composant/footer.php'); ?>
    </footer>
  </div>

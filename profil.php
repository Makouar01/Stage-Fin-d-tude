<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant que professeur
if (isset($_SESSION['etudiant'])) {
    // Inclure le fichier de connexion à la base de données
    include('modele/Connexion.php');
    
    // Récupérer l'ID du professeur connecté depuis la session
    $etudiantid = $_SESSION['etudiant'];
    
    // Créer une instance de la classe Connexion
    $connexion = new Connexion();
    $pdo = $connexion->getPDO();
    
    // Vérifier si le formulaire de modification a été soumis
    if (isset($_POST['button1'])) {
        // Récupérer les valeurs du formulaire
        $nom_etudiant = $_POST['nom_etudiant'];

        $email = $_POST['email'];
        
        // Requête SQL pour mettre à jour les informations du professeur
        $sql = "UPDATE etudiant SET nom_etudiant = :nom,  email = :email WHERE id_etudiant = :etudiantid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom_etudiant);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':etudiantid', $etudiantid);
        
        // Exécuter la requête de mise à jour
        if ($stmt->execute()) {
            echo "Les informations ont été mises à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour des informations.";
        }
    }
    
    // Vérifier si le formulaire de modification du mot de passe a été soumis
    if (isset($_POST['button2'])) {
        // Récupérer les valeurs du formulaire
        $mot_de_passe_actuel = $_POST['mot_de_passe_actuel'];
        $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
        $confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'];
        
        // Requête SQL pour récupérer le mot de passe actuel du professeur
        $sql = "SELECT mdp FROM etudiant WHERE id_etudiant = :etudiantid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':etudiantid', $etudiantid);
        $stmt->execute();
        
        // Vérifier si le professeur existe et si le mot de passe actuel est correct
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $mdp_actuel = $result['mdp'];
            
            if ($mdp_actuel === $mot_de_passe_actuel) {
                // Vérifier si le nouveau mot de passe correspond à la confirmation
                if ($nouveau_mot_de_passe === $confirmer_mot_de_passe) {
                    // Requête SQL pour mettre à jour le mot de passe du professeur
                    $sql = "UPDATE etudiant SET mdp = :motDePasse WHERE id_etudiant = :etudiantid";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':motDePasse', $nouveau_mot_de_passe);
                    $stmt->bindParam(':etudiantid', $etudiantid);
                                    // Exécuter la requête de mise à jour
                if ($stmt->execute()) {
                    echo "Le mot de passe a été modifié avec succès.";
                } else {
                    echo "Erreur lors de la modification du mot de passe.";
                }
            } else {
                echo "Le nouveau mot de passe ne correspond pas à la confirmation.";
            }
        } else {
            echo "Le mot de passe actuel est incorrect.";
        }
    } else {
        echo "Erreur lors de la récupération du mot de passe actuel.";
    }
}

// Requête SQL pour récupérer les informations du professeur
$sql = "SELECT * FROM etudiant WHERE id_etudiant = :etudiantid";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':etudiantid', $etudiantid);
$stmt->execute();

// Vérifier si le professeur existe
if ($stmt->rowCount() > 0) {
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    
    <!DOCTYPE html>
    <html>
    
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet"  href="CSS/bootstrap/css/bootstrap.min.css" />


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
          <li><a href="prof.php">Matériels</a></li>
          <li class="active"><a href="profil1.php">profil</a></li>
    
        </ul>
      </div>
      <div>
        <form action="deconnexion.php">
          <button class="logout-button"><table class="table-responsive">Deconnexion</table></button>
        </form>
      </div>
      <div class="col-lg-6">
        <div class='col-lg-12'>
          <h1 id="logoright">Vos Informations</h1>
          <fieldset>
            <form action="" method="post">
              <table class="login_table">
                <tr>
                  <td>Nom et prénom :</td>
                  <td><input value="<?= $etudiant['nom_etudiant'] ?>" type="text" name="nom_etudiant"></td>
                </tr>
                <tr>
                  <td>CNI :</td>
                  <td><input disabled value="<?= $etudiant['cni'] ?>" type="text" name="cni"></td>
                </tr>
                <tr>
                  <td>CNE :</td>
                  <td><input disabled value="<?= $etudiant['cne'] ?>" type="text" name="cne"></td>
                </tr>
                <tr>
                  <td>Email :</td>
                  <td><input value="<?= $etudiant['email'] ?>" type="text" name="email"></td>
                </tr>
        <tr>
                  <td></td>
                  <td>
                    <input type="submit" value="Modifier" name="button1">
                   <input type="submit" value="Modifier Mot de passe" onclick="showPasswordForm()" id="btn-password">
                  </td>
                </tr>
              </table>
            </form>
          </fieldset>
    
          <div id="password-form" style="display: none;">
            <form action="" method="post">
              <table class="login_table">
                <tr>
                  <td>Mot de passe actuel :</td>
                  <td><input type="password" name="mot_de_passe_actuel"></td>
                </tr>
                <tr>
                  <td>Nouveau Mot de passe :</td>
                  <td><input type="password" name="nouveau_mot_de_passe"></td>
                </tr>
                <tr>
                  <td>Confirmer le nouveau Mot de passe:</td>
                  <td><input type="password" name="confirmer_mot_de_passe"></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" value="Modifier Mot de passe" name="button2">
                  </td>
                </tr>
              </table>
            </form>
          </div>
          <script>
            function showPasswordForm() {
              var passwordForm = document.getElementById("password-form");
              var btnPassword = document.getElementById("btn-password");

              passwordForm.style.display = "block";
              btnPassword.disabled = true;
            }
          </script>
        </div>
      </div>
    </body>
    </html>
    </br>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    </br></br></br></br></br></br></br></br></br></br></br>
<div class='col-lg-12'>
<footer class='footer'>
  <?php include('composant/footer.php'); ?>
</footer>
</div>
    
    <?php
}
}
else{
  header('Location: index.php');
}
?>



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
        <li><a href="admin.php">Matériels</a></li>
        <li><a href="demande.php">Demande</a></li>
        <li><a href="suiver.php">Emprunts</a></li>


    </ul>
  </div>
  <?php
  
         //connexion à la base de donnée
         $con = mysqli_connect("localhost","root","","esto");
         if(!$con){
            echo "Vous n'êtes pas connecté à la base de donnée";
         }
         //on récupère le id dans le lien
          $id = $_GET['id'];
          //requête pour afficher les infos d'un Matériel
          $req = mysqli_query($con , "SELECT * FROM prof WHERE id_prof = $id");
          $row = mysqli_fetch_assoc($req);


       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($nom_prof) && isset($cni) && isset($departement)){
               //requête de modification
               $req = mysqli_query($con, "UPDATE prof SET nom_prof = '$nom_prof' , cni = '$cni' , departement = '$departement'  WHERE id_prof = $id");
                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: prof2.php");
                }else {//si non
                    $message = "Les information du prof non modifié";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
       ?>
       <h1></h1></br>
        <h3 id="logoright">Modifier les information du professeur  :<?=$row['nom_prof']?> </h3>
        
        <?php 
              if(isset($message)){
                  echo $message ;
              }
           ?>
       <fieldset>
  <form action="" method="post">
		<table class="login_table">
        

        <tr>
 
		<td>Nom et prénom :</td>
		<td><input value="<?=$row['nom_prof']?>" type="text" name="nom_prof" ></td>
		</tr>
		<tr>
		<td>CNI :</td>
		<td><input value="<?=$row['cni']?>" type="text" name="cni"    ></td>
		</tr>
        <tr>
    <td>Departement :</td>
    <td>
                    <select name="departement" value="<?= $row['departement'] ?>">
                      <option value="Génie Informatique" <?php if ($row['departement'] == 'Génie Informatique') echo 'selected'; ?>>Génie Informatique</option>
                    <option value="Génie Appliqué" <?php if ($row['departement'] == 'Génie Appliqué') echo 'selected'; ?>>Génie Appliqué</option>
            </select>
        </td>
        </tr>
            <td></td>

		<td><input type="submit" value="Modifier" name="button">
		</tr>
    <td></td></br>
</br>
</br>
		</table>
	</form>
  </fieldset>
  <div class="col-lg-12">
    <footer class="footer">
      <?php include('composant/footer.php'); ?>
    </footer>
  </div>
  <?php
}
else{
  header('location:index.php');
}
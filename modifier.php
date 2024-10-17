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

        <li><a href="admin.php">Retour</a></li>
        <li><a href="add_materiel.php">Ajouter un matériel</a></li>

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
          $req = mysqli_query($con , "SELECT * FROM materiel WHERE id = $id");
          $row = mysqli_fetch_assoc($req);


       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($nom_materiel) && isset($description) && isset($marque) &&$quantite){
               //requête de modification
               $req = mysqli_query($con, "UPDATE materiel SET nom_materiel = '$nom_materiel' , description = '$description' , marque = '$marque' ,quantite ='$quantite' WHERE id = $id");
                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: admin.php");
                }else {//si non
                    $message = "Matériel non modifié";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
       ?>
       <h1></h1></br>
        <h3 id="logoright">Modifier le Matériel :<?=$row['nom_materiel']?> </h3>
        
        <?php 
              if(isset($message)){
                  echo $message ;
              }
           ?>
       <fieldset>
  <form action="" method="post">
		<table class="login_table">
        

        <tr>
 
		<td>Nom de matériel</td>
		<td><input value="<?=$row['nom_materiel']?>" type="text" name="nom_materiel" ></td>
		</tr>
		<tr>
		<td>Description</td>
		<td><input value="<?=$row['description']?>" type="text" name="description"    ></td>
		</tr>
    <td>Marque</td>
		<td><input value="<?=$row['marque']?>" type="text" name="marque"  ></td>
		</tr>
    
    <td>Quantité</td>
		<td><input value="<?=$row['quantite']?>" min = 1 type="number" name="quantite"    ></td>
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
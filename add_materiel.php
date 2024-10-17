<?php
session_start();


if(isset($_SESSION['admin'])){ 
include("modele/esto.php");


if(!empty($_POST['nom']) AND !empty($_POST['description']) AND !empty($_POST['quantite']) AND !empty($_POST['marque'])){

  $materiel=new materiel();
    try
    {
        if(1)
        {
            $materiel->add_materiel($_POST['nom'],$_POST['description'],$_POST['quantite'],$_POST['marque']);
            header("location: admin.php");
        }

    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
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
  <fieldset>
  <form action="add_materiel.php" method="post">
		<table class="login_table">
        <td></td>
        <div class="col-lg-6">
        <td><h3 id="logoright" >Ajouter un Matériel</h3></td>
        </div>
        <td></td>
        <tr>
		<td>Nom de matériel</td>
		<td><input type="text" name="nom" id="nom" placeholder="Nom du matériel" required></td>
		</tr>
		<tr>
		<td>Description</td>
		<td><input type="text" name="description" id="description"  placeholder="Description" required></td>
		</tr>
    <td>Marque</td>
		<td><input type="text" name="marque" id="marque"   placeholder="Marque" required></td>
		</tr>
    
    <td>Quantité</td>
		<td><input type="number" min = 1 name="quantite" id="quantite"   placeholder="Quantité" required></td>
		</tr>

		
	
		<td></td>
		<td><input type="submit" value="Ajouter un materiél"/>
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
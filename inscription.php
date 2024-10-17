<?php
session_start();
if (isset($_SESSION['admin'])){


include("modele/esto.php");




if(!empty($_POST['nom']) AND !empty($_POST['cne']) AND !empty($_POST['cni'])AND !empty($_POST['filier'])AND !empty($_POST['annee'])){

  $etudiant=new etudiant();
    try
    {
        if(1)
        {
            $etudiant->add_etudiant($_POST['nom'],$_POST['annee'],$_POST['cne'],$_POST['cni'],$_POST['filier']);
            header("Location :etudiant2.php");
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
<link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" href="CSS/theme.css"/>
  <link rel="shortcut icon" href="" />
  <link rel="stylesheet" href="CSS/theme.css" />
  <link rel="stylesheet" href="CSS/esto.css" />
<script type="text/javascript"></script>
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

      <li class="active"><a href="inscription.php">Ajouter un étudiant</a></li>
 
      
      <li><a href="etudiant2.php" >Retour</a></li>
      
  </ul>
</div>
<div>
  <form action="deconnexion.php">

    <button class = "logout-button" ><table class="table-responsive" >Deconnexion</table></button>
    </form>
  </div>





<div class="col-lg-6">
 <div id="iscri">


    </div> 
</div>

<div class="row">



  <div class="col-lg-12">




<div class="panel panel-success panel1" >
  <div class="panel-heading">Remplie les information de l'étudiant</div>
  <div class="panel-body">
    <fieldset>
	<legend><b>  Ajouter liste des étudiantes par un fichier csv à la bas de la page</b></legend>


  <form action="inscription.php" method="post">
		<table class="login_table">
    <tr>
		<td>Nom et prénom<span>*</span></td>
		<td><input type="text" name="nom" id="nom" placeholder="Nom et prénom" required></td>
		</tr>
		<tr>
      <!--
		<td>Email<span>*</span></td>
		<td><input type="text" name="username" id="username" placeholder="Email" required></td>
		</tr> -->
		<tr>

		<tr>
		<td>CNI<span>*</span></td>
		<td><input type="text" name="cni" id="cni" placeholder="Carte nationale d'identité" required></td>
		</tr>
    <tr>
		<td>CNE <span>*</span></td>
		<td><input type="text" name="cne" id="cne" placeholder="Code national d'etudiante" required></td>
		</tr>
    <td>Filière <span>*</span></td>
		<td><input type="text" name="filier" id="cni" placeholder="Filière " required></td>

    <tr>
    <td>Niveau <span>*</span></td>
		<td><select name="annee">
  <option value="Première Année">Première Année</option>
  <option value="Deuxième Année">Deuxième Année</option>
  <option value="Licence professionnelle">Licence professionnelle</option>
</select></td>
</tr>
		<tr>

		<tr>
		<td></td>
		<td><input type="submit" value="Ajouter l'étudiant(e)"/><input type="reset" value="repeter"/></td>
		</tr>
		</table>
	</form>

  <div class = "col-lg-6">


    <form action="traitement.php" method="post" enctype="multipart/form-data">
      <table class="login_table">
<tr>
    <td><h2>Téléchargement d'un fichier CSV</h2></td>
</tr>
<tr>
  <td><label for="csvFile">Sélectionnez un fichier CSV :</label></td>
<tr>
        <td><input type="file" id="csvFile" name="csvFile" accept=".csv"></td>
</tr>
        <br><br>
<tr>
        <td><input type="submit" value="Télécharger"></td>
</tr>
      </table>  
    </form>


</div>
</fieldset>


  </div>
</div>
     
  </div>
</div>
<?php
include('composant/footer.php')
?>
</body>
</html>
<?php 
}
else{
  header('Location: index.php');
}





<?php
  //connexion à la base de données
  $con = mysqli_connect("localhost","root","","esto");
  if(!$con){
     echo "Vous n'êtes pas connecté à la base de donnée";
  }

  //connexion a la base de données

  //récupération de l'id dans le lien
  $id= $_GET['id'];
  //requête de suppression
 
  $req = mysqli_query($con , " UPDATE etudiant SET sup = '0' WHERE id_etudiant = $id");
  //redirection vers la page index.php
  header("Location:etudiant2.php")
?>
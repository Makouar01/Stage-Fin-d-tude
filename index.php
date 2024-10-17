<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['prof']) && !isset($_SESSION['etudiant'])) {

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css" />
  <link rel="shortcut icon" href="" />
  <link rel="stylesheet" href="CSS/theme.css" />
  <link rel="stylesheet" href="CSS/esto.css" />
  <script type="text/javascript" src="JQ/jquery-2.2.1.min.js"></script>
  <script type="text/javascript" src="JS/esto.js"></script>
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
 

      <li class="active"><a href="index.php">Acceuil</a></li>
    </ul>
  </div>



  <div class="col-lg-6">
    <div id="iscri">

        <form method="post" action="user.php">
          <input type="text" name="email" placeholder="E-mail" required />
          <input type="password" name="pwd" placeholder="Mot de pas" required />
          <a><input type="submit" value="Se connecter " /></a>


        </form>


    </div>
  </div>
  <div class="col-lg-12">
    <div class="tableau">

      <div class="panel panel-default">

        <div class="container">
          <div id="ninja-slider">
            <div class="slider-inner">
              <ul>
                <li><img class="ns-img" src="IMG/im1.jpg"></li>
                <li><img class="ns-img" src="IMG/im2.jpeg"></li>
                <li><img class="ns-img" src="IMG/im3.jpeg"></li>
                <li><img class="ns-img" src="IMG/im4.jpg"></li>
              </ul>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          var tag = document.createElement('script');

          tag.src = "https://www.youtube.com/player_api";
          var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

          var player;

          function onYouTubeIframeAPIReady() {
            player = new YT.Player('ytplayer', {
              events: {
                'onReady': onPlayerReady
              }
            });
          }

          function onPlayerReady() {
            player.playVideo();
            // Mute!
            player.mute();
          }
        </script>
        
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <footer class="footer">
      <?php include('composant/footer.php'); ?>
    </footer>
  </div>

</body>

</html>
<?php 
}

  if (isset($_SESSION['admin'])){
    header('Location:admin.php');
  }
  if (isset($_SESSION['prof'])){
    header('Location:prof.php');
  }
  if (isset($_SESSION['etudiant'])){
    header('Location:etudiant.php');
  }

?>
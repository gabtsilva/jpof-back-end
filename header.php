<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/jpof/style.css">
  <script src="https://kit.fontawesome.com/b052d01902.js" crossorigin="anonymous"></script>
  <?php 
  $page = $_SERVER['PHP_SELF']; 
  switch ($page){
  case '/jpof/index.php':
  $title= 'Accueil';
  break;
  case '/jpof/signin.php':
  $title= 'Connexion';
  break;
  case '/jpof/signup.php':
  $title= 'Inscription';
  break;
  case '/jpof/confirm-signup.php':
  $title= 'Confirmation d\'inscription';
  break;
  case '/jpof/detail.php':
  $title= 'Détail';
  break;
  case '/jpof/show-fav.php':
  $title= 'Favoris';
  break;
  case '/jpof/show-sub.php':
  $title= 'Inscriptions';
  break;
  case '/jpof/detail-conf.php':
  $title= 'Détail conferencier';
  break;
  default:
  $title = 'Back-End';
  }?>
  <title>JPOF - <?php echo $title?></title>
</head>
<body>
<?php

echo "<div class='container-xl'><ul class='d-flex flex-row nav'><li class='nav-item'><a class='nav-link' href='/jpof/'>Accueil</a></li>";
if(isset($_SESSION["token"])){
  if($_SESSION["isadmin"] == 1){
    echo "<li class='nav-item'><a class='nav-link' href='/jpof/admin/'>Back-end</a></li><div class='ml-auto d-flex'><li class='nav-item'><a class='nav-link' href='/jpof/signout.php'>Déconnexion</a></li></div></ul>";
  }else{
  echo"<li class='nav-item'><a class='nav-link' href='profile.php'>Mon profil</a></li><div class='ml-auto d-flex'><li class='nav-item'><a class='nav-link' href='signout.php'>Déconnexion</a></li></div></ul>";
  }
}else{
  echo"<div class='ml-auto d-flex'><li class='nav-item'><a class='nav-link' href='sign.php?set=signup'>Inscription</a></li><li class='nav-item'><a class='nav-link' href='sign.php?set=signin'>Connexion</a></li></div></ul>";
}

?>
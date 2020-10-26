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
  case '/jpof/sign.php?set=signin':
  $title= 'Connexion';
  break;
  case '/jpof/sign.php?set=signup':
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

echo "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <a class='navbar-brand' href='#'>FerrEvent - BackEnd</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNav'>
          <ul class='navbar-nav'>
          <div class='ml-auto d-flex'>
            <li class='nav-item'>
              <a class='nav-link' href='/jpof/'>Accueil</a>
            </li>";
if(isset($_SESSION["token"])){
  if($_SESSION["isadmin"] == 1){
    echo "<li class='nav-item'>
            <a class='nav-link' href='/jpof/admin/'>Back-End</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='/jpof/signout.php'>Déconnexion</a>
          </li>
        </ul>
      </div>";
  }else{
    echo "<li class='nav-item'><a class='nav-link' href='profile.php'>Mon profil</a></li>
          
            <li class='nav-item'><a class='nav-link' href='signout.php'>Déconnexion</a></li>
          </div>
        </ul>";
  }
}else{
    echo "
            <li class='nav-item'><a class='nav-link' href='sign.php?set=signup'>Inscription</a></li>
            <li class='nav-item'><a class='nav-link' href='sign.php?set=signin'>Connexion</a></li>
          </div>
        </ul>";
}
echo "</nav>";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/jpof/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="https://kit.fontawesome.com/b052d01902.js" crossorigin="anonymous"></script>
  <title>JPOF - Back-End</title>
</head>
<body>
<?php
echo "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
          <ul class='navbar-nav'>
            <div class='ml-auto d-flex'>
              <li class='nav-item'>
                <a class='nav-link' href='index.php'><i title='Accueil' class='fas mx-2 fa-home'></i></a>
              </li>";
              if(isset($_SESSION["token"]) && $_SESSION["isadmin"] == 1){
                echo "<li class='nav-item'>
                        <a class='nav-link' href='settings.php'><i title='Paramètres' class='fas mx-2 fa-cog'></i></a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link' href='includes/signout.inc.php'><i title='Déconnexion' class='fas mx-2 fa-sign-out-alt'></i></a>
                      </li>";
              }else{
                echo "<li class='nav-item'>
                <a class='nav-link' href='settings.php'><i title='Connexion' class='fas mx-2 fa-sign-in-alt'></i></a>
              </li>";
              }
            echo "</div>
                </ul>
              </nav>
              <div class=' my-2'>
                <div class='col-10 d-flex'>
                  <a href='data-manage.php?table=speakers' class='btn btn-info col-2 justify-content-center align-items-center d-flex menu-icon m-1 p-3'>
                      <i class='fas mr-2 fa-users'></i>
                      CONFÉRENCIERS
                  </a>
                  <a href='data-manage.php?table=buildings' class='btn btn-warning col-2 justify-content-center align-items-center d-flex menu-icon m-1 p-3'>
                      <i class='fas mr-2 fa-building'></i>
                      CAMPUS
                  </a>
                  <a href='data-manage.php?table=rooms' class='btn btn-primary col-2 justify-content-center align-items-center d-flex menu-icon m-1 p-3'>
                    <i class='fas mr-2 fa-door-open'></i>
                    LOCAUX
                  </a>
                  <a href='data-manage.php?table=activities' class='btn btn-secondary col-2 justify-content-center align-items-center d-flex menu-icon m-1 p-3'>
                      <i class='fas mr-2 fa-archive'></i>
                      ACTIVITÉS
                  </a>
                  <a href='data-manage.php?table=events' class='btn btn-success col-2 justify-content-center align-items-center d-flex menu-icon m-1 p-3'>
                      <i class='fas mr-2 fa-building'></i>
                      ÉVÉNEMENTS
                  </a>
                  <a href ='data-manage.php?table=departments' class='btn btn-dark col-2 justify-content-center align-items-center d-flex menu-icon m-1 p-3'>
                      <i class='fas mr-2 fa-building'></i>
                      DÉPARTEMENTS
                  </a>
                </div>
                </div>
                <div class='col-11'>";
?>
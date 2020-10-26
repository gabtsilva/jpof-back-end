<?php
// Démarrage de la session et vérification de la connexion utilisateur
session_start();
require "../header.php";
if(isset($_SESSION["token"])){



// Affichage de l'index Back-End pour ajout ou gestion des données
echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'>Accueil</li></ol></div><h1>Que souhaitez-vous faire?</h1><div class='list-group-flush'><a href='add.php?table=events' class='list-group-item list-group-item-action'>Ajouter un événement</a><a href='add.php?table=activities' class='list-group-item list-group-item-action'>Ajouter une activité</a><a href='add.php?table=room' class='list-group-item list-group-item-action'>Ajouter un local</a><a href='add.php?table=building' class='list-group-item list-group-item-action'>Ajouter un campus</a><a href='add.php?table=section' class='list-group-item list-group-item-action'>Ajouter une catégorie</a><a href='add.php?table=conf' class='list-group-item list-group-item-action'>Ajouter un conférencier</a></div><div class='list-group list-group-2'><a href='data-menu.php' class='list-group-item list-group-item-action'>Gérer les données</a></div>";

require "../footer.php";

// Renvoi automatique vers l'index si pas loggé
}else{
  header("Location:../index.php?error");
}
?>
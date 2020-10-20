<?php
// Démarrage de la session et vérification de la connexion utilisateur
session_start();
if(isset($_SESSION["token"])){

require "../header.php";
require "includes/conn.inc.php";

// Récupération de l'id et affichage des événements
$id = $_GET["id"];
$sql = "SELECT * FROM activities WHERE activity_id = $id";
$result = $conn->query($sql)->fetch();
$activityName = $result["activity_name"];
echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data/data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'><a href='data/data-manage.php?table=activities'>Gérer les activités</a></li></ol></div><h1><span class='e-name'>$activityName</span></h1><h2>Liste des inscriptions</h2><table class='table table-striped'><tr class='thead-light'><th>Nom</th><th>Prénom</th><th>E-mail</th><th></th><tr>";

$sql = "SELECT * FROM users LEFT JOIN registrations ON users.user_token = registrations.user_token WHERE registrations.activity_id = $id";
$result = $conn->query($sql);
foreach($result as $row){
  echo "<tr><td>".$row["user_name"]."</td><td>".$row["user_surname"]."</td><td>".$row["user_email"]."</td><td class='modsup'><a href='delete-activity.php?id=".$row["user_id"]."'><i class='fas fa-trash-alt'></i></a></td></tr>";
}
echo "</table>";

echo "<h2>Liste des favoris</h2><table class='table table-striped'><tr class='thead-light'><th>Nom</th><th>Prénom</th><th>E-mail</th><tr>";
$sql = "SELECT * FROM users LEFT JOIN favorites ON users.user_token = favorites.user_token WHERE favorites.activity_id = $id";
$result = $conn->query($sql);
foreach($result as $row){
  echo "<tr><td>".$row["user_name"]."</td><td>".$row["user_surname"]."</td><td>".$row["user_email"]."</td></tr>";
}


require "../footer.php";

// Renvoi automatique vers l'index si pas loggé
}else{
  header("Location:../index.php?error");
}
?>
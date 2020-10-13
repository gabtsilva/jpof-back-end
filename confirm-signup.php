<?php 
session_start();
require "admin/includes/conn.inc.php";
require "header.php";

if(isset($_GET["confirm-signup"])){
  echo " <h2>Bravo! Vous êtes bien inscrit au site JPOF</h2><p class='signup-text'>Vous avez reçu un mail de confirmation, veuillez cliquer sur le lien qu'il contient pour pouvoir commencer à utiliser votre compte.</p><a class='btn btn-success btn-confirm-signup' href='index.php'>Retourner à la page d'accueil</a> ";
}else{
  header("Location: index.php");
}


require "footer.php";

?>

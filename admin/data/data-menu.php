<?php 
session_start();
if(isset($_SESSION["token"])){
require "../../header.php";

echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'>Gérer les données</li></ol></div><h1>Quelles données souhaitez-vous gérer ?</h1><div class='list-group-flush'><a href='data-manage.php?table=events' class='list-group-item list-group-item-action'>Gérer les événements</a><a href='data-manage.php?table=room' class='list-group-item list-group-item-action in'>Gérer les locaux</a><a href='data-manage.php?table=building' class='list-group-item list-group-item-action'>Gérer les campus</a><a href='data-manage.php?table=section' class='list-group-item list-group-item-action'>Gérer les catégories</a><a href='data-manage.php?table=conf' class='list-group-item list-group-item-action'>Gérer les conférenciers</a></div>";
require "../../footer.php";
}else{
  header("Location:../index.php?error");
}
?>
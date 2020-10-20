<?php
session_start();
if(isset($_SESSION["token"])){
require "../includes/conn.inc.php";
require "../../header.php";

$table=$_GET["table"];

if($table === "section"){
  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'>Gérer les catégories</li></ol></div><h1>Liste des catégories</h1><small>Cliquez sur une entrée pour la modifier</small><table class='table table-striped'>";
  echo "<tr class='thead-light'><th>#</th><th>Nom</th><th>Campus associé</th><th>Tel</th><th>Mail</th><th></th><tr>";
  $sql = "SELECT * FROM categories LEFT JOIN buildings ON categories.building_id = buildings.building_id";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr><td>".$row["category_id"]."</td><td><a href='../update.php?id=".$row["category_id"]."&table=section'>".$row["category_name"]."</a></td><td>".$row["building_name"]."</td><td>".$row["category_number"]."</td><td>".$row["category_email"]."</td><td class='modsup'><a href='../delete.php?id=".$row["category_id"]."&table=section'><i class='fas fa-trash-alt'></i></a></td></tr>";
  }
}else if($table === "building"){
  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data-menu.php'>Gérer les campus</a></li><li class='breadcrumb-item active'>Gérer les sections</li></ol></div><h1>Liste des campus</h1><small>Cliquez sur une entrée pour la modifier</small><table class='table table-striped'>";
  echo "<tr class='thead-light'><th>#</th><th>Nom</th><th>Adresse</th><th>CP - Ville</th><th></th><tr>";
  $sql = "SELECT * FROM buildings";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr><td>".$row["building_id"]."</td><td><a href=../update.php?id=".$row["building_id"]."&table=building>".$row["building_name"]."</a></td><td>".$row["building_street"].", n°".$row["building_number"]."</td><td>".$row["building_cp"]." - ".$row["building_city"]."</td><td class='modsup'><a href='../delete.php?id=".$row["building_id"]."&table=building'><i class='fas fa-trash-alt'></i></a></td></tr>";
  }
}else if($table === "conf"){
  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data-menu.php'>Gérer les conférenciers</a></li><li class='breadcrumb-item active'>Gérer les sections</li></ol></div><h1>Liste des conférenciers</h1><small>Cliquez sur une entrée pour la modifier</small><table class='table table-striped'>";
  echo "<tr class='thead-light'><th>#</th><th>Nom</th><th>Prénom</th><th>LinkedIn</th><th></th><tr>";
  $sql = "SELECT * FROM speakers";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr><td>".$row["speaker_id"]."</td><td><a href='../update.php?id=".$row["speaker_id"]."&table=conf'>".$row["speaker_name"]."</a></td><td>".$row["speaker_surname"]."</td><td>".$row["speaker_linkedin"]."</td><td class='modsup'><a href='../delete.php?id=".$row["speaker_id"]."&table=conf'><i class='fas fa-trash-alt'></i></a></td></tr>";
  }
}else if($table === "activities"){
  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'>Gérer les activités</li></ol></div><h1>Liste des activités</h1><small>Cliquez sur une entrée pour la modifier</small><table class='table table-striped'>";
  echo "<tr class='thead-light'><th>Nom</th><th>Implantation</th><th>Local</th><th>Section</th><th>Nombre d'inscrits</th><th>Inscrits/Favoris</th><th></th><tr>";
  $sql = "SELECT activities.*,buildings.*,categories.*, rooms.* FROM activities LEFT JOIN buildings ON activities.building_id = buildings.building_id LEFT JOIN categories ON activities.category_id= categories.category_id LEFT JOIN rooms ON activities.room_id = rooms.room_id";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr><td><a href='../update.php?id=".$row["activity_id"]."&table=activities'>".$row["activity_name"]."</a></td><td>".$row["building_name"]."</a></td><td>".$row["room_name"]."</td><td>".$row["category_name"]."</td>";
    $sql2 = "SELECT * FROM registrations WHERE activity_id = ".$row["activity_id"]."";
    $result2 = $conn->query($sql2);
    $i = 0;
    foreach($result2 as $row2){
      $i++;
    }
    if($row["activity_size"] === "0"){
      echo "<td>$i/∞</td>";
    }else{
      echo "<td>$i/".$row["activity_size"]."</td>";
    }
    echo "<td><a href='../activity-list.php?id=".$row["activity_id"]."'><i class='fas fa-list'></i></a></td><td class='modsup'><a href='../delete.php?id=".$row["activity_id"]."&table=activities'><i class='fas fa-trash-alt'></i></a></td></tr>";
  }
}else if($table === "room"){
  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'>Gérer les locaux</li></ol></div><h1>Liste des locaux</h1><small>Cliquez sur une entrée pour la modifier</small><table class='table table-striped'>";
  echo "<tr class='thead-light'><th>Numéro de local</th><th>Implantation</th><th>Capacité</th><tr>";
  $sql = "SELECT * FROM rooms LEFT JOIN buildings ON rooms.building_id = buildings.building_id ORDER BY building_name";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr><td><a href='../update.php?id=".$row["room_id"]."&table=room'>".$row["room_name"]."</a></td><td>".$row["building_name"]."</a></td><td>".$row["room_capacity"]."</td>";
  }
}
echo "</table>";
require "../../footer.php";
}else{
  header("Location:../index.php?error");  
}
?>
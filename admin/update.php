<?php
// Démarrage de la session et vérification de la connexion utilisateur
session_start();
if(isset($_SESSION["token"])){
require "includes/conn.inc.php";
require "../header.php";

// Récupération ID et Table pour affichage
$id=$_GET["id"];
$table =$_GET["table"];

// Mise à jour d'un bâtiment
if($table === 'building'){
  $sql="SELECT * FROM buildings WHERE building_id=$id";
  $result = $conn->query($sql)->fetch();

  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data/data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'><a href='data/data-manage.php?table=building'>Gérer les campus</a></li><li class='breadcrumb-item active'>".$result["building_name"]."</li></ol></div>";
  echo "<h1>Modifications pour : <span class='e-name'>".$result["building_name"]."</span></h1><form action='confirm-update.php?id=$id&table=building' method='POST'><div class='form-group'><label for='name-building'>Nom du campus</label><input type='text' class='form-control' value='".$result["building_name"]."' id='name-building' name='name-building'></div><div class='row'><div class='form-group col-9'><label for='street-building'>Adresse</label><input type='text' class='form-control' value='".$result["building_street"]."' id='street-building' name='street-building'></div><div class='form-group col'><label for='number-building'>N°</label><input type='text' value='".$result["building_number"]."' class='form-control' id='number-building' name='number-building'></div></div><div class='row'><div class='form-group col'><label for='cp-building'>Code postal</label><input type='text' class='form-control' value='".$result["building_cp"]."' id='cp-building' name='cp-building'></div><div class='form-group col'><label for='city-building'>Ville</label><input type='text' class='form-control' value='".$result["building_city"]."' id='city-building' name='city-building'></div></div><button type='submit' class='btn btn-success'>Mettre à jour</button></form>";

// Mise à jour d'un événement
}else if($table === "events"){

  $sql = "SELECT events.*,buildings.* FROM events LEFT JOIN buildings ON events.building_id = buildings.building_id WHERE event_id = $id ";
  $result = $conn->query($sql)->fetch();
  $building = $result["building_id"];
  $room = $result["room_id"];
  $section = $result["category_id"];
  $conf = $result["event_speaker"];

  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data/data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'><a href='data/data-manage.php?table=events'>Gérer les événements</a></li><li class='breadcrumb-item active'>".$result["event_name"]."</li></ol></div>","<h1>Modifications pour : <span class='e-name'>".$result["event_name"]."</span></h1><form action='confirm-update.php?id=$id&table=events' method='POST'><div class='form-group'><label for='event-name'>Intitulé</label><input type='text' value='".$result["event_name"]."' class='form-control' id='event-name' name='event-name'></div><div class='row'><div class='form-group col'><label for='event-name'>Date</label><input value='".$result["event_date"]."' type='date' class='form-control' id='event-name' name='event-date'></div><div class='form-group col'><label for='event-time'>Tranche horaire</label><div class='input-group'><div class='input-group-prepend'><span class='input-group-text' id='basic-addon1'>De</span></div><input value='".$result["event_start"]."' type ='time' min='08:00' max='18:00' class='form-control' name='event-start'><div class='input-group-prepend'><span class='input-group-text'>À</span></div><input type ='time' min='09:00' value='".$result["event_end"]."' max='18:00' class='form-control' name='event-end'></div></div></div><div class='form-group'><label for='event-desc'>Description</label><textarea class='form-control' name='event-desc' id='event-desc' rows='3'>".$result["event_description"]."</textarea></div><div class='row'><div class='form-group col'><label for='event-building'>Implantation</label><select name='event-building' class='col-auto form-control'>";

  $sql = "SELECT * FROM buildings";
  $result = $conn->query($sql);

  foreach($result as $row){
    if($row["building_id"] === $building){
      echo "<option selected value='".$row["building_id"]."'>".$row["building_name"]."</option>";
    }else{
      echo "<option value='".$row["building_id"]."'>".$row["building_name"]."</option>";
    }
  }

  echo "</select></div><div class='form-group col'><label for='event-local'>Local</label><select name='event-local' class='col-auto form-control'>";

  $sql = "SELECT * FROM rooms";
  $result = $conn->query($sql);

  foreach($result as $row){
    if($row["room_id"] === $room){
      echo "<option selected value='".$row["room_id"]."'>".$row["room_name"]."</option>";
    }else{
      echo "<option value='".$row["room_id"]."'>".$row["room_name"]."</option>";
    }
  }

  echo "</select></div><div class='form-group col'><label for='event-section'>Section</label><select name='event-section' class='col-auto form-control'>";

  $sql = "SELECT * FROM categories";
  $result = $conn->query($sql);

  foreach($result as $row){
    if($row["category_id"] === $section){
      echo "<option selected value='".$row["category_id"]."'>".$row["category_name"]."</option>";
    }else{
      echo "<option value='".$row["category_id"]."'>".$row["category_name"]."</option>";
    }
  }

  $sql = "SELECT * FROM events WHERE event_id = $id ";
  $result = $conn->query($sql)->fetch();

  echo "</select></div></div><div class='form-group'>
  <label for='event_size'>Nombre de places</label>
  <input type='text' class='form-control' name='event-size' value='".$result["event_size"]."'><small>Laisser sur 0 s'il n'y a pas de limite de places</small></div>";
  echo "<div class='form-group'><label for='event-section'>Conférencier</label><select name='event-conf' class='col-auto form-control' required><option disabled selected value> --- </option>";

  $sql = "SELECT * FROM speakers ORDER BY speaker_name ASC";
  $result = $conn->query($sql);

  foreach($result as $row){
    if($row["speaker_id"] === $conf){
      echo "<option selected value='".$row["speaker_id"]."'>".$row["speaker_name"].", ".$row["speaker_surname"]."</option>";
    }else{
      echo "<option value='".$row["speaker_id"]."'>".$row["speaker_name"].", ".$row["speaker_surname"]."</option>";
    }
  }

  echo "</select></div><button type='submit' class='btn btn-success'>Mettre à jour</button><input type='hidden' value='".$id."' name='id'></form>";

// Mise à jour d'une catégorie
}elseif($table === "section"){

  $sql = "SELECT * FROM categories WHERE category_id=$id";
  $result = $conn->query($sql)->fetch();
  $building = $result["building_id"];

  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data/data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'><a href='data/data-manage.php?table=section'>Gérer les sections</a></li><li class='breadcrumb-item active'>".$result["category_name"]."</li></ol></div>";
  echo "<h1>Modifications pour : <span class='e-name'>".$result["category_name"]."</span></h1><form action='confirm-update.php?id=$id&table=section' method='POST'><div class='form-group'><label for='name-section'>Nom</label><input value='".$result["category_name"]."' type='text' class='form-control' id='name-section' name='name-section'></div><div class='form-group'><label for='id-building'>Implantation</label><select name='id-building' class='col-auto form-control'>";

  $sql = "SELECT * FROM buildings ORDER BY building_name ASC";
  $result = $conn->query($sql);

  foreach($result as $row){
    if($row["building_id"] === $building){
      echo "<option selected value='".$row["building_id"]."'>".$row["building_name"]."</option>";
    }else{
      echo "<option value='".$row["building_id"]."'>".$row["building_name"]."</option>";
    }
  }

  $sql = "SELECT * FROM categories WHERE category_id=$id";
  $result = $conn->query($sql)->fetch();
  
  echo "</select></div><div class='row'><div class='form-group col'><label for='num-section'>Téléphone</label><input type='text' class='form-control' id='num-section' value='".$result["category_number"]."' name='num-section'></div><div class='form-group col'><label for='mail-section'>Mail de contact</label><input value='".$result["category_email"]."' type='e-mail' class='form-control' id='mail-section' name='mail-section'></div></div><button type='submit' class='btn btn-success'>Mettre à jour</button></form>";

// Mise à jour d'un conférencier
}elseif($table === "conf"){

  $sql = "SELECT * FROM speakers WHERE speaker_id=$id";
  $result = $conn->query($sql)->fetch();


  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'><a href='data/data-menu.php'>Gérer les données</a></li><li class='breadcrumb-item active'><a href='data/data-manage.php?table=conf'>Gérer les conférenciers</a></li><li class='breadcrumb-item active'>".$result["speaker_name"]." - ".$result["speaker_surname"]."</li></ol></div>";
  echo "<h1>Modifications pour : <span class='e-name'>".$result["speaker_name"]." - ".$result["speaker_surname"]."</span></h1><form action='confirm-update.php?id=".$result["speaker_id"]."&table=conf' enctype='multipart/form-data' method='POST'><div class='row'><div class='form-group col'><label for='name-conf'>Nom</label><input type='text' class='form-control' id='name-conf' value='".$result["speaker_name"]."' name='name-conf'></div><div class='form-group col'><label for='surname-conf'>Prénom</label><input type='text'  value='".$result["speaker_surname"]."' class='form-control' id='surname-conf' name='surname-conf'></div></div><div class='row'><div class='form-group col-7'><label for='linkedin-conf'>LinkedIn</label><input  value='".$result["speaker_linkedin"]."' type='text' class='form-control' id='linkedin-conf' name='linkedin-conf'></div><div class='form-group col'><label for='city-conf'>Image de profil</label><input type='file' class='form-control-file' id='city-conf' name='city-conf'></div></div><button type='submit' class='btn btn-success'>Mettre à jour</button></form>";

// Mise à jour d'un local
}else if($table === "room"){
  $sql = "SELECT * FROM rooms WHERE room_id = $id";
  $result = $conn->query($sql)->fetch();
  $building = $result["building_id"];
  $capacity = $result["room_capacity"];
  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'>Mise à jour local ".$result["room_name"]."</li></ol></div><h1>Mise à jour du local: <span class='e-name'>".$result["room_name"]."</span></h1><form action='confirm-update.php?id=".$result["room_id"]."&table=room' method='POST'><div class='form-group row'><div class='col'><label for='name-room'>Numéro du local</label>
  <input type='text' class='form-control' value='".$result["room_name"]."'name ='name-room' id='name-room'></div><div class='col'><label for='event-local'>Implantation</label><select name='event-local' class='col-auto form-control'><option disabled selected value> --- </option>";

  $sql = "SELECT * FROM buildings ORDER BY building_name ASC";
  $result = $conn->query($sql);

  foreach($result as $row){
    if($row["building_id"] === $building){
      echo "<option selected value='".$row["building_id"]."'>".$row["building_name"]."</option>";
    }else{
      echo "<option value='".$row["building_id"]."'>".$row["building_name"]."</option>";
    }
  }

  echo"</select></div></div><div class='form-group'><label for='capacity-room'>Nombre de places assises</label><input type='text' class='form-control' name='capacity-room' value='$capacity'id='capacity-room'></div><button type='submit' class='btn btn-success'>Mettre à jour</button></form>";
}
require "../footer.php";

// Renvoi automatique vers l'index si pas loggé
}else{
  header("Location:../index.php?error");
}
?>
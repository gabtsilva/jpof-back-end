<?php 
session_start();
require "admin/includes/conn.inc.php";
require "header.php";
$id = $_GET["id"];

$sql = "SELECT *  FROM events LEFT JOIN buildings ON events.building_id = buildings.building_id LEFT JOIN categories ON events.category_id = categories.category_id LEFT JOIN rooms ON events.room_id = rooms.room_id LEFT JOIN speakers ON events.event_speaker = speakers.speaker_id WHERE event_id = $id";
$result = $conn->query($sql)->fetch();
$max_event = $result["event_size"];
$originalDate = $result["event_date"];
$newDate = date("d-m-Y", strtotime($originalDate));
$start_time = date("g:i", strtotime($result["event_start"]));
$end_time = date("G:i", strtotime($result["event_end"]));
echo "<div class='event-detail'><h3>".$result["event_name"]."</h3><h6 class='card-subtitle mb-2 text-muted'>Date: $newDate - Heure: $start_time • $end_time</h6><h6 class='card-subtitle mb-2'>Concerne le département: ".$result["category_name"]." • Local: ".$result["room_name"]." • Bâtiment: ".$result["building_name"]."</h6><h6 class='card-subtitle mb-2'>Présenté par: <a href='detail-conf.php?id=".$result["speaker_id"]."'>".$result["speaker_name"].", ".$result["speaker_surname"]."</a></h6><p class='detail-text card-text'>".$result["event_description"]."</p>";
$sql2 = "SELECT * FROM registrations WHERE event_id = $id";
$result2 = $conn->query($sql2);
$i = 0;
foreach($result2 as $row2){
  $i++;
}
if($max_event == 0){
  echo "<h6 class='card-subtitle mb-2 text-muted'>Nombre d'inscrits: $i/ illimité</h6>";
}elseif($i == $max_event){
  echo "<h6 class='card-subtitle mb-2 text-muted'><span class='e-name'>COMPLET</span></h6>";
}else{
  echo "<h6 class='card-subtitle mb-2 text-muted'>Nombre d'inscrits: $i / $max_event</h6>";
}
require "admin/includes/conn.inc.php";
if(isset($_SESSION["token"]) && $_SESSION["isadmin"] == 0){
  $token = $_SESSION["token"];
  $sql2 = "SELECT * FROM registrations WHERE event_id = $id AND user_token = '$token'";
  $result2 = $conn->query($sql2)->fetch();
  if($result2 != FALSE){
    echo "<a href='sub.php?action=unsub&id=$id' class='card-link'>Se désinscrire de l'événement</a>";
  }else{
    echo "<a href='sub.php?action=sub&id=$id' class='card-link'>S'inscrire à l'événement</a>";
  }
}elseif(isset($_SESSION["isadmin"]) && $_SESSION["isadmin"] == 1){
  
}else{
  echo "<h6 class='card-subtitle mb-2'>Pour pouvoir vous inscrire/ajouter cet événement à vos favoris, veuillez vous <a href='signin.php'>connecter</a>.</h6>";
}

echo "</div>";
if(isset($_SESSION["isadmin"])){
  if($_SESSION["isadmin"] == 1){
    echo "<a class='detail-btn btn btn-warning' href='admin/update.php?table=events&id=$id'>Modifier l'événement</a>";
  }else{
  }
}

require "footer.php";

?>
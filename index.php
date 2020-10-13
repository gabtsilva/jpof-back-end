<?php 
session_start();
require "admin/includes/conn.inc.php";
require "header.php";
echo "<h1>Événements à venir</h1>";
$sql = "SELECT * FROM events ORDER BY event_date DESC";
$result = $conn->query($sql);
foreach($result as $row){
  $originalDate = $row["event_date"];
  $newDate = date("d-m-Y", strtotime($originalDate));
  $start_time = date("G:i", strtotime($row["event_start"]));
  $end_time = date("G:i", strtotime($row["event_end"]));
  if(strlen($row["event_description"]) > 50) $row["event_description"] = substr($row["event_description"], 0, 50).'...';
  echo "<div class='card' style='width: 18rem;'>
  <div class='card-body'><h5 class='card-title'>".$row["event_name"]."</h5><h6 class='card-subtitle mb-2 text-muted'>Date: $newDate</h6><h6 class='card-subtitle mb-2 text-muted'>Heure: $start_time - $end_time</h6><p class='card-text'>".$row["event_description"]."</p><a href='detail.php?id=".$row["event_id"]."' class='card-link'>Détail</a>";
  $conn = null;
  require "admin/includes/conn.inc.php";
  if(isset($_SESSION["token"]) && $_SESSION["isadmin"] == 0){
    $event = $row["event_id"];
    $token = $_SESSION["token"];
    $sql2 = "SELECT * FROM favorites WHERE event_id = $event AND user_token = '$token'";
    $result2 = $conn->query($sql2)->fetch();
    if($result2 != FALSE){
      echo "<a href='fav.php?action=remove&id=".$row["event_id"]."' class='card-link'>Enlever des favoris</a>";
    }else{
      echo "<a href='fav.php?action=add&id=".$row["event_id"]."' class='card-link'>Ajouter aux favoris</a>";
    }
  }else{
  }
  echo "</div></div>";
  
}

require "footer.php";

?>

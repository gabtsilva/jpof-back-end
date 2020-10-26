<?php 
session_start();
require "admin/includes/conn.inc.php";
require "header.php";
$sql = "SELECT * FROM events WHERE event_on = 1";
$result = $conn->query($sql);
foreach($result as $row){
$eventid = $row["event_id"];
echo "<div class='container'><h1>".$row["event_name"]."</h1>";
$sql = "SELECT * FROM activities WHERE event_id = $eventid ORDER BY activity_date DESC";
$result = $conn->query($sql);
foreach($result as $row){
  $originalDate = $row["activity_date"];
  $newDate = date("d-m-Y", strtotime($originalDate));
  $start_time = date("G:i", strtotime($row["activity_start"]));
  $end_time = date("G:i", strtotime($row["activity_end"]));
  if(strlen($row["activity_description"]) > 50) $row["activity_description"] = substr($row["activity_description"], 0, 50).'...';
  echo "<div class='card' style='width: 18rem;'>
  <div class='card-body'><h5 class='card-title'>".$row["activity_name"]."</h5><h6 class='card-subtitle mb-2 text-muted'>Date: $newDate</h6><h6 class='card-subtitle mb-2 text-muted'>Heure: $start_time - $end_time</h6><p class='card-text'>".$row["activity_description"]."</p><a href='detail.php?id=".$row["activity_id"]."' class='card-link'>Détail</a>";
  $conn = null;
  require "admin/includes/conn.inc.php";
  if(isset($_SESSION["token"]) && $_SESSION["isadmin"] == 0){ 
    $activity = $row["activity_id"];
    $token = $_SESSION["token"];
    $sql2 = "SELECT * FROM favorites WHERE activity_id = $activity AND user_token = '$token'";
    $result2 = $conn->query($sql2)->fetch();
    if($result2 != FALSE){
      echo "<a href='fav.php?action=remove&id=".$row["activity_id"]."' class='card-link'>Enlever des favoris</a>";
    }else{
      echo "<a href='fav.php?action=add&id=".$row["activity_id"]."' class='card-link'>Ajouter aux favoris</a>";
    }
  }else{
  }
  echo "</div></div></div>";
  
}
}


require "footer.php";

?>

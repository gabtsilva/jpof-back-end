<?php
session_start();
require "admin/includes/conn.inc.php";
require "header.php";

if(isset($_SESSION["token"])){
    echo "<h2 class='my-3'>Mes favoris</h2>";
    $token = $_SESSION["token"];
    $sql = "SELECT * FROM activities RIGHT JOIN favorites ON activities.activity_id = favorites.activity_id WHERE user_token = '$token'";
    $result = $conn->query($sql)->fetchall();
    foreach($result as $row){
    $originalDate = $row["activity_date"];
    $newDate = date("d-m-Y", strtotime($originalDate));
    $start_time = date("g:i", strtotime($row["activity_start"]));
    $end_time = date("G:i", strtotime($row["activity_end"]));
    if(strlen($row["activity_description"]) > 50) $row["activity_description"] = substr($row["activity_description"], 0, 50).'...';
    echo "<div class='card' style='width: 18rem;'><img class='card-img-top' src='https://images.pexels.com/photos/373488/pexels-photo-373488.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260' alt='Card image cap'><div class='card-body'><h5 class='card-title'>".$row["activity_name"]."</h5><h6 class='card-subtitle mb-2 text-muted'>Date: $newDate</h6><h6 class='card-subtitle mb-2 text-muted'>Heure: $start_time - $end_time</h6><p class='card-text'>".$row["activity_description"]."</p><a href='detail.php?id=".$row["activity_id"]."' class='card-link'>Détail</a>";
    $conn = null;
    require "admin/includes/conn.inc.php";
    if(isset($_SESSION["token"])){
        $activity = $row["activity_id"];
        $token = $_SESSION["token"];
        $sql2 = "SELECT * FROM favorites WHERE activity_id = $activity AND user_token = '$token'";
        $result2 = $conn->query($sql2)->fetch();
        if($result2 != FALSE){
        echo "<a href='fav.php?action=remove&id=".$row["activity_id"]."' class='card-link'>Enlever des favoris</a>";
        }else{
        echo "<a href='fav.php?action=add&id=".$row["activity_id"]."' class='card-link'>Ajouter aux favoris</a>";
        }
    }
    echo "</div></div>";
    }
    echo "<h2 class='my-3'>Mes inscriptions</h2>";
    $sql = "SELECT * FROM activities RIGHT JOIN registrations ON activities.activity_id = registrations.activity_id WHERE user_token = '$token'";
    $result = $conn->query($sql)->fetchall();
    foreach($result as $row){
    $originalDate = $row["activity_date"];
    $newDate = date("d-m-Y", strtotime($originalDate));
    $start_time = date("g:i", strtotime($row["activity_start"]));
    $end_time = date("G:i", strtotime($row["activity_end"]));
    if(strlen($row["activity_description"]) > 50) $row["activity_description"] = substr($row["activity_description"], 0, 50).'...';
    echo "<div class='card' style='width: 18rem;'><img class='card-img-top' src='https://images.pexels.com/photos/373488/pexels-photo-373488.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260' alt='Card image cap'>
    <div class='card-body'><h5 class='card-title'>".$row["activity_name"]."</h5><h6 class='card-subtitle mb-2 text-muted'>Date: $newDate</h6><h6 class='card-subtitle mb-2 text-muted'>Heure: $start_time - $end_time</h6><p class='card-text'>".$row["activity_description"]."</p><a href='detail.php?id=".$row["activity_id"]."' class='card-link'>Détail</a>";
    $conn = null;
    echo "</div></div>";
    }
  }else{
    header("Location:index.php?error"); 
  }

?>
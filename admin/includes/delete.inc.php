<?php

require "conn.inc.php";

// Suppression d'une donnée en particulier (gère toutes les données)
$table=$_GET["table"];
$id=$_GET["id"];

try {
  if ($table === "activities"){
    $sql = "DELETE FROM activities WHERE activity_id=$id";
  } elseif($table === "buildings"){
    $sql = "DELETE FROM buildings WHERE building_id=$id";
  } elseif($table === "departments"){
    $sql = "DELETE FROM categories WHERE category_id=$id";
  } elseif($table === "speakers"){
    $sql = "DELETE FROM speakers WHERE speaker_id=$id";
  }else if($table === "events"){
    $sql = "DELETE FROM events WHERE event_id=$id";
  }else if($table === "rooms"){
    $sql = "DELETE FROM rooms WHERE room_id=$id";
  }
  $conn->exec($sql);
  header("Location:../data-manage.php?table=".$table);
  }
catch(PDOException $e)
  {
  echo $sql . "<br>" . $e->getMessage();
  }

$conn = null;

?>
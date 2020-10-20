<?php

require "includes/conn.inc.php";
require "../header.php";

// Suppression d'une donnée en particulier (gère toutes les données)
$table=$_GET["table"];
$id=$_GET["id"];

try {
  if ($table === "events"){
    $sql = "DELETE FROM activities WHERE activity_id=$id";
  } elseif($table === "building"){
    $sql = "DELETE FROM buildings WHERE building_id=$id";
  } elseif($table === "section"){
    $sql = "DELETE FROM categories WHERE category_id=$id";
  } elseif($table === "conf"){
    $sql = "DELETE FROM speakers WHERE speakers_id=$id";
  }
  $conn->exec($sql);
  header("Location:data/data-manage.php?table=".$table);
  }
catch(PDOException $e)
  {
  echo $sql . "<br>" . $e->getMessage();
  }

$conn = null;

require "../footer.php";

?>
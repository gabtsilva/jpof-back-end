<?php
require "includes/conn.inc.php";
$id = $_GET["id"];
try {
  $sql = "DELETE FROM registrations WHERE registration_id=$id";
  $conn->exec($sql);
  header("Location:".$_SERVER['HTTP_REFERER']);
  }
catch(PDOException $e)
  {
  echo $sql . "<br>" . $e->getMessage();
  }
$conn = null;
?>
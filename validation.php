<?php

require "admin/includes/conn.inc.php";
$token = $_GET["token"];
try {

  $sql = "UPDATE users SET user_validated = 1 WHERE user_token = '$token'";
  $result = $conn->query($sql);
  header("Location: index.php?validated");
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

?>
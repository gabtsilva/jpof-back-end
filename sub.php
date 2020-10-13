<?php 
session_start();
require "admin/includes/conn.inc.php";

$id = $_GET["id"];
$token = $_SESSION["token"];
if($_GET["action"] === "sub"){
  try {

    $sql = "INSERT INTO registrations (activity_id,user_token) VALUES ('$id','$token')";
  
    $conn->exec($sql);
    header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
  
  $conn = null;
}elseif($_GET["action"] === "unsub"){
  try {
  
    $sql = "DELETE FROM registrations WHERE activity_id = $id AND user_token = '$token'";
  
    $conn->exec($sql);
    header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
  
  $conn = null;
}






?>
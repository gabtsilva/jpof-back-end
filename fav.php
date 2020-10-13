<?php 
session_start();
require "admin/includes/conn.inc.php";

$id = $_GET["id"];
$token = $_SESSION["token"];
if($_GET["action"] === "add"){
  try {

    $sql = "INSERT INTO favorites (event_id,user_token) VALUES ('$id','$token')";
  
    $conn->exec($sql);
    header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
  
  $conn = null;
}elseif($_GET["action"] === "remove"){
  try {
  
    $sql = "DELETE FROM favorites WHERE event_id = $id AND user_token = '$token'";
  
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
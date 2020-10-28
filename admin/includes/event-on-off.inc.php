<?php
require "conn.inc.php";
$active = $_GET["active"];
$id = $_GET["id"];

try {

    $sql = "UPDATE events SET event_on = '$active' WHERE event_id =$id";

    $conn->exec($sql);
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

?>
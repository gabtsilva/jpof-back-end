<?php

require "includes/conn.inc.php";
require "../header.php";

$id=$_GET["id"];
$table=$_GET["table"];

if($table === "events"){
  $eventname = $_POST["event-name"];
  $eventdesc = addslashes($_POST["event-desc"]);
  $eventlocal = $_POST["event-local"];
  $eventbuilding = $_POST["event-building"];
  $eventsection = $_POST["event-section"];
  $eventsize = $_POST["event-size"];
  $eventdate = $_POST["event-date"];
  $eventstart = $_POST["event-start"];
  $eventend = $_POST["event-end"];
  $eventconf = $_POST["event-conf"];

  try {

    $sql = "UPDATE events SET event_name='$eventname', event_description='$eventdesc', room_id=$eventlocal, building_id=$eventbuilding, category_id=$eventsection, event_size=$eventsize, event_date='$eventdate', event_start='$eventstart',event_end='$eventend',event_speaker='$eventconf' WHERE event_id = $id";

    $conn->exec($sql);
    header('Location:data/data-manage.php?table=events');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

}else if($table === "building"){

  $name=$_POST["name-building"];
  $street=$_POST["street-building"];
  $number=$_POST["number-building"];
  $cp=$_POST["cp-building"];
  $city=$_POST["city-building"];
  
  try {
  
    $sql = "UPDATE buildings SET building_name='$name',building_street='$street',building_number='$number',building_cp='$cp',building_city='$city' WHERE building_id=$id";
  
    $conn->exec($sql);
    header("Location:data/data-manage.php?table=building");
  }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

}elseif($table === "section"){

  $name=$_POST["name-section"];
  $building=$_POST["id-building"];
  $number=$_POST["num-section"];
  $mail=$_POST["mail-section"];
  
  try {
  
    $sql = "UPDATE categories SET category_name='$name',building_id='$building',category_number='$number',category_email='$mail' WHERE category_id=$id";
  
    $conn->exec($sql);
    header("Location:data/data-manage.php?table=section");
  }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
 
}elseif($table === "conf"){

  $name=$_POST["name-conf"];
  $surname=$_POST["surname-conf"];
  $linkedin=$_POST["linkedin-conf"];
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["pic-conf"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  move_uploaded_file($_FILES["pic-conf"]["tmp_name"], $target_file);
  
  try {
  
    $sql = "UPDATE speakers SET speaker_name='$name',speaker_surname='$surname',speaker_linkedin='$linkedin' WHERE speaker_id=$id";
  
    $conn->exec($sql);
    header("Location:data/data-manage.php?table=conf");
  }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
 
}else if($table === "room"){
  $nameroom = $_POST["name-room"];
  $buildingroom = $_POST["event-local"];
  $capacityroom = $_POST["capacity-room"];

  try {

    $sql = "UPDATE rooms SET room_name='$nameroom',building_id='$buildingroom',room_capacity='$capacityroom' WHERE room_id = $id";

    $conn->exec($sql);
    header('Location:data/data-manage.php?table=room');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null; 
}

$conn = null;
require "../footer.php";

?>
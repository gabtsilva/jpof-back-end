<?php 

require "../header.php";
require "includes/conn.inc.php";

// Insertion d'une catégorie
if($_GET["table"] == "section"){

  $name = $_POST["name-section"];
  $num = $_POST["num-section"];
  $mail = $_POST["mail-section"];
  $building = $_POST["id-building"];
  
  try {
  
    $sql = "INSERT INTO categories (category_name,category_number,category_email,building_id) VALUES ('$name','$num','$mail','$building')";
  
    $conn->exec($sql);
    header('Location:../admin/index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
  
  $conn = null;

// Insertion d'un local
}elseif($_GET["table"] == "room"){

  $nameroom = $_POST["name-room"];
  $buildingroom = $_POST["event-local"];
  $capacityroom = $_POST["capacity-room"];

  try {

    $sql = "INSERT INTO rooms (room_name,building_id,room_capacity) VALUES ('$nameroom','$buildingroom','$capacityroom')";

    $conn->exec($sql);
    header('Location:../admin/index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Insertion d'un événement
}elseif($_GET["table"] == "event"){

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

    $sql = "INSERT INTO events (event_name,event_description,room_id,building_id,category_id,event_size,event_date,event_start,event_end,event_speaker) VALUES ('$eventname','$eventdesc',$eventlocal,$eventbuilding,$eventsection,$eventsize,'$eventdate','$eventstart','$eventend', '$eventconf')";

    $conn->exec($sql);
    header('Location:../admin/index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Insertion d'un bâtiment
}elseif($_GET["table"] == "building"){

  $name = $_POST["name-building"];
  $street = $_POST["street-building"];
  $num = $_POST["number-building"];
  $cp = $_POST["cp-building"];
  $city = $_POST["city-building"];

  try {

    $sql = "INSERT INTO buildings (building_name,building_street,building_number,building_cp,building_city) VALUES ('$name','$street','$num','$cp','$city')";

    $conn->exec($sql);
    header('Location:../admin/index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Insertion d'un conférencier
}elseif($_GET["table"] == "conf"){

  $name = $_POST["name-conf"];
  $surname = $_POST["surname-conf"];
  $linkedin = $_POST["linkedin-conf"];
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["pic-conf"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  move_uploaded_file($_FILES["pic-conf"]["tmp_name"], $target_file);

  try {

    $sql = "INSERT INTO speakers (speaker_name,speaker_surname,speaker_linkedin,speaker_pfp) VALUES ('$name','$surname','$linkedin','$target_file')";

    $conn->exec($sql);
    header('Location:../admin/index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Renvoi vers index en cas d'erreur ou d'arrivée inexpliquée sur la page 
}else{
  header("Location: /jpof/index.php?error");
}

require "../footer.php"; 

?>
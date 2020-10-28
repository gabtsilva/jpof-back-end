<?php 

// require "../../header.php";
require "conn.inc.php";

// Insertion d'une catégorie
if($_GET["table"] == "departments"){

  $name = $_POST["name-section"];
  $num = $_POST["num-section"];
  $mail = $_POST["mail-section"];
  $building = $_POST["id-building"];
  
  try {
  
    $sql = "INSERT INTO categories (category_name,category_number,category_email,building_id) VALUES ('$name','$num','$mail','$building')";
  
    $conn->exec($sql);
    header('Location:../index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
  
  $conn = null;

// Insertion d'un local
}elseif($_GET["table"] == "rooms"){

  $nameroom = $_POST["name-room"];
  $buildingroom = $_POST["activity-local"];
  $capacityroom = $_POST["capacity-room"];

  try {

    $sql = "INSERT INTO rooms (room_name,building_id,room_capacity) VALUES ('$nameroom','$buildingroom','$capacityroom')";

    $conn->exec($sql);
    header('Location:../index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Insertion d'un événement
}elseif($_GET["table"] == "activities"){

  $activityname = $_POST["activity-name"];
  $activitydesc = addslashes($_POST["activity-desc"]);
  $eventid = $_POST["event-id"];
  $activitylocal = $_POST["activity-local"];
  $activitybuilding = $_POST["activity-building"];
  $activitysection = $_POST["activity-section"];
  $activitysize = $_POST["activity-size"];
  $activitydate = $_POST["activity-date"];
  $activitystart = $_POST["activity-start"];
  $activityend = $_POST["activity-end"];
  $activityconf = $_POST["activity-conf"];

  try {

    $sql = "INSERT INTO activities (activity_name,activity_description,room_id,building_id,category_id,activity_size,activity_date,activity_start,activity_end,activity_speaker,event_id) VALUES ('$activityname','$activitydesc',$activitylocal,$activitybuilding,$activitysection,$activitysize,'$activitydate','$activitystart','$activityend', '$activityconf','$eventid')";

    $conn->exec($sql);
    header('Location:../index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Insertion d'un bâtiment
}elseif($_GET["table"] == "buildings"){

  $name = $_POST["name-building"];
  $street = $_POST["street-building"];
  $num = $_POST["number-building"];
  $cp = $_POST["cp-building"];
  $city = $_POST["city-building"];

  try {

    $sql = "INSERT INTO buildings (building_name,building_street,building_number,building_cp,building_city) VALUES ('$name','$street','$num','$cp','$city')";

    $conn->exec($sql);
    header('Location:../index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Insertion d'un conférencier
}elseif($_GET["table"] == "speakers"){

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
    header('Location:../index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

// Renvoi vers index en cas d'erreur ou d'arrivée inexpliquée sur la page 
}else if($_GET["table"] === "event"){
  $eventname = addslashes($_POST["event-name"]);
  $eventdesc = addslashes($_POST["event-desc"]);
  $eventdate = addslashes($_POST["event-date"]);
  $eventactive = $_POST["event-active"];

  try {

    $sql = "INSERT INTO events (event_name,event_description,event_date,event_on) VALUES ('$eventname','$eventdesc','$eventdate','$eventactive')";

    $conn->exec($sql);
    header('Location:../index.php');
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

}else{
  header("Location: /jpof/index.php?error");
}

// require "../../footer.php"; 

?>
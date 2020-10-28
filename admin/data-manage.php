<?php
session_start();
if(isset($_SESSION["token"])){
require "includes/conn.inc.php";
require "header.php";

$table=$_GET["table"];
if($table == "activities"){
  $add = "activités";
}elseif($table == "departments"){
  $add = "départements";
}elseif($table == "rooms"){
  $add = "locaux";
}elseif($table == "speakers"){
  $add = "conférenciers";
}elseif($table == "buildings"){
  $add = "campus";
}elseif($table == "events"){
  $add = "événements";
}
echo "<div class='my-4'>
<ol class='breadcrumb'>
  <li class='breadcrumb-item active'>
    <a href='/jpof/admin/'>Accueil</a>
  </li>
  <li class='breadcrumb-item active'>Gérer les $add </li>
</ol>
</div>
<a href='add.php?table=$table' class='btn my-3 btn-info'>Ajouter des $add</a>";

// TABLE DÉPARTEMENTS
if($table === "departments"){
        echo "<table class='table table-striped'><tr class='thead-light'>
          <th>ID</th>
          <th>Nom</th>
          <th>Campus associé</th>
          <th>Tel</th>
          <th>Mail</th>
          <th></th>
        <tr>";

  $sql = "SELECT * FROM categories LEFT JOIN buildings ON categories.building_id = buildings.building_id";
  $result = $conn->query($sql);

  foreach($result as $row){
    echo "<tr>
            <td>".$row["category_id"]."</td>
            <td>
              <a href='update.php?id=".$row["category_id"]."&table=departments'>".$row["category_name"]."</a>
            </td>
            <td>".$row["building_name"]."</td>
            <td>".$row["category_number"]."</td>
            <td>".$row["category_email"]."</td>
            <td class='modsup'>
              <a href='includes/delete.inc.php?id=".$row["category_id"]."&table=departments'>
                <i class='fas fa-trash-alt'></i>
              </a>
            </td>
          </tr>";
  }

// TABLE CAMPUS
}else if($table === "buildings"){
  echo "<table class='table table-striped'>
          <tr class='thead-light'>
            <th>#</th>
            <th>Nom</th>
            <th>Adresse</th>
            <th>CP - Ville</th>
            <th></th>
          <tr>";

  $sql = "SELECT * FROM buildings";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr>
            <td>".$row["building_id"]."</td>
            <td>
              <a href=update.php?id=".$row["building_id"]."&table=buildings>".$row["building_name"]."</a>
            </td>
            <td>".$row["building_street"].", n°".$row["building_number"]."</td>
            <td>".$row["building_cp"]." - ".$row["building_city"]."</td>
            <td class='modsup'>
              <a href='includes/delete.inc.php?id=".$row["building_id"]."&table=buildings'>
                <i class='fas fa-trash-alt'></i>
              </a>
            </td>
          </tr>";
  }

// TABLE CONFÉRENCIERS
}else if($table === "speakers"){
  echo "<table class='table table-striped'>
        <tr class='thead-light'>
          <th>#</th>
          <th>Nom - Prénom</th>
          <th>LinkedIn</th>
          <th></th>
        <tr>";
  $sql = "SELECT * FROM speakers";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr>
            <td>".$row["speaker_id"]."</td>
            <td>
              <a href='update.php?id=".$row["speaker_id"]."&table=speakers'>".$row["speaker_name"]." - ".$row["speaker_surname"]."</a>
            </td>
            <td>".$row["speaker_linkedin"]."</td>
            <td class='modsup'>
              <a href='includes/delete.inc.php?id=".$row["speaker_id"]."&table=speakers'>
                <i class='fas fa-trash-alt'></i>
              </a>
            </td>
          </tr>";
  }

// TABLE ACTIVITÉS
}else if($table === "activities"){
        echo "<table class='table table-striped'>
          <tr class='thead-light'>
          <th>Nom</th>
          <th>Implantation</th>
          <th>Local</th>
          <th>Département</th>
          <th>Nombre d'inscrits</th>
          <th>Inscrits/Favoris</th>
          <th></th>
        <tr>";

  $sql = "SELECT activities.*,buildings.*,categories.*, rooms.* FROM activities LEFT JOIN buildings ON activities.building_id = buildings.building_id LEFT JOIN categories ON activities.category_id= categories.category_id LEFT JOIN rooms ON activities.room_id = rooms.room_id";

  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr>
            <td>
              <a href='update.php?id=".$row["activity_id"]."&table=activities'>".$row["activity_name"]."</a>
            </td>
            <td>".$row["building_name"]."</td>
            <td>".$row["room_name"]."</td>
            <td>".$row["category_name"]."</td>";

    $sql2 = "SELECT * FROM registrations WHERE activity_id = ".$row["activity_id"]."";
    $result2 = $conn->query($sql2);
    $i = 0;
    foreach($result2 as $row2){
      $i++;
    }
    if($row["activity_size"] === "0"){
      echo "<td>$i/∞</td>";
    }else{
      echo "<td>$i/".$row["activity_size"]."</td>";
    }
    echo "<td>
            <a href='activity-list.php?id=".$row["activity_id"]."'>
              <i class='fas fa-list'></i>
            </a>
          </td>
          <td class='modsup'>
            <a href='includes/delete.inc.php?id=".$row["activity_id"]."&table=activities'>
              <i class='fas fa-trash-alt'></i>
            </a>
          </td>
        </tr>";
  }

// TABLE LOCAUX
}else if($table === "rooms"){
  echo "<table class='table table-striped'>
        <tr class='thead-light'>
          <th>Numéro de local</th>
          <th>Implantation</th>
          <th>Capacité</th>
          <th></th>
        <tr>";
  $sql = "SELECT * FROM rooms LEFT JOIN buildings ON rooms.building_id = buildings.building_id ORDER BY building_name";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr>
            <td>
              <a href='update.php?id=".$row["room_id"]."&table=room'>".$row["room_name"]."</a>
            </td>
            <td>".$row["building_name"]."</td>
            <td>".$row["room_capacity"]."</td>
            <td class='modsup'>
              <a href='includes/delete.inc.php?id=".$row["room_id"]."&table=rooms'>
                <i class='fas fa-trash-alt'></i>
              </a>
            </td>";
  }

// TABLE ÉVÉNEMENTS
}else if($table === "events"){
        echo "<table class='table table-striped'>
        <tr class='thead-light'>
          <th>Nom</th>
          <th>Date</th>
          <th></th>
          <th></th>
        <tr>";

  $sql = "SELECT * FROM events ORDER BY event_name";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<tr>
            <td>
              <a href='update.php?id=".$row["event_id"]."&table=events'>".$row["event_name"]."</a>
            </td>
            <td>".$row["event_date"]."</td>
            <td class='modsup'>
              <a href='delete.php?id=".$row["event_id"]."&table=events'>
                <i class='fas fa-trash-alt'></i>
              </a>
            </td>
            <td>
              <input type='checkbox' ";
              if($row["event_on"] == 1) {
                echo "checked"; 
              } 
              echo " id='".$row["event_id"]."' class='event-btn' data-act='".$row["event_on"]."' data-size='sm' data-toggle='toggle'>
            </td>";
}
}
echo "</table>";
require "footer.php";
}else{
  header("Location:index.php?error");  
}

?>
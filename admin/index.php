<?php 
session_start();
if(isset($_SESSION["token"])){
require "header.php";
require "includes/conn.inc.php";
echo "<div id='accordion'>";
$sql = "SELECT activities.*,events.* FROM events LEFT JOIN activities ON events.event_id = activities.event_id WHERE event_on = 1 GROUP BY events.event_name";
$result = $conn->query($sql);
$j = 0;
foreach($result as $row){
  $id = $row["event_id"];
  echo "
  <div class='card'>
    <div class='card-header' id='heading_$j'>
      <h5 class='mb-0'>
        <button class='btn btn-link collapsed' data-toggle='collapse' data-target='#collapse_$j' aria-expanded='false' aria-controls='collapse_$j'>".$row["event_name"]."</button></h5>
    </div>
    <div id='collapse_$j' class='collapse show' aria-labelledby='heading_$j' data-parent='#accordion'>
      <div class='card-body'>
        <table class='table table-striped'>
          <tr class='thead-light'>
          <th>Nom</th>
          <th>Implantation</th>
          <th>Local</th>
          <th>Département</th>
          <th>Nombre d'inscrits</th>
        </tr>";

  $sql = "SELECT activities.*,buildings.*,categories.*, rooms.* FROM activities LEFT JOIN buildings ON activities.building_id = buildings.building_id LEFT JOIN categories ON activities.category_id= categories.category_id LEFT JOIN rooms ON activities.room_id = rooms.room_id LEFT JOIN events ON activities.event_id = events.event_id WHERE events.event_id = $id";

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
      echo "<td>$i/∞</td></tr>";
    }else{
      echo "<td>$i/".$row["activity_size"]."</td></tr>";
    }
  $j++;
}
echo "</table></div></div></div>";
}
echo "</div>";

require "footer.php";

}else{
  header("Location:sign.php?set=signin");
}
?>